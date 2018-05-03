{include file="layout/header.tpl"}

	<div class="container content top-offset unsubs-padding">
		<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 mt10">
		{if $success}
			<div class="positive-feedback-bracket">{$translations.subscriptions.unsubscription_successful_msg}</div>
			{include file="snippets/more-content.tpl"}
		{elseif $fail}
			<div class="negative-feedback-bracket">{$translations.subscriptions.unsubscription_unsuccessful_msg}</div>
			{include file="snippets/more-content.tpl"}
		</div>
		{else}
			<div class="row clearfix">
				<div class="col-md-12 column ">

				<h4 class="general-headline gray-border-bottom">{$translations.subscriptions.stop_subscription}</h4>
				<span class="light-font">
					{$translations.subscriptions.quit_msg}
				</span>
				<br /><br />

					<form role="form" method="post" action="/{$URL_UNSUBSCRIBE}">
						<input type="hidden" name="unsubscribe" value="{$auth}">
						<button type="submit" class="btn btn-default btn-success mbtn">{$translations.subscriptions.unsubscribe}</button>
						<a href="/"><button type="button" class="btn btn-default btn-warning  mbtn right-btn">{$translations.subscriptions.stay}</button></a>
					</form>
				</div>
			</div>
		{/if}
	</div><!-- #content -->

{include file="layout/footer.tpl"}
