<?php
/**
 * Class Router
 * Static class to manage router records stored in the database.
 */
class Router {

    /**
     * Static method to create a new router record.
     *
     * @param array $data Associative array of data to create the router record.
     * @return int|false ID of the created record or false on failure.
     */
    public static function create($data) {
        try {
            $router = ORM::for_table('tbl_routers')->create($data);
            $router->save();
            return $router->id();
        } catch (\Exception $e) {
            // Handle exception (e.g., log error, return false)
            return false;
        }
    }

    /**
     * Static method to update an existing router record.
     *
     * @param int $id ID of the router record to update.
     * @param array $data Associative array of data to update.
     * @return bool True on success, false on failure.
     */
    public static function update($id, $data) {
        try {
            $router = ORM::for_table('tbl_routers')->find_one($id);
            if ($router) {
                foreach ($data as $key => $value) {
                    $router->$key = $value;
                }
                $router->save();
                return true;
            }
            return false;
        } catch (\Exception $e) {
            // Handle exception (e.g., log error, return false)
            return false;
        }
    }

    /**
     * Static method to fetch a router record by ID.
     *
     * @param int $id ID of the router record to fetch.
     * @return array|null Associative array of router record data or null if not found.
     */
    public static function getById($id) {
        try {
            $router = ORM::for_table('tbl_routers')->find_one($id);
            return $router ? $router->as_array() : null;
        } catch (\Exception $e) {
            // Handle exception (e.g., log error, return null)
            return null;
        }
    }

    /**
     * Static method to delete a router record by ID.
     *
     * @param int $id ID of the router record to delete.
     * @return bool True on success, false on failure.
     */
    public static function delete($id) {
        try {
            $router = ORM::for_table('tbl_routers')->find_one($id);
            if ($router) {
                $router->delete();
                return true;
            }
            return false;
        } catch (\Exception $e) {
            // Handle exception (e.g., log error, return false)
            return false;
        }
    }

    /**
     * Static method to fetch all router records.
     *
     * @return array Array of associative arrays representing router records.
     */
    public static function getAll() {
        try {
            $routers = ORM::for_table('tbl_routers')->find_array();
            return $routers ?: [];
        } catch (\Exception $e) {
            // Handle exception (e.g., log error, return empty array)
            return [];
        }
    }

    /**
     * Static method to serialize a router record to JSON format.
     *
     * @param int $id ID of the router record to serialize.
     * @return string|null JSON representation of the router record or null if not found.
     */
    public static function serializeToJson($id) {
        try {
            $router = ORM::for_table('tbl_routers')->find_one($id);
            return $router ? json_encode($router->as_array()) : null;
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

    public static function getName($id) {
        return self::getById($id)['name'];
    }

    public static function setName($id, $value) {
        self::update($id, ['name' => $value]);
    }

    public static function getIpAddress($id) {
        return self::getById($id)['ip_address'];
    }

    public static function setIpAddress($id, $value) {
        self::update($id, ['ip_address' => $value]);
    }

    public static function getUsername($id) {
        return self::getById($id)['username'];
    }

    public static function setUsername($id, $value) {
        self::update($id, ['username' => $value]);
    }

    public static function getPassword($id) {
        return self::getById($id)['password'];
    }

    public static function setPassword($id, $value) {
        self::update($id, ['password' => $value]);
    }

    public static function getDescription($id) {
        return self::getById($id)['description'];
    }

    public static function setDescription($id, $value) {
        self::update($id, ['description' => $value]);
    }

    public static function getEnabled($id) {
        return self::getById($id)['enabled'];
    }

    public static function setEnabled($id, $value) {
        self::update($id, ['enabled' => $value]);
    }
}
?>
