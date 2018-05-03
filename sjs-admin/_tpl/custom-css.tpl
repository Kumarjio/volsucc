{include file="header.tpl"}
		
<div class="admin-content">
 <div class="admin-wrap-content">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
	<label class="admin-label">Custom Styles</label>
	<div class="subheading">Below, you can change the color scheme of the website elements.</div>
	</div>

	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mt25">
	    <form method="post" action="{$BASE_URL_ADMIN}css" role="form">
			<div class="form-group">
			  <textarea class="form-control" rows="20" name="cssarea" id="cssarea">{$data}</textarea>
			</div>
			<div class="form-group" style="margin-top: 30px;">
			   <button type="submit"  class="btn btn-default btn-primary mbtn" name="submit" id="submit" >Submit</button>
			</div>
		</form>
    </div>
    </div>
</div>

{if $updated == 'true'}
<script type="text/javascript">
   setTimeout(function(){
   	jobberBase.messages.add('Styles have been updated');
   }, 1000);
</script>
{/if}

{include file="footer.tpl"}