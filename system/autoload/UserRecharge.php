<?php

/**
 * Class UserRecharge
 * Static class to manage user recharge records stored in the database.
 */
class UserRecharge
{

  /**
   * Static method to create a new user recharge record.
   *
   * @param array $data Associative array of data to create the user recharge record.
   * @return int|false ID of the created record or false on failure.
   */
  public static function create($data)
  {
    try {
      $recharge = ORM::for_table('tbl_user_recharges')->create($data);
      $recharge->save();
      return $recharge->id();
    } catch (\Exception $e) {
      // Handle exception (e.g., log error, return false)
      return false;
    }
  }

  /**
   * Static method to update an existing user recharge record.
   *
   * @param int $id ID of the user recharge record to update.
   * @param array $data Associative array of data to update.
   * @return bool True on success, false on failure.
   */
  public static function update($id, $data)
  {
    try {
      $recharge = ORM::for_table('tbl_user_recharges')->find_one($id);
      if ($recharge) {
        foreach ($data as $key => $value) {
          $recharge->$key = $value;
        }
        $recharge->save();
        return true;
      }
      return false;
    } catch (\Exception $e) {
      // Handle exception (e.g., log error, return false)
      return false;
    }
  }

  /**
   * Static method to fetch a user recharge record by ID.
   *
   * @param int $id ID of the user recharge record to fetch.
   * @return array|null Associative array of user recharge record data or null if not found.
   */
  public static function getById($id)
  {
    try {
      $recharge = ORM::for_table('tbl_user_recharges')->find_one($id);
      return $recharge ? $recharge->as_array() : null;
    } catch (\Exception $e) {
      // Handle exception (e.g., log error, return null)
      return null;
    }
  }

  /**
   * Static method to fetch a user recharge record by customer_id.
   *
   * @param int $id ID of the user recharge record to fetch.
   * @return array|null Associative array of user recharge record data or null if not found.
   */
  public static function getByCustomer($id)
  {
    try {
      $recharge = ORM::for_table('tbl_user_recharges')->where("status", "on")->where("customer_id", $id)->find_one();
      return $recharge ? $recharge->as_array() : null;
    } catch (\Exception $e) {
      // Handle exception (e.g., log error, return null)
      return null;
    }
  }

  /**
   * Static method to fetch a user recharge record by attribute.
   *
   * @param attribute ATTRIBUTE of the user recharge record to fetch.
   * @param value ATTRIBUTE value of attribute in db.
   * @return array|null Associative array of user recharge record data or null if not found.
   */
  public static function getByAttribute($attribute, $value)
  {
    try {
      $recharge = ORM::for_table('tbl_user_recharges')->where($attribute, $value);
      return $recharge ? $recharge->as_array() : null;
    } catch (\Exception $e) {
      // Handle exception (e.g., log error, return null)
      return null;
    }
  }
  /**
   * Static method to delete a user recharge record by ID.
   *
   * @param int $id ID of the user recharge record to delete.
   * @return bool True on success, false on failure.
   */
  public static function delete($id)
  {
    try {
      $recharge = ORM::for_table('tbl_user_recharges')->find_one($id);
      if ($recharge) {
        $recharge->delete();
        return true;
      }
      return false;
    } catch (\Exception $e) {
      // Handle exception (e.g., log error, return false)
      return false;
    }
  }

  /**
   * Static method to fetch all user recharge records.
   *
   * @return array Array of associative arrays representing user recharge records.
   */
  public static function getAll()
  {
    try {
      $recharges = ORM::for_table('tbl_user_recharges')->find_array();
      return $recharges ?: [];
    } catch (\Exception $e) {
      // Handle exception (e.g., log error, return empty array)
      return [];
    }
  }

  /**
   * Static method to serialize a user recharge record to JSON format.
   *
   * @param int $id ID of the user recharge record to serialize.
   * @return string|null JSON representation of the user recharge record or null if not found.
   */
  public static function serializeToJson($id)
  {
    try {
      $recharge = ORM::for_table('tbl_user_recharges')->find_one($id);
      return $recharge ? json_encode($recharge->as_array()) : null;
    } catch (\Exception $e) {
      // Handle exception (e.g., log error, return null)
      return null;
    }
  }

  /**
   * Static methods to get and set properties
   */

  public static function getId($id)
  {
    return self::getById($id)['id'];
  }

  public static function setId($id, $value)
  {
    self::update($id, ['id' => $value]);
  }

  public static function getCustomerId($id)
  {
    return self::getById($id)['customer_id'];
  }

  public static function setCustomerId($id, $value)
  {
    self::update($id, ['customer_id' => $value]);
  }

  public static function getUsername($id)
  {
    return self::getById($id)['username'];
  }

  public static function setUsername($id, $value)
  {
    self::update($id, ['username' => $value]);
  }

  public static function getPlanId($id)
  {
    return self::getById($id)['plan_id'];
  }

  public static function setPlanId($id, $value)
  {
    self::update($id, ['plan_id' => $value]);
  }

  public static function getNamebp($id)
  {
    return self::getById($id)['namebp'];
  }

  public static function setNamebp($id, $value)
  {
    self::update($id, ['namebp' => $value]);
  }

  public static function getRechargedOn($id)
  {
    return self::getById($id)['recharged_on'];
  }

  public static function setRechargedOn($id, $value)
  {
    self::update($id, ['recharged_on' => $value]);
  }

  public static function getRechargedTime($id)
  {
    return self::getById($id)['recharged_time'];
  }

  public static function setRechargedTime($id, $value)
  {
    self::update($id, ['recharged_time' => $value]);
  }

  public static function getExpiration($id)
  {
    return self::getById($id)['expiration'];
  }

  public static function setExpiration($id, $value)
  {
    self::update($id, ['expiration' => $value]);
  }

  public static function getTime($id)
  {
    return self::getById($id)['time'];
  }

  public static function setTime($id, $value)
  {
    self::update($id, ['time' => $value]);
  }

  public static function getStatus($id)
  {
    return self::getById($id)['status'];
  }

  public static function setStatus($id, $value)
  {
    self::update($id, ['status' => $value]);
  }

  public static function getMethod($id)
  {
    return self::getById($id)['method'];
  }

  public static function setMethod($id, $value)
  {
    self::update($id, ['method' => $value]);
  }

  public static function getRouters($id)
  {
    return self::getById($id)['routers'];
  }

  public static function setRouters($id, $value)
  {
    self::update($id, ['routers' => $value]);
  }

  public static function getType($id)
  {
    return self::getById($id)['type'];
  }

  public static function setType($id, $value)
  {
    self::update($id, ['type' => $value]);
  }

  public static function getAdminId($id)
  {
    return self::getById($id)['admin_id'];
  }

  public static function setAdminId($id, $value)
  {
    self::update($id, ['admin_id' => $value]);
  }
}
