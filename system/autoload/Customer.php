<?php
class Customer
{
  private static $defaults;

  public static function init()
  {
    $default_customer = [
      'pppoe_password' => '',
      'address' => null,
      'city' => "Nairobi",
      'district' => "Nairobi",
      'state' => "Kenya",
      'zip' => "+254",
      'phonenumber' => '254715488965',
      'coordinates' => '6.465422, 3.406448',
      'account_type' => 'Personal',
      'balance' => 0.00,
      'service_type' => '',
      'auto_renewal' => 0,
      'status' => 'Active',
      'created_by' => 1,
      'created_at' => date('Y-m-d H:i:s'),
      'last_login' => null
    ];
    self::$defaults = $default_customer;
  }

  public static function create($data)
  {
    self::init();

    $orm = ORM::for_table('tbl_customers');
    $data = array_merge(self::$defaults, $data);
    $data['created_at'] = date('Y-m-d H:i:s');

    $customer = $orm->create();
    foreach ($data as $key => $value) {
      $customer->$key = $value;
    }
    $customer->save();
    return $customer->as_array();
  }

  public static function getById($id)
  {
    $orm = ORM::for_table('tbl_customers');
    $customer = $orm->find_one($id);
    return $customer->as_array();
  }

  public static function getByAttribute($attribute, $value)
  {
    $orm = ORM::for_table('tbl_customers');
    $customer = $orm->where($attribute, $value)->find_one();
    if ($customer) {
      return $customer->as_array();
    }
    return false;
  }

  public static function update($id, $data)
  {
    $orm = ORM::for_table('tbl_customers');
    $customer = $orm->find_one($id);
    if ($customer) {
      foreach ($data as $key => $value) {
        $customer->$key = $value;
      }
      $customer->save();
    }
  }

  public static function delete($id)
  {
    $orm = ORM::for_table('tbl_customers');
    $customer = $orm->find_one($id);
    if ($customer) {
      $customer->delete();
    }
  }

  public static function getAll()
  {
    return ORM::for_table('tbl_customers')->find_array();
  }

  public static function setBalance($id, $value)
  {
    self::update($id, ['balance' => $value]);
  }
}

Customer::init(); // Initialize defaults
