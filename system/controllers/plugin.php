<?php
/**
 *  PHP Mikrotik Billing (https://zeiteckispradius.zeiteckcomputers.co.ke/)
 *  by https://t.me/Zadok
 **/

if(function_exists($routes[1])){
    call_user_func($routes[1]);
}else{
    r2(U.'dashboard', 'e', 'Function not found');
}