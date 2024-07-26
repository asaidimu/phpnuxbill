<?php
/**
 *  PHP Mikrotik Billing (https://zeiteckispradius.zeiteckcomputers.co.ke/)
 *  by https://t.me/Zadok
 **/

run_hook('customer_logout'); #HOOK
if (session_status() == PHP_SESSION_NONE) session_start();
Admin::removeCookie();
User::removeCookie();
session_destroy();
_alert(Lang::T('Logout Successful'),'warning', "login");