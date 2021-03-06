{include file="header.tpl"}
		
<div class="admin-content">
 <div class="admin-wrap-content " >
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		<label class="admin-label">Добавление вакансии</label>
		<a href="/sjs-admin/feeder"><div class="subheading" style="color: #000;opacity: 0.65;">(&larr;назад)</div></a><br />
		<div class="alert alert-info fade in main-color">
		    <a href="#" class="close" data-dismiss="alert">&times;</a>
		     <i class="fa fa-info-circle info-fa" aria-hidden="true"></i>&nbsp;
		    Все опубликованные вакансии принадлежат учетной записи администратора по умолчанию, с работодателем под названием «Admin» и компанией с именем ВолГУ. Вы можете изменить данные компании. Оставьте имя работодателя «Admin».
		</div>
		{if $EMP_MISSING_ERR}
		<div class="negative-feedback red">Отсутствует профиль администратора работодателя! Создайте работодателя с именем «Admin» и компанией
связанный с ним. Этот профиль станет владельцем размещенных вакансий.</div>
		{/if}
	</div>

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mlpl0">
	 <form role="form" method="post" action="{$BASE_URL_ADMIN}feeder/jobs" enctype="multipart/form-data" >

		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb20 deskPr100">
			<!-- job types-->
			<div class="form-group grayLabel mb40">
				<label for="type">{$translations.dashboard_recruiter.post_type_label}</label>
				<select id="type_select" name="type_select" {if $lock_post}disabled{/if} class="form-control minput">
					{foreach from=$types key=id item=value}
						<option {if $DRAFT}{if $draft_data.type_name == {$value}}selected{/if}{/if} value="{$id}">{$value}</option>
					{/foreach}
				</select>
			</div>

			<!-- catgory-->
			<div class="form-group grayLabel mb40">
				<label for="type">{$translations.dashboard_recruiter.post_category_label}</label>
				<select id="cat_select" name="cat_select" {if $lock_post}disabled{/if} class="form-control minput">
					{foreach from=$cats key=id item=value}
						<option {if $DRAFT}{if $draft_data.category_id == {$id}}selected{/if}{/if} value="{$id}">{$value}</option>
					{/foreach}
				</select>
			</div>

			<div class="form-group grayLabel mb40">
				<label for="description">{$translations.dashboard_recruiter.post_location_label}</label>
				<select id="location_select" name="location_select" {if $lock_post}disabled{/if} class="form-control minput">
				{foreach from=$cities key=id item=value}
					<option {if $DRAFT}{if $draft_data.city_id == {$id}}selected{/if}{/if} value="{$id}">{$value}</option>
				{/foreach}
				</select>
			</div>

		</div>

		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 mb20 deskPr100">
			<div class="form-group grayLabel mb40">
				<label for="title">{$translations.dashboard_recruiter.post_title_label}</label>
				<input {if $lock_post}disabled{/if} required name="title" id="title" maxlength="400" type="text" value="{if $DRAFT == 'true'}{$draft_data.title}{/if}" class="form-control minput"  />
			</div>

			<div class="form-group grayLabel mb40">
				<label for="salary">{$translations.dashboard_recruiter.salary_label}<!--<span class="italic"> {$translations.dashboard_recruiter.salary_desc}</span>--></label>
				<input name="salary" id="salary" maxlength="100" type="text" class="form-control minput" value="{if $DRAFT == 'true'}{$draft_data.salary}{/if}"  />
			</div>

			<!--<div class="form-group mb30 grayLabel mb40">
				<label for="premium_select">{$translations.dashboard_recruiter.premium_text} </label>
				<select id="premium_select" name="premium_select" {if $lock_post}disabled{/if} class="form-control minput">
						<option value="0">{$translations.dashboard_recruiter.standard_label}</option>
						<option value="1">Premium</option>
				</select>
			</div>-->

		</div>

		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

			<div class="form-group mb20 grayLabel">
				<label for="description">{$translations.dashboard_recruiter.post_desc_label} (*)</label>
				<textarea id="description" name="description">{$job.description}</textarea>
			</div>

	 		<div class="form-group mb20 ">
			 	<input type="checkbox" onchange="applyChanged(this.checked);" name="apply_online_switch" id="apply_online_switch" data-size="mini" {if $job.apply_online == '1'}checked{/if} /><label style="margin-left: 10px;" class="switch-label mt25">{$translations.dashboard_recruiter.apply_label}</label><span class="apply-desc-span">{$translations.dashboard_recruiter.apply_desc}</span>
			 </div>

			 <div id="apply-desc-block" class="form-group mb20 {if $job.apply_online == '1'} displayNone{/if}" >
				<label>{$translations.dashboard_recruiter.howto_apply_label}</label>
				<textarea id="howtoTA" class="noTinymceTA form-control minput" rows="5" cols="5" id="howtoapply" name="howtoapply">{$job.apply_desc}</textarea>
			 </div>

			<button type="submit" class="btn btn-default btn-primary mbtn mt30" onclick="return Jobber.validatePasswords();" >POST</button>
		</div>

	</form>
	</div>
 </div>
</div><!-- #content -->

{literal}
<script type="text/javascript">
	$(document).ready(function(){
		var theme = "{/literal}{$THEME}{literal}";
		tinymce.init({selector:'textarea:not(.noTinymceTA)', content_css : "/_tpl/" + theme + "/css/custom-editor.css", height : 250, resize: 'both' , theme: 'modern', toolbar1: 'insertfile undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image', toolbar2: 'preview media | forecolor emoticons', plugins: ["paste advlist autolink lists link image charmap preview hr anchor pagebreak searchreplace wordcount visualblocks visualchars media nonbreaking save table contextmenu directionality emoticons template textcolor colorpicker textpattern "], paste_retain_style_properties: "color font-style font-size",paste_webkit_styles: "color font-style font-size" });
	});

	function applyChanged(val) {
		if (val == false) {
			$('#apply-desc-block').removeClass('displayNone');
		} else {
			$('#howtoTA').val('');
			$('#apply-desc-block').addClass('displayNone');
		}
	}

	function validateDesc() {
		if (tinymce.activeEditor.getContent() == "") {
			alert("Please, fill in the job description");
			return false;
		} else return true;
	}

</script>
{/literal}	

{if $JOB_ADDED == 'true'}
<script type="text/javascript">
   setTimeout(function(){
   	jobberBase.messages.add('Job has been posted');
   }, 1000);
</script>
{/if}

{include file="footer.tpl"}