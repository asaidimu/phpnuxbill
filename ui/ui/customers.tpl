{include file="sections/header.tpl"}
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
                {if in_array($_admin['user_type'],['SuperAdmin','Admin'])}
                    <div class="btn-group pull-right">
                        <a class="btn btn-primary btn-xs" title="save" href="{$_url}customers/csv"
                            onclick="return confirm('This will export to CSV?')"><span class="glyphicon glyphicon-download"
                                aria-hidden="true"></span> CSV</a>
                    </div>
                {/if}
                {Lang::T('Manage Contact')}
            </div>
            <div class="panel-body">
                <form id="site-search" method="post" action="{$_url}customers" style="">
                        <div class="col-lg-4">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <span class="fa fa-search"></span>
                                </div>
                                <input type="text" name="search" class="form-control"
                                    placeholder="{Lang::T('Search')}..." value="{$search}">
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
                            <a href="{$_url}customers/add" class="btn btn-success text-black btn-block" title="{Lang::T('Add')}">
                            <i class="ion ion-android-add"></i><i class="glyphicon glyphicon-user"></i>
                            </a>
                        </div>
                    </div>
                </form>
                <div  style="padding: 16px;">
                <ul class="nav nav-tabs">
                    <li role="presentation" {if $v=='online' }class="active"
                    {/if}><a
                    href="{$_url}customers/list/online">{Lang::T('Online
                    Customers')}</a></li>

                    <li role="presentation" {if $v=='hotspot' }class="active"
                    {/if}><a
                    href="{$_url}customers/list/hotspot">{Lang::T('Hotspot Customers')}</a></li>

                    <li role="presentation" {if $v=='pppoe' }class="active"
                    {/if}><a
                    href="{$_url}customers/list/pppoe">{Lang::T('PPPoE Customers')}</a></li>

                    <li role="presentation" {if $v=='static' }class="active"
                    {/if}><a
                    href="{$_url}customers/list/static">{Lang::T('Static Customers')}</a></li>

                    <li role="presentation" {if $v=='expired' }class="active"
                    {/if}><a
                    href="{$_url}customers/list/expired">{Lang::T('Expired Customers')}</a></li>

                    <li role="presentation" {if $v=='all' }class="active"
                    {/if}><a
                    href="{$_url}customers/list/all">{Lang::T('All Customers')}</a></li>

                    <li role="presentation" {if $v=='inactive' }class="active"
                    {/if}><a
                    href="{$_url}customers/list/inactive">{Lang::T('Inactive Customers')}</a></li>

                </ul>
                <div class="table-responsive table_mobile" style="padding: 16px;
                border: 1px #ddd solid;
                border-top: 0px">
                    <table id="customerTable" class="table table-bordered table-striped table-condensed">
                        <thead>
                            <tr>
                                <th>{Lang::T('Username')}</th>
                                <th>{Lang::T('Full Name')}</th>
                                <th>{Lang::T('Online')}</th>
                                <th>{Lang::T('Contact')}</th>
                                <th>{Lang::T('Package')}</th>
                                <th>{Lang::T('Wallet')}</th>
                                <th>{Lang::T('Type')}</th>
                                <th>{Lang::T('Service')}</th>
                                <th>{Lang::T('Created On')}</th>
                                <th>{Lang::T('Manage')}</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach $d as $ds}
                                <tr {if $ds['status'] != 'Active'}class="danger"{/if}>
                                    <td onclick="window.location.href = '{$_url}customers/view/{$ds['id']}'"
                                        style="cursor:pointer;">{$ds['username']}</td>
                                    <td onclick="window.location.href = '{$_url}customers/view/{$ds['id']}'"
                                        style="cursor: pointer;">{$ds['fullname']}</td>
                                    <td>
                                {if $ds["online"]}
                                    <small class="label bg-green">online</small>
                                {else}
                                    <small class="label bg-red">offline</small>
                                {/if}
                                    </td>
                                    <td align="center">
                                            {$ds['phonenumber']}
                                    </td>
                                    <td align="center">
                                {if $ds["name_plan"]}
                                    <small class="label bg-green">{$ds["name_plan"]}</small>
                                {else}
                                    <small class="label bg-red">Expired</small>
                                {/if}
                                    </td>
                                    <td>{Lang::moneyFormat($ds['balance'])}</td>
                                    <td>{$ds['account_type']}</td>
                                    <td>{$ds['service_type']}</td>
                                    <td>{Lang::dateTimeFormat($ds['created_at'])}</td>
                                    <td align="center">
                                        <a href="{$_url}customers/view/{$ds['id']}" id="{$ds['id']}"
                                            style="margin: 0px; color:black"
                                            class="btn btn-success btn-xs">&nbsp;&nbsp;{Lang::T('View')}&nbsp;&nbsp;</a>
                                        <a href="{$_url}customers/edit/{$ds['id']}" id="{$ds['id']}"
                                            style="margin: 0px; color:black"
                                            class="btn btn-info btn-xs">&nbsp;&nbsp;{Lang::T('Edit')}&nbsp;&nbsp;</a>
                                        <a href="{$_url}plan/recharge/{$ds['id']}" id="{$ds['id']}" style="margin: 0px;"
                                            class="btn btn-primary btn-xs">{Lang::T('Recharge')}</a>
                                    </td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script>
    var $j = jQuery.noConflict();
    $j(document).ready(function() {
        $j('#customerTable').DataTable({
            order: [[{$order_pos}, '{$orderby}']],
            "pagingType": "full_numbers",
            "lengthMenu": [
                [5, 10, 25, 50, 100, -1],
                [5, 10, 25, 50, 100, "All"]
            ],
            "pageLength": 25
        });
    });
</script>
{include file="sections/footer.tpl"}