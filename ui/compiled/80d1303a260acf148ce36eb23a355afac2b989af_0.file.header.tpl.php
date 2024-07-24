<?php
/* Smarty version 4.5.3, created on 2024-07-24 10:01:39
  from '/home/augustine/projects/NuX/phpnuxbill/ui/ui/sections/header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_66a0a6d3ce51b7_57146425',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '80d1303a260acf148ce36eb23a355afac2b989af' => 
    array (
      0 => '/home/augustine/projects/NuX/phpnuxbill/ui/ui/sections/header.tpl',
      1 => 1721804366,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66a0a6d3ce51b7_57146425 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php echo $_smarty_tpl->tpl_vars['_title']->value;?>
 - <?php echo $_smarty_tpl->tpl_vars['_c']->value['CompanyName'];?>
</title>
    <link rel="shortcut icon" href="ui/ui/images/logo.png" type="image/x-icon" />

    <link rel="stylesheet" href="ui/ui/styles/bootstrap.min.css">

    <link rel="stylesheet" href="ui/ui/fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="ui/ui/fonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="ui/ui/styles/modern-AdminLTE.min.css">
    <link rel="stylesheet" href="ui/ui/styles/select2.min.css" />
    <link rel="stylesheet" href="ui/ui/styles/select2-bootstrap.min.css" />
    <link rel="stylesheet" href="ui/ui/styles/sweetalert2.min.css" />
    <link rel="stylesheet" href="ui/ui/styles/plugins/pace.css" />
    <?php echo '<script'; ?>
 src="ui/ui/scripts/sweetalert2.all.min.js"><?php echo '</script'; ?>
>
    <style>
        ::-moz-selection {
            /* Code for Firefox */
            color: red;
            background: yellow;
        }

        ::selection {
            color: red;
            background: yellow;
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            margin-top: 0px !important;
        }

        @media (min-width: 768px) {
            .outer {
                height: 200px
                    /* Or whatever */
            }
        }

        th:first-child,
        td:first-child {
            position: sticky;
            left: 0px;
            background-color: #f9f9f9;
        }


        .text1line {
            display: block;
            /* or inline-block */
            text-overflow: ellipsis;
            word-wrap: break-word;
            overflow: hidden;
            max-height: 1em;
            line-height: 1em;
        }


        .loading {
            pointer-events: none;
            opacity: 0.7;
        }

        .loading::after {
            content: "";
            display: inline-block;
            width: 16px;
            height: 16px;
            vertical-align: middle;
            margin-left: 10px;
            border: 2px solid #fff;
            border-top-color: transparent;
            border-radius: 50%;
            animation: spin 0.8s infinite linear;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /*
         * maintenance top-bar
         */

        .notification-top-bar {
            position: fixed;
            top: 0;
            left: 0;
            height: 40px;
            line-height: 40px;
            width: 100%;
            background: #ec2106;
            text-align: center;
            color: #FFFFFF;
            font-family: serif;
            font-weight: bolder;
            font-size: 14px;
            z-index: 9999;
            box-sizing: border-box;
            padding: 0 10px;
        }

        .notification-top-bar p {
            padding: 0;
            margin: 0;
        }

        .notification-top-bar p a {
            padding: 5px 10px;
            border-radius: 3px;
            background: #FFF;
            color: #1ABC9C;
            font-weight: bold;
            text-decoration: none;
            display: inline;
            font-size: inherit;
        }

        @media (max-width: 600px) {
            .notification-top-bar {
                font-size: 12px;
                height: auto;
                line-height: normal;
                padding: 10px;
            }

            .notification-top-bar p a {
                padding: 5px 10px;
                margin: 5px 0;
                font-size: 10px;
                display: inline-block;
            }
        }

        .bs-callout {
            padding: 20px;
            margin: 20px 0;
            border: 1px solid #eee;
            border-left-width: 5px;
            border-radius: 3px;
        }

        .bs-callout h4 {
            margin-top: 0;
            margin-bottom: 5px
        }

        .bs-callout p:last-child{
            margin-bottom:0
        }
        .bs-callout code{
            border-radius:3px
        }
        .bs-callout+.bs-callout{
            margin-top:-5px
        }
        .bs-callout-danger{
            border-left-color:#ce4844
        }
        .bs-callout-danger h4{
            color:#ce4844
        }
        .bs-callout-warning{
            border-left-color:#aa6708
        }
        .bs-callout-warning h4{
            color:#aa6708
        }
        .bs-callout-info{
            border-left-color:#1b809e
        }
        .bs-callout-info h4{
            color:#1b809e
        }
    </style>
    <?php if ((isset($_smarty_tpl->tpl_vars['xheader']->value))) {?>
        <?php echo $_smarty_tpl->tpl_vars['xheader']->value;?>

    <?php }?>

</head>

<body class="hold-transition modern-skin-dark sidebar-mini <?php if ($_smarty_tpl->tpl_vars['_kolaps']->value) {?>sidebar-collapse<?php }?>">
    <div class="wrapper">
        <header class="main-header">
            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
dashboard" class="logo">
                <span class="logo-mini"><b>ZEITECK</b>ISP</span>
                <span class="logo-lg"><?php echo $_smarty_tpl->tpl_vars['_c']->value['CompanyName'];?>
</span>
            </a>
            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" onclick="return setKolaps()">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="https://robohash.org/<?php echo $_smarty_tpl->tpl_vars['_admin']->value['id'];?>
?set=set3&size=100x100&bgset=bg1"
                                    onerror="this.src='<?php echo $_smarty_tpl->tpl_vars['UPLOAD_PATH']->value;?>
/admin.default.png'" class="user-image"
                                    alt="Avatar">
                                <span class="hidden-xs"><?php echo $_smarty_tpl->tpl_vars['_admin']->value['fullname'];?>
</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    <img src="https://robohash.org/<?php echo $_smarty_tpl->tpl_vars['_admin']->value['id'];?>
?set=set3&size=100x100&bgset=bg1"
                                        onerror="this.src='<?php echo $_smarty_tpl->tpl_vars['UPLOAD_PATH']->value;?>
/admin.default.png'" class="img-circle"
                                        alt="Avatar">
                                    <p>
                                        <?php echo $_smarty_tpl->tpl_vars['_admin']->value['fullname'];?>

                                        <small><?php echo Lang::T($_smarty_tpl->tpl_vars['_admin']->value['user_type']);?>
</small>
                                    </p>
                                </li>
                                <li class="user-body">
                                    <div class="row">
                                        <div class="col-xs-7 text-center text-sm">
                                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/change-password"><i class="ion ion-settings"></i>
                                                <?php echo Lang::T('Change Password');?>
</a>
                                        </div>
                                        <div class="col-xs-5 text-center text-sm">
                                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/users-view/<?php echo $_smarty_tpl->tpl_vars['_admin']->value['id'];?>
">
                                                <i class="ion ion-person"></i> <?php echo Lang::T('My Account');?>
</a>
                                        </div>
                                    </div>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-right">
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
logout" class="btn btn-default btn-flat"><i
                                                class="ion ion-power"></i> <?php echo Lang::T('Logout');?>
</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="main-sidebar">
            <section class="sidebar">
                <ul class="sidebar-menu" data-widget="tree">
                    <li <?php if ($_smarty_tpl->tpl_vars['_system_menu']->value == 'dashboard') {?>class="active" <?php }?>>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
dashboard">
                            <i class="ion ion-monitor"></i>
                            <span><?php echo Lang::T('Dashboard');?>
</span>
                        </a>
                    </li>
                    <?php echo $_smarty_tpl->tpl_vars['_MENU_AFTER_DASHBOARD']->value;?>

                    <?php if (!in_array($_smarty_tpl->tpl_vars['_admin']->value['user_type'],array('Report'))) {?>
                        <li class="<?php if (in_array($_smarty_tpl->tpl_vars['_system_menu']->value,array('customers','map'))) {?>active<?php }?> treeview">
                            <a href="#">
                                <i class="fa fa-users"></i> <span><?php echo Lang::T('Customer');?>
</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li <?php if ($_smarty_tpl->tpl_vars['_system_menu']->value == 'customers') {?>class="active" <?php }?>><a
                                        href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers"><?php echo Lang::T('Lists');?>
</a></li>
                                <li <?php if ($_smarty_tpl->tpl_vars['_system_menu']->value == 'map') {?>class="active" <?php }?>><a
                                        href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
map/customer"><?php echo Lang::T('Location');?>
</a></li>
                                <?php echo $_smarty_tpl->tpl_vars['_MENU_CUSTOMERS']->value;?>

                            </ul>
                        </li>
                        <?php echo $_smarty_tpl->tpl_vars['_MENU_AFTER_CUSTOMERS']->value;?>

                        <li class="<?php if ($_smarty_tpl->tpl_vars['_system_menu']->value == 'plan') {?>active<?php }?> treeview">
                            <a href="#">
                                <i class="fa fa-ticket"></i> <span><?php echo Lang::T('Services');?>
</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'list') {?>class="active" <?php }?>><a
                                        href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plan/list"><?php echo Lang::T('Active Users');?>
</a></li>
                                <?php if ($_smarty_tpl->tpl_vars['_c']->value['disable_voucher'] != 'yes') {?>
                                    <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'voucher') {?>class="active" <?php }?>><a
                                            href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plan/voucher"><?php echo Lang::T('Vouchers');?>
</a></li>
                                    <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'refill') {?>class="active" <?php }?>><a
                                            href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plan/refill"><?php echo Lang::T('Refill Customer');?>
