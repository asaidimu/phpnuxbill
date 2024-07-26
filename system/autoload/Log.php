<?php

/**
 *  PHP Mikrotik Billing (https://zeiteckispradius.zeiteckcomputers.co.ke/)
 *  by https://t.me/Zadok
 **/


class Log{
    public static function put($type, $description, $userid = '', $username = '')
    {
        $d = ORM::for_table('tbl_logs')->create();
        $d->date = date('Y-m-d H:i:s');
        $d->type = $type;
        $d->description = $description;
        $d->userid = $userid;
        $d->ip = (empty($username)) ? $_SERVER["REMOTE_ADDR"] : $username;
        $d->save();
    }

    public static function arrayToText($array, $start = '', $result = '')
    {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                $result = Log::arrayToText($v, "$start$k.", $result);
            } else {
                $result .= $start.$k ." : ". strval($v) ."\n";
            }
        }
        return $result;
    }
}