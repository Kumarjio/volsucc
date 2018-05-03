{include file="layout/header.tpl"}
	<div class="container content top-offset unsubs-padding ">
		<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 mt10 wrap-msg">
			{if $success}
			<div class="positive-feedback-bracket">
				{$translations.subscriptions.confirmed_msg}
			</div>
			{else}
			<div class="negative-feedback-bracket">
				{$msg}
			</div>
			{/if}
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ml0 pl0">
			{include file="snippets/more-content.tpl"}
		</div>
		
	</div><!-- #content -->
{include file="layout/footer.tpl"}
