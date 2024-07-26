<?php
/**
 *  PHP Mikrotik Billing (https://zeiteckispradius.zeiteckcomputers.co.ke/)
 *  by https://t.me/Zadok
 **/

if(Admin::getID()){
    r2(U.'dashboard');
}if(User::getID()){
    r2(U.'home');
}else{
    r2(U.'login');
}
