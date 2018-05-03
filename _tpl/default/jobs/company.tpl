{include file="1.5/layout/sjs-header.tpl"}
		
<div class="jobs-v1 company-detail">
	<div class="container">
 
		<div class="row mb2-half-p">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mlpl0">

				<div class="row mlpl0">

					<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 mlpl0" >
					</div>

					<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 mlpl0" >

		 				<ul class="nav navbar-nav pull-left ttu">
							<li><a href="{$BASE_URL}{$URL_COMPANIES}">{$translations.dashboard_recruiter.back}</a></li>
						</ul>

						<ul class="nav navbar-nav pull-right ttu">
							<li><a target="_blank" href="{$BASE_URL}{$URL_REGISTER_RECRUITERS}">{$translations.dashboard_recruiter.add_company}</a></li>
						</ul>
					</div>

				</div>

				<div class="row mlpl0">
					<div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 mlpl0" >
					</div>
					<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 mlpl0" >
						<img id="profile" class="img-responsive" src="{$BASE_URL}{$company.profile_picture}" />
					</div>

				</div>

				<div class="row mlpl0">
					<div class="col-lg-1 col-md-1 col-sm-1 hidden-xs mlpl0" >
					</div>

					<div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 mlpl0" >
						<div class="rise">
							<img id="profileLogo" class="img-responsive" src="{$BASE_URL}{$company.logo_path}" />
						</div>
					</div>

					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 mlpl0 comp-info-pad" >
						<h3>{$company.name}</h3><br />
						<p>{$company.description}</p><br />
						<a target="_blank" href="http://{$company.url}">{$company.url}</a>
					</div>

				</div>

			</div>
		</div> 

		<div class="row company-jobs">
	

			<div class="col-lg-1 col-md-1 hidden-sm col-xs-4 mlpl0" >
			</div>

			<div class="col-lg-10 col-md-10 col-sm-11 col-xs-12 comp-jobs-tablet-fix">

				<hr />

				<div class="row search-heading">
						<h2 class="tal-desk">{$translations.dashboard_recruiter.open_jobs}</h2>
				</div>

				<div id="job-listings">
				{if $jobs}
					{include file="jobs/company-posts-loop.tpl"}
				{else}
					<div class="centerMobile">
						{$translations.dashboard_recruiter.no_entries}
					</div>
				{/if}
				</div>		

	
			</div>

		</div>



		

	

	</div>
</div>

{include file="1.5/layout/sjs-footer.tpl"}