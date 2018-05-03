<div class="row search-filter">
	<div class="col-md-3 col-xs-12">
		
		<!-- INDEED JOB TYPES -->
		{if !isset($hide_filter) and $indeedJobtypesCount}
		<div class="search-content">
			<h5 class="job-heading">{$translations.searchbar.job_types}</h5>
			<div class="filter-menu {if count($indeedJobtypes) > 8} scrollbar {/if}">
				<div class="filter-title">
					<h2>{$translations.searchbar.select}</h2>
					<i class="fa fa-angle-down" aria-hidden="true"></i>
				</div>
				<div id="indeed-jt-tab" class="filter-slide displayNone indeed-filter" >
 
			  	{section name=tmp loop=$indeedJobtypes}
					       {if $indeed_type == $indeedJobtypes[tmp].value}
						   		<label><h6><a class="act" href="{$BASE_URL}{$URL_JOBS}/{$indeedJobtypes[tmp].value}/">{$indeedJobtypes[tmp].name}</a></h6></label><br />
					       {else}
						   		<label><h6><a class="indeed-panel-link" href="{$BASE_URL}{$URL_JOBS}/{$indeedJobtypes[tmp].value}/">{$indeedJobtypes[tmp].name}</a></h6></label><br />
					       {/if}
			  	{/section}

				</div>
			</div>
			<br />
		</div>
		{/if}


	{if $REMOTE_PORTAL == 'deactivated'}

		{if $indeedCountriesCount and $indeedCountriesCount != '-1'}
		<div class="search-content">
			<h5 class="job-heading">{$translations.indeed.locations}</h5>
			<div class="filter-menu {if count($types) > 8} scrollbar {/if}">
				<div class="filter-title">
					<h2>{$translations.searchbar.select}</h2>
					<i class="fa fa-angle-down" aria-hidden="true"></i>
				</div>
				<div id="indeed-co-tab" class="filter-slide displayNone indeed-filter" >
				
				{for $index=0 to $indeedCountriesCount}

					{if $IndeedLocation == $indeedCountries[$index].value}
						<label><h6><a class="act" href="/location/{$indeedCountries[$index].value}">{$indeedCountries[$index].name}</a></h6></label><br />
					{else}
						<label><h6><a class="indeed-panel-link" href="/location/{$indeedCountries[$index].value}">{$indeedCountries[$index].name}</a></h6></label><br />
					{/if}

				{/for}

				</div>
			</div>
			<br />
		</div>
		{/if}

		{if $indeedCitiesCount and $indeedCitiesCount != '-1'}
		<div class="search-content">
			<h5 class="job-heading">{$translations.indeed.cities}</h5>
			<div class="filter-menu {if count($types) > 8} scrollbar {/if}">
				<div class="filter-title">
					<h2>{$translations.searchbar.select}</h2>
					<i class="fa fa-angle-down" aria-hidden="true"></i>
				</div>
				<div id="indeed-ci-tab" class="filter-slide displayNone indeed-filter" >

					{for $index=0 to $indeedCitiesCount}
	 					{if $IndeedCity == $indeedCities[$index].value}
							<label><h6><a class="act" href="/area/{$indeedCities[$index].value}">{$indeedCities[$index].name}</a></h6></label><br />

						{else}
							<label><h6><a class="indeed-panel-link" href="/area/{$indeedCities[$index].value}">{$indeedCities[$index].name}</a></h6></label><br />
						{/if}
				  	{/for}

				</div>
			</div>
			<br />
		</div>
		{/if}

	{/if}

</div>