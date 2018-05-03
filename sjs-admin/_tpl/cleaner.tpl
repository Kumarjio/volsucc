{include file="header.tpl"} 

<div class="admin-content">
  <div class="admin-wrap-content" >
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb25">
			<label class="admin-label">
				Очистка базы данных
			</label>
			<div class="subheading">Вы можете удалить ненужные записи базы данных в этом разделе.</div>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<ul class="list-group cleaner">
			  <li class="list-group-item">Временные рабочие места - <strong>{$tmp_count}</strong><div class="float-right"><a href="{$BASE_URL_ADMIN}cleaner/tmp"><button type="button" class="mbtn btn btn-default alizarinBtn">Очистить</button></a></div></li>
			  	 <li class="list-group-item">Истекшие вакансии - <strong>{$exp_count}</strong><div class="float-right"><a href="{$BASE_URL_ADMIN}cleaner/exp"><button type="button" class="mbtn btn btn-default alizarinBtn">{if $EXPIRED_JOBS_ACTION == 'deactivate'}Деактивировать{else}CLEAN{/if}</button></a></div></li>
			</ul>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			{if $popup}
				<div class="alert alert-info fade in main-color">
				    <a href="#" class="close" data-dismiss="alert">&times;</a>
				    <i class="fa fa-check" aria-hidden="true"></i>
				   Резервные записи были успешно очищены.
				</div>
			{/if}
		</div>
  </div>
</div>



{include file="footer.tpl"}