{if $jobs}

<div class="list">

{foreach item=job from=$jobs name=tmp}
	<div id="item{$job.id}" class="row settings-row p15" style="padding: 10px;">
		<div class="icons" >
			 {if $job.spotlight == 0}
				<a class="mr10 mb3" id="activateSpotlight{$job.id}" href="javascript:void(0);" onclick="Jobber.SpotlightActivate('{$BASE_URL_ADMIN}activate-spotlight/', {$job.id});" title="Включить выделение"><i class="fa fa-star-o fa-lg yellow-fa" aria-hidden="true"></i>
			{else}
				<a class="mr10 mb3" id="deactivateSpotlight{$job.id}" href="javascript:void(0);" onclick="Jobber.SpotlightDeactivate('{$BASE_URL_ADMIN}deactivate-spotlight/', {$job.id});" title="Выключить выделение"><i class="fa fa-star fa-lg yellow-fa" aria-hidden="true"></i></a>
			{/if}
			{if $job.is_active == 0}
				<a  class="mr10 mb3" id="activateLink{$job.id}" href="javascript:void(0);" onclick="Jobber.Activate('{$BASE_URL_ADMIN}activate/', {$job.id}, {if $CURRENT_PAGE == ''}1{else}0{/if});" title="Активация вакансии"><i class="fa fa-circle-o fa-lg green-fa" aria-hidden="true"></i></a>
			{else}
				<a  class="mr10 mb3" id="deactivateLink{$job.id}" href="javascript:void(0);" onclick="Jobber.Deactivate('{$BASE_URL_ADMIN}deactivate/', {$job.id});" title="Деактивация вакансии"><i class="fa fa-circle fa-lg green-fa" aria-hidden="true"></i></a>
			{/if}
			<a href="{$BASE_URL_ADMIN}edit-post/{$job.id}/" title="Редактирование вакансии"><i class="fa fa-gear fa-lg mr10" aria-hidden="true"></i></a>
			<a href="javascript:void(0);" onclick="Jobber.Delete('{$BASE_URL_ADMIN}delete/', {$job.id});" title="Удалить вакансию"><i class="fa fa-trash fa-lg blueColor" aria-hidden="true"></i></span></a>
			<br />
			<div class="clear"></div>
			<span class="fs13 gray" >{$job.post_date}</span>
		</div>

		<strong class="f14"><a style="color: #113E4D; text-decoration: none" href="{$BASE_URL_ADMIN}{$URL_JOB}/{$job.id}/{$job.url_title}/" title="{$job.title}">{$job.title}</a></strong> 
		<span class="f14"><span class="light">//</span> <span class="moderate-black" style="color: #39b6b3">{$job.company}{if $job.is_location_anywhere}, {$translations.jobs.location_anywhere}{else} </span><span class="light">//</span> <span class="moderate-black">{$job.location}</span>{/if}</span>
		<div>
			<span class="fs13 gray">просмотрено <strong>{$job.views_count} раз</span></strong>{if $statisticalData[$job.id]}, <strong>{$statisticalData[$job.id].numberOfApplications} applicants</strong>, 
			last application on <strong>{$statisticalData[$job.id].lastApplicationOn}</strong>{/if}{if $spamReportStatisticalData[$job.id]},
			<span class="spam"> reported as spam <strong>{$spamReportStatisticalData[$job.id].numberOfSpamReports} times</strong>, 
				last time on <strong>{$spamReportStatisticalData[$job.id].lastSpamReportOn}</strong></span>{/if}</div>
	</div>
{/foreach}
</div>

<div class="pagination">{$pages}</div>

{else}
	<div id="no-ads">
		Пока нет вакансий.
	</div>
{/if}