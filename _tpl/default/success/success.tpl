{include file="1.5/layout/sjs-header.tpl"}

<div class="action-req">
	<div class="container">
		<div class="row caution">
			<div class="col-md-12 col-xs-12">
				<div class="row">
					<div class="col-md-1 col-xs-12">
						<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
					</div>
					<div class="col-md-11 col-xs-12">
						<p>
						 <span>{$success_msg}</span>
						</p>

					</div>
				</div>
			</div>
		</div>

		{if $more_jobs}

			<br /><br />
			<div class="ml20 latest-jobs-title">
				<p>{$translations.alljobs.all_jobs}</p>
			</div>
			
			{foreach item=job from=$more_jobs name='jobsLoop'}
				{include file="jobs/JOBS-LOOP.tpl"}
			{/foreach}

			<!-- PAGINATOR - NOT IMPLEMENTED FOR MORE JOBS. NEED TO ADD THIS IN CONTROLLER
			{*include file="jobs/PAGINATOR.tpl"*}-->

		{/if}
		
	</div>
</div>

{include file="1.5/layout/sjs-footer.tpl"}