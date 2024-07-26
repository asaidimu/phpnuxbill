<?php
/* Smarty version 4.5.3, created on 2024-07-26 11:02:06
  from '/home/augustine/projects/NuX/phpnuxbill/system/paymentgateway/ui/mpesa.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_66a357fe874561_37965167',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e4cc1c257339d8497034f47bb2e830126c38d8a6' => 
    array (
      0 => '/home/augustine/projects/NuX/phpnuxbill/system/paymentgateway/ui/mpesa.tpl',
      1 => 1721980922,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_66a357fe874561_37965167 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<form class="form-horizontal" method="post" role="form" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
paymentgateway/mpesa" >
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel panel-primary panel-hovered panel-stacked mb30">
                <div class="panel-heading">M-Pesa</div>
                <div class="panel-body row">
                    <div class="form-group col-6">
                        <label class="col-md-2 control-label">Consumer Key</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="MPESA_CONSUMER_KEY" name="MPESA_CONSUMER_KEY" placeholder="xxxxxxxxxxxxxxxxx" value="<?php echo $_smarty_tpl->tpl_vars['_c']->value['MPESA_CONSUMER_KEY'];?>
">
                            <small class="form-text text-muted"><a href="https://developer.safaricom.co.ke/MyApps" target="_blank">https://developer.safaricom.co.ke/MyApps</a></small>
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label class="col-md-2 control-label">Consumer Secret</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" id="MPESA_CONSUMER_SECRET" name="MPESA_CONSUMER_SECRET" placeholder="xxxxxxxxxxxxxxxxx" value="<?php echo $_smarty_tpl->tpl_vars['_c']->value['MPESA_CONSUMER_SECRET'];?>
">
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label class="col-md-2 control-label">Business Shortcode</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control"
                            id="MPESA_SHORTCODE" name="MPESA_SHORTCODE"
                            placeholder="xxxxxxx" maxlength="7"
                            value="<?php echo $_smarty_tpl->tpl_vars['_c']->value['MPESA_SHORTCODE'];?>
">
                        </div>
                    </div>
					<div class="form-group col-6">
                        <label class="col-md-2 control-label">Pass Key</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="MPESA_PASSKEY" name="MPESA_PASSKEY" placeholder="bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919" maxlength="" value="<?php echo $_smarty_tpl->tpl_vars['_c']->value['MPESA_PASSKEY'];?>
">
                        </div>
                    </div>

	                  <div class="form-group col-6">
                        <label class="col-md-2 control-label">Surpport Offline Pay Methods / C2B Pay Methods</label>
                        <div class="col-md-6">
                            <select class="form-control" name="MPESA_CHANNEL">
                                <option value="0" <?php if ($_smarty_tpl->tpl_vars['_c']->value['MPESA_CHANNEL'] == 0) {?>selected<?php }?>>No</option>
                                <option value="1" <?php if ($_smarty_tpl->tpl_vars['_c']->value['MPESA_CHANNEL'] == 1) {?>selected<?php }?>>Yes</option>
                            </select>
                            <small class="form-text text-muted">Enable this if you want to support offline payment methods.</small>
                        </div>
                    </div>

                     <div class="form-group col-6">
                        <label class="col-md-2 control-label">Version of the API</label>
                        <div class="col-md-6">
                            <select class="form-control" name="MPESA_API_VERSION">
                                <option value="v1" <?php if ($_smarty_tpl->tpl_vars['_c']->value['MPESA_API_VERSION'] == 'v1') {?>selected<?php }?>>v1</option>
                                <option value="v2" <?php if ($_smarty_tpl->tpl_vars['_c']->value['MPESA_API_VERSION'] == 'v2') {?>selected<?php }?>>v2</option>
                            </select>
                            <small class="form-text text-muted">Select the version of the API you want to use.</small>
                          </div>
                    </div>



					<div class="form-group col-6">
                        <label class="col-md-2 control-label">M-Pesa Environment</label>
                        <div class="col-md-6">
                            <select class="form-control" name="MPESA_ENV">
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['env']->value, 'environment');
$_smarty_tpl->tpl_vars['environment']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['environment']->value) {
$_smarty_tpl->tpl_vars['environment']->do_else = false;
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['environment']->value['id'];?>
"
                                    <?php if ($_smarty_tpl->tpl_vars['environment']->value['id'] == $_smarty_tpl->tpl_vars['_c']->value['MPESA_ENV']) {?>selected<?php }?>
                                    ><?php echo $_smarty_tpl->tpl_vars['environment']->value['id'];?>
 - <?php echo $_smarty_tpl->tpl_vars['environment']->value['name'];?>
</option>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </select>
                            <small class="form-text text-muted"><font color="red"><b>Sandbox</b></font> is for testing purpose, please switch to <font color="green"><b>Live</b></font> in production.</small>
                        </div>
                    </div>

                    <div class="form-group col-6">
                        <label class="col-md-2 control-label">Confirmation Url Notification</label>
                        <div class="col-md-6">
                            <input type="hidden" name="MPESA_CALLBACK_URL" value="<?php echo APP_URL;?>
/system/api.php?r=ocallback">
                            <input type="hidden" name="MPESA_VALIDATION_URL" value="<?php echo APP_URL;?>
/system/api.php?r=ccallback">
                            <input type="text"
                            class="form-control" onclick="this.select()"
                            disabled value="<?php echo APP_URL;?>
/system/api.php?r=ccallback">
                            <p class="help-block">Confirmation callBack url</p>
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button class="btn btn-primary waves-effect
                            waves-light" type="submit">Save</button>
                        </div>
                    </div>
                        <pre>/ip hotspot walled-garden
                   add dst-host=safaricom.co.ke
                   add dst-host=*.safaricom.co.ke</pre>
                </div>
            </div>
        </div>
    </div>
</form>
<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
