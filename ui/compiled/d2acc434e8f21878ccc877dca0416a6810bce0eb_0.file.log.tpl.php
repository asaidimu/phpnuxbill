<?php
/* Smarty version 4.5.3, created on 2024-07-22 11:00:02
  from '/home/augustine/projects/NuX/phpnuxbill/system/plugin/ui/log.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.3',
  'unifunc' => 'content_669e1182cbc097_07501665',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd2acc434e8f21878ccc877dca0416a6810bce0eb' => 
    array (
      0 => '/home/augustine/projects/NuX/phpnuxbill/system/plugin/ui/log.tpl',
      1 => 1721562939,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:sections/header.tpl' => 1,
    'file:sections/footer.tpl' => 1,
  ),
),false)) {
function content_669e1182cbc097_07501665 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/augustine/projects/NuX/phpnuxbill/system/vendor/smarty/smarty/libs/plugins/modifier.count.php','function'=>'smarty_modifier_count',),));
$_smarty_tpl->_subTemplateRender("file:sections/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<form class="form-horizontal" method="post" role="form" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/log_ui">
    <ul class="nav nav-tabs"> 
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['routers']->value, 'r');
$_smarty_tpl->tpl_vars['r']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['r']->value) {
$_smarty_tpl->tpl_vars['r']->do_else = false;
?> 
            <li role="presentation" <?php if ($_smarty_tpl->tpl_vars['r']->value['id'] == $_smarty_tpl->tpl_vars['router']->value) {?>class="active"<?php }?>>
                <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
plugin/log_ui/<?php echo $_smarty_tpl->tpl_vars['r']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['r']->value['name'];?>
</a>
            </li> 
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?> 
    </ul>
</form>
<style>
    /* Styles for overall layout and responsiveness */
    body {
        background-color: #f0f2f5;
        font-family: 'Arial', sans-serif;
    }
    .container {
        margin-top: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }
    .nav-tabs {
        border-bottom: 2px solid #dee2e6;
    }
    .nav-tabs .nav-link {
        color: #007bff;
        font-weight: bold;
    }
    .nav-tabs .nav-link:hover {
        background-color: #e9ecef;
        color: #0056b3;
    }
    .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
        color: #495057;
        background-color: #e9ecef;
        border-color: #dee2e6 #dee2e6 #fff;
    }
    .form-control {
        border-radius: 4px;
    }
    /* Styles for table and pagination */
    .table {
        width: 100%;
        margin-bottom: 1rem;
        background-color: #fff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .table th {
        vertical-align: middle;
        border-color: #dee2e6;
        background-color: #343a40;
        color: #fff;
    }
    .table td {
        vertical-align: middle;
        border-color: #dee2e6;
    }
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(0, 0, 0, 0.05);
    }
    .dataTables_length, .dataTables_filter {
        margin-bottom: 20px;
    }
    .pagination {
        justify-content: center;
        margin-top: 20px;
    }
    .pagination .page-item .page-link {
        color: #007bff;
        background-color: #fff;
        border: 1px solid #dee2e6;
        margin: 0 2px;
        padding: 6px 12px;
        transition: background-color 0.3s, color 0.3s;
    }
    .pagination .page-item .page-link:hover {
        background-color: #e9ecef;
        color: #0056b3;
    }
    .pagination .page-item.active .page-link {
        z-index: 1;
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
    }
    .pagination-container {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }
    /* Styles for log message badges */
    .badge {
        padding: 6px 12px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        border-radius: 4px;
        transition: background-color 0.3s, color 0.3s;
    }
    .badge-danger {
        color: #721c24;
        background-color: #f8d7da;
    }
    .badge-success {
        color: #155724;
        background-color: #d4edda;
    }
    .badge-warning {
        color: #856404;
        background-color: #ffeeba;
    }
    .badge-info {
        color: #0c5460;
        background-color: #d1ecf1;
    }
    .badge:hover {
        opacity: 0.8;
    }
</style>

