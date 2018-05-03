<!doctype html>
<html lang="ru">
<head>
	<title>{if $smarty.const.SITE_NAME}{$smarty.const.SITE_NAME} | Admin{else}Job board admin{/if}</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="{$meta_description}" />
	<meta name="keywords" content="{$meta_keywords}" />
	<link rel="shortcut icon" href="{$BASE_URL}fav.png" type="image/x-icon" />

	<link rel="stylesheet" href="{$BASE_URL}js/bootstrap/css/bootstrap.min.css" type="text/css" /> 
	<link href="{$BASE_URL}js/bootstrap/css/flat-ui.css" rel="stylesheet">
	<link href="{$BASE_URL}js/admin/lib/style.css" rel="stylesheet">
	<link href="{$BASE_URL}js/admin/lib/flat-green.css" rel="stylesheet">
    <link href="{$BASE_URL}js/tags/tagl/assets/css/taggle.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

	<script src="{$BASE_URL}js/jquery-1.11.2.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js" type="text/javascript"></script>
	<script src="{$BASE_URL}js/bootstrap/js/bootstrap.min.js"></script>

	<script src="{$BASE_URL}js/admin/js/functions.js" type="text/javascript"></script>
	<script src="{$BASE_URL}js/admin/js/main.js" type="text/javascript"></script>
	<script src="{$BASE_URL}js/admin/js/categories.js" type="text/javascript"></script>
	<script src="{$BASE_URL}js/admin/js/translations.js" type="text/javascript"></script>
	<script src="{$BASE_URL}js/admin/js/messages.js" type="text/javascript"></script>
	<script src="{$BASE_URL}js/admin/js/overlay.js" type="text/javascript"></script>
	<script src="{$BASE_URL}js/admin/js/types.js" type="text/javascript"></script>
	<script src="{$BASE_URL}js/admin/lib/app.js" type="text/javascript"></script>

	{if $editor}
	<script src="{$BASE_URL}js/tinymce/tinymce.min.js"></script>
	{/if}
</head>