</a></li>
                                <?php }?>
                                <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'recharge') {?>class="active" <?php }?>><a
                                        href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plan/recharge"><?php echo Lang::T('Recharge Customer');?>
</a></li>
                                <?php if ($_smarty_tpl->tpl_vars['_c']->value['enable_balance'] == 'yes') {?>
                                    <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'deposit') {?>class="active" <?php }?>><a
                                            href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plan/deposit"><?php echo Lang::T('Refill Balance');?>
</a></li>
                                <?php }?>
                                <?php echo $_smarty_tpl->tpl_vars['_MENU_SERVICES']->value;?>

                            </ul>
                        </li>
                    <?php }?>
                    <?php echo $_smarty_tpl->tpl_vars['_MENU_AFTER_SERVICES']->value;?>

                    <?php if (in_array($_smarty_tpl->tpl_vars['_admin']->value['user_type'],array('SuperAdmin','Admin'))) {?>
                        <li class="<?php if ($_smarty_tpl->tpl_vars['_system_menu']->value == 'services') {?>active<?php }?> treeview">
                            <a href="#">
                                <i class="ion ion-cube"></i> <span><?php echo Lang::T('Internet Plan');?>
</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'hotspot') {?>class="active" <?php }?>><a
                                        href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
services/hotspot">Hotspot</a></li>
                                <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'pppoe') {?>class="active" <?php }?>><a
                                        href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
