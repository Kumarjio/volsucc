<div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">

               <!-- JOB TYPES -->
               {if $indeedJobtypesCount}
                  <li class="sidebar-brand">
                    <a>{$translations.searchbar.job_types}</a>
                  </li>
                  {if ! isset($hide_filter)}
                   {for $index=0 to $indeedJobtypesCount}
                        <li id="{$indeedJobtypes[$index].name}" class="{if $indeed_type == $indeedJobtypes[$index].value}sidemenu_selected{/if}">
                              <a href="{$BASE_URL}{$URL_JOBS}/{$indeedJobtypes[$index].value}/">{$indeedJobtypes[$index].name}</a>
                        </li>
                   {/for}
                  {/if}
                <!-- ######### -->
                {/if}

                {if $REMOTE_PORTAL == 'deactivated'}

                 {if $indeedCountriesCount}
                    <!-- CITIES -->
                    <li class="sidebar-brand">
                      <a>{$translations.indeed.locations}</a>
                    </li>
                    {for $index=0 to $indeedCountriesCount}
                      {if $IndeedLocation == $indeedCountries[$index].value}
                        <li><a class="sidemenu_selected" href="/location/{$indeedCountries[$index].value}">{$indeedCountries[$index].name}</a></li>
                      {else}
                        <li><a href="/location/{$indeedCountries[$index].value}">{$indeedCountries[$index].name}</a></li>
                      {/if}
                    {/for}
                  {/if}


                  {if $indeedCitiesCount}
                    <!-- CITIES -->
                    <li class="sidebar-brand">
                      <a>{$translations.indeed.cities}</a>
                    </li>
                    {for $index=0 to $indeedCitiesCount}
                      {if $IndeedCity == $indeedCities[$index].value}
                        <li><a class="sidemenu_selected" href="/area/{$indeedCities[$index].value}">{$indeedCities[$index].name}</a></li>
                      {else}
                        <li><a href="/area/{$indeedCities[$index].value}">{$indeedCities[$index].name}</a></li>
                      {/if}
                    {/for}
                  {/if}
                {/if}

            </ul>
        </div>
        <!-- /#sidebar-wrapper -->
</div>