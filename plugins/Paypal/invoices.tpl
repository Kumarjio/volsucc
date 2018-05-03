<div class="row board">
  <h2>{$translations.dashboard_recruiter.top_menu_invoices}</h2>
  <p>{$translations.dashboard_recruiter.invoices_section_desc}</p>
</div>
<br /><br />

<div class="row board mt0">
	<div class="table-responsive job-table">
		<table class="table table-striped">
		    <thead>
		      <tr>
		        <th><strong>{$translations.dashboard_recruiter.date_column}</strong></th>
		        <th><strong>{$translations.dashboard_recruiter.invoice_column}</strong></th>
		      </tr>
		    </thead>
		    <tbody>
		      {foreach from=$invoices item=invoice}
		      <tr>
		      	<td>{$invoice.date}</td>
		      	<td><a href="{$invoice.path}" target="_blank"><i class="fa fa-file-pdf-o fa-lg pdf-el" aria-hidden="true"></i></a></td>
		      </tr>
		      {/foreach}
		    </tbody>
		</table>
	</div>
</div>