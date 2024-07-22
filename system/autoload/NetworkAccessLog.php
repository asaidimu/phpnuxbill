<?php

class NetworkAccessLog
{
    private static $table = 'tbl_session_logs';
    /**
     * @param mixed $data
     * @return mixed $data
     */
    public static function create($data)
    {
        $record = ORM::for_table(self::$table)->create($data);
        $record->save();
        return $record->as_array();
    }
    /**
     * @param mixed $id
     * @return mixed $data
     */
    public static function find($id)
    {
        try {
            $log = ORM::for_table(self::$table)->find_one($id);
            return $log ? $log->as_array() : null;
        } catch (\Exception $e) {
            // Handle exception (e.g., log error, return null)
            return null;
        }
    }

    /**
     * @param mixed $id
     * @return mixed $data | null
     * @param mixed $attributes
     */
    public static function findWhere($attributes)
    {
        try {
            $query = ORM::for_table(self::$table);
            foreach ($attributes as $key => $value) {
                $query->where($key, $value);
            }
            $log = $query->find_one();
            return $log ? $log->as_array() : null;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * @param mixed $id
     * @param mixed $data
     */
    public static function update($id, $data): void
    {
        $orm = ORM::for_table(self::$table);
        $record = $orm->find_one($id);
        if ($record) {
            foreach ($data as $key => $value) {
                $record->$key = $value;
            }
            $record->save();
        }
    }

    /**
     * @return array
     */
    public static function findActive()
    {
        try {
            $logs = ORM::for_table(self::$table)->where("active", true)->find_array();
            return $logs ?: [];
        } catch (\Exception $e) {
            // Handle exception (e.g., log error, return empty array)
            return [];
        }
    }
    /**
     * @return void
     */
    public static function rotate()
    {
        $date_one_year_ago = date('Y-m-d H:i:s', strtotime('-365 days'));
        ORM::for_table(self:table_name)
            ->where_lt('end', $date_one_year_ago)
            ->delete_many();
    }
}
