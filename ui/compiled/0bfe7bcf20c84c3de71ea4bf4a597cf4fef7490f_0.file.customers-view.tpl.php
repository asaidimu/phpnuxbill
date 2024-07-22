<?php
/* Smarty version 4.5.3, created on 2024-07-22 14:36:41
  from '/home/augustine/projects/NuX/phpnuxbill/ui/ui/customers-view.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_669e444911a3a3_78956188',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0bfe7bcf20c84c3de71ea4bf4a597cf4fef7490f' => 
    array (
      0 => '/home/augustine/projects/NuX/phpnuxbill/ui/ui/customers-view.tpl',
      1 => 1721648172,
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
function content_669e444911a3a3_78956188 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div class="row">
    <div class="col-sm-4 col-md-4">
        <div class="box box-<?php if ($_smarty_tpl->tpl_vars['d']->value['status'] == 'Active') {?>primary<?php } else { ?>danger<?php }?>">
            <div class="box-body box-profile">
                <img class="profile-user-img img-responsive img-circle"
                    src="https://robohash.org/<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
?set=set3&size=100x100&bgset=bg1"
                    onerror="this.src='<?php echo $_smarty_tpl->tpl_vars['UPLOAD_PATH']->value;?>
/user.default.jpg'" alt="avatar">
                <h3 class="profile-username text-center"><?php echo $_smarty_tpl->tpl_vars['d']->value['fullname'];?>
</h3>
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b><?php echo Lang::T('Status');?>
</b> <span
                            class="pull-right <?php if ($_smarty_tpl->tpl_vars['d']->value['status'] != 'Active') {?>bg-red<?php }?>">&nbsp;<?php echo Lang::T($_smarty_tpl->tpl_vars['d']->value['status']);?>
&nbsp;</span>
                    </li>
                    <li class="list-group-item">
                        <b><?php echo Lang::T('Username');?>
</b> <span class="pull-right"><?php echo $_smarty_tpl->tpl_vars['d']->value['username'];?>
</span>
                    </li>
                    <li class="list-group-item">
                        <b><?php echo Lang::T('Phone Number');?>
</b> <span class="pull-right"><?php echo $_smarty_tpl->tpl_vars['d']->value['phonenumber'];?>
</span>
                    </li>
                    <li class="list-group-item">
                        <b><?php echo Lang::T('Email');?>
</b> <span class="pull-right"><?php echo $_smarty_tpl->tpl_vars['d']->value['email'];?>
</span>
                    </li>
                    <li class="list-group-item"><?php echo Lang::nl2br($_smarty_tpl->tpl_vars['d']->value['address']);?>
</li>
                    <li class="list-group-item">
                        <b><?php echo Lang::T('City');?>
</b> <span class="pull-right"><?php echo Lang::T($_smarty_tpl->tpl_vars['d']->value['city']);?>
</span>
                    </li>
                    <li class="list-group-item">
                        <b><?php echo Lang::T('District');?>
</b> <span class="pull-right"><?php echo Lang::T($_smarty_tpl->tpl_vars['d']->value['district']);?>
</span>
                    </li>
                    <li class="list-group-item">
                        <b><?php echo Lang::T('State');?>
</b> <span class="pull-right"><?php echo Lang::T($_smarty_tpl->tpl_vars['d']->value['state']);?>
</span>
                    </li>
                    <li class="list-group-item">
                        <b><?php echo Lang::T('Zip');?>
</b> <span class="pull-right"><?php echo Lang::T($_smarty_tpl->tpl_vars['d']->value['zip']);?>
</span>
                    </li>
                    <li class="list-group-item">
                        <b><?php echo Lang::T('Password');?>
</b> <input type="password" value="<?php echo $_smarty_tpl->tpl_vars['d']->value['password'];?>
"
                            style=" border: 0px; text-align: right;" class="pull-right"
                            onmouseleave="this.type = 'password'" onmouseenter="this.type = 'text'"
                            onclick="this.select()">
                    </li>
                    <?php if ($_smarty_tpl->tpl_vars['d']->value['pppoe_password'] != '') {?>
                        <li class="list-group-item">
                            <b>PPPOE <?php echo Lang::T('Password');?>
</b> <input type="password" value="<?php echo $_smarty_tpl->tpl_vars['d']->value['pppoe_password'];?>
"
                                style=" border: 0px; text-align: right;" class="pull-right"
                                onmouseleave="this.type = 'password'" onmouseenter="this.type = 'text'"
                                onclick="this.select()">
                        </li>
                    <?php }?>
                    <!--Customers Attributes view start -->
                    <?php if ($_smarty_tpl->tpl_vars['customFields']->value) {?>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['customFields']->value, 'customField');
$_smarty_tpl->tpl_vars['customField']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['customField']->value) {
$_smarty_tpl->tpl_vars['customField']->do_else = false;
?>
                            <li class="list-group-item">
                                <b><?php echo $_smarty_tpl->tpl_vars['customField']->value['field_name'];?>
</b> <span class="pull-right">
                                    <?php if (strpos($_smarty_tpl->tpl_vars['customField']->value['field_value'],':0') === false) {?>
                                        <?php echo $_smarty_tpl->tpl_vars['customField']->value['field_value'];?>

                                    <?php } else { ?>
                                        <b><?php echo Lang::T('Paid');?>
</b>
                                    <?php }?>
                                </span>
                            </li>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <?php }?>
                    <!--Customers Attributes view end -->
                    <li class="list-group-item">
                        <b><?php echo Lang::T('Service Type');?>
</b> <span class="pull-right"><?php echo Lang::T($_smarty_tpl->tpl_vars['d']->value['service_type']);?>
</span>
                    </li>
                    <li class="list-group-item">
                        <b><?php echo Lang::T('Account Type');?>
</b> <span class="pull-right"><?php echo Lang::T($_smarty_tpl->tpl_vars['d']->value['account_type']);?>
</span>
                    </li>
                    <li class="list-group-item">
                        <b><?php echo Lang::T('Balance');?>
</b> <span class="pull-right"><?php echo Lang::moneyFormat($_smarty_tpl->tpl_vars['d']->value['balance']);?>
</span>
                    </li>
                    <li class="list-group-item">
                        <b><?php echo Lang::T('Auto Renewal');?>
</b> <span class="pull-right"><?php if ($_smarty_tpl->tpl_vars['d']->value['auto_renewal']) {?>yes<?php } else { ?>no
                            <?php }?></span>
                    </li>
                    <li class="list-group-item">
                        <b><?php echo Lang::T('Created On');?>
</b> <span
                            class="pull-right"><?php echo Lang::dateTimeFormat($_smarty_tpl->tpl_vars['d']->value['created_at']);?>
</span>
                    </li>
                    <li class="list-group-item">
                        <b><?php echo Lang::T('Last Login');?>
</b> <span
                            class="pull-right"><?php echo Lang::dateTimeFormat($_smarty_tpl->tpl_vars['d']->value['last_login']);?>
</span>
                    </li>
                    <?php if ($_smarty_tpl->tpl_vars['d']->value['coordinates']) {?>
                        <li class="list-group-item">
                            <b><?php echo Lang::T('Coordinates');?>
</b> <span class="pull-right">
                                <i class="glyphicon glyphicon-road"></i> <a style="color: black;"
                                    href="https://www.google.com/maps/dir//<?php echo $_smarty_tpl->tpl_vars['d']->value['coordinates'];?>
/" target="_blank">Get
                                    Directions</a>
                            </span>
                            <div id="map" style="width: '100%'; height: 100px;"></div>
                        </li>
                    <?php }?>
                </ul>
                <div class="row">
                    <div class="col-xs-4">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/delete/<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
"
                            class="btn btn-danger btn-block btn-sm"
                            onclick="return confirm('<?php echo Lang::T('Delete');?>
?')"><span class="fa fa-trash"></span></a>
                    </div>
                    <div class="col-xs-8">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/edit/<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
"
                            class="btn btn-warning btn-sm btn-block"><?php echo Lang::T('Edit');?>
</a>
                    </div>
                </div>
            </div>
        </div>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['packages']->value, 'package');
$_smarty_tpl->tpl_vars['package']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['package']->value) {
$_smarty_tpl->tpl_vars['package']->do_else = false;
?>
            <div class="box box-<?php if ($_smarty_tpl->tpl_vars['package']->value['status'] == 'on') {?>success<?php } else { ?>danger<?php }?>">
                <div class="box-body box-profile">
                    <h4 class="text-center"><?php echo $_smarty_tpl->tpl_vars['package']->value['type'];?>
 - <?php echo $_smarty_tpl->tpl_vars['package']->value['namebp'];?>
</h4>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <?php echo Lang::T('Active');?>
 <span class="pull-right"><?php if ($_smarty_tpl->tpl_vars['package']->value['status'] == 'on') {?>yes<?php } else { ?>no
                            <?php }?></span>
                    </li>
                    <li class="list-group-item">
                        <?php echo Lang::T('Type');?>
 <span class="pull-right">
                            <?php if ($_smarty_tpl->tpl_vars['package']->value['prepaid'] == 'yes') {?>Prepaid<?php } else { ?><b>Postpaid</b><?php }?></span>
                    </li>
                    <li class="list-group-item">
                        <?php echo Lang::T('Created On');?>
 <span
                            class="pull-right"><?php echo Lang::dateAndTimeFormat($_smarty_tpl->tpl_vars['package']->value['recharged_on'],$_smarty_tpl->tpl_vars['package']->value['recharged_time']);?>
</span>
                    </li>
                    <li class="list-group-item">
                        <?php echo Lang::T('Expires On');?>
 <span class="pull-right"><?php echo Lang::dateAndTimeFormat($_smarty_tpl->tpl_vars['package']->value['expiration'],$_smarty_tpl->tpl_vars['package']->value['time']);?>
</span>
                    </li>
                    <li class="list-group-item">
                        <?php echo $_smarty_tpl->tpl_vars['package']->value['routers'];?>
 <span class="pull-right"><?php echo $_smarty_tpl->tpl_vars['package']->value['method'];?>
</span>
                    </li>
                </ul>
                <div class="row">
                    <div class="col-xs-4">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/deactivate/<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
/<?php echo $_smarty_tpl->tpl_vars['package']->value['plan_id'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
"
                            class="btn btn-danger btn-block btn-sm"
                            onclick="return confirm('This will deactivate Customer Plan, and make it expired')"><?php echo Lang::T('Deactivate');?>
</a>
                    </div>
                    <div class="col-xs-8">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/recharge/<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
/<?php echo $_smarty_tpl->tpl_vars['package']->value['plan_id'];?>
"
                            class="btn btn-success btn-sm btn-block"><?php echo Lang::T('Recharge');?>
</a>
                    </div>
                </div>
            </div>
        </div>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        <div class="row">
            <div class="col-xs-4">
                <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/list" class="btn btn-primary btn-sm btn-block"><?php echo Lang::T('Back');?>
</a>
            </div>
            <div class="col-xs-4">
                <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/sync/<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
"
                    onclick="return confirm('This will sync Customer to Mikrotik?')"
                    class="btn btn-info btn-sm btn-block"><?php echo Lang::T('Sync');?>
</a>
            </div>
            <div class="col-xs-4">
                <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
message/send/<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
" class="btn btn-success btn-sm btn-block"><?php echo Lang::T('Send
                    Message');?>
</a>
            </div>
        </div>
    </div>
    <div class="col-sm-8 col-md-8">
        <ul class="nav nav-tabs">
            <li role="presentation" <?php if ($_smarty_tpl->tpl_vars['v']->value == 'order') {?>class="active" <?php }?>><a
                    href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/view/<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
/order">30 <?php echo Lang::T('Order History');?>
</a></li>
            <li role="presentation" <?php if ($_smarty_tpl->tpl_vars['v']->value == 'activation') {?>class="active" <?php }?>><a
                    href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/view/<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
/activation">30 <?php echo Lang::T('Activation History');?>
</a></li>
            <li role="presentation" <?php if ($_smarty_tpl->tpl_vars['v']->value == 'logs') {?>class="active" <?php }?>><a
                    href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
customers/view/<?php echo $_smarty_tpl->tpl_vars['d']->value['id'];?>
/logs"><?php echo Lang::T('Connection Logs');?>
</a></li>
        </ul>
        <div class="table-responsive" style="background-color: white;">
            <table id="datatable" class="table table-bordered table-striped"
            style="white-space: nowrap;">
                <?php if (Lang::arrayCount($_smarty_tpl->tpl_vars['logs']->value)) {?>
                    <thead>
                        <tr>
                            <th><?php echo Lang::T('Service');?>
</th>
                            <th><?php echo Lang::T('Status');?>
</th>
                            <th><?php echo Lang::T('Start');?>
</th>
                            <th><?php echo Lang::T('End');?>
</th>
                            <th><?php echo Lang::T('Uptime');?>
</th>
                            <th><?php echo Lang::T('Upload');?>
</th>
                            <th><?php echo Lang::T('Download');?>
</th>
                            <th><?php echo Lang::T('Total');?>
</th>
                            <th><?php echo Lang::T('IP');?>
</th>
                            <th><?php echo Lang::T('MAC');?>
</th>
                            <th><?php echo Lang::T('Plan');?>
</th>
                            <th><?php echo Lang::T('Router');?>
</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['logs']->value, 'log');
$_smarty_tpl->tpl_vars['log']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['log']->value) {
$_smarty_tpl->tpl_vars['log']->do_else = false;
?>
                        <tr>
                            <td><?php echo $_smarty_tpl->tpl_vars['log']->value["service"];?>
</td>
                            <td>
                                <?php if ($_smarty_tpl->tpl_vars['log']->value["active"]) {?>
                                    <small class="label bg-green">online</small>
                                <?php } else { ?>
                                    <small class="label bg-red">offline</small>
                                <?php }?>
                            </td>
                            <td><?php echo $_smarty_tpl->tpl_vars['log']->value["start"];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['log']->value["end"];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['log']->value["uptime"];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['log']->value["upload"];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['log']->value["download"];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['log']->value["total"];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['log']->value["ip"];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['log']->value["mac"];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['log']->value["plan"];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['log']->value["router"];?>
</td>
                        </tr>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </tbody>
                <?php }?>
                <?php if (Lang::arrayCount($_smarty_tpl->tpl_vars['activation']->value)) {?>
                    <thead>
                        <tr>
                            <th><?php echo Lang::T('Invoice');?>
</th>
                            <th><?php echo Lang::T('Username');?>
</th>
                            <th><?php echo Lang::T('Plan Name');?>
</th>
                            <th><?php echo Lang::T('Plan Price');?>
</th>
                            <th><?php echo Lang::T('Type');?>
</th>
                            <th><?php echo Lang::T('Created On');?>
</th>
                            <th><?php echo Lang::T('Expires On');?>
</th>
                            <th><?php echo Lang::T('Method');?>
</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['activation']->value, 'ds');
$_smarty_tpl->tpl_vars['ds']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ds']->value) {
$_smarty_tpl->tpl_vars['ds']->do_else = false;
?>
                            <tr onclick="window.location.href = '<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plan/view/<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
'" style="cursor:pointer;">
                                <td><?php echo $_smarty_tpl->tpl_vars['ds']->value['invoice'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ds']->value['username'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ds']->value['plan_name'];?>
</td>
                                <td><?php echo Lang::moneyFormat($_smarty_tpl->tpl_vars['ds']->value['price']);?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ds']->value['type'];?>
</td>
                                <td class="text-success"><?php echo Lang::dateAndTimeFormat($_smarty_tpl->tpl_vars['ds']->value['recharged_on'],$_smarty_tpl->tpl_vars['ds']->value['recharged_time']);?>

                                </td>
                                <td class="text-danger"><?php echo Lang::dateAndTimeFormat($_smarty_tpl->tpl_vars['ds']->value['expiration'],$_smarty_tpl->tpl_vars['ds']->value['time']);?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ds']->value['method'];?>
</td>
                            </tr>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </tbody>
                <?php }?>
                <?php if (Lang::arrayCount($_smarty_tpl->tpl_vars['order']->value)) {?>
                    <thead>
                        <tr>
                            <th><?php echo Lang::T('Plan Name');?>
</th>
                            <th><?php echo Lang::T('Gateway');?>
</th>
                            <th><?php echo Lang::T('Routers');?>
</th>
                            <th><?php echo Lang::T('Type');?>
</th>
                            <th><?php echo Lang::T('Plan Price');?>
</th>
                            <th><?php echo Lang::T('Created On');?>
</th>
                            <th><?php echo Lang::T('Expires On');?>
</th>
                            <th><?php echo Lang::T('Date Done');?>
</th>
                            <th><?php echo Lang::T('Method');?>
</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['order']->value, 'ds');
$_smarty_tpl->tpl_vars['ds']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ds']->value) {
$_smarty_tpl->tpl_vars['ds']->do_else = false;
?>
                            <tr>
                                <td><?php echo $_smarty_tpl->tpl_vars['ds']->value['plan_name'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ds']->value['gateway'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ds']->value['routers'];?>
</td>
                                <td><?php echo $_smarty_tpl->tpl_vars['ds']->value['payment_channel'];?>
</td>
                                <td><?php echo Lang::moneyFormat($_smarty_tpl->tpl_vars['ds']->value['price']);?>
</td>
                                <td class="text-primary"><?php echo Lang::dateTimeFormat($_smarty_tpl->tpl_vars['ds']->value['created_date']);?>
</td>
                                <td class="text-danger"><?php echo Lang::dateTimeFormat($_smarty_tpl->tpl_vars['ds']->value['expired_date']);?>
</td>
                                <td class="text-success"><?php if ($_smarty_tpl->tpl_vars['ds']->value['status'] != 1) {
echo Lang::dateTimeFormat($_smarty_tpl->tpl_vars['ds']->value['paid_date']);
}?></td>
                                <td><?php if ($_smarty_tpl->tpl_vars['ds']->value['status'] == 1) {
echo Lang::T('UNPAID');?>

                                    <?php } elseif ($_smarty_tpl->tpl_vars['ds']->value['status'] == 2) {
echo Lang::T('PAID');?>

                                    <?php } elseif ($_smarty_tpl->tpl_vars['ds']->value['status'] == 3) {
echo $_smarty_tpl->tpl_vars['_L']->value['FAILED'];?>

                                    <?php } elseif ($_smarty_tpl->tpl_vars['ds']->value['status'] == 4) {
echo Lang::T('CANCELED');?>

                                    <?php } elseif ($_smarty_tpl->tpl_vars['ds']->value['status'] == 5) {
echo Lang::T('UNKNOWN');?>

                                    <?php }?></td>
                            </tr>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </tbody>
                <?php }?>
            </table>
        </div>
        <?php $_smarty_tpl->_subTemplateRender("file:pagination.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    </div>
</div>

<?php if ($_smarty_tpl->tpl_vars['d']->value['coordinates']) {?>
    
        <?php echo '<script'; ?>
 src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
>
            function setupMap(lat, lon) {
                var map = L.map('map').setView([lat, lon], 17);
                L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/light_all/{z}/{x}/{y}.png', {
                attribution:
                    '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
                    subdomains: 'abcd',
                    maxZoom: 20
            }).addTo(map);
            var marker = L.marker([lat, lon]).addTo(map);
            }
            window.onload = function() {
                setupMap(<?php echo $_smarty_tpl->tpl_vars['d']->value['coordinates'];?>
);
            }
        <?php echo '</script'; ?>
>
    
<?php }
$_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
