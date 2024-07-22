<?php
/* Smarty version 4.5.3, created on 2024-07-21 12:36:43
  from '/home/augustine/projects/NuX/phpnuxbill/ui/ui/paymentgateway.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_669cd6abb81064_54884424',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '91a040b5128fd9c0dd030cf64143b4bdbc01a896' => 
    array (
      0 => '/home/augustine/projects/NuX/phpnuxbill/ui/ui/paymentgateway.tpl',
      1 => 1721497305,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_669cd6abb81064_54884424 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<form method="post">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-info panel-hovered">
                <div class="panel-heading"><?php echo Lang::T('Payment Gateway');?>
</div>
                <div class="table-responsive">
                    <table class="table table-striped table-condensed">
                        <tbody>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['pgs']->value, 'pg');
$_smarty_tpl->tpl_vars['pg']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['pg']->value) {
$_smarty_tpl->tpl_vars['pg']->do_else = false;
?>
                                <tr>
                                    <td width="10" align="center" valign="center"><input type="checkbox" name="pgs[]"
                                            <?php if (in_array($_smarty_tpl->tpl_vars['pg']->value,$_smarty_tpl->tpl_vars['actives']->value)) {?>checked<?php }?> value="<?php echo $_smarty_tpl->tpl_vars['pg']->value;?>
"></td>
                                    <td><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
paymentgateway/<?php echo $_smarty_tpl->tpl_vars['pg']->value;?>
"
                                            class="btn btn-block btn-<?php if (in_array($_smarty_tpl->tpl_vars['pg']->value,$_smarty_tpl->tpl_vars['actives']->value)) {?>info<?php } else { ?>default<?php }?> text-left"><?php echo ucwords($_smarty_tpl->tpl_vars['pg']->value);?>
</a>
                                    </td>
                                    <td width="10"><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
paymentgateway/delete/<?php echo $_smarty_tpl->tpl_vars['pg']->value;?>
"
                                            onclick="return confirm('<?php echo Lang::T('Delete');?>
 <?php echo $_smarty_tpl->tpl_vars['pg']->value;?>
?')" class="btn btn-danger"><i
                                                class="glyphicon glyphicon-trash"></i></a></td>
                                </tr>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer"><button type="submit" class="btn btn-primary btn-block" name="save"
                        value="actives"><?php echo Lang::T('Save Changes');?>
</button></div>
            </div>
        </div>
    </div>
</form>
<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
