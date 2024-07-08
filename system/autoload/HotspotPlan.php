<?php
/**
 * Class InternetPlan
 * Static class to manage internet plan records stored in the database.
 */
class HotspotPlan {

    /**
     * Static method to create a new internet plan record.
     *
     * @param array $data Associative array of data to create the internet plan record.
     * @return int|false ID of the created record or false on failure.
     */
    public static function create($data) {
        try {
            $plan = ORM::for_table('tbl_plans')->create($data);
            $plan->save();
            return $plan->id();
        } catch (\Exception $e) {
            // Handle exception (e.g., log error, return false)
            return false;
        }
    }

    /**
     * Static method to update an existing internet plan record.
     *
     * @param int $id ID of the internet plan record to update.
     * @param array $data Associative array of data to update.
     * @return bool True on success, false on failure.
     */
    public static function update($id, $data) {
        try {
            $plan = ORM::for_table('tbl_plans')->find_one($id);
            if ($plan) {
                foreach ($data as $key => $value) {
                    $plan->$key = $value;
                }
                $plan->save();
                return true;
            }
            return false;
        } catch (\Exception $e) {
            // Handle exception (e.g., log error, return false)
            return false;
        }
    }

    /**
     * Static method to fetch an internet plan record by ID.
     *
     * @param int $id ID of the internet plan record to fetch.
     * @return array|null Associative array of internet plan record data or null if not found.
     */
    public static function getById($id) {
        try {
            $plan = ORM::for_table('tbl_plans')->find_one($id);
            return $plan ? $plan->as_array() : null;
        } catch (\Exception $e) {
            // Handle exception (e.g., log error, return null)
            return null;
        }
    }

    /**
     * Static method to delete an internet plan record by ID.
     *
     * @param int $id ID of the internet plan record to delete.
     * @return bool True on success, false on failure.
     */
    public static function delete($id) {
        try {
            $plan = ORM::for_table('tbl_plans')->find_one($id);
            if ($plan) {
                $plan->delete();
                return true;
            }
            return false;
        } catch (\Exception $e) {
            // Handle exception (e.g., log error, return false)
            return false;
        }
    }

    /**
     * Static method to fetch all internet plan records.
     *
     * @return array Array of associative arrays representing internet plan records.
     */
    public static function getAll() {
        try {
            $plans = ORM::for_table('tbl_plans')->find_array();
            return $plans ?: [];
        } catch (\Exception $e) {
            // Handle exception (e.g., log error, return empty array)
            return [];
        }
    }

    /**
     * Static method to serialize an internet plan record to JSON format.
     *
     * @param int $id ID of the internet plan record to serialize.
     * @return string|null JSON representation of the internet plan record or null if not found.
     */
    public static function toJson($id) {
        try {
            $plan = ORM::for_table('tbl_plans')->find_one($id);
            return $plan ? json_encode($plan->as_array()) : null;
        } catch (\Exception $e) {
            // Handle exception (e.g., log error, return null)
            return null;
        }
    }

    /**
     * Static methods to get and set properties
     */

    public static function getId($id) {
        return self::getById($id)['id'];
    }

    public static function setId($id, $value) {
        self::update($id, ['id' => $value]);
    }

    public static function getPlanName($id) {
        return self::getById($id)['name_plan'];
    }

    public static function setPlanName($id, $value) {
        self::update($id, ['name_plan' => $value]);
    }

    public static function getBandwidthId($id) {
        return self::getById($id)['id_bw'];
    }

    public static function setBandwidthId($id, $value) {
        self::update($id, ['id_bw' => $value]);
    }

    public static function getPrice($id) {
        return self::getById($id)['price'];
    }

    public static function setPrice($id, $value) {
        self::update($id, ['price' => $value]);
    }

    public static function getPriceOld($id) {
        return self::getById($id)['price_old'];
    }

    public static function setPriceOld($id, $value) {
        self::update($id, ['price_old' => $value]);
    }

