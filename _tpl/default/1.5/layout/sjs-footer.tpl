<div class="footer">
	<div class="container">
		<div class="row">
			<div class="col-md-3 footer-f2">
			</div>
			<div class="col-md-3 col-xs-4 footer-f1">
				<ul>
				<!--{foreach item=navitem from=$navigation name=i}
					 	{if $navitem->is_external == '1'}
					 		<li><a title="{$navitem->name}" target="_blank" href="{$navitem->external_url}">{$navitem->name}</a></li>
					 	{else}
					 		<li><a title="{$navitem->title}" href="{$BASE_URL}{$navitem->url}">{$navitem->name}</a></li>
					 	{/if}
				{/foreach}
			-->
			<ul>
									 						 		<li><a title="Контакты. Напишите нам." href="/contact">Контакты</a></li>
					 										 						 		<li><a title="О нас" href="/about">О нас</a></li>
					 										 						 		<li><a title="Подписаться" href="/subscribe">Подписаться</a></li>
					 					
				</ul>
				</ul>
			</div>
			<div class="col-md-3  footer-f5">
				<ul>
					<li><a href="#"><i class="fa fa-vk"></i></a></li>
					<li><a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
					<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
					<li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
				</ul>
			</div>

			<div class="col-md-3 footer-f2">
				<ul>
					<script class="hh-script" src="https://api.hh.ru/widgets/vacancies/search?count=3&locale=RU&links_color=1560b2&border_color=1560b2&area=1511"></script>
				</ul>
			</div>
		</div>
			<!--
<div class="col-md-3 col-xs-4 footer-f3">
				<ul>
					<li>{$translations.website_general.top_menu_applicants}</li>
					{if $PROFILES_PLUGIN and $PROFILES_PLUGIN == 'true'}
						<li><a href="{$BASE_URL}{$URL_REGISTER_APPLICANTS}">{$translations.website_general.top_menu_addcv}</a></li>
						<li><a href="{$BASE_URL}{$URL_LOGIN_APPLICANTS}">{$translations.registration.sign_in}</a></li>
					{/if}
					<li><a href="{$BASE_URL}{$URL_JOBS}">{$translations.website_general.browse_jobs}</a></li>
				</ul>
			</div>
			<div class="col-md-3 col-xs-4 footer-f4">
				<ul>
					<li>{$translations.website_general.top_menu_recruiters}</li>
					<li><a href="{$BASE_URL}{$URL_DASHBOARD}/{$URL_DASHBOARD_POST}">{$translations.dashboard_recruiter.top_menu_postajob}</a></li>
					{if $PROFILES_PLUGIN}<li><a href="{$BASE_URL}{$URL_DASHBOARD}/{$URL_DASHBOARD_CVDATABASE}">{$translations.website_general.search_resumes}</a></li>{/if}
					<li><a href="{$BASE_URL}{$URL_LOGIN_RECRUITERS}">{$translations.registration.sign_in}</a></li>
				</ul>
			</div>
		-->

			


		<div class="row copyright">
			<div class="col-md-6 f-left">
				<p>{$SITE_NAME} &copy; {$YEAR}</p> 
			</div>
			<div class="col-md-2 f-center">
				<a href="{$BASE_URL}"><img class="site-logo" src="{$BASE_URL}{$SITE_LOGO_PATH}" alt="Website's Logo"></a>
			</div>
			<div class="col-md-4 f-right">
				<div id="library-loads"></div>
			</div>
		</div>
	</div>
</div>

{if $dashboard_footer_flag}
	{include file="1.5/layout/dashboard-snippets.tpl"}
{else}
	{include file="1.5/layout/js-snippets.tpl"}
{/if}

</div> <!-- WRAPPER CLOSED -->

</body>
</html>