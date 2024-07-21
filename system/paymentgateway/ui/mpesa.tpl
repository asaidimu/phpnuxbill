{include file="sections/header.tpl"}

<form class="form-horizontal" method="post" role="form" action="{$_url}paymentgateway/mpesa" >
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="panel panel-primary panel-hovered panel-stacked mb30">
                <div class="panel-heading">M-Pesa</div>
                <div class="panel-body row">
                    <div class="form-group col-6">
                        <label class="col-md-2 control-label">Consumer Key</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="MPESA_CONSUMER_KEY" name="MPESA_CONSUMER_KEY" placeholder="xxxxxxxxxxxxxxxxx" value="{$_c['MPESA_CONSUMER_KEY']}">
                            <small class="form-text text-muted"><a href="https://developer.safaricom.co.ke/MyApps" target="_blank">https://developer.safaricom.co.ke/MyApps</a></small>
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label class="col-md-2 control-label">Consumer Secret</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" id="MPESA_CONSUMER_SECRET" name="MPESA_CONSUMER_SECRET" placeholder="xxxxxxxxxxxxxxxxx" value="{$_c['MPESA_CONSUMER_SECRET']}">
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <label class="col-md-2 control-label">Business Shortcode</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control"
                            id="MPESA_SHORTCODE" name="MPESA_SHORTCODE"
                            placeholder="xxxxxxx" maxlength="7"
                            value="{$_c['MPESA_SHORTCODE']}">
                        </div>
                    </div>
					<div class="form-group col-6">
                        <label class="col-md-2 control-label">Pass Key</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="MPESA_PASSKEY" name="MPESA_PASSKEY" placeholder="bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919" maxlength="" value="{$_c['MPESA_PASSKEY']}">
                        </div>
                    </div>

	                  <div class="form-group col-6">
                        <label class="col-md-2 control-label">Surpport Offline Pay Methods / C2B Pay Methods</label>
                        <div class="col-md-6">
                            <select class="form-control" name="MPESA_CHANNEL">
                                <option value="0" {if $_c['MPESA_CHANNEL'] == 0}selected{/if}>No</option>
                                <option value="1" {if $_c['MPESA_CHANNEL'] == 1}selected{/if}>Yes</option>
                            </select>
                            <small class="form-text text-muted">Enable this if you want to support offline payment methods.</small>
                        </div>
                    </div>

                     <div class="form-group col-6">
                        <label class="col-md-2 control-label">Version of the API</label>
                        <div class="col-md-6">
                            <select class="form-control" name="MPESA_API_VERSION">
                                <option value="v1" {if $_c['MPESA_API_VERSION'] == 'v1'}selected{/if}>v1</option>
                                <option value="v2" {if $_c['MPESA_API_VERSION'] == 'v2'}selected{/if}>v2</option>
                            </select>
                            <small class="form-text text-muted">Select the version of the API you want to use.</small>
                          </div>
                    </div>



					<div class="form-group col-6">
                        <label class="col-md-2 control-label">M-Pesa Environment</label>
                        <div class="col-md-6">
                            <select class="form-control" name="MPESA_ENV">
                                {foreach $env as $environment}
                                    <option value="{$environment['id']}"
                                    {if $environment['id'] == $_c['MPESA_ENV']}selected{/if}
                                    >{$environment['id']} - {$environment['name']}</option>
                                {/foreach}
                            </select>
                            <small class="form-text text-muted"><font color="red"><b>Sandbox</b></font> is for testing purpose, please switch to <font color="green"><b>Live</b></font> in production.</small>
                        </div>
                    </div>

                    <div class="form-group col-6">
                        <label class="col-md-2 control-label">Url Notification</label>
                        <div class="col-md-6">
                            <input type="hidden" name="MPESA_CALLBACK_URL" value="{APP_URL}/system/api.php?r=mcallback">
                            <input type="text"
                            class="form-control" onclick="this.select()"
                            disabled value="{APP_URL}/system/api.php?r=mcallback">
                            <p class="help-block">CallBack URL</p>
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
{include file="sections/footer.tpl"}
