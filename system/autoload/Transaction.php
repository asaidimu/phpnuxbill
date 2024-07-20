<?php

/**
 * Class Transaction
 * Static class to manage transaction records stored in the database.
 */
class Transaction
{

    /**
     * Static method to create a new transaction record.
     *
     * @param array $data Associative array of data to create the transaction record.
     * @return int|false ID of the created record or false on failure.
     */
    public static function create($data)
    {
        $invoice = "INV-" . ORM::for_table('tbl_transactions')->max('id') + 1;
        $data["invoice"] = $invoice;
        try {
            $transaction = ORM::for_table('tbl_transactions')->create($data);
            /* foreach ($data as $key => $value) {
                $transaction->$key = $value;
            } */
            $transaction->save();
            return $transaction->id();
        } catch (\Exception $e) {
            // Handle exception (e.g., log error, return false)
            return $e;
        }
    }

    /**
     * Static method to update an existing transaction record.
     *
     * @param int $id ID of the transaction record to update.
     * @param array $data Associative array of data to update.
     * @return bool True on success, false on failure.
     */
    public static function update($id, $data)
    {
        try {
            $transaction = ORM::for_table('tbl_transactions')->find_one($id);
            if ($transaction) {
                foreach ($data as $key => $value) {
                    $transaction->$key = $value;
                }
                $transaction->save();
                return true;
            }
            return false;
        } catch (\Exception $e) {
            // Handle exception (e.g., log error, return false)
            return false;
        }
    }

    /**
     * Static method to fetch a transaction record by ID.
     *
     * @param int $id ID of the transaction record to fetch.
     * @return array|null Associative array of transaction record data or null if not found.
     */
    public static function getById($id)
    {
        try {
            $transaction = ORM::for_table('tbl_transactions')->find_one($id);
            return $transaction ? $transaction->as_array() : null;
        } catch (\Exception $e) {
            // Handle exception (e.g., log error, return null)
            return null;
        }
    }

    /**
     * Static method to delete a transaction record by ID.
     *
     * @param int $id ID of the transaction record to delete.
     * @return bool True on success, false on failure.
     */
    public static function delete($id)
    {
        try {
            $transaction = ORM::for_table('tbl_transactions')->find_one($id);
            if ($transaction) {
                $transaction->delete();
                return true;
            }
            return false;
        } catch (\Exception $e) {
            // Handle exception (e.g., log error, return false)
            return false;
        }
    }

    /**
     * Static method to fetch all transaction records.
     *
     * @return array Array of associative arrays representing transaction records.
     */
    public static function getAll()
    {
        try {
            $transactions = ORM::for_table('tbl_transactions')->find_array();
            return $transactions ?: [];
        } catch (\Exception $e) {
            // Handle exception (e.g., log error, return empty array)
            return [];
        }
    }

    /**
     * Static method to serialize a transaction record to JSON format.
     *
     * @param int $id ID of the transaction record to serialize.
     * @return string|null JSON representation of the transaction record or null if not found.
     */
    public static function serializeToJson($id)
    {
        try {
            $transaction = ORM::for_table('tbl_transactions')->find_one($id);
            return $transaction ? json_encode($transaction->as_array()) : null;
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

    public static function getInvoice($id)
    {
        return self::getById($id)['invoice'];
    }

    public static function setInvoice($id, $value)
    {
        self::update($id, ['invoice' => $value]);
    }

    public static function getUsername($id)
    {
        return self::getById($id)['username'];
    }

    public static function setUsername($id, $value)
    {
        self::update($id, ['username' => $value]);
    }

    public static function getPlanName($id)
    {
        return self::getById($id)['plan_name'];
    }

    public static function setPlanName($id, $value)
    {
        self::update($id, ['plan_name' => $value]);
    }

    public static function getPrice($id)
    {
        return self::getById($id)['price'];
    }

    public static function setPrice($id, $value)
    {
        self::update($id, ['price' => $value]);
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

    public static function getNote($id)
    {
        return self::getById($id)['note'];
    }

    public static function setNote($id, $value)
    {
        self::update($id, ['note' => $value]);
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
