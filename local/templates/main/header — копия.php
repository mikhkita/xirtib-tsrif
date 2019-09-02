<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/".SITE_TEMPLATE_ID."/header.php");

$curPage = $APPLICATION->GetCurPage();
$urlArr = $GLOBALS["urlArr"] = explode("/", $curPage);
$GLOBALS["isMain"] = $isMain = ( $curPage == "/" )?true:false;
$page = $GLOBALS["page"] = ( $urlArr[2] == null || $urlArr[2] == "" )?$urlArr[1]:$urlArr[2];
$subPage = $GLOBALS["subpage"] = $urlArr[2];
$GLOBALS["version"] = 4917680;

$is404 = defined('ERROR_404') && ERROR_404=='Y' && !defined('ADMIN_SECTION');

$arPage = ( isset($arPages[$urlArr[2]]) )?$arPages[$urlArr[2]]:$arPages[$urlArr[1]];

$isCatalog = $GLOBALS["isCatalog"] = ($urlArr[1] == "catalog" || $urlArr[1] == "wholesale" || $urlArr[1] == "sale");
$isWholesale = $GLOBALS["isWholesale"] = ($urlArr[1] == "wholesale");
$isSale = $GLOBALS["isSale"] = ($urlArr[1] == "sale");
$isPersonal = $GLOBALS["isPersonal"] = ($urlArr[1] == "personal");
$isDelivery = $GLOBALS["isDelivery"] = ($urlArr[1] == "delivery");

$isDetail = $GLOBALS["isDetail"] = ($urlArr[1] == "catalog" && isset($urlArr[4]));

$notBText = $GLOBALS["notBText"] = ( in_array($page, array("cart", "order", "contacts", "success", "error", "search", "news", "new", "favourite")) || $isCatalog || $isMain )?true: false;

$GLOBALS["HEADER_CATEGORIES"] = array();

$GLOBALS["season"] = getSeason();

CModule::IncludeModule('iblock');

// CJSCore::Init();

// $count = getOrderCountInDate("30.05.2019");

?>
<!DOCTYPE html>
<html>
<head>
	<title><?$APPLICATION->ShowTitle()?></title>

	<?
	$APPLICATION->ShowHead();
	?>
	<?
 //    $APPLICATION->ShowMeta("keywords");      // Вывод мета - тега keywords
 //    $APPLICATION->ShowMeta("description");      // Вывод мета - тега description

	// $APPLICATION->ShowCSS();         // Подключение файлов стилей CSS

 //    // if($USER->IsAdmin())
 //       $APPLICATION->ShowHeadStrings();   // Отображает специальные стили, JavaScript
 //       $APPLICATION->ShowHeadScripts();      // Вывод скриптов
    ?>

	<!-- Google Tag Manager -->
	<!-- <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-TB8XJM3');</script> -->
	<!-- End Google Tag Manager -->

	<meta name="format-detection" content="telephone=no">

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/reset.css" type="text/css">
	<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/jquery.fancybox.css?<?=$GLOBALS["version"]?>" type="text/css">
	<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/KitAnimate.css" type="text/css">
	<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/layout.css?<?=$GLOBALS["version"]?>" type="text/css">
	<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/slick.css" type="text/css">
	
	<link rel="stylesheet" media="screen and (min-width: 240px) and (max-width: 1023px)" href="<?=SITE_TEMPLATE_PATH?>/css/layout-tablet.css?<?=$GLOBALS["version"]?>">
	<link rel="stylesheet" media="screen and (min-width: 240px) and (max-width: 960px)" href="<?=SITE_TEMPLATE_PATH?>/css/layout-mobile.css?<?=$GLOBALS["version"]?>">

	<? if (isMobile()):?>
		<meta name="viewport" content="width=device-width, user-scalable=no"> 
	<? else:?> 
		<meta name="viewport" content="width=1024, user-scalable=no"> 
	<? endif;?>

	<link rel="apple-touch-icon" sizes="180x180" href="<?=SITE_TEMPLATE_PATH?>/favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?=SITE_TEMPLATE_PATH?>/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?=SITE_TEMPLATE_PATH?>/favicon/favicon-16x16.png">
	<link rel="manifest" href="<?=SITE_TEMPLATE_PATH?>/favicon/site.webmanifest">
	<link rel="mask-icon" href="<?=SITE_TEMPLATE_PATH?>/favicon/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
	
	<!-- <script type="text/javascript">!function(){var t=document.createElement("script");t.type="text/javascript",t.async=!0,t.src="https://vk.com/js/api/openapi.js?159",t.onload=function(){VK.Retargeting.Init("VK-RTRG-293514-1wdRf"),VK.Retargeting.Hit()},document.head.appendChild(t)}();</script><noscript><img src="https://vk.com/rtrg?p=VK-RTRG-293514-1wdRf" style="position:fixed; left:-999px;" alt=""/></noscript> -->
