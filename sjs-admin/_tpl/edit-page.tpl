{include file="header.tpl"}
		<div class="admin-content">
		  <div class="admin-wrap-content" style="padding-right: 35px !important;">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<label class="admin-label">Редактирование страницы</label>

				{if $data.id == '19' or $data.id == '20' or $data.id == '2' or $data.id == '21' or $data.id == '55'}
					<div class="subheading"> Эта страница динамична. Вы можете изменять только заголовки, URL и мета строки. Содержимое можно редактировать только внутри самого файла. <br> <a style="opacity: 0.8;" href="{$BASE_URL_ADMIN}pages/">&larr;возвратиться</a></div>
				{else}
					<div class="subheading">Напишите URL-адрес в нижнем регистре как одно слово (например, «test-page»). Используйте редактор WYSIWYG для создания содержимого HTML на своей странице или для копирования содержимого из DOC / PDF. Файл шаблона будет создан в папке "_tpl/{$THEME}/static". <br><a style="opacity: 0.8;" href="{$BASE_URL_ADMIN}pages/">&larr;возвратиться</a></div>
				{/if}

				<br />
			</div>
		
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<form method="post" action="{$BASE_URL_ADMIN}pages/update" role="form">
					<input type="hidden" name="id" id="id" value="{$data.id}">
					<input type="hidden" name="was_external" id="was_external" value="{$data.is_external}">

				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="form-group mb30">
						<label for="title">Заголовок</label>
						<input  required name="title" id="title" maxlength="50" type="text" value="{$data.page_title}" class="form-control minput"  />
					</div>
					<div id="url-block" class="form-group {if $data.is_external == '1'}displayNone{/if}">
						<label for="url">URL</label>
						<input  name="url" id="url" maxlength="50" type="text" value="{$data.url}" class="form-control minput"  />
					</div>

					{if $data.id != '19' and $data.id != '20' and $data.id != '2' and $data.id != '21' and $data.id != '55'}
					<div class="form-group mb85mobile mb20 mt20">
		 			 	<input {if $data.is_external == '1'}checked{/if} type="checkbox" onchange="Jobber.pagesExternalSwitched(this.checked);" name="external_switch" id="external_switch" data-size="mini" />
		 			 	<span style="position: absolute; margin-top: -1px">
		 				 	<label style="margin-left: 20px;">Внешняя страница</label>
		 			 	</span>
		 			 </div>
		 			 {/if}

					<div class="form-group mb30">
						<label for="link_order">Порядок (1-50)</label>
						<input type="number" required class="form-control minput" name="link_order" id="link_order" value="{$data.link_order}" />
					</div>

		 		    <div id="external-page-block" class="form-group {if $data.is_external == '0'}displayNone{/if} mb30" >
		 			 	<label for="url">Внешняя страница URL <br><span class="fs13">(например, http://site.ru)</span></label>
						<input  name="external_url" id="external_url" type="text" class="form-control minput" {if $data.is_external == '1'}value="{$data.external_url}"{/if} />
		 			</div>
				</div>

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

					<div id="keywords-block" class="form-group mb30 {if $data.is_external == '1'}displayNone{/if}">
						<label for="keywords">Meta keywords</label>
						<textarea maxlength="50" class="noTinymceTA form-control" name="keywords" id="keywords" rows="3" >{$data.keywords}</textarea>
					</div>
					<div id="desc-block" class="form-group mb30 {if $data.is_external == '1'}displayNone{/if}">
						<label for="desc">Meta description</label>
						<textarea class="noTinymceTA form-control" name="desc" id="desc" rows="5" >{$data.description}</textarea>
					</div>

				</div>

				{if $data.id != '19' and $data.id != '20' and $data.id != '2' and $data.id != '21' and $data.id != '55'}
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div id="content-block" class="form-group mb30 {if $data.is_external == '1'}displayNone{/if}">
						<label for="page_content">Контент</label>
						<textarea class="form-control minput" name="page_content" id="page_content" rows="10" style="min-width: 300px !important;">{$data.content}</textarea>
					</div>
				</div>
				{/if}

				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="form-group" style="margin-top: 10px;">
						<button type="submit" class="btn btn-default btn-primary mbtn" name="submit" id="submit" >Применить</button>
					</div>
				</div>

				</form>
			</div>
		</div><!-- #content -->
		</div>

{literal}
<script type="text/javascript">
	$(document).ready(function(){
		var theme = "{/literal}{$THEME}{literal}";
		tinymce.init({selector:'textarea:not(.noTinymceTA)', content_css : "/_tpl/" + theme + "/css/custom-editor.css", height : 250, resize: 'both' , theme: 'modern', toolbar1: 'insertfile undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image', toolbar2: 'preview media | forecolor emoticons', plugins: ["paste advlist autolink lists link image charmap preview hr anchor pagebreak searchreplace wordcount visualblocks visualchars media nonbreaking save table contextmenu directionality emoticons template textcolor colorpicker textpattern "], paste_retain_style_properties: "color font-style font-size",paste_webkit_styles: "color font-style font-size" });
	});
</script>
{/literal}	

{include file="footer.tpl"}