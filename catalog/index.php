<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Каталог");

if( !isset($_REQUEST["ORDER_FIELD"]) ){
	$_REQUEST["ORDER_FIELD"] = "NAME";
}

if( !isset($_REQUEST["ORDER_TYPE"]) ){
	$_REQUEST["ORDER_TYPE"] = "ASC";
}

$component = $GLOBALS["SECTION_ID"] ? 'subcategories' : 'categories';

?>
	<?$APPLICATION->IncludeComponent("redder:catalog.section.list", $component, Array(
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
		"SECTION_ID" => (isset($GLOBALS["SECTION_ID"]))?$GLOBALS["SECTION_ID"]:"",	// ID раздела
		"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
		"SECTION_USER_FIELDS" => array(	// Свойства разделов
		),
		"SHOW_PARENT_NAME" => "Y",	// Показывать название раздела
		"TOP_DEPTH" => "1",	// Максимальная отображаемая глубина разделов
		"VIEW_MODE" => "LINE",	// Вид списка подразделов
		"PROPERTY" => ($GLOBALS["isWholesale"])?array( "WHOLESALE" => 78 ):array(),
	),
	false
	);?>
	<?if(!$GLOBALS["SECTION_ID"]):?>
	<div class="b-daily-product b-category-daily-product">
		<div class="b-block">
			<div class="b-two-blocks">
				<div class="b-block-1 b-two-blocks-item">
					<h2>Товар дня*</h2>
					<h3>от «Первого магазина»</h3>
					<h4>Узнавайте об <span class="bold">акциях и новинках</span> первыми</h4>
					<h4>Подпишитесь на рассылку и покупайте<br>с выгодой для себя</h4>
					<form action="/kitsend.php" class="b-one-string-form">
						<input type="text" placeholder="Введите ваш E-mail">
						<a href="#" class="pink">Подписаться</a>
					</form>
				</div>
				<div class="b-block-2 b-two-blocks-item">
					<?$GLOBALS['arDailyFilter'] = array("PROPERTY_DAILY_VALUE" => "Y");?>
					<?$APPLICATION->IncludeComponent(
						"bitrix:catalog.section",
						"daily",
						Array(
							"ACTION_VARIABLE" => "action",
							"ADD_PICT_PROP" => "MORE_PHOTO",
							"ADD_PROPERTIES_TO_BASKET" => "Y",
							"ADD_SECTIONS_CHAIN" => "Y",
							"ADD_TO_BASKET_ACTION" => "ADD",
							"AJAX_MODE" => "Y",
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
							"DISPLAY_BOTTOM_PAGER" => "N",
							"DISPLAY_TOP_PAGER" => "N",
							"ELEMENT_SORT_FIELD" => "sort",
							"ELEMENT_SORT_FIELD2" => "id",
							"ELEMENT_SORT_ORDER" => "ASC",
							"ELEMENT_SORT_ORDER2" => "DESC",
							"FILTER_NAME" => "arDailyFilter",
							"HIDE_NOT_AVAILABLE" => "Y",
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
							"PAGE_ELEMENT_COUNT" => 1,
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
							"SECTION_CODE" => "",
							"SECTION_CODE_PATH" => "",
							"SECTION_ID" => "",
							"SECTION_ID_VARIABLE" => "SECTION_ID",
							"SECTION_URL" => "",
							"SECTION_USER_FIELDS" => array(0=>"",1=>"",),
							"SEF_MODE" => "N",
							"SET_BROWSER_TITLE" => "N",
							"SET_LAST_MODIFIED" => "N",
							"SET_META_DESCRIPTION" => "Y",
							"SET_META_KEYWORDS" => "Y",
							"SET_STATUS_404" => "N",
							"SET_TITLE" => "N",
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
	</div>
	<div class="b-catalog-preview b-category-catalog-preview wave-bottom">
		<div class="b-block">
			<div class="b-sort">
				<form action="" method="GET" class="b-catalog-form">
					<div class="b-sort-container">
						<div class="b-sort-item b-sort-type">
							<p><b>Сортировать по:</b></p>
							<div class="b-sort-select">
								<select name="sort">
									<option value="NAME">Алфавиту</option>
									<option value="PROPERTY_PRICE">PROPERTY_PRICE</option>
									<option value="PRICE">PRICE</option>
								</select>
								<input type="hidden" name="section_id" value="<?=$GLOBALS["SECTION_ID"]?>">
							</div>
						</div>
						<div class="b-sort-item b-sort-discount">
							<label class="checkbox">
							  <input type="checkbox" name="discount">
							  <span>Только со скидкой</span>
							</label>
						</div>
						<div class="b-sort-item b-sort-wholesale">
							<label class="checkbox">
							  <input type="checkbox" name="wholesale">
							  <span>Купить оптом</span>
							</label>
						</div>
					</div>
					<div class="b-sort-container">
						<div class="b-sort-item b-sort-count">
							<p><b>Показывать по:</b></p>
							<div class="b-sort-select">
								<select name="count">
									<option value="12">12</option>
									<option value="24">24</option>
									<option value="48">48</option>
								</select>
							</div>
						</div>
						<div class="b-sort-item b-sort-view">
							<a href="#" class="sort-icon icon-sort-2 active" data-style="small-tile"></a>
							<a href="#" class="sort-icon icon-list" data-style="list"></a>
						</div>
					</div>
				</form>
			</div>
			<?
			if ($_GET['discount']=="on") {
				$arDiscounts = getDiscountProducts();
				var_dump($arDiscounts);
				$GLOBALS["arrDiscountFilter"][] = Array(
					"LOGIC"=>"OR",
					Array("ID" =>$arDiscounts["PRODUCTS"]),
					Array("SECTION_ID" => $arDiscounts["SECTIONS"], "INCLUDE_SUBSECTIONS" => "Y"),
				);	
			}
			?>
			<div class="pagination-container">
				<?$APPLICATION->IncludeComponent(
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
						"ELEMENT_SORT_FIELD" => isset($_GET['sort'])?$_GET['sort']:$_REQUEST["ORDER_FIELD"],
						"ELEMENT_SORT_FIELD2" => "id",
						"ELEMENT_SORT_ORDER" => $_REQUEST["ORDER_TYPE"],
						"ELEMENT_SORT_ORDER2" => "DESC",
						"FILTER_NAME" => "arrDiscountFilter",
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
					),
				false,
				Array(
					'ACTIVE_COMPONENT' => 'Y'
				)
				);?>
			</div>
		</div>
	</div>
	<?endif;?>
	<div class="b-bottom-catalog b-category-bottom-catalog">
		<div class="b-block">
			<div id="b-category-tab-slider" class="b-tabs-container b-tabs-container-underline">
				<div class="b-tab active" data-tab="about">О магазине</div>
				<div class="b-tab" data-tab="inventory">Инвентарь</div>
				<div class="b-tab" data-tab="regs">Ингредиенты</div>
				<div class="b-tab" data-tab="colors">Красители</div>
				<div class="b-tab" data-tab="brands">Бренды</div>
				<div class="b-tab" data-tab="forms">Формы</div>
			</div>
			<div class="b-tab-item b-tab-about" id="about">
				<p>Самый большой интернет-магазин кондитерского инвентаря и ингредиентов. Мы предлагаем только то, что используем сами. В каталоге нашего магазина вы найдете товары для профессионалов и для домашней выпечки.<br><br>
				Самый большой интернет-магазин кондитерского инвентаря и ингредиентов. Мы предлагаем только то, что используем сами. В каталоге нашего магазина вы найдете товары для профессионалов и для домашней выпечки. Самый большой интернет-магазин кондитерского инвентаря и ингредиентов. Инвентаря и ингредиентов.</p>
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
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>