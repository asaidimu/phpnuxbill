<?php
/* Smarty version 4.5.3, created on 2024-07-26 10:15:47
  from '/home/augustine/projects/NuX/phpnuxbill/ui/ui/admin-login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_66a34d23255019_40842691',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'abe71afd1f12634d8cce424940b5ab6f2ef2bc5d' => 
    array (
      0 => '/home/augustine/projects/NuX/phpnuxbill/ui/ui/admin-login.tpl',
      1 => 1721497304,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66a34d23255019_40842691 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php echo Lang::T('Login');?>
 - <?php echo $_smarty_tpl->tpl_vars['_c']->value['CompanyName'];?>
</title>
    <link rel="shortcut icon" href="ui/ui/images/logo.png" type="image/x-icon" />

    <link rel="stylesheet" href="ui/ui/styles/bootstrap.min.css">
    <link rel="stylesheet" href="ui/ui/styles/modern-AdminLTE.min.css">


</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <?php echo $_smarty_tpl->tpl_vars['_c']->value['CompanyName'];?>

        </div>
        <div class="login-box-body">
            <p class="login-box-msg"><?php echo Lang::T('Enter Admin Area');?>
</p>
            <?php if ((isset($_smarty_tpl->tpl_vars['notify']->value))) {?>
                <?php echo $_smarty_tpl->tpl_vars['notify']->value;?>

            <?php }?>
            <form action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
admin/post" method="post">
                <div class="form-group has-feedback">
                    <input type="text" required class="form-control" name="username" placeholder="<?php echo Lang::T('Username');?>
">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" required class="form-control" name="password" placeholder="<?php echo Lang::T('Password');?>
">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-flat"><?php echo Lang::T('Login');?>
</button>
            </form>
        </div>
    </div>
</body>

</html><?php }
}
