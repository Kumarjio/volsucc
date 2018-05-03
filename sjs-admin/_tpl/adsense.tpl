{include file="header.tpl"} 

<div class="admin-content">
	<div class="admin-wrap-content" >
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<label class="admin-label">
				Google Adsense
			</label>
			<div class="subheading">Manage third party ads on your website. Copy & paste the adsense code in the following locations. Leave empty if you do not wish to display the ad.</div>
		</div>

		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mt25">
		
			<form id="adsense-form" name="adsense-form" method="post" action="{$BASE_URL_ADMIN}adsense/update" role="form" >
				 <div class="form-group mb50">
					<label for="home_sidebar">Home sidebar rectangle (optimal 300x250)</label>
					<textarea  class="form-control grayInput noTinymceTA" maxlength="2000" name="home_sidebar" id="home_sidebar" rows="4">{if $current_form}{$current_form.home_sidebar_value}{/if}</textarea>
				</div>

				<div class="form-group mb50">
					<label for="home_leaderboard">Home listing leaderboard (optimal 728x90). Displayed between every XY (specify at the bottom) ads.</label>
					<textarea  class="form-control grayInput noTinymceTA" maxlength="2000" name="home_leaderboard" id="home_leaderboard" rows="4" >{if $current_form}{$current_form.home_leaderboard_value}{/if}</textarea>
				</div>

				<div class="form-group mb50">
					<label for="detail_rectangle">Job detail rectangle (optimal 300x250)</label>
					<textarea  class="form-control grayInput noTinymceTA" maxlength="2000" name="detail_rectangle" id="detail_rectangle" rows="4" >{if $current_form}{$current_form.detail_rectangle_value}{/if}</textarea>
				</div>

				 <div class="form-group mb50">
					<label for="backoffice_rectangle">Recruiter backoffice sidebar rectangle (optimal 300x250)</label>
					<textarea  class="form-control grayInput noTinymceTA" maxlength="2000" name="backoffice_rectangle" id="backoffice_rectangle" rows="4" >{if $current_form}{$current_form.backoffice_rectangle_value}{/if}</textarea>
				</div>

				 <div class="form-group mb50">
					<label for="adsense_count">Display ads between every XY entries</label>
					<input  required name="adsense_count" id="adsense_count" maxlength="50" type="text" value="{$adsense_count}" class="form-control minput"  />
				</div>

				<div class="form-group mt30">
				   <button onclick="jobberBase.messages.add('Adsense saved');" type="submit" class="btn btn-default btn-primary mbtn" name="submit" id="submit" >Save</button>
				</div>
			</form>

		</div>

    </div>
</div><!-- #content -->

{include file="footer.tpl"}

