<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use Bitrix\Main\Localization\Loc;

$userID = $USER->GetID();
$rsUser = CUser::GetByID($userID);
$arUser = $rsUser->Fetch();
$photo = array();
if ($arUser['PERSONAL_PHOTO']){
	$photo = CFile::ResizeImageGet($arUser['PERSONAL_PHOTO'], Array("width" => 266, "height" => 266), BX_RESIZE_IMAGE_EXACT, false, $arFilters );
}?>

<div class="b-cabinet wave-bottom">
	<div class="b-block">
		<div class="b-cabinet-left sticky">
			<div class="b-profile clearfix">
				<?if(!empty($photo)):?>
					<div class="b-profile-photo has-photo" style="background-image: url(<?=$photo['src']?>);"></div>
				<?else:?>
					<a href="edit" class="b-profile-photo icon-add-photo"></a>
				<?endif;?>
				<div class="b-profile-name"><?=$arUser['NAME']." ".$arUser["SECOND_NAME"]." ".$arUser['LAST_NAME']?></div>
				<?
				// <div class="b-profile-bonus-text">Мои бонусные баллы</div>
				// <div class="b-profile-bonus-count">125</div>
				?>
				<a href="edit" class="b-btn">Редактировать профиль</a>
				<div class="b-btn-cont">
					<a href="?action=logout" class="cabinet-logout-link">Выйти</a>
				</div>
			</div>
			<?
			// <div class="b-get-bonus">
			// 	<div class="b-get-bonus-text">Получить бонусные баллы</div>
			// 	<form action="/getBonus.php" method="POST" class="b-one-string-form">
			// 		<div class="b-get-bonus-input-container">
			// 			<input type="text" placeholder="Ссылка на селфи">
			// 			<a href="#" class="pink ajax">Получить</a>
			// 		</div>
			// 		<div class="b-get-bonus-input-container">
			// 			<input type="text" placeholder="Ссылка на отзыв">
			// 			<a href="#" class="pink ajax">Получить</a>
			// 		</div>
			// 		<div class="b-get-bonus-input-container">
			// 			<input type="text" placeholder="Ссылка на мастер-класс">
			// 			<a href="#" class="pink ajax">Получить</a>
			// 		</div>
			// 	</form>
			// </div>
			?>
		</div>
		<div class="b-cabinet-right">
			<div class="b-cabinet-hello">Здравствуйте, <?=$arUser['NAME']?>!</div>
			<div class="b-orders pagination-container">
				<?$APPLICATION->IncludeComponent(
					"bitrix:sale.personal.order.list",
					"main",
					Array(
						"DEFAULT_SORT" => 'ID',
				        "STATUS_COLOR_N" => "green",
				        "STATUS_COLOR_P" => "yellow",
				        "STATUS_COLOR_F" => "gray",
				        "STATUS_COLOR_PSEUDO_CANCELLED" => "red",
				        "PATH_TO_DETAIL" => "order_detail.php?ID=#ID#",
				        "PATH_TO_COPY" => "basket.php",
				        "PATH_TO_CANCEL" => "order_cancel.php?ID=#ID#",
				        "PATH_TO_BASKET" => "basket.php",
				        "PATH_TO_PAYMENT" => "payment.php",
				        "ORDERS_PER_PAGE" => 5,
				        "ID" => $ID,
				        "SET_TITLE" => "N",
				        "SAVE_IN_SESSION" => "Y",
				        "NAV_TEMPLATE" => "main",
				        "CACHE_TYPE" => "A",
				        "CACHE_TIME" => "3600",
				        "CACHE_GROUPS" => "Y",
				        "HISTORIC_STATUSES" => array(),
				        "ACTIVE_DATE_FORMAT" => "d.m.Y",
				    )
				);?>
			</div>
			<div class="b-tabs">
				<div id="b-cabinet-tab-slider" class="b-tabs-container b-tabs-container-underline tacenter">
					<div class="b-tab active" data-tab="fav">Мои покупки</div>
					<div class="b-tab" data-tab="myworks">Мои работы</div>
					<div class="b-tab" data-tab="myreviews">Мои отзывы</div>
					<div class="b-tab" data-tab="myquestions">Мои вопросы</div>
				</div>
				<div class="b-tab-item" id="fav">
					<div class="myreviews-header">Мои покупки</div>
					<div class="b-works-list b-cabinet-works-list pagination-container">
						<?
							$ids = getFavourites();

							$ids = (empty($ids) || !count($ids)) ? 0 : $ids;
							$GLOBALS["favFilter"] = array("ID" => $ids);

							$APPLICATION->IncludeComponent(
								"bitrix:catalog.section",
								"main",
								Array(
									"ACTION_VARIABLE" => "action",
									"ADD_PICT_PROP" => "MORE_PHOTO",
									"ADD_PROPERTIES_TO_BASKET" => "Y",
									"ADD_SECTIONS_CHAIN" => "Y",
									"ADD_TO_BASKET_ACTION" => "ADD",
									"AJAX_MODE" => "N",
									"AJAX_OPTION_ADDITIONAL" => "",
									"AJAX_OPTION_HISTORY" => "Y",
									"AJAX_OPTION_JUMP" => "Y",
									"AJAX_OPTION_STYLE" => "Y",
									"BACKGROUND_IMAGE" => "-",
									"BASKET_URL" => "/personal/cart/",
									"BROWSER_TITLE" => "-",
									"CACHE_FILTER" => "N",
									"CACHE_GROUPS" => "Y",
									"CACHE_TIME" => "36000000",
									"CACHE_TYPE" => "N",
									"COMPONENT_TEMPLATE" => ".default",
									"CONVERT_CURRENCY" => "N",
									"DETAIL_URL" => "",
									"DISABLE_INIT_JS_IN_COMPONENT" => "N",
									"DISPLAY_BOTTOM_PAGER" => "Y",
									"DISPLAY_TOP_PAGER" => "N",
									"ELEMENT_SORT_FIELD" => $_REQUEST["ORDER_FIELD"],
									"ELEMENT_SORT_FIELD2" => "id",
									"ELEMENT_SORT_ORDER" => "ASC",
									"ELEMENT_SORT_ORDER2" => "DESC",
									"FILTER_NAME" => "favFilter",
									"HIDE_NOT_AVAILABLE" => "N",
									"IBLOCK_ID" => "1",
									"IBLOCK_TYPE" => "catalog",
									"IBLOCK_TYPE_ID" => "catalog",
									"INCLUDE_SUBSECTIONS" => "A",
									"LABEL_PROP" => "SALELEADER",
									"LINE_ELEMENT_COUNT" => "1",
									"MESSAGE_404" => "",
									"MESS_BTN_ADD_TO_BASKET" => "В корзину",
									"MESS_BTN_BUY" => "Купить",
									"MESS_BTN_DETAIL" => "Подробнее",
									"MESS_BTN_SUBSCRIBE" => "Подписаться",
									"MESS_NOT_AVAILABLE" => "Заказ по телефону",
									"META_DESCRIPTION" => "-",
									"META_KEYWORDS" => "-",
									"OFFERS_CART_PROPERTIES" => array(0=>"COLOR_REF",1=>"SIZES_CLOTHES",),
									"OFFERS_FIELD_CODE" => array(0=>"",1=>"",),
									"OFFERS_LIMIT" => "5",
									"OFFERS_PROPERTY_CODE" => array(0=>"COLOR_REF",1=>"SIZES_CLOTHES",2=>"SIZES_SHOES",3=>"",),
									"OFFERS_SORT_FIELD" => "sort",
									"OFFERS_SORT_FIELD2" => "id",
									"OFFERS_SORT_ORDER" => "desc",
									"OFFERS_SORT_ORDER2" => "desc",
									"OFFER_ADD_PICT_PROP" => "-",
									"OFFER_TREE_PROPS" => array(0=>"COLOR_REF",1=>"SIZES_SHOES",2=>"SIZES_CLOTHES",),
									"PAGER_BASE_LINK_ENABLE" => "N",
									"PAGER_DESC_NUMBERING" => "N",
									"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
									"PAGER_SHOW_ALL" => "Y",
									"PAGER_SHOW_ALWAYS" => "N",
									"PAGER_TEMPLATE" => "main",
									"PAGER_TITLE" => "Товары",
									"PAGE_ELEMENT_COUNT" => 10,
									"PARTIAL_PRODUCT_PROPERTIES" => "N",
									"PRICE_CODE" => array(0=>"PRICE",),
									"PRICE_VAT_INCLUDE" => "N",
									"PRODUCT_DISPLAY_MODE" => "N",
									"PRODUCT_ID_VARIABLE" => "id",
									"PRODUCT_PROPERTIES" => array(),
									"PRODUCT_PROPS_VARIABLE" => "prop",
									"PRODUCT_QUANTITY_VARIABLE" => "",
									"PRODUCT_SUBSCRIPTION" => "N",
									"PROPERTY_CODE" => array(0=>"",1=>"",),
									"SECTION_CODE" => $_REQUEST["SECTION_CODE"],
									"SECTION_CODE_PATH" => "",
									"SECTION_ID" => "",
									"SECTION_ID_VARIABLE" => "SECTION_ID",
									"SECTION_URL" => "",
									"SECTION_USER_FIELDS" => array(0=>"",1=>"",),
									"SEF_MODE" => "N",
									"SET_BROWSER_TITLE" => "Y",
									"SET_LAST_MODIFIED" => "N",
									"SET_META_DESCRIPTION" => "Y",
									"SET_META_KEYWORDS" => "Y",
									"SET_STATUS_404" => "N",
									"SET_TITLE" => "Y",
									"SHOW_404" => "N",
									"SHOW_ALL_WO_SECTION" => "Y",
									"SHOW_CLOSE_POPUP" => "N",
									"SHOW_DISCOUNT_PERCENT" => "N",
									"SHOW_OLD_PRICE" => "N",
									"SHOW_PRICE_COUNT" => "1",
									"TEMPLATE_THEME" => "site",
									"USE_MAIN_ELEMENT_SECTION" => "N",
									"USE_PRICE_COUNT" => "N",
									"USE_PRODUCT_QUANTITY" => "N",
									"WITH_REVIEWS" => ($isFirst)?"Y":"N",
									"WITH_CALLBACK" => ($isLast)?"Y":"N",
									"CLASS" => "b-2-items",
									// "CUSTOM_ORDER" => $ids,
									"SHOW_REMOVE_BUTTON" => "Y",
									"CUSTOM_MESSAGE" => "У вас ещё не было покупок"
								),
							false,
							Array(
								'ACTIVE_COMPONENT' => 'Y'
							)
							);
						?>
					</div>
				</div>
				<div class="b-tab-item hide" id="myworks">
					<div class="myreviews-header">Мои работы</div>
					<div class="b-works-list b-cabinet-works-list">
						<?$GLOBALS['galleryFilter'] = array('PROPERTY_AUTHOR' => $userID);?>
						<?$APPLICATION->IncludeComponent(
							"bitrix:news.list", 
							"gallery", 
							array(
								"ACTIVE_DATE_FORMAT" => "d.m.Y",
								"ADD_SECTIONS_CHAIN" => "N",
								"AJAX_MODE" => "N",
								"AJAX_OPTION_ADDITIONAL" => "",
								"AJAX_OPTION_HISTORY" => "N",
								"AJAX_OPTION_JUMP" => "N",
								"AJAX_OPTION_STYLE" => "Y",
								"CACHE_FILTER" => "N",
								"CACHE_GROUPS" => "Y",
								"CACHE_TIME" => "36000000",
								"CACHE_TYPE" => "A",
								"CHECK_DATES" => "Y",
								"DETAIL_URL" => "",
								"DISPLAY_BOTTOM_PAGER" => "Y",
								"DISPLAY_DATE" => "Y",
								"DISPLAY_NAME" => "Y",
								"DISPLAY_PICTURE" => "Y",
								"DISPLAY_PREVIEW_TEXT" => "Y",
								"DISPLAY_TOP_PAGER" => "N",
								"FIELD_CODE" => array(
									0 => "",
									1 => "",
								),
								"FILTER_NAME" => "galleryFilter",
								"HIDE_LINK_WHEN_NO_DETAIL" => "N",
								"IBLOCK_ID" => "11",
								"IBLOCK_TYPE" => "content",
								"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
								"INCLUDE_SUBSECTIONS" => "Y",
								"MESSAGE_404" => "",
								"NEWS_COUNT" => isset($_GET['count']) ? $_GET['count'] : 12,
								"PAGER_BASE_LINK_ENABLE" => "N",
								"PAGER_DESC_NUMBERING" => "N",
								"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
								"PAGER_SHOW_ALL" => "N",
								"PAGER_SHOW_ALWAYS" => "N",
								"PAGER_TEMPLATE" => "main",
								"PAGER_TITLE" => "Новости",
								"PARENT_SECTION" => "",
								"PARENT_SECTION_CODE" => "",
								"PREVIEW_TRUNCATE_LEN" => "",
								"PROPERTY_CODE" => array(
									0 => "PHOTOS",
									1 => "",
								),
								"SET_BROWSER_TITLE" => "N",
								"SET_LAST_MODIFIED" => "N",
								"SET_META_DESCRIPTION" => "N",
								"SET_META_KEYWORDS" => "N",
								"SET_STATUS_404" => "N",
								"SET_TITLE" => "N",
								"SHOW_404" => "N",
								"SORT_BY1" => isset($_GET['sort'])?$_GET['sort']:"PROPERTY_LIKES",
								"SORT_BY2" => "SORT",
								"SORT_ORDER1" => "DESC",
								"SORT_ORDER2" => "ASC",
								"STRICT_SECTION_CHECK" => "N",
								"COMPONENT_TEMPLATE" => "news"
							),
							false
						);?>
					</div>
					<!-- <div class="b-works-upload">
						<a href="#" class="b-load-more icon-load">
							<p class="pink dashed">Показать все</p>
						</a>
					</div> -->
				</div>
				<div class="b-tab-item hide" id="myreviews">
					<div class="myreviews-header">Мои отзывы</div>
					<div class="myreviews-list">
						<? $GLOBALS['reviewFilter'] = array('CODE' => $userID);
						$APPLICATION->IncludeComponent(
							"bitrix:news.list",
							"cabinet_reviews",
							Array(
								"ACTIVE_DATE_FORMAT" => "d.m.Y",
								"ADD_SECTIONS_CHAIN" => "N",
								"AJAX_MODE" => "Y",
								"AJAX_OPTION_ADDITIONAL" => "",
								"AJAX_OPTION_HISTORY" => "Y",
								"AJAX_OPTION_JUMP" => "Y",
								"AJAX_OPTION_STYLE" => "Y",
								"CACHE_FILTER" => "N",
								"CACHE_GROUPS" => "N",
								"CACHE_TIME" => "36000000",
								"CACHE_TYPE" => "A",
								"CHECK_DATES" => "Y",
								"DETAIL_URL" => "",
								"DISPLAY_BOTTOM_PAGER" => "Y",
								"DISPLAY_DATE" => "N",
								"DISPLAY_NAME" => "Y",
								"DISPLAY_PICTURE" => "Y",
								"DISPLAY_PREVIEW_TEXT" => "Y",
								"DISPLAY_TOP_PAGER" => "N",
								"FIELD_CODE" => array("NAME","PREVIEW_TEXT","","DATE_CREATE"),
								"FILTER_NAME" => "reviewFilter",
								"HIDE_LINK_WHEN_NO_DETAIL" => "N",
								"IBLOCK_ID" => "2",
								"IBLOCK_TYPE" => "content",
								"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
								"INCLUDE_SUBSECTIONS" => "N",
								"MESSAGE_404" => "",
								"NEWS_COUNT" => "10",
								"PAGER_BASE_LINK" => "",
								"PAGER_BASE_LINK_ENABLE" => "Y",
								"PAGER_DESC_NUMBERING" => "N",
								"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
								"PAGER_PARAMS_NAME" => "arrPager",
								"PAGER_SHOW_ALL" => "Y",
								"PAGER_SHOW_ALWAYS" => "N",
								"PAGER_TEMPLATE" => "main",
								"PAGER_TITLE" => "Новости",
								"PARENT_SECTION" => "",
								"PARENT_SECTION_CODE" => "",
								"PREVIEW_TRUNCATE_LEN" => "",
								"PROPERTY_CODE" => array("PRODUCT_ID", "USER_ID"),
								"SET_BROWSER_TITLE" => "N",
								"SET_LAST_MODIFIED" => "N",
								"SET_META_DESCRIPTION" => "N",
								"SET_META_KEYWORDS" => "N",
								"SET_STATUS_404" => "N",
								"SET_TITLE" => "N",
								"SHOW_404" => "N",
								"SORT_BY1" => "SORT",
								"SORT_BY2" => "ACTIVE_FROM",
								"SORT_ORDER1" => "ASC",
								"SORT_ORDER2" => "DESC"
							)
						);?>
					</div>
				</div>
				<div class="b-tab-item hide" id="myquestions">
					<div class="myreviews-header">Мои вопросы</div>
						<? $GLOBALS['questionsFilter'] = array(
							'PROPERTY_USER' => $userID,
							"ACTIVE" => array("Y", "N"),
						);?>
						<?$APPLICATION->IncludeComponent(
							"bitrix:news.list",
							"questions",
							Array(
								"ACTIVE_DATE_FORMAT" => "d.m.Y",
								"ADD_SECTIONS_CHAIN" => "N",
								"AJAX_MODE" => "Y",
								"AJAX_OPTION_ADDITIONAL" => "",
								"AJAX_OPTION_HISTORY" => "Y",
								"AJAX_OPTION_JUMP" => "Y",
								"AJAX_OPTION_STYLE" => "Y",
								"CACHE_FILTER" => "N",
								"CACHE_GROUPS" => "N",
								"CACHE_TIME" => "36000000",
								"CACHE_TYPE" => "A",
								"CHECK_DATES" => "Y",
								"DETAIL_URL" => "",
								"DISPLAY_BOTTOM_PAGER" => "Y",
								"DISPLAY_DATE" => "N",
								"DISPLAY_NAME" => "Y",
								"DISPLAY_PICTURE" => "Y",
								"DISPLAY_PREVIEW_TEXT" => "Y",
								"DISPLAY_TOP_PAGER" => "N",
								"FIELD_CODE" => array("NAME","PREVIEW_TEXT","","DATE_CREATE"),
								"FILTER_NAME" => "questionsFilter",
								"HIDE_LINK_WHEN_NO_DETAIL" => "N",
								"IBLOCK_ID" => "16",
								"IBLOCK_TYPE" => "content",
								"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
								"INCLUDE_SUBSECTIONS" => "N",
								"MESSAGE_404" => "",
								"NEWS_COUNT" => "10",
								"PAGER_BASE_LINK" => "",
								"PAGER_BASE_LINK_ENABLE" => "Y",
								"PAGER_DESC_NUMBERING" => "N",
								"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
								"PAGER_PARAMS_NAME" => "arrPager",
								"PAGER_SHOW_ALL" => "Y",
								"PAGER_SHOW_ALWAYS" => "N",
								"PAGER_TEMPLATE" => "main",
								"PAGER_TITLE" => "Новости",
								"PARENT_SECTION" => "",
								"PARENT_SECTION_CODE" => "",
								"PREVIEW_TRUNCATE_LEN" => "",
								"PROPERTY_CODE" => array("PRODUCT_ID", "USER_ID"),
								"SET_BROWSER_TITLE" => "N",
								"SET_LAST_MODIFIED" => "N",
								"SET_META_DESCRIPTION" => "N",
								"SET_META_KEYWORDS" => "N",
								"SET_STATUS_404" => "N",
								"SET_TITLE" => "N",
								"SHOW_404" => "N",
								"SORT_BY1" => "SORT",
								"SORT_BY2" => "ACTIVE_FROM",
								"SORT_ORDER1" => "ASC",
								"SORT_ORDER2" => "DESC"
							)
						);?>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="b-sub-block">
	<div class="b-block">
		<h2 class="sub-title">Узнавайте об <b>акциях и новинках</b> первыми</h2>
		<h5>Подпишитесь на рассылку и покупайте с выгодой для себя</h5>
		<form action="/kitsend.php" class="b-one-string-form">
			<input type="text" placeholder="Введите ваш E-mail">
			<a href="#" class="pink">Подписаться</a>
		</form>
	</div>
</div>