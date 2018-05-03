
{section name=index loop=$applications}
 <div id="modal_{$applications[index].id}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{$translations.js.candidate_profile}</h4>
      </div>

	 <div class="modal-body">
      	<span class="modal-label">{$translations.js.applied_label}</span><br /><br />
      		{$applications[index].created_on}
      </div>
      <div class="modal-body">
      		<span class="modal-label">{$translations.js.email_label}</span><br /><br />
      		{$applications[index].email}
      </div>
      {if $applications[index].phone and $applications[index].phone != '-'}
      <div class="modal-body">
      		<span class="modal-label">{$translations.js.phone_label}</span><br /><br />
      		<a href="tel:{$applications[index].phone}">{$applications[index].phone}</a>
      </div>
      {/if}

      {if $applications[index].weblink and $applications[index].weblink != '-'}
   	  <div class="modal-body">
      		<span class="modal-label">{$translations.js.website_label}</span><br /><br />
      		<a href="http://{$applications[index].weblink}" target="_blank">{$applications[index].weblink_short}</a>
      </div>
      {/if}

      {if $applications[index].sm_links}
      <div class="modal-body">
      		<span class="modal-label">{$translations.js.social_media_label}</span><br /><br />
			 {foreach $applications[index].sm_links as $SM_OBJ}
				 	 <a class="mr12" href="{if $SM_OBJ->whatsapp == 'true'}tel:{$SM_OBJ->whatsapp_numb}{else}{$SM_OBJ->linkToShow}{/if}" target="_blank"><i class="fa fa-{$SM_OBJ->icon} fa-lg mt10" aria-hidden="true"></i></a>
			 {/foreach}
      </div>
      {/if}

      <div class="modal-body">
      		<span class="modal-label">{$translations.js.application_message}</span><br /><br />
      		{$applications[index].message}
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-green" data-dismiss="modal">{$translations.js.close}</button>
      </div>
    </div>

  </div>
</div>
 {/section}