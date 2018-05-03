{include file="header.tpl"}
		
<div class="admin-content">
 <div class="admin-wrap-content">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
	<label class="admin-label">Companies</label>
	<div class="subheading">Company name in red color indicates that employer has not confirmed his email address</div>
	</div>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<ul class="applicants-list ">  
				{foreach item=company from=$companies name=obj} 
				    <li class="p40"> 

				    <span><span class="{if $company.confirmed == '1'}green{else}red{/if}">{$company.name}</span>&nbsp;/&nbsp;{$company.email}</span>

			    	<div style="float:right;">

				    	<a href="{$BASE_URL_ADMIN}company/{$company.emp_id}"><button type="submit" class="btn btn-default btn-primary mbtn" style="width: 85px !important; background-color: #E74C3C">Detail</button></a>

				    </div>


					</li>
				{/foreach}
			</ul>
			<br />
			<div class="pagination">{$pages}</div>
    </div>
    {if $deletedPopup == 'true'}
      <script type="text/javascript">
       setTimeout(function(){
       	jobberBase.messages.add('Company has been deleted');
       }, 1000);
      </script>
    {/if}
 </div>
</div>

{include file="footer.tpl"}