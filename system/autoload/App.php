<?php
/**
 *  PHP Mikrotik Billing (https://zeiteckispradius.zeiteckcomputers.co.ke/)
 *  by https://t.me/Zadok
 **/


class App{
    public static function _run(){
        return true;
    }

    public static function getToken(){
        return md5(microtime());
    }

    public static function setToken($token, $value){
        $_SESSION[$token] = $value;
    }

    public static function getTokenValue($key){
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        }else{
            return "";
        }
    }

}