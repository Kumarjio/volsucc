{include file="header.tpl"}
		<div class="admin-content">
		  <div class="admin-wrap-content" >
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<label class="admin-label">Тип работы</label>
					<div class="subheading">Напишите постоянную ссылку в нижнем регистре как одно слово (например, «частичная занятость»).</div>
				</div>

				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div id="typesContainer">
					{section name=tmp loop=$types}
						<div class="typeItem" rel="{$types[tmp]->getId()}">
							<div class="typeWrapper">

								<a href="#" title="Удалить" class="deleteType"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a>
								<label><span class="gray">Название:</span><input class="light-text minput" type="text" size="25" name="name[{$types[tmp]->getId()}]" value="{$types[tmp]->getName()}" /></label>
								<a href="#" title="Сохранить" class="saveType mtSave"><i class="fa fa-save fa-lg blue-fa" aria-hidden="true"></i></a>

								<label class="sec-column"><span class="gray typesPadding">Ссылка:</span><input class="light-text minput" type="text" size="25" id="nr" name="var_name[{$types[tmp]->getId()}]" value="{$types[tmp]->getVarName()}" /></label>
							</div>
						</div>
					{/section}
					</div>
				<p></p>
				<p>
					<a href="#" title="Добавить"><i class="fa fa-plus-circle fa-lg" aria-hidden="true"></i></a></p>
				</div>
		 </div><!-- #content -->
		</div>

{include file="footer.tpl"}
