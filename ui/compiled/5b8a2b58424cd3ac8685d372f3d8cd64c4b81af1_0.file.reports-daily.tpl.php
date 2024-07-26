<?php
/* Smarty version 4.5.3, created on 2024-07-21 16:26:59
  from '/home/augustine/projects/NuX/ZeiteckIspRadius/ui/ui/reports-daily.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_669d0ca30ecad4_65993881',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5b8a2b58424cd3ac8685d372f3d8cd64c4b81af1' => 
    array (
      0 => '/home/augustine/projects/NuX/ZeiteckIspRadius/ui/ui/reports-daily.tpl',
      1 => 1721497305,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:pagination.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_669d0ca30ecad4_65993881 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<!-- reports-daily -->

<div class="row">
    <div class="col-md-12">
        <div class="invoice-wrap">
            <div class="clearfix invoice-head">
                <h3 class="brand-logo text-uppercase text-bold left mt15">
                    <span class="text"><?php echo Lang::T('Daily Reports');?>
</span>
                </h3>
            </div>
            <div class="clearfix invoice-subhead mb20">
                <div class="group clearfix left">
                    <p class="text-bold mb5"><?php echo Lang::T('All Transactions at Date');?>
:</p>
                    <p class="small"><?php echo date($_smarty_tpl->tpl_vars['_c']->value['date_format'],strtotime($_smarty_tpl->tpl_vars['mdate']->value));?>
 <?php echo $_smarty_tpl->tpl_vars['mtime']->value;?>
</p>
                </div>
                <div class="group clearfix right">
                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
export/print-by-date" class="btn btn-default" target="_blank"><i
                            class="ion ion-printer"></i><?php echo Lang::T('Export for Print');?>
</a>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
export/pdf-by-date" class="btn btn-default"><i
                            class="fa fa-file-pdf-o"></i><?php echo Lang::T('Export to PDF');?>
</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-condensed">
                    <thead>
                        <tr>
                            <th><?php echo Lang::T('Username');?>
</th>
                            <th><?php echo Lang::T('Type');?>
</th>
                            <th><?php echo Lang::T('Plan Name');?>
</th>
                            <th><?php echo Lang::T('Plan Price');?>
</th>
                            <th><?php echo Lang::T('Created On');?>
</th>
                            <th><?php echo Lang::T('Expires On');?>
</th>
                            <th><?php echo Lang::T('Method');?>
</th>
                            <th><?php echo Lang::T('Routers');?>
</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['d']->value, 'ds');
$_smarty_tpl->tpl_vars['ds']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ds']->value) {
$_smarty_tpl->tpl_vars['ds']->do_else = false;
?>
                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['ds']->value['username'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ds']->value['type'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ds']->value['plan_name'];?>
</td>
                                <td class="text-right"><?php echo Lang::moneyFormat($_smarty_tpl->tpl_vars['ds']->value['price']);?>
</td>
                                <td><?php echo Lang::dateAndTimeFormat($_smarty_tpl->tpl_vars['ds']->value['recharged_on'],$_smarty_tpl->tpl_vars['ds']->value['recharged_time']);?>
</td>
                                <td><?php echo Lang::dateAndTimeFormat($_smarty_tpl->tpl_vars['ds']->value['expiration'],$_smarty_tpl->tpl_vars['ds']->value['time']);?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ds']->value['method'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ds']->value['routers'];?>
</td>
                            </tr>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </tbody>
                </table>
            </div>
            <?php $_smarty_tpl->_subTemplateRender("file:pagination.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

            <div class="clearfix text-right total-sum mb10">
                <h4 class="text-uppercase text-bold"><?php echo Lang::T('Total Income');?>
:</h4>
                <h3 class="sum"><?php echo Lang::moneyFormat($_smarty_tpl->tpl_vars['dr']->value);?>
</h3>
            </div>
            <p class="text-center small text-info"><?php echo Lang::T('All Transactions at Date');?>
:
                <?php echo date($_smarty_tpl->tpl_vars['_c']->value['date_format'],strtotime($_smarty_tpl->tpl_vars['mdate']->value));?>
 <?php echo $_smarty_tpl->tpl_vars['mtime']->value;?>
</p>
        </div>
    </div>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
