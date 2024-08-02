{include file="sections/header.tpl"}
<!-- pool -->
<div class="row">
  <div class="col-sm-12">
    <div class="panel panel-hovered mb20 panel-primary">
      <div class="panel-heading">Payment Transaction Log</div>
      <div class="panel-body">
        <div class="text-center" style="padding: 15px">
          <div class="col-md-4">
            <form
              id="site-search"
              method="post"
              action="{$_url}reports/transactions"
            >
              <div class="input-group">
                <div class="input-group-addon">
                  <span class="fa fa-search"></span>
                </div>
                <input
                  type="text"
                  name="q"
                  class="form-control"
                  value="{$q}"
                  placeholder="{Lang::T('Transaction code')}..."
                />
                <div class="input-group-btn">
                  <button class="btn btn-success" type="submit">
                    {Lang::T('Search')}
                  </button>
                </div>
              </div>
            </form>
          </div>
          <div class="col-md-8"></div>
          &nbsp;
        </div>
        <br />
        <div class="table-responsive">
          <table id="datatable" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>{Lang::T('Payment Gateway')}</th>
                <th>{Lang::T('Payment Method')}</th>
                <th>{Lang::T('Account Number')}</th>
                <th>{Lang::T('Full Name')}</th>
                <th>{Lang::T('Code')}</th>
                <th>{Lang::T('Original Balance')}</th>
                <th>{Lang::T('Amount')}</th>
                <th>{Lang::T('Date')}</th>
              </tr>
            </thead>
            <tbody>
              {foreach $transactions as $ds}
              <tr>
                <td>{$ds["gateway"]}</td>
                <td>{$ds["payment_method"]}</td>
                <td
                  onclick="window.location.href = '{$_url}customers/viewu/{$ds['username']}'"
                  style="cursor: pointer"
                >
                  {$ds['username']}
                </td>
                <td>{$ds["fullname"]}</td>
                <td>{$ds["gateway_trx_id"]}</td>
                
                <td>{Lang::moneyFormat($ds['orig_balance'])}</td>
                <td>{Lang::moneyFormat($ds['price'])}</td>
                <td class="text-success">
                  {Lang::dateAndTimeFormat($ds['paid_date'],$ds['recharged_time'])}
                </td>
              </tr>
              {/foreach}
            </tbody>
          </table>
        </div>
        {include file="pagination.tpl"}
      </div>
    </div>
  </div>
</div>

{include file="sections/footer.tpl"}
