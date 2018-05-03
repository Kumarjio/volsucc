{include file="header.tpl"}
		
		<div class="admin-content" >
		 <div class="admin-wrap-content">
			<div id="job-listings">
				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<label class="admin-label">
						{$translations.category.jobs_for} {$current_category_name} {if $current_type}/ {$current_type}{/if}
					</label>
				</div>
				<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 mb15">
					<div id="sort-by-type">
					{$translations.category.display_only}&nbsp; 
					<a href="{$BASE_URL_ADMIN}{$URL_JOBS}/{$current_category}" title="All" >
					  <div class="box">
						Cброс
					  </div>
					</a>
						{section name=tmp loop=$types}
						<a class="{if $current_type == $types[tmp].var_name}active{/if}" href="{$BASE_URL_ADMIN}{$URL_JOBS}/{$current_category}/{$types[tmp].var_name}/" title="{$current_category} {$types[tmp].name}" >
						  <div class="box">
							{$types[tmp].name}
						  </div>
						  </a>
						{/section}
					</div>
				</div>
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="container-fluid">
						{include file="posts-loop.tpl"}
					</div>
				</div>

			</div>
		</div>
		</div>

{if $JOB_EDITED == 'true'}
<script type="text/javascript">
   setTimeout(function(){
   	jobberBase.messages.add('Вакансия изменена');
   }, 1000);
</script>
{/if}

{include file="footer.tpl"}