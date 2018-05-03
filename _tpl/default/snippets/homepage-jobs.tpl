
{if $more_jobs}
<div class="jobs-v1">
	<div id="job-listings">
			<ul class="listings-block">
			{foreach item=job from=$more_jobs name='jobsLoop'}
				<!-- JOB LISTING TPL -->
				{include file="jobs/JOBS-LOOP.tpl"}
			{/foreach}
			</ul>
			<!-- PAGINATOR - NOT IMPLEMENTED FOR MORE JOBS. NEED TO ADD THIS IN CONTROLLER
			{include file="jobs/PAGINATOR.tpl"}-->
	</div>
</div>
{/if}