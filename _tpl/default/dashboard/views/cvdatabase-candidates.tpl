<div class="row cvSearchBlock mlm35">
	<form method="post" action="{$BASE_URL}{$URL_DASHBOARD}/{$URL_DASHBOARD_CVDATABASE}" role="form">

<div class="row">
	<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" >
		<label>{$translations.apply.occupation_label}</label>
		<input id="cvdb_occupation" {if $searched_occupation}value="{$searched_occupation}"{/if} name="cvdb_occupation" type="text" class="form-control minput" />
	</div>

	<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" >
		<label>{$translations.dashboard_recruiter.post_location_label}</label>
		<input id="cvdb_location" {if $searched_location}value="{$searched_location}"{/if} name="cvdb_location" type="text" class="form-control minput" />
	</div>

	<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" >
		<label>{$translations.js.skills_label}</label>
		<div class="minput textarea clearfix cvDbTaggle"></div>
	</div>

	<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" >
		<button name="submit" id="standartSearchBtn" type="submit" class="btn mbtn search-btn"><i class="fa fa-search" aria-hidden="true"></i> Поиск</button>
	</div>
</div>

	</form>
</div>

<hr />

<div class="candidates-list candidates-list-v2">
	<div class="container">
		<br />

			{if $applications}	
				 {section name=index loop=$applications}
					<div class="row cl-content">
						<div class="col-md-8 colx-xs-12">
							<h3>{$applications[index].fullname}</h3>
							<ul class="description">
								{if $applications[index].occupation != '-'}
									<li><i class="fa fa-lg fa-user-o" aria-hidden="true"></i> {$applications[index].occupation}</li>
								{/if}

								{if $applications[index].location != '-'}
									<li><i class="fa fa-lg fa-map-marker" aria-hidden="true"></i> {$applications[index].location}</li>
								{/if}
							</ul>
							<ul class="tags">
								{$applications[index].skills_formated}
							</ul>
						</div>
						<div class="col-md-4 col-sm-12 colx-xs-12">

						{if $applications[index].cv_path != '-'}
						<ul class="social">
								<a href="{$BASE_URL}{$applications[index].cv_path}" onclick="SimpleJobScript.subsctractCvDownload({$EMP_ID}, {$PAYMENT_MODE});"><i class="{$applications[index].fa_class}" aria-hidden="true"></i></a>
						</ul>
						{else}
						<br />
						{/if}

						<button type="button" data-toggle="modal" data-target="#modal_{$applications[index].id}" class="btn cv-btn">{$translations.apply.about}</button>

						</div>
					</div>
					<hr />

				{/section}
			{else}
				{$translations.dashboard_recruiter.no_candidates_msg}
			{/if}

			{include file="jobs/PAGINATOR.tpl"}

	</div>
</div>