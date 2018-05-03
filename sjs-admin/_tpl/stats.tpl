{include file="header.tpl"}
		
		<div class="admin-content">
		  <div class="admin-wrap-content">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb20">
			  <label class="admin-label">Статистика</label>
			  <!--<div>{if not $PAYPAL_PLUGIN} Note: Paypal payment plugin missing.{/if}</div>-->
			</div>
			<br /><br />

			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				
				<!--{if $PAYPAL_PLUGIN == '1'}
				<div class="row-fluid">
					<div class="light">Payments / orders</div>
						<div class="row dash-boxes">
							<div class="dash-box1">
								<div class="row dash-icon" style="margin: 0; padding: 0;">{$payment_reports['this_week']}</div>
								<div class="row dash-text" >payments this week</div>
							</div>
							<div class="dash-box2">
								<div class="row dash-icon" style="margin: 0; padding: 0;">{$payment_reports['this_month']}</div>
								<div class="row dash-text" >payments this month</div>
							</div>
							<div class="dash-box3">
								<div class="row dash-icon" style="margin: 0; padding: 0;">{$payment_reports['monthly_revenue']}</div>
								<div class="row dash-text" >last 30 days revenue</div>
							</div>
						</div>
				</div>
				<div class="row-fluid">
					<div class="light">Payments / orders</div>
						<div class="row dash-boxes">
							<div class="dash-box1">
								<div class="row dash-icon" style="margin: 0; padding: 0;">*</div>
								<div class="row dash-text" >payments this week</div>
							</div>
							<div class="dash-box2">
								<div class="row dash-icon" style="margin: 0; padding: 0;">*</div>
								<div class="row dash-text" >payments this month</div>
							</div>
							<div class="dash-box3">
								<div class="row dash-icon" style="margin: 0; padding: 0;">*</div>
								<div class="row dash-text" >last 30 days revenue</div>
							</div>
						</div>
				</div>
				{/if}
-->
				<br />
				<div class="row-fluid">
					<div class="light">Новые резюме</div>
						<div class="row dash-boxes">
							<div class="dash-box1">
								<div class="row dash-icon" style="margin: 0; padding: 0;">{$app_stats['today']}</div>
								<div class="row dash-text" >Сегодня</div>
							</div>
							<div class="dash-box2">
								<div class="row dash-icon" style="margin: 0; padding: 0;">{$app_stats['this_week']}</div>
								<div class="row dash-text" >Неделя</div>
							</div>
							<div class="dash-box3">
								<div class="row dash-icon" style="margin: 0; padding: 0;">{$app_stats['this_month']}</div>
								<div class="row dash-text" >Месяц</div>
							</div>
						</div>
				</div>
				<br />
			</div>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				
				<div class="row-fluid">
					<div class="light">Новые вакансии</div>

					<div class="row dash-boxes">
						<div class="dash-box1">
							<div class="row dash-icon" style="margin: 0; padding: 0;">{$job_stats['today']} </div>
							<div class="row dash-text" >За сегодня</div>
						</div>
						<div class="dash-box2">
							<div class="row dash-icon" style="margin: 0; padding: 0;">{$job_stats['this_week']}</div>
							<div class="row dash-text" >За неделю</div>
						</div>
						<div class="dash-box3">
							<div class="row dash-icon" style="margin: 0; padding: 0;">{$job_stats['this_month']}</div>
							<div class="row dash-text" >За месяц</div>
						</div>
					</div>
				</div>
				<br />


				<div class="row-fluid">
					<div class="light">Пользователи системы</div>

					<div class="row dash-boxes">
						<div class="dash-box1">
							<div class="row dash-icon" style="margin: 0; padding: 0;">{$user_stats['companies']} </div>
							<div class="row dash-text" >Зарегистрированных компаний</div>
						</div>
						<div class="dash-box2">
							<div class="row dash-icon" style="margin: 0; padding: 0;">{$user_stats['candidates']}</div>
							<div class="row dash-text" >Зарегистрированных соискателей</div>
						</div>
						<div class="dash-box3">
							<div class="row dash-icon" style="margin: 0; padding: 0;">{$user_stats['subscribers']}</div>
							<div class="row dash-text" >Всего подписчиков</div>
						</div>
					</div>
				</div>
				<br />
			</div>
			<!--<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="row-fluid">
					<div class="light mb20">Последний отчет о спаме</div>

					<div class="table-responsive">
						<table class="table table-hover">
							<thead>
								<tr class="fs14">
									<th>Job title</th>
									<th>Message</th>
									<th>Votes</th>
									<th>Date</th>
								</tr>
							</thead>
							<tbody class="gray">
							{section name=tmp loop=$spam_reports}
								<tr>
									<td>{$spam_reports[tmp].title}</td>
									<td>{$spam_reports[tmp].msg}</td>
									<td>{$spam_reports[tmp].count}</td>
									<td>{$spam_reports[tmp].date}</td>
								</tr>
							{/section}
						</table>
					</div>
				</div>
-->
				<br />
	 		<!-- LAST 50 SEARCHES -->
				<div class="row-fluid">
					<label class="light" >Что ищут?</label>
					<div class="">
						<div class="suggestion mb1">
							<span class="blue-font">Всего искали:</span> {$keywordz.count},&nbsp; <span class="blue-font">Среднее на прошлой неделе:</span> {$keywordz.avg},&nbsp;  <span class="blue-font">Максимум на прошлой неделе:</span> {$keywordz.max}
						</div><br />
						<div class="stats_list">{$keywordz.stats}</div>
					</div>
				</div>
			</div>
		</div>

{include file="footer.tpl"}