services/pppoe">PPPOE</a></li>
                                <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'static') {?>class="active" <?php }?>><a
                                        href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
services/static">Static</a></li>
                                <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'list') {?>class="active" <?php }?>><a
                                        href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
bandwidth/list"><?php echo Lang::T('Bandwidth');?>
</a></li>
                                <?php if ($_smarty_tpl->tpl_vars['_c']->value['enable_balance'] == 'yes') {?>
                                    <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'balance') {?>class="active" <?php }?>><a
                                            href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
services/balance"><?php echo Lang::T('Customer Balance');?>
</a></li>
                                <?php }?>
                                <?php echo $_smarty_tpl->tpl_vars['_MENU_PLANS']->value;?>

                            </ul>
                        </li>
                    <?php }?>
                    <?php echo $_smarty_tpl->tpl_vars['_MENU_AFTER_PLANS']->value;?>

                    <li class="<?php if ($_smarty_tpl->tpl_vars['_system_menu']->value == 'reports') {?>active<?php }?> treeview">
                        <a href="#">
                            <i class="ion ion-clipboard"></i> <span><?php echo Lang::T('Reports');?>
</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'daily-report') {?>class="active" <?php }?>><a
                                    href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
reports/daily-report"><?php echo Lang::T('Daily Reports');?>
</a></li>
                            <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'by-period') {?>class="active" <?php }?>><a
                                    href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
