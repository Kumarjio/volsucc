{include file="header.tpl"}

	<div class="admin-content">
		<div class="admin-wrap-content" style="padding-right: 35px !important;">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<label class="admin-label">Город</label>
				{if $REMOTE_PORTAL == 'activated'}
				<div class="subheading">Удаленный портал активирован. Города не будут показаны. Измените <a target="_blank" href="/sjs-admin/settings/main/">.</a></div> <br />
				{/if}
			</div>
				<br /><br />

				<div class="ml15">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="list">
							{foreach from=$cities item=city}
							<div class="row settings-row p15" id="item{$city.id}" >
								<div class="icons">
									<a href="{$BASE_URL_ADMIN}cities/prepare-edit/{$city.id}/" title="Редактировать"><i class="fa fa-gear fa-lg mr10" aria-hidden="true"></i></a>
									<a href="javascript:void(0);" title="Удалить" onclick="jobberBase.deleteCity('{$BASE_URL_ADMIN}cities/delete/', {$city.id})"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a>
								</div>
								<span>{$city.name}</span> - ( {$city.ascii_name} )
							</div>
							{/foreach}
						</div>
						<p style="margin: 20px -10px;"><a href="{$BASE_URL_ADMIN}cities/prepare-add/" title="Добавить"><span title="Добавить" class="blueColor fui-plus-circle iconSize" aria-hidden="true"></span></a></p>
					</div>
				</div>
		</div><!-- #content -->
		</div>

{include file="footer.tpl"}

{if $cityAdded}
<script type="text/javascript">
   setTimeout(function(){
   	jobberBase.messages.add('Новый город создан');
   }, 1000);
</script>
{/if}

{if $cityEdited}
<script type="text/javascript">
   setTimeout(function(){
   	jobberBase.messages.add('Список городов обновлен');
   }, 1000);
</script>
{/if}