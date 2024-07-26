<?php

/**
 *  PHP Mikrotik Billing (https://zeiteckispradius.zeiteckcomputers.co.ke/)
 *  by https://t.me/Zadok
 **/

$maintenance_mode = $config['maintenance_mode'];
if ($maintenance_mode == true) {
    displayMaintenanceMessage();
}

if(Admin::getID()) {
    r2(U.'dashboard', "s", Lang::T("You are already logged in"));
}

if (User::getID()) {
    r2(U . 'home');
}

if (isset($routes['1'])) {
    $do = $routes['1'];
} else {
    $do = 'login-display';
}

switch ($do) {
    case 'post':
        $username = _post('username');
        $password = _post('password');
        run_hook('customer_login'); #HOOK
        if ($username != '' and $password != '') {
            $type = "customer";
            $d = ORM::for_table('tbl_customers')->where('username', $username)->find_one();
            if(empty($d)) {
                $type = "admin";
                $d = ORM::for_table('tbl_users')->where('username', $username)->find_one();
            }
            if ($d) {
                $d_pass = $d['password'];
                if ($type == "customer" && $d['status'] == 'Banned') {
                    _alert(Lang::T('This account status') . ' : ' . Lang::T($d['status']), 'danger', "");
                }
                $verified = false;
                if($type = "customer") {
                    $verified = Password::_uverify($password, $d_pass);
                } else {
                    $verified = Password::_verify($password, $d_pass);
                }
                if ($verified) {
                    if($type == "customer") {
                        $_SESSION['uid'] = $d['id'];
                        User::setCookie($d['id']);
                        $d->last_login = date('Y-m-d H:i:s');
                        $d->save();
                        _log($username . ' ' . Lang::T('Login Successful'), 'User', $d['id']);
                        r2(U . 'home');
                    } else {
                        $_SESSION['aid'] = $d['id'];
                        $token = Admin::setCookie($d['id']);
                        $d->last_login = date('Y-m-d H:i:s');
                        $d->save();
                        r2(U . 'dashboard');
                        _log($username . ' ' . Lang::T('Login Successful'), $d['user_type'], $d['id']);
                    }
                } else {
                    _msglog('e', Lang::T('Invalid Username and Password 1'));
                    _log($username . ' ' . Lang::T('Failed Login'), 'User');
                    r2(U . 'login');
                }
            } else {
                _msglog('e', Lang::T('Invalid Username or Password 2'. $type));
                r2(U . 'login');
            }
        } else {
            _msglog('e', Lang::T('Invalid Username or Password 3'));
            r2(U . 'login');
        }

        break;

    case 'activation':
        $voucher = _post('voucher');
        $username = _post('username');
        $v1 = ORM::for_table('tbl_voucher')->where('code', $voucher)->find_one();
        if ($v1) {
            // voucher exists, check customer exists or not
            $user = ORM::for_table('tbl_customers')->where('username', $username)->find_one();
            if (!$user) {
                $d = ORM::for_table('tbl_customers')->create();
                $d->username = alphanumeric($username, "+_.@");
                $d->password = $voucher;
                $d->fullname = '';
                $d->address = '';
                $d->email = '';
                $d->phonenumber = (strlen($username) < 21) ? $username : '';
                if ($d->save()) {
                    $user = ORM::for_table('tbl_customers')->where('username', $username)->find_one($d->id());
                    if (!$user) {
                        r2(U . 'login', 'e', Lang::T('Voucher activation failed'));
                    }
                } else {
                    _alert(Lang::T('Login Successful'), 'success', "dashboard");
                    r2(U . 'login', 'e', Lang::T('Voucher activation failed') . '.');
                }
            }
            if ($v1['status'] == 0) {
                $oldPass = $user['password'];
                // change customer password to voucher code
                $user->password = $voucher;
                $user->save();
                // voucher activation
                if (Package::rechargeUser($user['id'], $v1['routers'], $v1['id_plan'], "Voucher", $voucher)) {
                    $v1->status = "1";
                    $v1->user = $user['username'];
                    $v1->save();
                    $user->last_login = date('Y-m-d H:i:s');
                    $user->save();
                    // add customer to mikrotik
                    if (!empty($_SESSION['nux-mac']) && !empty($_SESSION['nux-ip'])) {
                        try {
                            $p = ORM::for_table('tbl_plans')->where('id', $v1['id_plan'])->find_one();
                            $dvc = Package::getDevice($p);
                            if ($_app_stage != 'demo') {
                                if (file_exists($dvc)) {
                                    require_once $dvc;
                                    (new $p['device']())->connect_customer($user, $_SESSION['nux-ip'], $_SESSION['nux-mac'], $v1['routers']);
                                    if (!empty($config['voucher_redirect'])) {
                                        r2($config['voucher_redirect'], 's', Lang::T("Voucher activation success, now you can login"));
                                    } else {
                                        r2(U . "login", 's', Lang::T("Voucher activation success, now you can login"));
                                    }
                                } else {
                                    new Exception(Lang::T("Devices Not Found"));
                                }
                            }
                            if (!empty($config['voucher_redirect'])) {
                                r2($config['voucher_redirect'], 's', Lang::T("Voucher activation success, you are connected to internet"));
                            } else {
                                r2(U . "login", 's', Lang::T("Voucher activation success, you are connected to internet"));
                            }
                        } catch (Exception $e) {
                            if (!empty($config['voucher_redirect'])) {
                                r2($config['voucher_redirect'], 's', Lang::T("Voucher activation success, now you can login"));
                            } else {
                                r2(U . "login", 's', Lang::T("Voucher activation success, now you can login"));
                            }
                        }
                    }
                    if (!empty($config['voucher_redirect'])) {
                        r2($config['voucher_redirect'], 's', Lang::T("Voucher activation success, now you can login"));
                    } else {
                        r2(U . "login", 's', Lang::T("Voucher activation success, now you can login"));
                    }
                } else {
                    // if failed to recharge, restore old password
                    $user->password = $oldPass;
                    $user->save();
                    r2(U . 'login', 'e', Lang::T("Failed to activate voucher"));
                }
            } else {
                // used voucher
                // check if voucher used by this username
                if ($v1['user'] == $user['username']) {
                    $user->last_login = date('Y-m-d H:i:s');
                    $user->save();
                    if (!empty($_SESSION['nux-mac']) && !empty($_SESSION['nux-ip'])) {
                        try {
                            $p = ORM::for_table('tbl_plans')->where('id', $v1['id_plan'])->find_one();
                            $dvc = Package::getDevice($p);
                            if ($_app_stage != 'demo') {
                                if (file_exists($dvc)) {
                                    require_once $dvc;
                                    (new $p['device']())->connect_customer($user, $_SESSION['nux-ip'], $_SESSION['nux-mac'], $v1['routers']);
                                    if (!empty($config['voucher_redirect'])) {
                                        r2($config['voucher_redirect'], 's', Lang::T("Voucher activation success, now you can login"));
                                    } else {
                                        r2(U . "login", 's', Lang::T("Voucher activation success, now you can login"));
                                    }
                                } else {
                                    new Exception(Lang::T("Devices Not Found"));
                                }
                            }
                            if (!empty($config['voucher_redirect'])) {
                                r2($config['voucher_redirect'], 's', Lang::T("Voucher activation success, you are connected to internet"));
                            } else {
                                r2(U . "login", 's', Lang::T("Voucher activation success, now you can login"));
                            }
                        } catch (Exception $e) {
                            if (!empty($config['voucher_redirect'])) {
                                r2($config['voucher_redirect'], 's', Lang::T("Voucher activation success, now you can login"));
                            } else {
                                r2(U . "login", 's', Lang::T("Voucher activation success, now you can login"));
                            }
                        }
                    } else {
                        if (!empty($config['voucher_redirect'])) {
                            r2($config['voucher_redirect'], 's', Lang::T("Voucher activation success, you are connected to internet"));
                        } else {
                            r2(U . "login", 's', Lang::T("Voucher activation success, now you can login"));
                        }
                    }
                } else {
                    // voucher used by other customer
                    r2(U . 'login', 'e', Lang::T('Voucher Not Valid'));
                }
            }
        } else {
            _msglog('e', Lang::T('Invalid Username or Password'));
            r2(U . 'login');
        }
        // no break
    default:
        run_hook('customer_view_login'); #HOOK
        if ($config['disable_registration'] == 'yes') {
            $ui->assign('code', alphanumeric(_get('code'), "-"));
            $ui->display('user-login-noreg.tpl');
        } else {
            $ui->display('user-login.tpl');
        }
        break;
}
