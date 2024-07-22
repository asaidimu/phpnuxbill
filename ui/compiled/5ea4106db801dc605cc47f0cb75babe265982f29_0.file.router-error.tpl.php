<?php
/* Smarty version 4.5.3, created on 2024-07-22 12:17:08
  from '/home/augustine/projects/NuX/phpnuxbill/ui/ui/router-error.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_669e239462b888_51825759',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5ea4106db801dc605cc47f0cb75babe265982f29' => 
    array (
      0 => '/home/augustine/projects/NuX/phpnuxbill/ui/ui/router-error.tpl',
      1 => 1721497305,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_669e239462b888_51825759 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Error - PHPNuxBill</title>
    <link rel="shortcut icon" href="ui/ui/images/logo.png" type="image/x-icon" />

    <link rel="stylesheet" href="ui/ui/styles/bootstrap.min.css">

    <link rel="stylesheet" href="ui/ui/fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="ui/ui/fonts/font-awesome/css/font-awesome.min.css">

    <link rel="stylesheet" href="ui/ui/styles/modern-AdminLTE.min.css">

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
    </style>

</head>

<body class="hold-transition skin-blue">
    <div class="container">

        <section class="content">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="box box-danger box-solid">
                        <section class="content-header">
                            <h1 class="text-center">
                                <?php echo $_smarty_tpl->tpl_vars['error_title']->value;?>

                            </h1>
                        </section>
                        <div class="box-body" style="font-size: larger;">
                            <center>
                            <img src="./ui/ui/images/error.png" class="img-responsive hidden-sm hidden-xs"></center>
                            <br>
                            <?php echo $_smarty_tpl->tpl_vars['error_message']->value;?>

                            <br>
                            Mikrotik troubleshooting: <br>
                            <ul>
                                <li>Make sure you use API Port, Default 8728</li>
                                <li>Make sure Username and Password are correct</li>
                                <li>Make sure your hosting not blocking port to external</li>
                                <li>Make sure your Mikrotik accessible from PHPNuxBill</li>
                            </ul>
                            If you just update PHPNuxBill from upload files, try click Update Database
                        </div>
                        <div class="box-footer">
                            <div class="btn-group btn-group-justified" role="group" aria-label="...">
                                <a href="./update.php?step=4" style="color: black;" class="btn btn-info btn-sm btn-block">Update Database</a>
                                <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
community#update" style="color: black;" class="btn btn-success btn-sm btn-block">Update
                                    PHPNuxBill</a>
                            </div>
                            <br>
                            <div class="btn-group btn-group-justified" role="group" aria-label="...">
                            <a href="https://github.com/hotspotbilling/phpnuxbill/discussions" target="_blank"
                            class="btn btn-success btn-sm btn-block" style="color: black;">Ask Github Community</a>
                                <a href="https://t.me/phpnuxbill" target="_blank"
                                    class="btn btn-primary btn-sm btn-block">Ask Telegram Community</a>
                            </div>
                            <br><br>
                            <a href="javascript::history.back()" onclick="history.back()"
                                class="btn btn-warning btn-block">back</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <img src="./ui/ui/images/error.png" class="img-responsive hidden-md hidden-lg">
                </div>
            </div>
        </section>
    </div>
</body>

</html><?php }
}
