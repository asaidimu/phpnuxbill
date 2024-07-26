<?php
/* Smarty version 4.5.3, created on 2024-07-26 10:15:41
  from '/home/augustine/projects/NuX/phpnuxbill/ui/ui/user-login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_66a34d1d45a633_72823851',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5e05661990d9cab8ac4c2017d5c98d93fd5b4899' => 
    array (
      0 => '/home/augustine/projects/NuX/phpnuxbill/ui/ui/user-login.tpl',
      1 => 1721497304,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66a34d1d45a633_72823851 (Smarty_Internal_Template $_smarty_tpl) {
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

<body>
    <div class="container">
        <div class="hidden-xs" style="height:150px"></div>
        <div class="form-head mb20">
            <h1 class="site-logo h2 mb5 mt5 text-center text-uppercase text-bold"
                style="text-shadow: 2px 2px 4px #757575;"><?php echo $_smarty_tpl->tpl_vars['_c']->value['CompanyName'];?>
</h1>
            <hr>
        </div>
        <?php if ((isset($_smarty_tpl->tpl_vars['notify']->value))) {?>
            <div class="alert alert-<?php if ($_smarty_tpl->tpl_vars['notify_t']->value == 's') {?>success<?php } else { ?>danger<?php }?>">
                <button type="button" class="close" data-dismiss="alert">
                    <span aria-hidden="true">×</span>
                </button>
                <div><?php echo $_smarty_tpl->tpl_vars['notify']->value;?>
</div>
            </div>
        <?php }?>
        <div class="row">
            <div class="col-sm-6 col-sm-offset-1">
                <div class="panel panel-info">
                    <div class="panel-heading"><?php echo Lang::T('Announcement');?>
</div>
                    <div class="panel-body">
                    <?php $_smarty_tpl->_assignInScope('Announcement', ((string)$_smarty_tpl->tpl_vars['PAGES_PATH']->value)."/Announcement.html");?>
                    <?php if (file_exists($_smarty_tpl->tpl_vars['Announcement']->value)) {?>
                        <?php $_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['Announcement']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
                    <?php }?>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="panel panel-primary">
                    <div class="panel-heading"><?php echo Lang::T('Log in to Member Panel');?>
</div>
                    <div class="panel-body">
                        <form action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
login/post" method="post">
                            <div class="form-group">
                                <label><?php if ($_smarty_tpl->tpl_vars['_c']->value['country_code_phone'] != '') {
echo Lang::T('Phone Number');
} else {
echo Lang::T('Username');
}?></label>
                                <div class="input-group">
                                    <?php if ($_smarty_tpl->tpl_vars['_c']->value['country_code_phone'] != '') {?>
                                        <span class="input-group-addon" id="basic-addon1"><i
                                        class="glyphicon glyphicon-phone-alt"></i></span>
                                    <?php } else { ?>
                                        <span class="input-group-addon" id="basic-addon1"><i
                                                class="glyphicon glyphicon-user"></i></span>
                                    <?php }?>
                                    <input type="text" class="form-control" name="username"
                                placeholder="<?php if ($_smarty_tpl->tpl_vars['_c']->value['country_code_phone'] != '') {
echo $_smarty_tpl->tpl_vars['_c']->value['country_code_phone'];?>
 <?php echo Lang::T('Phone Number');
} else {
echo Lang::T('Username');
}?>">
                                </div>

                            </div>
                            <div class="form-group">
    <label><?php echo Lang::T('Password');?>
</label>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon2"><i class="glyphicon glyphicon-lock"></i></span>
        <input type="password" class="form-control" name="password" placeholder="<?php echo Lang::T('Password');?>
">
    </div>
</div>

                            <div class="clearfix hidden">
                                <div class="ui-checkbox ui-checkbox-primary right">
                                    <label>
                                        <input type="checkbox">
                                        <span>Remember me</span>
                                    </label>
                                </div>
                            </div>
                            <div class="btn-group btn-group-justified mb15">
                                <div class="btn-group">
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
register" class="btn btn-success"><?php echo Lang::T('Register');?>
</a>
                                </div>
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-primary"><?php echo Lang::T('Login');?>
</button>
                                </div>
                            </div>
                            <br>
                            <center>
                                <a href="javascript:showPrivacy()">Privacy</a>
                                &bull;
                                <a href="javascript:showTaC()">T &amp; C</a>
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="HTMLModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body" id="HTMLModal_konten"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">&times;</button>
                </div>
            </div>
        </div>
    </div>


    <?php echo '<script'; ?>
 src="ui/ui/scripts/vendors.js?v=1"><?php echo '</script'; ?>
>
</body>

</html>
<?php }
}