reports/by-period"><?php echo Lang::T('Period Reports');?>
</a></li>
                            <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'activation') {?>class="active" <?php }?>><a
                                    href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
reports/activation"><?php echo Lang::T('Activation History');?>
</a></li>
                            <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'transactions') {?>class="active" <?php }?>><a
                                    href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
reports/transactions"><?php echo Lang::T('Transaction History');?>
</a></li>
                            <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'pending') {?>class="active" <?php }?>><a
                                    href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
reports/pending"><?php echo Lang::T('Pending Transactions');?>
</a></li>
                            <?php echo $_smarty_tpl->tpl_vars['_MENU_REPORTS']->value;?>

                        </ul>
                    </li>
                    <?php echo $_smarty_tpl->tpl_vars['_MENU_AFTER_REPORTS']->value;?>

                    <li class="<?php if ($_smarty_tpl->tpl_vars['_system_menu']->value == 'message') {?>active<?php }?> treeview">
                        <a href="#">
                            <i class="ion ion-android-chat"></i> <span><?php echo Lang::T('Send Message');?>
</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'send') {?>class="active" <?php }?>><a
                                    href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
message/send"><?php echo Lang::T('Single Customer');?>
</a></li>
                            <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'send_bulk') {?>class="active" <?php }?>><a
                                    href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
message/send_bulk"><?php echo Lang::T('Bulk Customers');?>
</a></li>
                            <?php echo $_smarty_tpl->tpl_vars['_MENU_MESSAGE']->value;?>

                        </ul>
                    </li>
                    <?php echo $_smarty_tpl->tpl_vars['_MENU_AFTER_MESSAGE']->value;?>

                    <?php if (in_array($_smarty_tpl->tpl_vars['_admin']->value['user_type'],array('SuperAdmin','Admin'))) {?>
                        <li class="<?php if ($_smarty_tpl->tpl_vars['_system_menu']->value == 'network') {?>active<?php }?> treeview">
                            <a href="#">
                                <i class="ion ion-network"></i> <span><?php echo Lang::T('Network');?>
</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[0] == 'routers' && $_smarty_tpl->tpl_vars['_routes']->value[1] == 'list') {?>class="active" <?php }?>><a
                                        href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
routers/list"><?php echo Lang::T('Routers');?>
</a></li>
                                <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[0] == 'pool' && $_smarty_tpl->tpl_vars['_routes']->value[1] == 'list') {?>class="active" <?php }?>><a
                                        href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
pool/list"><?php echo Lang::T('IP Pool');?>
</a></li>
                                <?php echo $_smarty_tpl->tpl_vars['_MENU_NETWORK']->value;?>

                            </ul>
                        </li>
                        <?php echo $_smarty_tpl->tpl_vars['_MENU_AFTER_NETWORKS']->value;?>

                        <?php if ($_smarty_tpl->tpl_vars['_c']->value['radius_enable']) {?>
                            <li class="<?php if ($_smarty_tpl->tpl_vars['_system_menu']->value == 'radius') {?>active<?php }?> treeview">
                                <a href="#">
                                    <i class="fa fa-database"></i> <span><?php echo Lang::T('Radius');?>
</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[0] == 'radius' && $_smarty_tpl->tpl_vars['_routes']->value[1] == 'nas-list') {?>class="active" <?php }?>><a
                                            href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
