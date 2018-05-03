{include file="layout/sjs-header.tpl"}

		<div class="container content top-offset">
			<div id="job-listings"></div><!-- #job-listings -->
			<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 mb10 mt10 wrap-msg">
				<div id="no-ads">
					<div class="negative-feedback-bracket mt5">{$translations.alljobs.no_job}</div>
					<p>
						{if $smarty.const.ENABLE_NEW_JOBS}
						<a href="{$BASE_URL}post/" title="{$translations.footer.new_job_title}">{$translations.footer.new_job}</a> &middot;
						{/if} 
						<a href="{$BASE_URL}">{$translations.notfound.back}</a>
					</p>
				</div>
			</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ml0 pl0">
			{include file="snippets/more-content.tpl"}
		</div>
		</div><!-- /content -->

{include file="layout/footer.tpl"}