</head>
<body>
	<!-- <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TB8XJM3" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> -->
	<?$APPLICATION->ShowPanel();?>
	<div id="mobile-menu" class="mobile-menu hide">
		<h2>Меню</h2>
		<ul>
			<li><a href="/discounts/" class="active icon-discount">Акции и скидки</a></li>
			<li><a href="/">Главная</a></li>
			<li><a href="/delivery/">Доставка и&nbsp;оплата</a></li>
			<li><a href="/new/">Новые приходы</a></li>
			<li><a href="/magazin/">Розничный магазин</a></li>
			<li><a href="/rukovodstvo/">Связь с&nbsp;руководством</a></li>
		</ul>
		<div class="b-phone">
			<a href="tel:+74959225055" class="phone">+ 7 495 922 50 55</a>
			<a href="tel:+74956447572" class="phone">+ 7 495 644 75 72</a>
			<a href="#b-popup-phone" class="phone-link fancy">Не дозвонились?</a>
		</div>
	</div>
	<div id="mobile-catalog" class="mobile-catalog hide">
		<h2 class="b-bottom-border">Каталог</h2>
		<div class="menu-accordion">
			<div class="menu-accodion-block ">
				<h3 class="menu-header icon-arrow">Лавка кулинара</h3>
				<?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "main_categories", Array(
					"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
						"CACHE_GROUPS" => "Y",	// Учитывать права доступа
						"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
						"CACHE_TYPE" => "N",	// Тип кеширования
						"COUNT_ELEMENTS" => "Y",	// Показывать количество элементов в разделе
						"IBLOCK_ID" => "1",	// Инфоблок
						"IBLOCK_TYPE" => "content",	// Тип инфоблока
						"SECTION_CODE" => "",	// Код раздела
						"SECTION_FIELDS" => array(	// Поля разделов
							0 => "NAME",
						),
						"SECTION_ID" => 1,	// ID раздела
						"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
						"SECTION_USER_FIELDS" => array(	// Свойства разделов
						),
						"SHOW_PARENT_NAME" => "Y",	// Показывать название раздела
						"TOP_DEPTH" => "1",	// Максимальная отображаемая глубина разделов
						"VIEW_MODE" => "LINE",	// Вид списка подразделов
					),
					false
				);?>
			</div>
			<div class="menu-accodion-block">
				<h3 class="menu-header icon-arrow">Кондитерский инвентарь</h3>
				<?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "main_categories", Array(
					"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
						"CACHE_GROUPS" => "Y",	// Учитывать права доступа
						"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
						"CACHE_TYPE" => "N",	// Тип кеширования
						"COUNT_ELEMENTS" => "Y",	// Показывать количество элементов в разделе
						"IBLOCK_ID" => "1",	// Инфоблок
						"IBLOCK_TYPE" => "content",	// Тип инфоблока
						"SECTION_CODE" => "",	// Код раздела
						"SECTION_FIELDS" => array(	// Поля разделов
							0 => "NAME",
						),
						"SECTION_ID" => 2,	// ID раздела
						"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
						"SECTION_USER_FIELDS" => array(	// Свойства разделов
						),
						"SHOW_PARENT_NAME" => "Y",	// Показывать название раздела
						"TOP_DEPTH" => "1",	// Максимальная отображаемая глубина разделов
						"VIEW_MODE" => "LINE",	// Вид списка подразделов
					),
					false
				);?>
			</div>
		</div>
	</div>
	<div id="panel-page">
		<div class="b-top-content clearfix">
			<div class="b-block">
				<div class="b-top-content-container">
					<div class="b-top-content-block b-top-city">
						<a href="#b-popup-city" class="dashed fancy"><b>Москва</b></a>
						<p>25 пунктов выдачи</p>
					</div>
					<div class="b-top-content-block b-top-schedule">
						<p class="icon-clock">пн-пт: с 10:00 до 19:00, сб: с 10:00 до 18:00, вс – выходной</p>
					</div>
					<div class="b-top-content-block b-top-auth">
						<a href="#" class="icon-rub-round"><b>Купить оптом</b></a>
						<a href="#b-popup-auth" class="dashed fancy">Войти</a>
					</div>
					<div class="b-phone b-phone-mobile">
						<a href="tel:+4959225055" class="phone">+7 (495) 922-50-55</a>
					</div>
				</div>
			</div>
		</div>
		<!-- Хедер для главной -->
		<div class="b-header<? if( !$isMain ): ?> inner-header<? endif; ?>">
		<!-- Хедер для внутренних -->
			<div class="b-block">
				<div class="b-header-block b-header-top clearfix">
					<? if( $isCatalog ): ?>
						<a href="/" class="b-logo b-logo-<?=$GLOBALS["SECTIONS"][0]["ID"]?>"></a>
					<? else: ?>
						<a href="/" class="b-logo"></a>
					<? endif; ?>
					<div class="b-menu-container">
						<ul class="b-menu">
							<li><a href="/delivery/">Доставка и&nbsp;оплата</a></li>
							<li><a href="/new/">Новые приходы</a></li>
							<li><a href="/magazin/">Розничный магазин</a></li>
							<li><a href="/rukovodstvo/">Связь с&nbsp;руководством</a></li>
							<li><a href="/discounts/" class="yellow">Акции и&nbsp;скидки</a></li>
						</ul>
					</div>
					<? if (isAuth()): ?>
					<a href="/personal/" class="b-mobile-auth"></a>	
					<? else: ?>
					<a href="#b-popup-auth" class="b-mobile-auth fancy"></a>
					<? endif; ?>
					<? $basketInfo = getBasketCount(); ?>
					<a href="/cart/" class="b-cart">
						<div class="b-cart-img icon-cart"></div>
						<div class="b-cart-text">
							<p class="mobile-cart-count"><?=$basketInfo["count"]?></p>
							<p class="cart-count" <? if( $basketInfo["sum"] == 0 ): ?>style="display:none;"<? endif; ?>><?=$basketInfo["count"]?> шт.</p>
							<p class="cart-sum icon-rub" <? if( $basketInfo["sum"] == 0 ): ?>style="display:none;"<? endif; ?>><?=$basketInfo["sum"]?></p>
						</div>
					</a>
					<div class="b-phone">
						<a href="tel:+74959225055" class="phone">+ 7 495 922 50 55</a>
						<a href="tel:+74956447572" class="phone">+ 7 495 644 75 72</a>
						<a href="#b-popup-phone" class="phone-link fancy">Не дозвонились?</a>
					</div>
				</div>
				<div class="b-header-block pink-header-block house-<?=$GLOBALS["season"]?> clearfix">
					<a href="#" class="b-catalog-menu icon-list b-go" data-block=".b-big-menu">Каталог товаров</a>
					<div class="b-phone">
						<a href="tel:+74959225055" class="phone">+ 7 495 922 50 55</a>
						<a href="tel:+74956447572" class="phone">+ 7 495 644 75 72</a>
						<a href="#b-popup-phone" class="phone-link fancy">Не дозвонились?</a>
					</div>
					<div id="burger-menu" class="burger-menu icon-menu"></div>
					<div class="b-search-form-cont">
						<?$APPLICATION->IncludeComponent("bitrix:search.title", "header", Array(
							"CATEGORY_0" => array(	// Ограничение области поиска
									0 => "iblock_content",
								),
								"CATEGORY_0_TITLE" => "",	// Название категории
								"CATEGORY_0_forum" => array(
									0 => "all",
								),
								"CATEGORY_0_iblock_content" => array(	// Искать в информационных блоках типа "iblock_content"
									0 => "1",
								),
								"CATEGORY_0_main" => array(
									0 => "",
								),
								"CHECK_DATES" => "N",	// Искать только в активных по дате документах
								"CONTAINER_ID" => "title-search",	// ID контейнера, по ширине которого будут выводиться результаты
								"CONVERT_CURRENCY" => "N",	// Показывать цены в одной валюте
								"INPUT_ID" => "title-search-input",	// ID строки ввода поискового запроса
								"NUM_CATEGORIES" => "1",	// Количество категорий поиска
								"ORDER" => "rank",	// Сортировка результатов
								"PAGE" => "#SITE_DIR#search/",	// Страница выдачи результатов поиска (доступен макрос #SITE_DIR#)
								"PREVIEW_HEIGHT" => "75",	// Высота картинки
								"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода
								"PREVIEW_WIDTH" => "75",	// Ширина картинки
								"PRICE_CODE" => "",	// Тип цены
								"PRICE_VAT_INCLUDE" => "Y",	// Включать НДС в цену
								"SHOW_INPUT" => "Y",	// Показывать форму ввода поискового запроса
								"SHOW_OTHERS" => "N",	// Показывать категорию "прочее"
								"SHOW_PREVIEW" => "Y",	// Показать картинку
								"TEMPLATE_THEME" => "blue",
								"TOP_COUNT" => "5",	// Количество результатов в каждой категории
								"USE_LANGUAGE_GUESS" => "Y",	// Включить автоопределение раскладки клавиатуры
							),
							false
						);?>
					</div>
					<a href="#b-popup-ask" class="dashed fancy">Задать вопрос</a>
				</div>
				<div class="b-header-block menu-header-block">
					<div class="b-auth-block b-auth-left-block">
						<?$APPLICATION->IncludeComponent("redder:catalog.section.list", "holiday_categories", Array(
							"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
								"CACHE_GROUPS" => "Y",	// Учитывать права доступа
								"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
								"CACHE_TYPE" => "N",	// Тип кеширования
								"COUNT_ELEMENTS" => "Y",	// Показывать количество элементов в разделе
								"IBLOCK_ID" => "1",	// Инфоблок
								"IBLOCK_TYPE" => "content",	// Тип инфоблока
								"SECTION_CODE" => "",	// Код раздела
								"SECTION_FIELDS" => array(	// Поля разделов
									0 => "NAME",
									1 => "PICTURE",
								),
								"SECTION_ID" => $GLOBALS["HEADER_CATEGORIES"],	// ID раздела
								"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
								"SECTION_USER_FIELDS" => array(	// Свойства разделов
									"UF_HIGHLIGHT",
									"UF_HIDE",
								),
								"SHOW_PARENT_NAME" => "Y",	// Показывать название раздела
								"TOP_DEPTH" => "1",	// Максимальная отображаемая глубина разделов
								"VIEW_MODE" => "LINE",	// Вид списка подразделов
								"PROPERTY" => $property,
							),
							false
						);?>
					</div>
					<?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "header_categories", Array(
						"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
							"CACHE_GROUPS" => "Y",	// Учитывать права доступа
							"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
							"CACHE_TYPE" => "N",	// Тип кеширования
							"COUNT_ELEMENTS" => "Y",	// Показывать количество элементов в разделе
							"IBLOCK_ID" => "1",	// Инфоблок
							"IBLOCK_TYPE" => "content",	// Тип инфоблока
							"SECTION_CODE" => "",	// Код раздела
							"SECTION_FIELDS" => array(	// Поля разделов
								0 => "NAME",
							),
							"SECTION_ID" => 0,	// ID раздела
							"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
							"SECTION_USER_FIELDS" => array(	// Свойства разделов
							),
							"SHOW_PARENT_NAME" => "Y",	// Показывать название раздела
							"TOP_DEPTH" => "1",	// Максимальная отображаемая глубина разделов
							"VIEW_MODE" => "LINE",	// Вид списка подразделов
						),
						false
					);?>
					<? if( !isAuth() ): ?>
						<a href="#b-popup-auth" class="auth fancy" noindex>Войти</a>
					<? else: ?>
						<div class="b-auth-block">
							<a href="/personal/">Личный кабинет</a>
							<a href="/personal?action=logout&redirect=/" class="grey">Выйти</a>
						</div>
					<? endif; ?>
				</div>
				<div class="b-header-block mobile-menu-header-block">
					<div class="mobile-menu-header-text icon-list" id="catalog-menu-btn">Каталог товаров</div>
				</div>
			</div>
		</div>
		<? if( !$isMain ): ?>
		<div class="b-content-block">
			<div class="b-block clearfix">
				<? if( $isCatalog ): ?>
					<div class="b-category-left b-category-left-catalog b-category-item">
						<?
						$property = ($GLOBALS["isWholesale"])?array( "WHOLESALE" => 78 ):Array();
						if( ($GLOBALS["isSale"]) ){
							$property = array( "!DISCOUNT"=> false );
						}
						?>
						<?$APPLICATION->IncludeComponent("redder:catalog.section.list", "left_categories", Array(
							"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
								"CACHE_GROUPS" => "Y",	// Учитывать права доступа
								"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
								"CACHE_TYPE" => "N",	// Тип кеширования
								"COUNT_ELEMENTS" => "Y",	// Показывать количество элементов в разделе
								"IBLOCK_ID" => "1",	// Инфоблок
								"IBLOCK_TYPE" => "content",	// Тип инфоблока
								"SECTION_CODE" => "",	// Код раздела
								"SECTION_FIELDS" => array(	// Поля разделов
									0 => "NAME",
									1 => "PICTURE",
								),
								"SECTION_ID" => ($GLOBALS["isWholesale"] || $GLOBALS["isSale"])?$GLOBALS["HEADER_CATEGORIES"]:$GLOBALS["SECTIONS"][0]["ID"],	// ID раздела
								"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
								"SECTION_USER_FIELDS" => array(	// Свойства разделов
									"UF_HIGHLIGHT",
									"UF_HIDE",
								),
								"SHOW_PARENT_NAME" => "Y",	// Показывать название раздела
								"TOP_DEPTH" => "1",	// Максимальная отображаемая глубина разделов
								"VIEW_MODE" => "LINE",	// Вид списка подразделов
								"PROPERTY" => $property,
							),
							false
						);?>
					</div>
					<div class="b-category-right b-category-item">
				<? elseif( $isPersonal ): ?>
					<div class="b-category-left b-category-left-personal b-category-item">
						<?$APPLICATION->IncludeComponent("bitrix:menu", "personal_menu", array(
							"ROOT_MENU_TYPE" => "personal",
							"MAX_LEVEL" => "1",
							"MENU_CACHE_TYPE" => "A",
							"CACHE_SELECTED_ITEMS" => "N",
							"MENU_CACHE_TIME" => "36000000",
							"MENU_CACHE_USE_GROUPS" => "Y",
							"MENU_CACHE_GET_VARS" => array(),
						),
							false
						);?>
					</div>
					<div class="b-category-right b-personal-right b-category-item">
				<? endif; ?>					
					<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "main", Array(
							"COMPONENT_TEMPLATE" => ".default",
							"START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
							"PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
							"SITE_ID" => "-",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
						),
						false
					);?>
					<h1><?$APPLICATION->ShowTitle(false)?></h1>
		<? endif; ?>
		<? if( !$notBText ): ?>
			<div class="b-text<? if( $isDelivery ): ?> b-delivery-text<? endif; ?>">
		<? endif; ?>