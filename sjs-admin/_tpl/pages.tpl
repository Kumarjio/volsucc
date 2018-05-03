{include file="header.tpl"}
		<div class="admin-content">
		 <div class="admin-wrap-content" style="padding-right: 35px !important;">
			 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mobMargin">
				<label class="admin-label">Страницы</label>
				<div class="subheading">Шаблоны для статических страниц можно найти в папке _tpl/default/static</div>
			</div>
			<br /><br />

			<div class="ml15">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

				<div class="list">
				{foreach from=$pages item=page}
					<div class="row settings-row p15" >
						<div class="icons">
							<a class="mr5" href="{$BASE_URL}{$page.url}/" target="_blank" title="Просмотр страницы"><i class="fa fa-eye fa-lg mr5" aria-hidden="true"></i></a>
							<a class="mr5" href="{$BASE_URL_ADMIN}pages/edit/{$page.id}/" title="Редактирование страницы"><i class="fa fa-gear fa-lg mr5" aria-hidden="true"></i></a>

						<a href="{$BASE_URL_ADMIN}pages/delete/{$page.id}/" title="Удалить страницу" onclick="if(!confirm('Вы точно желаете удалить страницу?'))return false;"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a>
						</div>
						<span class="dark-font">{$page.page_title}</span>  - <span>{if $page.is_external == '0'}( {$page.url} ){else}( {$page.external_url} ){/if} </span>
					</div>
				{/foreach}
				<p style="margin: 20px -10px;">
					<a href="{$BASE_URL_ADMIN}pages/add/" title="Добавить новую страницу" style="margin-top:"><span title="Добавить новую страницу" class="blueColor fui-plus-circle iconSize" ></span></a>
				</p>
				</div>
			</div></div>

		</div><!-- #content -->
	</div>
{include file="footer.tpl"}

{if $updated == 'true'}
<script type="text/javascript">
   setTimeout(function(){
   	jobberBase.messages.add('Страница обновлена');
   }, 1000);
</script>
{/if}

{if $deleted == 'true'}
<script type="text/javascript">
   setTimeout(function(){
   	jobberBase.messages.add('Страница удалена');
   }, 1000);
</script>
{/if}

{if $added == 'true'}
<script type="text/javascript">
   setTimeout(function(){
   	jobberBase.messages.add('Новая страница добавлена');
   }, 1000);
</script>
{/if}