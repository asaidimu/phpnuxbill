{include file="sections/header.tpl"}
<section class="content">
    <div class="panel panel-primary panel-hovered panel-stacked mb30">
        <div class="panel-heading">{Lang::T('Create Capture Portal')}</div>
            <div class="panel-body">
                <form method="POST" class="form-horizontal" action="{$_url}plugin/generate_portal" role="form" enctype="multipart/form-data">
                    <div class="box-body">
                            <div class="form-group">
                                <label class="col-md-2 control-label for="title">HotSpot Title</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="title" id="title" value="{$title}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label for="description">HotSpot Description</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="description" id="description" value="{$description}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">
                                    {Lang::T('Router Name')}
                                </label>
                                <div class="col-md-6">
                                    <select id="routers" name="router" required class="form-control select2">
                                        <option value=''>{Lang::T('Select Router')}</option>
                                            {foreach $routers as $router}
                                                <option value="{$router['name']}">{$router['name']}</option>
                                            {/foreach}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info pull-right" style="margin:1.5rem;">Download Login Page</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
{include file="sections/footer.tpl"}