<body class="flat-green">
		{if $isAuthenticated == 1}
	<div class="app-container">
        <div class="row content-container">
            <nav class="navbar navbar-default navbar-fixed-top navbar-top">
                <div class="container-fluid menuPadding">
                    <div class="navbar-header">
                        <button id="menuBtn" type="button" class="navbar-expand-toggle">
                           <i class="fa fa-th-list" aria-hidden="true"></i>
                        </button>
                        <ol class="breadcrumb navbar-breadcrumb">
                            <li class="active">Меню</li>
                        </ol>
                        <button type="button" class="navbar-right-expand-toggle pull-right visible-xs visible-sm">
                               <i class="fa fa-align-justify" aria-hidden="true"></i>
                        </button>
                    </div>
                    <ul class="nav navbar-nav navbar-right" >
                        <button type="button" class="navbar-right-expand-toggle pull-right visible-xs visible-sm">
                            <i class="fa fa-close fa-lg" aria-hidden="true"></i>
                        </button>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle noHover" data-toggle="dropdown" role="button" aria-expanded="false"> <i class="fa fa-wrench fa-lg" aria-hidden="true"></i></a>
                            <ul class="dropdown-menu animated fadeInDown">
                                <!--<li class="title">
                                   <a href="{$BASE_URL_ADMIN}translations/">Перевод</a>
                                </li>-->
                                 <li class="title" style="border-top: solid 1px #e6e6e6;">
                                   <a href="{$BASE_URL_ADMIN}settings/">Настройки</a>
                                </li>
                                <li class="title" style="border-top: solid 1px #e6e6e6;">
                                   <a href="{$BASE_URL_ADMIN}stats/">Статистика</a>
                                </li>
                                <!--<li class="title" style="border-top: solid 1px #e6e6e6;">
                                   <a href="{$BASE_URL_ADMIN}css/">Замена CSS</a>
                                </li>-->
                            </ul>
                        </li>
 						<li class="dropdown">
                            <a href="#" class="dropdown-toggle noHover" data-toggle="dropdown" role="button" aria-expanded="false"> <i class="fa fa-address-card-o fa-lg" aria-hidden="true"></i></a>
                            <ul class="dropdown-menu animated fadeInDown">
                                <li class="title">
                                   <a href="{$BASE_URL_ADMIN}subscribers/">Подписчики</a>
                                </li>
                                 <li class="title" style="border-top: solid 1px #e6e6e6;">
                                   <a href="{$BASE_URL_ADMIN}companies/">Компании</a>
                                </li>
                                <li class="title" style="border-top: solid 1px #e6e6e6;">
                                   <a href="{$BASE_URL_ADMIN}candidates/">Соискатели</a>
                                </li>
                                <li class="title" style="border-top: solid 1px #e6e6e6;">
                                   <a href="{$BASE_URL_ADMIN}news/">Новости</a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle noHover" data-toggle="dropdown" role="button" aria-expanded="false"> <i class="fa fa-home fa-lg" aria-hidden="true"></i></a>
                            <ul class="dropdown-menu animated fadeInDown">
                                <li class="title">
                                   <a href="{$BASE_URL_ADMIN}clear-cache/">Очистить кэш</a>
                                </li>
                                 <li class="title" style="border-top: solid 1px #e6e6e6;">
                                   <a href="{$BASE_URL}" target="_blank">На главную</a>
                                </li>
                                <li class="title" style="border-top: solid 1px #e6e6e6;">
                                   <a href="{$BASE_URL_ADMIN}logout/">Выйти</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="side-menu sidebar-inverse">
                <nav class="navbar navbar-default" role="navigation">
                    <div class="side-menu-container upc">
                        <div class="navbar-header">
                            <a  href="#" class="navbar-brand">
                                 <i class="fa fa-arrow-circle-down ml12 mr15 fa-lg" aria-hidden="true"></i>
                                <div class="title" style="text-transform: none">Админпанель</div>
                            </a>
                        </div>
                        <ul class="nav navbar-nav">
                            <li class="{if $ACTIVE == '1'}active{/if}">
                                <a href="{$BASE_URL_ADMIN}{$URL_JOBS}/inactive/">
                                     <i class="fa fa-volume-off fa-lg ml5 mr5" aria-hidden="true"></i><span class="title">Неактивные вакансии</span>
                                </a>
                            </li>
                            <li class="panel panel-default dropdown {if $ACTIVE == '2'}active{/if}">
                                <a data-toggle="collapse" href="#dropdown-element">
                                    <i class="fa fa-volume-up fa-lg ml5 mr5" aria-hidden="true"></i><span class="title">Активные вакансии</span>
                                </a>
                                <!-- Dropdown level 1 -->
                                <div id="dropdown-element" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="nav navbar-nav">
                                            <li>
                                                <a href='{$BASE_URL_ADMIN}{$URL_JOBS}/all'>Все</a>
                                            </li>
                                            {section name=tmp loop=$categories}
                                            <li>
		     									<a href='{$BASE_URL_ADMIN}{$URL_JOBS}/{$categories[tmp].var_name}/'>{$categories[tmp].name}</a>
		     								</li>
                                            {/section}
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="{if $ACTIVE == '3'}active{/if}">
                                <a href="{$BASE_URL_ADMIN}job-applications/">
                                    <i class="fa fa-user-circle fa-lg ml5 mr5" aria-hidden="true"></i><span class="title">Заявления</span>
                                </a>
                            </li>
                            <li class="{if $ACTIVE == '4'}active{/if}">
                                <a href="{$BASE_URL_ADMIN}pages/">
                                    <i class="fa fa-file-text-o fa-lg ml5 mr5" aria-hidden="true"></i><span class="title">Страницы</span>
                                </a>
                            </li>
                            <li class="{if $ACTIVE == '5'}active{/if}">
                                <a href="{$BASE_URL_ADMIN}cities/list/">
                                    <i class="fa fa-map-marker fa-lg ml5 mr5" aria-hidden="true"></i><span class="title">Города</span>
                                </a>
                            </li>
                            <li class="{if $ACTIVE == '6'}active{/if}">
                                <a href="{$BASE_URL_ADMIN}categories/">
                                    <i class="fa fa-tasks fa-lg ml5 mr5" aria-hidden="true"></i><span class="title">Категории</span>
                                </a>
                            </li>
                            <li class="{if $ACTIVE == '7'}active{/if}">
                                <a href="{$BASE_URL_ADMIN}types/">
                                    <i class="fa fa-calendar-check-o fa-lg ml5 mr5" aria-hidden="true"></i><span class="title">Типы</span>
                                </a>
                            </li>

                            <li class="{if $ACTIVE == '12'}active{/if}">
                            <a href="{$BASE_URL_ADMIN}cleaner/">
                                    <i class="fa fa-recycle fa-lg ml5 mr5" aria-hidden="true"></i><span class="title">Очистка</span>
                                </a>
                            </li>
                            <li class="{if $ACTIVE == '50'}active{/if}">
                            <a href="{$BASE_URL_ADMIN}feeder/">
                                    <i class="fa fa-share-alt fa-lg ml5 mr5" aria-hidden="true"></i><span class="title">Добавление данных</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </nav>
            </div>
            <!-- Main Content -->
            <div class="container-fluid">

            </div>
        </div>
        <footer class="app-footer">
            <div class="wrapper">
                 &copy; {$SITE_NAME}
            </div>
        </footer>
		{/if}