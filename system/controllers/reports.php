<?php

/**
 *  PHP Mikrotik Billing (https://zeiteckispradius.zeiteckcomputers.co.ke/)
 *  by https://t.me/Zadok
 **/

_admin();
$ui->assign('_title', Lang::T('Reports'));
$ui->assign('_system_menu', 'reports');

$action = $routes['1'];
$ui->assign('_admin', $admin);

$mdate = date('Y-m-d');
$mtime = date('H:i:s');
$tdate = date('Y-m-d', strtotime('today - 30 days'));
$firs_day_month = date('Y-m-01');
$this_week_start = date('Y-m-d', strtotime('previous sunday'));
$before_30_days = date('Y-m-d', strtotime('today - 30 days'));
$month_n = date('n');

/**
 * Add gateway fields to each transaction in the array.
 *
 * @param array $transactions The array of transactions.
 * @return array The array with the added 'fullname' field.
 */
function addFullname(array $transactions): array {
    return array_map(function($transaction) {
        $customer = Customer::getByAttribute("username", $transaction["username"]);
        $dataArray = json_decode($transaction["pg_paid_response"], true);
        $fullname = "PENDING";
        $balance = 0;
        if (json_last_error() === JSON_ERROR_NONE) {
          $fullname = isset($dataArray['FirstName']) ? $dataArray['FirstName'] : "PENDING";
          $balance = $dataArray["OrgAccountBalance"];
        }
      	if ($customer && !preg_match('/^\d+$/', $customer["fullname"])) {
          $fullname = $customer["fullname"];
        }
        $transaction['fullname'] = $fullname;
        $transaction['orig_balance'] = $balance;
        return $transaction;
    }, $transactions);
}

switch ($action) {
    case 'pending':
        $q = (_post('q') ? _post('q') : _get('q'));
        if ($q != '') {
            $query = ORM::for_table('tbl_payment_gateway')
                ->where_like("username", "PENDING-%")
              ->where("status", 2)
                ->where_like('gateway_trx_id', '%' . $q . '%')->order_by_desc('id');
            $d = Paginator::findMany($query);
        } else {
            $query = ORM::for_table('tbl_payment_gateway')
                ->where_like("username", "PENDING-%")
                ->where("status", 2)
                ->order_by_desc('id');
            $d = Paginator::findMany($query);
        }
        $transactions = $d->as_array();
        $ui->assign('transactions', addFullName($transactions));
        $ui->assign('q', $q);
        $ui->display('report-transactions.tpl');
        break;
    case 'transactions':
        $q = (_post('q') ? _post('q') : _get('q'));
        if ($q != '') {
            $query = ORM::for_table('tbl_payment_gateway')->where_like('gateway_trx_id', '%' . $q . '%')
              ->where("status", 2)
              ->order_by_desc('id');
            $d = Paginator::findMany($query);
        } else {
            $query = ORM::for_table('tbl_payment_gateway')
              ->where("status", 2)
              ->order_by_desc('id');
            $d = Paginator::findMany($query);
        }
        $transactions = $d->as_array();
        $ui->assign('transactions', addFullName($transactions));
        $ui->assign('q', $q);
        $ui->display('report-transactions.tpl');
        break;
    case 'activation':
        $q = (_post('q') ? _post('q') : _get('q'));
        $keep = _post('keep');
        if (!empty($keep)) {
            ORM::raw_execute("DELETE FROM tbl_transactions WHERE date < UNIX_TIMESTAMP(DATE_SUB(NOW(), INTERVAL $keep DAY))");
            r2(U . "logs/list/", 's', "Delete logs older than $keep days");
        }
        if ($q != '') {
            $query = ORM::for_table('tbl_transactions')->where_like('invoice', '%' . $q . '%')->order_by_desc('id');
            $d = Paginator::findMany($query, ['q' => $q]);
        } else {
            $query = ORM::for_table('tbl_transactions')->order_by_desc('id');
            $d = Paginator::findMany($query);
        }

        $ui->assign('activation', $d);
        $ui->assign('q', $q);
        $ui->display('reports-activation.tpl');
        break;
    case 'by-date':
    case 'daily-report':
        $query = ORM::for_table('tbl_transactions')->where('recharged_on', $mdate)->order_by_desc('id');
        $d = Paginator::findMany($query);
        $dr = $query->sum('price');

        $ui->assign('d', $d);
        $ui->assign('dr', $dr);
        $ui->assign('mdate', $mdate);
        $ui->assign('mtime', $mtime);
        run_hook('view_daily_reports'); #HOOK
        $ui->display('reports-daily.tpl');
        break;

    case 'by-period':
        $ui->assign('mdate', $mdate);
        $ui->assign('mtime', $mtime);
        $ui->assign('tdate', $tdate);
        run_hook('view_reports_by_period'); #HOOK
        $ui->display('reports-period.tpl');
        break;

    case 'period-view':
        $fdate = _post('fdate');
        $tdate = _post('tdate');
        $stype = _post('stype');

        $d = ORM::for_table('tbl_transactions');
        if ($stype != '') {
            $d->where('type', $stype);
        }

        $d->where_gte('recharged_on', $fdate);
        $d->where_lte('recharged_on', $tdate);
        $d->order_by_desc('id');
        $x =  $d->find_many();

        $dr = ORM::for_table('tbl_transactions');
        if ($stype != '') {
            $dr->where('type', $stype);
        }

        $dr->where_gte('recharged_on', $fdate);
        $dr->where_lte('recharged_on', $tdate);
        $xy = $dr->sum('price');

        $ui->assign('d', $x);
        $ui->assign('dr', $xy);
        $ui->assign('fdate', $fdate);
        $ui->assign('tdate', $tdate);
        $ui->assign('stype', $stype);
        run_hook('view_reports_period'); #HOOK
        $ui->display('reports-period-view.tpl');
        break;

    default:
        $ui->display('a404.tpl');
}
