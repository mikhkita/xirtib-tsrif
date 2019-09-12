<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

global $APPLICATION;

if ($arResult['JSON_OFFERS']):
	?><script>
		var offers = <?=$arResult['JSON_OFFERS']?>;
	</script><?
endif;

$this->setFrameMode(true);
$APPLICATION->SetPageProperty('title', $arResult["NAME"]);
$APPLICATION->AddHeadString('<link rel="canonical" href="https://nevkusno.ru' . $arResult["DETAIL_PAGE_URL"] . '" />'); 

$arImg = getElementImages($arResult);

$bigImage = $arImg['DETAIL_PHOTO'][0]['BIG'];
$isSliderImg = false;
$quantity = intval($arResult['OFFERS'] ? $arResult['OFFERS'][0]["PRODUCT"]["QUANTITY"] : $arResult["PRODUCT"]["QUANTITY"]);
$id = $arResult['OFFERS'] ? $arResult['OFFERS'][0]['ID'] : $arResult['ID'];

foreach ($arImg['DETAIL_PHOTO'] as $img) {
	if ($bigImage != $img['BIG']) {
		$isSliderImg = true;	
	}
}

if ($arResult["OFFERS"]){
	foreach ($arResult["OFFERS"] as $key => $offer){

		if ($key == 0){
			$price = $offer["PRICES"]["PRICE"]["VALUE"];
			$discountPrice = $offer["PRICES"]["PRICE"]["DISCOUNT_VALUE"];
		}

		if($offer["PRICES"]["PRICE"]["DISCOUNT_VALUE"] != $offer["PRICES"]["PRICE"]["VALUE"]){
			$discountClass = "b-discount-price";
		}
	}
} else {

	if( $arResult["PRICES"]["PRICE"]["DISCOUNT_VALUE"] != $arResult["PRICES"]["PRICE"]["VALUE"] ){
		$discountClass = "b-discount-price";
	}

	$price = $arResult["PRICES"]["PRICE"]["VALUE"];
	$discountPrice = $arResult["PRICES"]["PRICE"]["DISCOUNT_VALUE"];
}

if (isset($discountClass)) {
	$discount = round(100 - ($discountPrice * 100 / $price));
}

?>

