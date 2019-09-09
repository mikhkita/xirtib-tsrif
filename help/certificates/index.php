<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Сертификаты соответствия");?>

<div class="b-subcategory b-certificates-block">
	<div class="b-block">
		<div class="b-1-by-3-blocks">
			<div class="b-block-1">
				<div class="b-category-left-list">
					<?$APPLICATION->IncludeComponent("bitrix:menu", "help", Array(
							"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
								"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
								"DELAY" => "N",	// Откладывать выполнение шаблона меню
								"MAX_LEVEL" => "2",	// Уровень вложенности меню
								"MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
									0 => "",
								),
								"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
								"MENU_CACHE_TYPE" => "N",	// Тип кеширования
								"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
								"ROOT_MENU_TYPE" => "help",	// Тип меню для первого уровня
								"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
							),
						false
					);?>
				</div>
			</div>
			<div class="b-block-2">
				<h3>Наша продукция имеет действующие<br>сертификаты качества</h3>
				<div class="b-certificates-list">
					<a href="<?=SITE_TEMPLATE_PATH?>/i/certificate-1.jpg" class="b-certificates-item fancy-img">
						<div class="b-certificate-img-cont icon-zoom"><img class="b-certificate-img" src="<?=SITE_TEMPLATE_PATH?>/i/certificate-1.jpg"></div>
						<div class="b-certificate-name">Сертификат 1</div>
					</a>
					<a href="<?=SITE_TEMPLATE_PATH?>/i/certificate-2.jpg" class="b-certificates-item fancy-img">
						<div class="b-certificate-img-cont icon-zoom"><img class="b-certificate-img" src="<?=SITE_TEMPLATE_PATH?>/i/certificate-2.jpg"></div>
						<div class="b-certificate-name">Сертификат 2</div>
					</a>
					<a href="<?=SITE_TEMPLATE_PATH?>/i/certificate-3.jpg" class="b-certificates-item fancy-img">
						<div class="b-certificate-img-cont icon-zoom"><img class="b-certificate-img" src="<?=SITE_TEMPLATE_PATH?>/i/certificate-3.jpg"></div>
						<div class="b-certificate-name">Сертификат 3</div>
					</a>
					<a href="<?=SITE_TEMPLATE_PATH?>/i/certificate-1.jpg" class="b-certificates-item fancy-img">
						<div class="b-certificate-img-cont icon-zoom"><img class="b-certificate-img" src="<?=SITE_TEMPLATE_PATH?>/i/certificate-1.jpg"></div>
						<div class="b-certificate-name">Сертификат 4</div>
					</a>
					<a href="<?=SITE_TEMPLATE_PATH?>/i/certificate-2.jpg" class="b-certificates-item fancy-img">
						<div class="b-certificate-img-cont icon-zoom"><img class="b-certificate-img" src="<?=SITE_TEMPLATE_PATH?>/i/certificate-2.jpg"></div>
						<div class="b-certificate-name">Сертификат 5</div>
					</a>
					<a href="<?=SITE_TEMPLATE_PATH?>/i/certificate-3.jpg" class="b-certificates-item fancy-img">
						<div class="b-certificate-img-cont icon-zoom"><img class="b-certificate-img" src="<?=SITE_TEMPLATE_PATH?>/i/certificate-3.jpg"></div>
						<div class="b-certificate-name">Сертификат 6</div>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>