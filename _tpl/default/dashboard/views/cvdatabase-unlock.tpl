<form method="post" action="{$BASE_URL}cvdb-payment/" role="form">
	<input type="hidden" id="employer_id" name="employer_id" value="{$EMP_ID}" />

	<div class="col-md-10 col-sm-12 locked mt25">
		<div class="modal1">
			<div class="modal fade in" id="myModal" role="dialog" style="display: block;">
				<div class="modal-dialog">
			
					<div class="modal-content">
						<div class="modal-body">
							<h4 class="modal-title md-hide">2/2</h4>
							<h4 class="modal-title md-show" style="display:none;">2/2</h4>

							<p class="tac">{$translations.paypal.payment_summary}</p>
							<br />

							<p class="tac">{$translations.invoice.price} : <span class="bold">{$PRICE_FORMATED}</span></p>

							{if $PRICE_VAT_FORMATED}
								<p class="tac">{$translations.post_step2.vat} <span class="bold">{$PRICE_VAT_FORMATED}</span></p>
							{/if}

							{if $PRICE_VAT_FORMATED}
								<p class="tac">{$translations.post_step2.fees} <span class="bold">{$PRICE_VAT_TOTAL_FORMATED}</span></p>
							{else}
								<p class="tac">{$translations.post_step2.fees} <span class="bold">{$PRICE_FORMATED}</span></p>
							{/if}

							<a href="{$BASE_URL}{$URL_DASHBOARD}/{$URL_DASHBOARD_ACCOUNT_ORDER}">
								<button type="submit" name="submit" id="submit" class="btn btn-default btn-lock">{$translations.paypal.pay}</button>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	

  </form>