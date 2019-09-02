<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$count = getParam("NEW_COUNT");
// setParam("NEW_COUNT", "200");

$currentDate = date("d.m.Y");

$arTabs = array(
	0 => array(
		'TAB' => 'currentMonth',
		'DATE' => '-1 months',
		'NAME' => 'За текущий месяц',
	),
	1 => array(
		'TAB' => '1MonthAgo',
		'DATE' => '-2 months',
		'NAME' => 'Месяц назад',
	),
	2 => array(
		'TAB' => '3MonthAgo',
		'DATE' => '-3 months',
		'NAME' => 'Три месяца назад',
	),
	3 => array(
		'TAB' => '6MonthAgo',
		'DATE' => '-6 months',
		'NAME' => 'Полгода назад',
	),
	4 => array(
		'TAB' => '1YearAgo',
		'DATE' => '-1 months',
		'NAME' => 'Год назад',
	),
);

$arCount = array('12', '24', '48');

foreach ($_REQUEST as $key => $value){
	if (strpos($key, "PAGEN") !== false){
		$pagen['name'] = $key;
		$pagen['value'] = $value;
	}
}

$APPLICATION->SetTitle('Новинки');?>
<div class="view-tab-block b-catalog-preview">
	<div class="b-tabs">
		<div id="b-novelties-tab-slider" class="b-tabs-container b-tabs-container-underline ajax-tabs">
			<? foreach($arTabs as $tab): ?>
				<?
				$GLOBALS[$tab['TAB']] = array( "ID" => getNewItems($currentDate, date("d.m.Y", strtotime($tab['DATE']))));
				$active = $_REQUEST['tab'] ? $_REQUEST['tab'] : 'currentMonth';
				$isActive = ($active == $tab['TAB']) ? 'active' : '';
				?>
				<div class="b-tab <?=$isActive?>" data-tab="<?=$tab['TAB']?>"><?=$tab['NAME']?></div>
			<? endforeach; ?>
		</div>
		<div class="b-sort b-view-sort-only">
			<form action="" method="GET" class="b-catalog-form">
				<div class="b-sort-container">
					<div class="b-sort-item b-sort-count">
						<p><b>Показывать по:</b></p>
						<div class="b-sort-select">
							<select name="count">
								<? foreach ($arCount as $value): ?>
									<? if (isset($_REQUEST['count'])): ?>
										<? $selected = ($_REQUEST['count'] == $value) ? 'selected' : '' ;?>
									<? endif; ?>
									<option value="<?=$value?>" <?=$selected?>><?=$value?></option>
								<? endforeach; ?>
							</select>
						</div>
					</div>
					<div class="b-sort-item b-sort-view">
						<? $view = $_REQUEST['view'] ? $_REQUEST['view'] : 'tile'; ?>
						<input type="radio" name="view" value="tile" class="sort-icon icon-sort-1 <? echo $view == 'tile' ? 'active' : ''; ?>" <? echo $view == 'tile' ? 'checked' : ''; ?>>
						<input type="radio" name="view" value="list" class="sort-icon icon-list <? echo $view == 'list' ? 'active' : ''; ?>" <? echo $view == 'list' ? 'checked' : ''; ?>>
					</div>
					<input type="hidden" id="data-tab" name="tab" value=<?=$_REQUEST['tab'] ? $_REQUEST['tab'] : 'currentMonth'?>> 
					<? if (isset($pagen)): ?>
						<input type="hidden" id="pagen" name="<?=$pagen['name']?>" value='<?=$pagen['value']?>'>
					<? endif; ?>
				</div>
			</form>
		</div>
		<div class="b-tab-item" id="current-month">
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
					"ELEMENT_SORT_FIELD" => 'CREATED_DATE',
					"ELEMENT_SORT_FIELD2" => "id",
					"ELEMENT_SORT_ORDER" => 'ASC',
					"ELEMENT_SORT_ORDER2" => "DESC",
					"FILTER_NAME" => $_REQUEST['tab'] ? $_REQUEST['tab'] : 'currentMonth',
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
					"OFFERS_SORT_FIELD" => "created_date",
					"OFFERS_SORT_FIELD2" => "id",
					"OFFERS_SORT_ORDER" => "asc",
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
					"PAGE_ELEMENT_COUNT" => isset($_REQUEST['count']) ? $_REQUEST['count'] : 12,
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
				),
			false,
			Array(
				'ACTIVE_COMPONENT' => 'Y'
			)
			);?>
		</div>
	</div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>