radius/nas-list"><?php echo Lang::T('Radius NAS');?>
</a></li>
                                    <?php echo $_smarty_tpl->tpl_vars['_MENU_RADIUS']->value;?>

                                </ul>
                            </li>
                        <?php }?>
                        <?php echo $_smarty_tpl->tpl_vars['_MENU_AFTER_RADIUS']->value;?>

                        <li class="<?php if ($_smarty_tpl->tpl_vars['_system_menu']->value == 'pages') {?>active<?php }?> treeview">
                            <a href="#">
                                <i class="ion ion-document"></i> <span><?php echo Lang::T("Static Pages");?>
</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'Order_Voucher') {?>class="active" <?php }?>><a
                                        href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
pages/Order_Voucher"><?php echo Lang::T('Order Voucher');?>
</a></li>
                                <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'Voucher') {?>class="active" <?php }?>><a
                                        href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
pages/Voucher"><?php echo Lang::T('Voucher');?>
 Template</a></li>
                                <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'Announcement') {?>class="active" <?php }?>><a
                                        href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
pages/Announcement"><?php echo Lang::T('Announcement');?>
</a></li>
                                <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'Announcement_Customer') {?>class="active" <?php }?>><a
                                        href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
pages/Announcement_Customer"><?php echo Lang::T('Customer Announcement');?>
</a>
                                </li>
                                <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'Registration_Info') {?>class="active" <?php }?>><a
                                        href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
pages/Registration_Info"><?php echo Lang::T('Registration Info');?>
</a></li>
                                <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'Privacy_Policy') {?>class="active" <?php }?>><a
                                        href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
pages/Privacy_Policy"><?php echo Lang::T('Privacy Policy');?>
</a></li>
                                <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'Terms_and_Conditions') {?>class="active" <?php }?>><a
                                        href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
pages/Terms_and_Conditions"><?php echo Lang::T('Terms and Conditions');?>
</a></li>
                                <?php echo $_smarty_tpl->tpl_vars['_MENU_PAGES']->value;?>

                            </ul>
                        </li>
                    <?php }?>
                    <?php echo $_smarty_tpl->tpl_vars['_MENU_AFTER_PAGES']->value;?>

                    <li
                        class="<?php if ($_smarty_tpl->tpl_vars['_system_menu']->value == 'settings' || $_smarty_tpl->tpl_vars['_system_menu']->value == 'paymentgateway') {?>active<?php }?> treeview">
                        <a href="#">
                            <i class="ion ion-gear-a"></i> <span><?php echo Lang::T('Settings');?>
</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <?php if (in_array($_smarty_tpl->tpl_vars['_admin']->value['user_type'],array('SuperAdmin','Admin'))) {?>
                                <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'app') {?>class="active" <?php }?>><a
                                        href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/app"><?php echo Lang::T('General Settings');?>
</a></li>
                                <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'localisation') {?>class="active" <?php }?>><a
                                        href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/localisation"><?php echo Lang::T('Localisation');?>
</a></li>
                                <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'maintenance') {?>class="active" <?php }?>><a
                                        href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/maintenance"><?php echo Lang::T('Maintenance Mode');?>
</a></li>
                                <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'notifications') {?>class="active" <?php }?>><a
                                        href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/notifications"><?php echo Lang::T('User Notification');?>
</a></li>
                            <?php }?>
                            <?php if (in_array($_smarty_tpl->tpl_vars['_admin']->value['user_type'],array('SuperAdmin','Admin','Agent'))) {?>
                                <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'users') {?>class="active" <?php }?>><a
                                        href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/users"><?php echo Lang::T('Administrator Users');?>