<div id="logsys-mikrotik" class="container">
    <div class="row">
        <div class="col-sm-4 col-md-10">
            <div class="dataTables_length" id="data_length">
                <label>Show entries
                    <select name="data_length" aria-controls="data" class="custom-select custom-select-sm form-control form-control-sm" onchange="updatePerPage(this.value)">
                        <option value="5" <?php if ($_smarty_tpl->tpl_vars['per_page']->value == 5) {?>selected<?php }?>>5</option>
                        <option value="10" <?php if ($_smarty_tpl->tpl_vars['per_page']->value == 10) {?>selected<?php }?>>10</option>
                        <option value="25" <?php if ($_smarty_tpl->tpl_vars['per_page']->value == 25) {?>selected<?php }?>>25</option>
                        <option value="50" <?php if ($_smarty_tpl->tpl_vars['per_page']->value == 50) {?>selected<?php }?>>50</option>
                        <option value="100" <?php if ($_smarty_tpl->tpl_vars['per_page']->value == 100) {?>selected<?php }?>>100</option>
                    </select>
                </label>
            </div>
        </div>
        <div class="col-sm-2 col-md-2">
            <div id="data_filter" class="dataTables_filter">
                <label>Search:<input type="search" id="logSearch" class="form-control form-control-sm" placeholder="" aria-controls="data" onkeyup="filterLogs()"></label>
            </div>
        </div>
    </div>

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Time</th>
                <th>Topic</th>
                <th>Message</th>
            </tr>
        </thead>
        <tbody id="logTableBody">
            <?php $_smarty_tpl->_assignInScope('current_page', (($tmp = $_GET['page'] ?? null)===null||$tmp==='' ? 1 ?? null : $tmp));?>
            <?php $_smarty_tpl->_assignInScope('per_page', (($tmp = $_GET['per_page'] ?? null)===null||$tmp==='' ? 10 ?? null : $tmp));?>
            <?php $_smarty_tpl->_assignInScope('start_index', ($_smarty_tpl->tpl_vars['current_page']->value-1)*$_smarty_tpl->tpl_vars['per_page']->value);?>
            
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, array_reverse($_smarty_tpl->tpl_vars['logs']->value), 'log', false, NULL, 'logLoop', array (
  'index' => true,
));
$_smarty_tpl->tpl_vars['log']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['log']->value) {
$_smarty_tpl->tpl_vars['log']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_logLoop']->value['index']++;
?>
                <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_logLoop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_logLoop']->value['index'] : null) >= $_smarty_tpl->tpl_vars['start_index']->value && (isset($_smarty_tpl->tpl_vars['__smarty_foreach_logLoop']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_logLoop']->value['index'] : null) < ($_smarty_tpl->tpl_vars['start_index']->value+$_smarty_tpl->tpl_vars['per_page']->value)) {?>
                    <tr class="log-entry">
                        <td><?php echo $_smarty_tpl->tpl_vars['log']->value['time'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['log']->value['topics'];?>
</td>
                        <td class="log-message">
                            <?php if (strpos(mb_strtolower((string) $_smarty_tpl->tpl_vars['log']->value['message'], 'UTF-8'),'failed') !== false) {?>
                                <span class="badge badge-danger">Error</span>
                            <?php } elseif (strpos(mb_strtolower((string) $_smarty_tpl->tpl_vars['log']->value['message'], 'UTF-8'),'trying') !== false) {?>
                                <span class="badge badge-warning">Warning</span>
                            <?php } elseif (strpos(mb_strtolower((string) $_smarty_tpl->tpl_vars['log']->value['message'], 'UTF-8'),'logged in') !== false) {?>
                                <span class="badge badge-success">Success</span>
                            <?php } elseif (strpos(mb_strtolower((string) $_smarty_tpl->tpl_vars['log']->value['message'], 'UTF-8'),'login failed') !== false) {?>
                                <span class="badge badge-info">Login Info</span>
                            <?php } else { ?>
                                <span class="badge badge-info">Info</span>
                            <?php }?>
                            <?php echo $_smarty_tpl->tpl_vars['log']->value['message'];?>

                        </td>
                    </tr>
                <?php }?>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

        </tbody>
    </table>

    <?php $_smarty_tpl->_assignInScope('total_logs', smarty_modifier_count($_smarty_tpl->tpl_vars['logs']->value));?>
    <?php $_smarty_tpl->_assignInScope('last_page', ceil($_smarty_tpl->tpl_vars['total_logs']->value/$_smarty_tpl->tpl_vars['per_page']->value));?>

    <nav aria-label="Page navigation">
        <div class="pagination-container">
            <ul class="pagination">
                <?php if ($_smarty_tpl->tpl_vars['current_page']->value > 1) {?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?_route=plugin/log_ui&page=1&per_page=<?php echo $_smarty_tpl->tpl_vars['per_page']->value;?>
" aria-label="First">
                            <span aria-hidden="true">&laquo;&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="index.php?_route=plugin/log_ui&page=<?php echo $_smarty_tpl->tpl_vars['current_page']->value-1;?>
&per_page=<?php echo $_smarty_tpl->tpl_vars['per_page']->value;?>
" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                <?php }?>

                <?php $_smarty_tpl->_assignInScope('max_links', 5);?>

                <?php $_smarty_tpl->_assignInScope('start_page', max(1,$_smarty_tpl->tpl_vars['current_page']->value-floor($_smarty_tpl->tpl_vars['max_links']->value/2)));?>
                <?php $_smarty_tpl->_assignInScope('end_page', min($_smarty_tpl->tpl_vars['last_page']->value,$_smarty_tpl->tpl_vars['start_page']->value+$_smarty_tpl->tpl_vars['max_links']->value-1));?>

                <?php if ($_smarty_tpl->tpl_vars['start_page']->value > 1) {?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?_route=plugin/log_ui&page=<?php echo $_smarty_tpl->tpl_vars['start_page']->value-1;?>
&per_page=<?php echo $_smarty_tpl->tpl_vars['per_page']->value;?>
" aria-label="Previous">
                            <span aria-hidden="true">&hellip;</span>
                        </a>
                    </li>
                <?php }?>

                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, range($_smarty_tpl->tpl_vars['start_page']->value,$_smarty_tpl->tpl_vars['end_page']->value), 'page');
$_smarty_tpl->tpl_vars['page']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['page']->value) {
$_smarty_tpl->tpl_vars['page']->do_else = false;
?>
                    <li class="page-item <?php if ($_smarty_tpl->tpl_vars['page']->value == $_smarty_tpl->tpl_vars['current_page']->value) {?>active<?php }?>">
                        <a class="page-link" href="index.php?_route=plugin/log_ui&page=<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
&per_page=<?php echo $_smarty_tpl->tpl_vars['per_page']->value;?>
">
                            <?php echo $_smarty_tpl->tpl_vars['page']->value;?>

                        </a>
                    </li>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

                <?php if ($_smarty_tpl->tpl_vars['end_page']->value < $_smarty_tpl->tpl_vars['last_page']->value) {?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?_route=plugin/log_ui&page=<?php echo $_smarty_tpl->tpl_vars['end_page']->value+1;?>
&per_page=<?php echo $_smarty_tpl->tpl_vars['per_page']->value;?>
" aria-label="Next">
                            <span aria-hidden="true">&hellip;</span>
                        </a>
                    </li>
                <?php }?>

                <?php if ($_smarty_tpl->tpl_vars['current_page']->value < $_smarty_tpl->tpl_vars['last_page']->value) {?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?_route=plugin/log_ui&page=<?php echo $_smarty_tpl->tpl_vars['current_page']->value+1;?>
&per_page=<?php echo $_smarty_tpl->tpl_vars['per_page']->value;?>
" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="index.php?_route=plugin/log_ui&page=<?php echo $_smarty_tpl->tpl_vars['last_page']->value;?>
&per_page=<?php echo $_smarty_tpl->tpl_vars['per_page']->value;?>
" aria-label="Last">
                            <span aria-hidden="true">&raquo;&raquo;</span>
                        </a>
                    </li>
                <?php }?>
            </ul>
        </div>
    </nav>
</div>

<?php echo '<script'; ?>
>
  window.addEventListener('DOMContentLoaded', function() {
    var portalLink = "https://github.com/kevindoni";
    $('#version').html('Log Mikrotik | Ver: 1.0 | by: <a href="' + portalLink + '">Kevin Doni</a>');
  });

  function updatePerPage(value) {
    var urlParams = new URLSearchParams(window.location.search);
    urlParams.set('per_page', value);
    urlParams.set('page', 1); // Reset to first page
    window.location.search = urlParams.toString();
  }

  function filterLogs() {
    var input = document.getElementById('logSearch').value.toLowerCase();
    var table = document.getElementById('logTableBody');
    var tr = table.getElementsByClassName('log-entry');

    for (var i = 0; i < tr.length; i++) {
      var logMessage = tr[i].getElementsByClassName('log-message')[0].textContent || tr[i].getElementsByClassName('log-message')[0].innerText;
      if (logMessage.toLowerCase().indexOf(input) > -1) {
        tr[i].style.display = '';
      } else {
        tr[i].style.display = 'none';
      }
    }
  }
<?php echo '</script'; ?>
>

<?php $_smarty_tpl->_subTemplateRender("file:sections/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
