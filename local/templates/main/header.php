<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/".SITE_TEMPLATE_ID."/header.php");

$curPage = $APPLICATION->GetCurPage();
$urlArr = $GLOBALS["urlArr"] = explode("/", $curPage);
$GLOBALS["isMain"] = $isMain = ( $curPage == "/" )?true:false;
$page = $GLOBALS["page"] = ( $urlArr[2] == null || $urlArr[2] == "" )?$urlArr[1]:$urlArr[2];
$subPage = $GLOBALS["subpage"] = $urlArr[2];
$GLOBALS["version"] = 421;

$is404 = defined('ERROR_404') && ERROR_404=='Y' && !defined('ADMIN_SECTION');

$arPage = ( isset($arPages[$urlArr[2]]) )?$arPages[$urlArr[2]]:$arPages[$urlArr[1]];

$isCatalog = $GLOBALS["isCatalog"] = ($urlArr[1] == "catalog" || $urlArr[1] == "wholesale" || $urlArr[1] == "sale");
$isWholesale = $GLOBALS["isWholesale"] = ($urlArr[1] == "wholesale");
$isSale = $GLOBALS["isSale"] = ($urlArr[1] == "sale");
$isPersonal = $GLOBALS["isPersonal"] = ($urlArr[1] == "personal");
$isDelivery = $GLOBALS["isDelivery"] = ($urlArr[1] == "delivery");

$isDetail = $GLOBALS["isDetail"] = ($urlArr[1] == "catalog" && isset($urlArr[4]));

$notBText = $GLOBALS["notBText"] = ( in_array($page, array("cart", "contacts", "success", "error", "search", "news", "new")) || $isCatalog || $isMain )?true: false;

$GLOBALS["HEADER_CATEGORIES"] = array();

$GLOBALS["season"] = getSeason();

CModule::IncludeModule('iblock');

$GLOBALS["depends"] = array(
	// "edit" => array(
	// 	"js" => array(
	// 		SITE_TEMPLATE_PATH."/js/plupload.full.min.js"
	// 	)
	// ),
);

?>
<!DOCTYPE html>
<html>
<head>
	<title><?$APPLICATION->ShowTitle()?></title>

	<?$APPLICATION->ShowHead();?>

	<meta name="format-detection" content="telephone=no">

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/reset.css" type="text/css">
	<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/jquery-ui.min.css" type="text/css">
	<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/jquery.fancybox.css" type="text/css">
	<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/KitAnimate.css" type="text/css">
	<link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/chosen.min.css" type="text/css">
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

</head>
<body>
	<?$APPLICATION->ShowPanel();?>
	<div id="mobile-menu" class="mobile-menu hide">
		<h2>Меню</h2>
		<ul>
			<li><a href="/" class="active icon-discount">Акции и скидки</a></li>
			<li><a href="cooperation.html">Доставка и оплата</a></li>
			<li><a href="services.html">Помощь</a></li>
			<li><a href="about.html">Контакты</a></li>
			<li><a href="documents.html">Купить оптом</a></li>
		</ul>
		<div class="b-menu-schedule">
			<p class="icon-clock">пн-пт: с 10:00 до 19:00, сб: с 10:00 до 18:00, вс – выходной</p>
		</div>
		<div class="b-phone">
			<a href="tel:+74959225055" class="phone">+ 7 495 922 50 55</a>
			<a href="#b-popup-phone" class="pink dashed fancy">Заказать звонок</a>
		</div>
	</div>
	<div id="panel-page">
		<div class="b-top-content clearfix">
		<div class="b-block">
			<div class="b-top-content-container">
				<!-- <div class="b-top-content-block b-top-city">
					<a href="#b-popup-city" class="dashed fancy"><b>Москва</b></a>
					<p>25 пунктов выдачи</p>
				</div> -->
				<div class="b-top-content-block b-top-schedule">
					<p class="icon-clock">пн-пт: с 10:00 до 19:00, сб: с 10:00 до 18:00, вс – выходной</p>
				</div>
				<div class="b-top-content-block b-top-auth">
					<a href="#" class="icon-rub-round"><b>Купить оптом</b></a>
					<? if( !isAuth() ): ?>
						<a href="#b-popup-auth" class="fancy dashed">Войти</a>
					<? else: ?>
						<a href="/personal/" class="dashed">Личный кабинет</a>
					<? endif; ?>
				</div>
				<div class="b-phone b-phone-mobile">
					<a href="tel:+4959225055" class="phone">+7 (495) 922-50-55</a>
				</div>
			</div>
		</div>
	</div>
	<div class="b-header wave-bottom">
		<div class="b-block">
			<div class="b-header-block b-top-header-block clearfix">
				<a href="/" class="b-logo"></a>
				<div class="b-menu-container">
					<ul class="b-menu">
						<li><a href="/help/delivery/">Доставка и оплата</a></li>
						<li><a href="/help/">Помощь</a></li>
						<li><a href="/help/contacts/">Контакты</a></li>
						<li><a href="/sale/" class="pink icon-discount">Акции и скидки</a></li>
					</ul>
				</div>
				<div class="b-phone clearfix">
					<a href="tel:+74959225055" class="phone">+7 (495) 922-50-55</a>
					<a href="#b-popup-phone" class="pink dashed fancy">Заказать звонок</a>
				</div>
				<? $basketInfo = getBasketCount(); ?>
				<a href="/cart" class="b-cart b-mobile-cart">
					<div class="b-cart-img icon-cart"></div>
					<div class="b-cart-text">
						<p class="cart-count"><? if( $basketInfo["sum"] == 0 ): ?>Корзина<? else: ?><?=$basketInfo["count"]?> шт.<?endif;?></p>
						<p class="cart-sum icon-rub"><? if( $basketInfo["sum"] == 0 ): ?>пуста<? else: ?><?=$basketInfo["sum"]?><?endif;?></p>
					</div>
				</a>
			</div>
			<div class="b-header-block pink-header-block clearfix">
				<a href="#" class="b-catalog-menu icon-list">Каталог товаров</a>
				<div id="burger-menu" class="burger-menu icon-menu"></div>
				<div class="b-search-form">
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
							"TOP_COUNT" => "8",	// Количество результатов в каждой категории
							"USE_LANGUAGE_GUESS" => "Y",	// Включить автоопределение раскладки клавиатуры
						),
						false
					);?>
				</div>
				<a href="#b-popup-question" class="dashed fancy">Задать вопрос</a>
				<a href="/cart" class="b-cart">
					<div class="b-cart-img icon-cart"></div>
					<div class="b-cart-text">
						<p class="cart-count"><? if( $basketInfo["sum"] == 0 ): ?>Корзина<? else: ?><?=$basketInfo["count"]?> шт.<?endif;?></p>
						<p class="cart-sum icon-rub"><? if( $basketInfo["sum"] == 0 ): ?>пуста<? else: ?><?=$basketInfo["sum"]?><?endif;?></p>
					</div>
				</a>
			</div>
			<div class="b-header-block menu-header-block">
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
			</div>
		</div>
	</div>
	
	<?if ( !$isMain):?>
		<div class="b-content-block">
			<div class="b-block clearfix">
				<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "main", Array(
						"COMPONENT_TEMPLATE" => ".default",
						"START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
						"PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
						"SITE_ID" => "-",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
					),
					false
				);?>
				<? if (!$isDetail): ?>
					<h1><?$APPLICATION->ShowTitle(false)?></h1>
				<? endif; ?>
		
	<?endif;?>