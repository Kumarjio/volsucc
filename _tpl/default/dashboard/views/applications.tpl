
<style type="text/css">
.modal-body {
padding: 5% 3% !important;
}
.modal-dialog {
	margin-top: 10% !important;
}
</style>

<div class="row board mb25">
  <h2>{$translations.dashboard_recruiter.jobs_apps_headline}</h2>
  <p>{$translations.dashboard_recruiter.jobs_apps_desc}</p>
</div>
<br /><br />

<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 mlpl0 mb25">
	<form role="form">
		<label class="mb15" for="job_select">{$translations.dashboard_recruiter.select_jobs_title}</label>
			<i id="apps_spinner" class="ml15 displayNone fa fa-refresh fa-spin fa-lg fa-fw refresh-spinner"></i>
			<select id="job_select" name="job_select" class="form-control minput">
				{foreach from=$jobs_select key=id item=value}
					{if $select_job_id}
						{if $select_job_id == $id}
						<option selected value="{$id}">{$value}</option>
						{else}
						<option value="{$id}">{$value}</option>
						{/if}
					{else}
						<option value="{$id}">{$value}</option>
					{/if}
					}
				{/foreach}
			</select>
	</form>
</div>
<br /><br />

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mlpl0">
	<div class="table-responsive applications-table">
		<table class="table table-striped">
		    <thead>
		      <tr>
		        <th><strong>{$translations.apply.table_applicant}</strong></th>
		        <th><strong>{$translations.apply.occupation_label}</strong></th>
		        <th><strong>{$translations.apply.skills}</strong></th>
		        <th><strong>{$translations.apply.located}</strong></th>
		        <th><strong>{$translations.applications.cv}</strong></th>
		        <th><strong>{$translations.apply.table_message}</strong></th>
		        <th><strong>{$translations.apply.table_review}</strong></th>
		        <th><strong>{$translations.apply.table_delete}</strong></th>
		      </tr>
		    </thead>
		    <tbody id="ajax-content"></tbody>
		</table>
	</div>
</div>