    public static function getType($id) {
        return self::getById($id)['type'];
    }

    public static function setType($id, $value) {
        self::update($id, ['type' => $value]);
    }

    public static function getTypebp($id) {
        return self::getById($id)['typebp'];
    }

    public static function setTypebp($id, $value) {
        self::update($id, ['typebp' => $value]);
    }

    public static function getLimitType($id) {
        return self::getById($id)['limit_type'];
    }

    public static function setLimitType($id, $value) {
        self::update($id, ['limit_type' => $value]);
    }

    public static function getTimeLimit($id) {
        return self::getById($id)['time_limit'];
    }

    public static function setTimeLimit($id, $value) {
        self::update($id, ['time_limit' => $value]);
    }

    public static function getTimeUnit($id) {
        return self::getById($id)['time_unit'];
    }

    public static function setTimeUnit($id, $value) {
        self::update($id, ['time_unit' => $value]);
    }

    public static function getDataLimit($id) {
        return self::getById($id)['data_limit'];
    }

    public static function setDataLimit($id, $value) {
        self::update($id, ['data_limit' => $value]);
    }

    public static function getDataUnit($id) {
        return self::getById($id)['data_unit'];
    }

    public static function setDataUnit($id, $value) {
        self::update($id, ['data_unit' => $value]);
    }

    public static function getValidity($id) {
        return self::getById($id)['validity'];
    }

    public static function setValidity($id, $value) {
        self::update($id, ['validity' => $value]);
    }

    public static function getValidityUnit($id) {
        return self::getById($id)['validity_unit'];
    }

    public static function setValidityUnit($id, $value) {
        self::update($id, ['validity_unit' => $value]);
    }

    public static function getSharedUsers($id) {
        return self::getById($id)['shared_users'];
    }

    public static function setSharedUsers($id, $value) {
        self::update($id, ['shared_users' => $value]);
    }

    public static function getRouters($id) {
        return self::getById($id)['routers'];
    }

    public static function setRouters($id, $value) {
        self::update($id, ['routers' => $value]);
    }

    public static function getIsRadius($id) {
        return self::getById($id)['is_radius'];
    }

    public static function setIsRadius($id, $value) {
        self::update($id, ['is_radius' => $value]);
    }

    public static function getPool($id) {
        return self::getById($id)['pool'];
    }

    public static function setPool($id, $value) {
        self::update($id, ['pool' => $value]);
    }

    public static function getPlanExpired($id) {
        return self::getById($id)['plan_expired'];
    }

    public static function setPlanExpired($id, $value) {
        self::update($id, ['plan_expired' => $value]);
    }

    public static function getExpiredDate($id) {
        return self::getById($id)['expired_date'];
    }

    public static function setExpiredDate($id, $value) {
        self::update($id, ['expired_date' => $value]);
    }

    public static function getEnabled($id) {
        return self::getById($id)['enabled'];
    }

    public static function setEnabled($id, $value) {
        self::update($id, ['enabled' => $value]);
    }

    public static function getPrepaid($id) {
        return self::getById($id)['prepaid'];
    }

    public static function setPrepaid($id, $value) {
        self::update($id, ['prepaid' => $value]);
    }

    public static function getPlanType($id) {
        return self::getById($id)['plan_type'];
    }

    public static function setPlanType($id, $value) {
        self::update($id, ['plan_type' => $value]);
    }

    public static function getDevice($id) {
        return self::getById($id)['device'];
    }

    public static function setDevice($id, $value) {
        self::update($id, ['device' => $value]);
    }

    public static function getOnLogin($id) {
        return self::getById($id)['on_login'];
    }

    public static function setOnLogin($id, $value) {
        self::update($id, ['on_login' => $value]);
    }

    public static function getOnLogout($id) {
        return self::getById($id)['on_logout'];
    }

    public static function setOnLogout($id, $value) {
        self::update($id, ['on_logout' => $value]);
    }
}
