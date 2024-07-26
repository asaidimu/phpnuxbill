<?php
/* Smarty version 4.5.3, created on 2024-07-26 23:23:54
  from '/home/augustine/projects/NuX/phpnuxbill/ui/ui/customers.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_66a405da001e98_63794327',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bd106dafff02b7918f48971b464b41d4d4c2d922' => 
    array (
      0 => '/home/augustine/projects/NuX/phpnuxbill/ui/ui/customers.tpl',
      1 => 1722025262,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_66a405da001e98_63794327 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<style>
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        display: inline-block;
        padding: 5px 10px;
        margin-right: 5px;
        border: 1px solid #ccc;
        background-color: #fff;
        color: #333;
        cursor: pointer;
    }
</style>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-hovered mb20 panel-primary">
            <div class="panel-heading">
                <?php if (in_array($_smarty_tpl->tpl_vars['_admin']->value['user_type'],array('SuperAdmin','Admin'))) {?>
                    <div class="btn-group pull-right">
                        <a class="btn btn-primary btn-xs" title="save" href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/csv"
                            onclick="return confirm('This will export to CSV?')"><span class="glyphicon glyphicon-download"
                                aria-hidden="true"></span> CSV</a>
                    </div>
                <?php }?>
                <?php echo Lang::T('Manage Contact');?>

            </div>
            <div class="panel-body">
                <form id="site-search" method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers">
                    <div class="md-whiteframe-z1 mb20 text-center" style="padding: 15px">
                        <div class="col-lg-4">
                            <div class="input-group">
                                <span class="input-group-addon">Order &nbsp;&nbsp;</span>
                                <div class="row row-no-gutters">
                                    <div class="col-xs-8">
                                        <select class="form-control" id="order" name="order">
                                            <option value="username" <?php if ($_smarty_tpl->tpl_vars['order']->value == 'username') {?>selected<?php }?>><?php echo Lang::T('Username');?>
</option>
                                            <option value="created_at" <?php if ($_smarty_tpl->tpl_vars['order']->value == 'created_at') {?>selected<?php }?>><?php echo Lang::T('Created Date');?>
</option>
                                            <option value="balance" <?php if ($_smarty_tpl->tpl_vars['order']->value == 'balance') {?>selected<?php }?>><?php echo Lang::T('Balance');?>
</option>
                                            <option value="status" <?php if ($_smarty_tpl->tpl_vars['order']->value == 'status') {?>selected<?php }?>><?php echo Lang::T('Status');?>
</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-4">
                                        <select class="form-control" id="orderby" name="orderby">
                                            <option value="asc" <?php if ($_smarty_tpl->tpl_vars['orderby']->value == 'asc') {?>selected<?php }?>><?php echo Lang::T('Ascending');?>
</option>
                                            <option value="desc" <?php if ($_smarty_tpl->tpl_vars['orderby']->value == 'desc') {?>selected<?php }?>><?php echo Lang::T('Descending');?>
</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="input-group">
                                <span class="input-group-addon">Status</span>
                                <select class="form-control" id="filter" name="filter">
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['statuses']->value, 'status');
$_smarty_tpl->tpl_vars['status']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['status']->value) {
$_smarty_tpl->tpl_vars['status']->do_else = false;
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['status']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['filter']->value == $_smarty_tpl->tpl_vars['status']->value) {?>selected<?php }?>><?php echo Lang::T($_smarty_tpl->tpl_vars['status']->value);?>
</option>
                                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="fa fa-search"></span>
                                </div>
                                <input type="text" name="search" class="form-control"
                                    placeholder="<?php echo Lang::T('Search');?>
..." value="<?php echo $_smarty_tpl->tpl_vars['search']->value;?>
">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary" type="submit"><span class="fa fa-search"></span></button>
                                    <button class="btn btn-primary" type="submit" name="export" value="csv">
                                        <span class="glyphicon glyphicon-download"
                                        aria-hidden="true"></span> CSV
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/add" class="btn btn-success text-black btn-block" title="<?php echo Lang::T('Add');?>
">
                            <i class="ion ion-android-add"></i><i class="glyphicon glyphicon-user"></i>
                            </a>
                        </div>
                    </div>
                </form>
                <br>&nbsp;
                <div class="table-responsive table_mobile">
                    <table id="customerTable" class="table table-bordered table-striped table-condensed">
                        <thead>
                            <tr>
                                <th><?php echo Lang::T('Username');?>
</th>
                                <th><?php echo Lang::T('Account Type');?>
</th>
                                <th><?php echo Lang::T('Full Name');?>
</th>
                                <th><?php echo Lang::T('Online');?>
</th>
                                <th><?php echo Lang::T('Wallet');?>
</th>
                                <th><?php echo Lang::T('Contact');?>
</th>
                                <th><?php echo Lang::T('Package');?>
</th>
                                <th><?php echo Lang::T('Service Type');?>
</th>
                                <th><?php echo Lang::T('Status');?>
</th>
                                <th><?php echo Lang::T('Created On');?>
</th>
                                <th><?php echo Lang::T('Manage');?>
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
                                <tr <?php if ($_smarty_tpl->tpl_vars['ds']->value['status'] != 'Active') {?>class="danger"<?php }?>>
                                    <td onclick="window.location.href = '<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/view/<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
'"
                                        style="cursor:pointer;"><?php echo $_smarty_tpl->tpl_vars['ds']->value['username'];?>
</td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['ds']->value['account_type'];?>
</td>
                                    <td onclick="window.location.href = '<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/view/<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
'"
                                        style="cursor: pointer;"><?php echo $_smarty_tpl->tpl_vars['ds']->value['fullname'];?>
</td>
                                    <td>
                                <?php if ($_smarty_tpl->tpl_vars['ds']->value["online"]) {?>
                                    <small class="label bg-green">online</small>
                                <?php } else { ?>
                                    <small class="label bg-red">offline</small>
                                <?php }?>
                                    </td>
                                    <td><?php echo Lang::moneyFormat($_smarty_tpl->tpl_vars['ds']->value['balance']);?>
</td>
                                    <td align="center">
                                        <?php if ($_smarty_tpl->tpl_vars['ds']->value['phonenumber']) {?>
                                            <a href="tel:<?php echo $_smarty_tpl->tpl_vars['ds']->value['phonenumber'];?>
" class="btn btn-default btn-xs"
                                                title="<?php echo $_smarty_tpl->tpl_vars['ds']->value['phonenumber'];?>
"><i class="glyphicon glyphicon-earphone"></i></a>
                                        <?php }?>
                                        <?php if ($_smarty_tpl->tpl_vars['ds']->value['email']) {?>
                                            <a href="mailto:<?php echo $_smarty_tpl->tpl_vars['ds']->value['email'];?>
" class="btn btn-default btn-xs"
                                                title="<?php echo $_smarty_tpl->tpl_vars['ds']->value['email'];?>
"><i class="glyphicon glyphicon-envelope"></i></a>
                                        <?php }?>
                                        <?php if ($_smarty_tpl->tpl_vars['ds']->value['coordinates']) {?>
                                            <a href="https://www.google.com/maps/dir//<?php echo $_smarty_tpl->tpl_vars['ds']->value['coordinates'];?>
/" target="_blank"
                                                class="btn btn-default btn-xs" title="<?php echo $_smarty_tpl->tpl_vars['ds']->value['coordinates'];?>
"><i
                                                    class="glyphicon glyphicon-map-marker"></i></a>
                                        <?php }?>
                                    </td>
                                    <td align="center" api-get-text="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
autoload/customer_is_active/<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
">
                                        <span class="label label-default">&bull;</span>
                                    </td>
                                    <td><?php echo $_smarty_tpl->tpl_vars['ds']->value['service_type'];?>
</td>
                                    <td><?php echo Lang::T($_smarty_tpl->tpl_vars['ds']->value['status']);?>
</td>

                                    <td><?php echo Lang::dateTimeFormat($_smarty_tpl->tpl_vars['ds']->value['created_at']);?>
</td>
                                    <td align="center">
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/view/<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
"
                                            style="margin: 0px; color:black"
                                            class="btn btn-success btn-xs">&nbsp;&nbsp;<?php echo Lang::T('View');?>
&nbsp;&nbsp;</a>
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/edit/<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
"
                                            style="margin: 0px; color:black"
                                            class="btn btn-info btn-xs">&nbsp;&nbsp;<?php echo Lang::T('Edit');?>
&nbsp;&nbsp;</a>
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plan/recharge/<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
" style="margin: 0px;"
                                            class="btn btn-primary btn-xs"><?php echo Lang::T('Recharge');?>
</a>
                                    </td>
                                </tr>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.6.0.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
    var $j = jQuery.noConflict();

    $j(document).ready(function() {
        $j('#customerTable').DataTable({
            order: [[<?php echo $_smarty_tpl->tpl_vars['order_pos']->value;?>
, '<?php echo $_smarty_tpl->tpl_vars['orderby']->value;?>
']],
            "pagingType": "full_numbers",
            "lengthMenu": [
                [5, 10, 25, 50, 100, -1],
                [5, 10, 25, 50, 100, "All"]
            ],
            "pageLength": 25
        });
    });
<?php echo '</script'; ?>
>
<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