<div class="b-detail-item">
	<div class="b-block">
		<div class="b-detail-left-block">
			<div class="b-detail-top-slider">
				<? if ($arResult["OFFERS"]): ?>
					<? foreach ($arResult['OFFERS'] as $key => $offer): ?>
						<a href="<?=$arImg["DETAIL_PHOTO"][$key]["ORIGINAL"]?>" class="b-detail-big-pic fancy-img" data-fancybox="gallery" data-id="<?=$offer['ID']?>">
							<div class="img-cont">
								<img src="<?=$arImg["DETAIL_PHOTO"][$key]["BIG"]?>" alt="<?=$arResult['NAME']?> <?=$offer['NAME']?>" title="<?=$arResult['NAME']?> <?=$offer['NAME']?>">
							</div>
						</a>
					<? endforeach; ?>
				<? else: ?>
					<a href="<?=$arImg["DETAIL_PHOTO"][0]["ORIGINAL"]?>" class="b-detail-big-pic fancy-img">
						<div class="img-cont">
							<img src="<?=$arImg["DETAIL_PHOTO"][0]["BIG"]?>" alt="<?=$arResult['NAME']?> <?=$offer['NAME']?>" title="<?=$arResult['NAME']?> <?=$offer['NAME']?>">
						</div>
					</a>
				<? endif; ?>
			</div>
			<? if ($arResult["OFFERS"] && $isSliderImg): ?>
				<div class="b-detail-bottom-slider">
					<? foreach ($arResult['OFFERS'] as $key => $offer): ?>
						<div class="b-detail-small-pic" style="background-image: url('<?=$arImg["DETAIL_PHOTO"][$key]["SMALL"]?>" data-id="<?=$offer['ID']?>"></div>
					<? endforeach; ?>
				</div>
			<? endif; ?>
		</div>
		<div class="b-detail-right-block">
			<h3><?$APPLICATION->ShowTitle();?></h3>
			<div class="b-detail-bonus-container">
				<div class="b-detail-bonus green-bonus">-5% при оплате онлайн</div>
				<div class="b-detail-bonus purple-bonus bonus-with-add icon-info">
					Вернем 50% от стоимости доставки
					<!-- <div class="b-detail-bonus-add">Возврат осуществляется в случае</div> -->
				</div>
			</div>
			<div class="b-detail-top-slider b-detail-mobile-slider">
				<? if ($arResult["OFFERS"]): ?>
					<? foreach ($arResult["OFFERS"] as $key => $offer): ?>
						<div class="b-detail-big-pic" style="background-image: url('<?=$arImg["DETAIL_PHOTO"][$key]["BIG"]?>');" data-color-id="<?=$offer['ID']?>"></div>
					<? endforeach; ?>
				<? else: ?>
					<div class="b-detail-big-pic" style="background-image: url('<?=$arImg["DETAIL_PHOTO"][0]["BIG"]?>');" data-color-id="<?=$offer['ID']?>"></div>
				<? endif; ?>
			</div>
			<? if ($arResult["OFFERS"] && $isSliderImg): ?>
					<div class="b-detail-bottom-slider b-detail-mobile-slider">
						<? foreach ($arResult['OFFERS'] as $key => $offer): ?>
							<div class="b-detail-small-pic" style="background-image: url('<?=$arImg["DETAIL_PHOTO"][$key]["SMALL"]?>" data-id="<?=$offer['ID']?>"></div>
						<? endforeach; ?>
					</div>
				<? endif; ?>
			<div class="detail-price-container">
				<div class="price-container <?=$discountClass?>">
					<p class="old-price icon-rub"><?=convertPrice($price)?></p>
					<p class="new-price icon-rub"><?=convertPrice($discountPrice)?></p>
					<div class="cheaper-mobile">
						<a href="#" class="pink dashed">Купить этот товар дешевле</a>
					</div>
					<p class="app-price">Эксклюзивные цены в <a href="https://www.apple.com/ru/itunes/charts/free-apps/" class="pink dashed">приложении</a></p>
				</div>
				<? if (isset($discount)): ?>
					<div class="b-detail-discount">
						<div class="b-detail-disount-icon icon-discount-full">-<?=$discount?>%</div>
						<div class="discount-time">17 ч : 49 м : 58 с</div>
					</div>
				<? endif; ?>
			</div>
			<div class="detail-select-block">
				<? if (!empty($arResult['COLORS'])): ?>
					<div class="b-sort-select">
						<select name="color" id="colorSelect" data-placeholder="Выберите цвет">
							<? foreach ($arResult['COLORS'] as $xmlvalue => $color): ?>
								<option data-id="<?=$xmlvalue?>" <?=$color['SELECTED']?>><?=$color['NAME']?></option>
							<? endforeach; ?>
						</select>
					</div>
				<? endif; ?>
				<? if (!empty($arResult['SIZE'])): ?>
					<div class="b-sort-select">
						<select name="size" id="sizeSelect" data-placeholder="Выберите размер">
							<option></option>
							<? foreach ($arResult['SIZE'] as $xmlvalue => $size): ?>
								<option data-id="<?=$xmlvalue?>" <?=$size['SELECTED']?>><?=$size['NAME']?></option>
							<? endforeach; ?>
						</select>
					</div>
				<? endif; ?>
			</div>
			<div class="b-detail-count-block">
				<?if($quantity <= 0){
						$inputVal = 0;
					} else {
						$infoClass = "hide";
						$inputVal = 1;
					}?>
				<div class="b-detail-count b-product-quantity">
					<a href="#" class="icon-minus quantity-reduce"></a>
					<input type="text" name="count" class="quantity-input" data-quantity="<?=$quantity?>" maxlength="3" oninput="this.value = this.value.replace(/\D/g, '')" value="<?=$inputVal?>">
					<a href="#" class="icon-plus quantity-add"></a>
				</div>
				<?/*?><a href="#" class="pink dashed cheaper">Купить этот товар дешевле</a><?*/?>
				<div class="b-product-quantity-info <?=$infoClass?>">
					<span>В наличии:&nbsp;</span><span id="quantity-info"><?=$quantity?></span>
				</div>
				<div class="b-detail-buy b-detail-buy-mobile">
					<a href="/ajax/?action=ADD2BASKET" class="b-btn b-btn-to-cart b-btn-to-cart-detail icon-cart" data-id="<?=$id?>"><p>В корзину</p></a>
					<div href="#" onclick="return false;" class="b-btn b-btn-to-cart-cap hide">
						<span class="b-cap-text">Товар успешно добавлен</span>
					</div>
				</div>
			</div>
			<div class="b-detail-buy">
				<a href="/ajax/?action=ADD2BASKET" class="b-btn b-btn-to-cart b-btn-to-cart-detail icon-cart" data-id="<?=$id?>"><p>Добавить в корзину</p></a>
				<div href="#" onclick="return false;" class="b-btn b-btn-to-cart-cap hide">
					<span class="b-cap-text">Товар успешно добавлен</span>
				</div>
				<?/*?><div class="b-detail-one-click">или <a href="#" class="pink dashed">купить в один клик</a></div><?*/?>
			</div>
			<div class="b-detail-tabs">
				<div class="b-tabs-container b-catalog-tabs-slider b-tabs-container-underline">
					<div class="b-tab active" data-tab="description">Описание</div>
					<div class="b-tab" data-tab="delivery">Доставка</div>
					<div class="b-tab" data-tab="review">Отзывы (<?=$arResult["COUNT_REVIEWS"]?>)</div>
					<?/*?><div class="b-tab" data-tab="recipes">Рецепты с продуктом</div><?*/?>
				</div>
				<div class="b-tab-item b-tab-about" id="description">
					<div class="detail-description-text limit b-detail-text b-text" id="b-detail-text">
						<div class="b-detail-text-wrap">
							<?=$arResult['DETAIL_TEXT']?>	
						</div>						
					</div>
					<a href='#' class="b-detail-text-more">Читать полностью</a>
					<?/*?>
					<div class="detail-description-text"><b>Размеры:</b> диаметр 60 мм , высота 73 мм, объем 108 мл х 5 = 540 мл</div>
					<div class="detail-description-text"><b>Рекомендации по применению:</b> идеально подходят для выпечки, приготовления десертов и пирожных, холодных закусок, заливного, желе. Могут быть использованы в температурном режиме от -60 С до +230 С. После применения формы необходимо тщательно вымыть и просушить.</div>
					<div class="detail-description-text"><b>Внимание!</b> Не ставьте форму непосредственно на источник тепла. Не режьте изделия непосредственно в форме. Не используйте агрессивные моющие средства и жесткие губки. Не используйте форму в микроволновой печи в режиме "гриль". Рекомендации После выпечки нужно дать изделию полностью остыть для лучшего извлечения из формы. Рекомендуется также перед выпечкой предварительно смазывать формы маслом. Для полного устранения следов жира в форме, ее достаточно просто прокипятить в воде 10 минут.</div>
					<div class="detail-description-text"><b>Срок годности:</b> неограничен</div>
					<div class="detail-description-text"><b>Условия хранения:</b> хранить вдали от источников тепла и солнечных лучей при температуре от 15 до 25 °C</div>
					<?*/?>
				</div>
				<div class="b-tab-item b-tab-about hide" id="delivery">
					<p>Текст для доставок</p>
				</div>
				<div class="b-tab-item b-tab-about hide" id="review">
					<? $GLOBALS["arProductReviews"] = array(
							"PROPERTY_PRODUCT_ID" => $arResult["ID"]
						); 
					$APPLICATION->IncludeComponent(
						"bitrix:news.list",
						"reviews",
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
							"FILTER_NAME" => "arProductReviews",
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
				<div class="b-tab-item b-tab-about hide" id="recipes"></div>
			</div>
		</div>
	</div>
</div>
<div class="detail-advantages-block">
	<? includeArea('detail-advantages');?>
</div>
<div class="b-last-item-block b-last-detail wave-top">
	<div class="b-block">
		<h2>Успей купить! Последний товар</h2>
		<div class="b-catalog-slider">
			<?

			$GLOBALS["catalogFilter"] = array(
				"PROPERTY_LAST_VALUE" => "Y"
			);

			$APPLICATION->IncludeComponent(
				"bitrix:catalog.section",
				"slider",
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
					"ELEMENT_SORT_FIELD" => isset($_REQUEST['sort']) ? $_REQUEST['sort'] : 'sort',
					"ELEMENT_SORT_FIELD2" => "id",
					"ELEMENT_SORT_ORDER" => 'ASC',
					"ELEMENT_SORT_ORDER2" => "DESC",
					"FILTER_NAME" => "catalogFilter",
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
					"OFFERS_LIMIT" => "",
					"OFFERS_PROPERTY_CODE" => array(0=>"COLOR_REF",1=>"SIZES_CLOTHES",2=>"SIZES_SHOES",3=>"",),
					"OFFERS_SORT_FIELD" => 'ID',
					"OFFERS_SORT_FIELD2" => "id",
					"OFFERS_SORT_ORDER" => "ASC",
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
					"PAGE_ELEMENT_COUNT" => isset($_GET['count']) ? $_GET['count'] : 12,
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
					"SECTION_CODE" => '',
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
				),
			false,
			Array(
				'ACTIVE_COMPONENT' => 'Y'
			)
			);?>
		</div>
	</div>
</div>

<? includeArea('subscribe'); ?>