</a></li>
                            <?php }?>
                            <?php if (in_array($_smarty_tpl->tpl_vars['_admin']->value['user_type'],array('SuperAdmin','Admin'))) {?>
                                <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'dbstatus') {?>class="active" <?php }?>><a
                                        href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/dbstatus"><?php echo Lang::T('Backup/Restore');?>
</a></li>
                                <li <?php if ($_smarty_tpl->tpl_vars['_system_menu']->value == 'paymentgateway') {?>class="active" <?php }?>>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
paymentgateway">
                                        <span class="text"><?php echo Lang::T('Payment Gateway');?>
</span>
                                    </a>
                                </li>
                                <?php echo $_smarty_tpl->tpl_vars['_MENU_SETTINGS']->value;?>

                            <?php if (in_array($_smarty_tpl->tpl_vars['_admin']->value['user_type'],array('SuperAdmin'))) {?>
                                <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[0] == 'pluginmanager') {?>class="active" <?php }?>>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
pluginmanager"><i class="glyphicon glyphicon-tasks"></i>
                                        <?php echo Lang::T('Plugin Manager');?>
 <small class="label pull-right">Free</small></a>
                                </li>
                            <?php }?>
                            <?php }?>
                        </ul>
                    </li>
                    <?php echo $_smarty_tpl->tpl_vars['_MENU_AFTER_SETTINGS']->value;?>

                    <?php if (in_array($_smarty_tpl->tpl_vars['_admin']->value['user_type'],array('SuperAdmin','Admin'))) {?>
                        <li class="<?php if ($_smarty_tpl->tpl_vars['_system_menu']->value == 'logs') {?>active<?php }?> treeview">
                            <a href="#">
                                <i class="ion ion-clock"></i> <span><?php echo Lang::T('Logs');?>
</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'list') {?>class="active" <?php }?>><a
                                        href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
logs/phpnuxbill">Working Logs</a></li>
                                <?php if ($_smarty_tpl->tpl_vars['_c']->value['radius_enable']) {?>
                                    <li <?php if ($_smarty_tpl->tpl_vars['_routes']->value[1] == 'radius') {?>class="active" <?php }?>><a
                                            href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
logs/radius">Radius Logs</a>
                                    </li>
                                <?php }?>
                                <?php echo $_smarty_tpl->tpl_vars['_MENU_LOGS']->value;?>

                            </ul>
                        </li>
                    <?php }?>
                    <?php echo $_smarty_tpl->tpl_vars['_MENU_AFTER_LOGS']->value;?>

                    <?php echo $_smarty_tpl->tpl_vars['_MENU_AFTER_COMMUNITY']->value;?>

                </ul>
            </section>
        </aside>

        <?php if ($_smarty_tpl->tpl_vars['_c']->value['maintenance_mode'] == 1) {?>
            <div class="notification-top-bar">
                <p><?php echo Lang::T('The website is currently in maintenance mode, this means that some or all functionality may be
                unavailable to regular users during this time.');?>
<small> &nbsp;&nbsp;<a
                            href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/maintenance"><?php echo Lang::T('Turn Off');?>
</a></small></p>
            </div>
        <?php }?>

        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    <?php echo $_smarty_tpl->tpl_vars['_title']->value;?>

                </h1>
            </section>

            <section class="content">
                <?php if ((isset($_smarty_tpl->tpl_vars['notify']->value))) {?>
                    <?php echo '<script'; ?>
>
                        // Display SweetAlert toast notification
                        Swal.fire({
                            icon: '<?php if ($_smarty_tpl->tpl_vars['notify_t']->value == "s") {?>success<?php } else { ?>error<?php }?>',
                            title: '<?php echo $_smarty_tpl->tpl_vars['notify']->value;?>
',
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 5000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        });
                    <?php echo '</script'; ?>
>
<?php }
}
}
