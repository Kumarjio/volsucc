

{if $CVDB_ACCESS_RESULT == 'true'}

<div class="row board">
  <h2>{$translations.dashboard_recruiter.cvdb_headline}</h2>

	 {if $ACCESS_GRANTED_MSG}
     	<p>{$ACCESS_GRANTED_MSG}</p>
     {else}
     	<p>{$translations.dashboard_recruiter.cvdb_desc}</p>
     	{if $PAYMENT_MODE == '3'}
     	<br />
     	<div class="orange">{$msg}</div>
     	{/if}
     {/if} 

</div>
<br /><br />

{include file="dashboard/views/cvdatabase-candidates.tpl"}

{else}

	{if $lock_screen}

		<!-- PACKAGES MODE -->
		<div class="col-md-10 col-sm-12 locked mt25">
		<div class="modal1">
			<div class="modal fade in" id="myModal" role="dialog" style="display: block;">
				<div class="modal-dialog">
			
					<div class="modal-content">
						<div class="modal-body">
							<h4 class="modal-title md-hide">1/2</h4>
							<h4 class="modal-title md-show" style="display:none;">2/2</h4>
							{if $PAYMENT_MODE == '3'}<p class="tac">{$msg}</p>{/if}
							<img class="anim-pic" src="{$BASE_URL}_tpl/default/1.5/images/lock-image.png">
							<a href="{$BASE_URL}{$URL_DASHBOARD}/{$URL_DASHBOARD_ACCOUNT_ORDER}">
								<button type="button" class="btn btn-renew">{$translations.post_step1.renew}</button>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	

	{else}

	<!-- FEES MODE -->
	<div class="col-md-10 col-sm-12 locked mt25">
		<div class="modal1">
			<div class="modal fade in" id="myModal" role="dialog" style="display: block;">
				<div class="modal-dialog">
			
					<div class="modal-content">
						<div class="modal-body">
							<h4 class="modal-title md-hide">1/2</h4>
							<p class="tac">{$CVDB_MSG}</p>
							<img class="anim-pic" src="{$BASE_URL}_tpl/default/1.5/images/lock-image.png">
							<a href="{$BASE_URL}{$URL_DASHBOARD}/{$URL_DASHBOARD_CVDATABASE}/2">
								<button type="button" class="btn btn-default btn-lock">{$translations.dashboard_recruiter.unlock}</button>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	

	{/if}

{/if}