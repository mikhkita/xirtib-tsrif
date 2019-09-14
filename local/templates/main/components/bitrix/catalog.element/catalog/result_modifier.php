<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

$units = array(
	2 => "за 1 литр",
	3 => "за 1 грамм",
	4 => "за 1 килограмм",
	5 => "за штуку",
	6 => "за упаковку",
);

$arResult["MEASURE"] = $units[ $arResult["PRODUCT"]["MEASURE"] ];

if( isset($GLOBALS["BASKET_ITEMS"][ $arResult["ID"] ]) ){
	$arResult["BASKET"] = $GLOBALS["BASKET_ITEMS"][ $arResult["ID"] ];
}

$arResult = $arResult + getRating($arResult["ID"]);

$rsStore = CCatalogStoreProduct::GetList(array(), array('PRODUCT_ID' =>$arResult["ID"], 'STORE_ID' => 1), false, false); 
$arResult["AMOUNT"] = array();
if ($arStore = $rsStore->Fetch()){
	array_push($arResult["AMOUNT"], $arStore);
}

$tmpColorId = array();
$tmpSizeId = array();
$arResult['COLORS'] = array();
$jsonOffers = array();

function getOfferProperties($arResult){
	
}

if ($arResult["OFFERS"]) {

	$hasColors = false;
	$hasSizes = false;

	foreach ($arResult["OFFERS"] as $key => $offer) {
		if (isset($offer['PROPERTIES']['COLOR']['VALUE_XML_ID'])) {
			$hasColors = true;
		}
		if (isset($offer['PROPERTIES']['SIZE']['VALUE_XML_ID'])) {
			$hasSizes = true;
		}
	}

	foreach ($arResult["OFFERS"] as $key => $offer){ 

		$selected = ($key == 0) ? 'selected' : '';
		$addColor = true;
		$addSize = true;

		if ($hasColors && $hasSizes) {

			$color = $offer['PROPERTIES']['COLOR']['VALUE_XML_ID'];
			$size = $offer['PROPERTIES']['SIZE']['VALUE_XML_ID'];

			$jsonOffers[$color][$size]['PRICE'] = $offer['PRICES']['PRICE']['VALUE'];
			$jsonOffers[$color][$size]['DISCOUNT_PRICE'] = $offer['PRICES']['PRICE']['DISCOUNT_VALUE'];
			$jsonOffers[$color][$size]['QUANTITY'] = $offer["PRODUCT"]["QUANTITY"];
			$jsonOffers[$color][$size]['OFFER_ID'] = $offer['ID'];
			$jsonOffers[$color][$size]['ITEM_PRICES'] = $offer["ITEM_PRICES"];

		} else {

			$option = ($hasColors) ? $offer['PROPERTIES']['COLOR']['VALUE_XML_ID'] : $offer['PROPERTIES']['SIZE']['VALUE_XML_ID'];

			$jsonOffers[$option]['PRICE'] = $offer['PRICES']['PRICE']['VALUE'];
			$jsonOffers[$option]['DISCOUNT_PRICE'] = $offer['PRICES']['PRICE']['DISCOUNT_VALUE'];
			$jsonOffers[$option]['QUANTITY'] = $offer["PRODUCT"]["QUANTITY"];
			$jsonOffers[$option]['OFFER_ID'] = $offer['ID'];
			$jsonOffers[$option]['ITEM_PRICES'] = $offer["ITEM_PRICES"];
			
		}

		foreach ($tmpColorId as $value){
			if (intval($offer['PROPERTIES']['COLOR']['VALUE_XML_ID']) == intval($value)){
				$addColor = false;
			}
		}

		foreach ($tmpSizeId as $value){
			if (intval($offer['PROPERTIES']['SIZE']['VALUE_XML_ID']) == intval($value)){
				$addSize = false;
			}
		}

		if ($addColor && isset($offer['PROPERTIES']['COLOR']['VALUE_XML_ID'])){
			$tmpColorId[] = $offer['PROPERTIES']['COLOR']['VALUE_XML_ID'];
			$colorxml = $offer['PROPERTIES']['COLOR']['VALUE_XML_ID'];
			$arResult['COLORS'][$colorxml] = array();
			$arResult['COLORS'][$colorxml]['NAME'] = $offer['PROPERTIES']['COLOR']['VALUE'];
			$arResult['COLORS'][$colorxml]['SELECTED'] = $selected;
		}

		if ($addSize && isset($offer['PROPERTIES']['SIZE']['VALUE_XML_ID'])){
			$tmpSizeId[] = $offer['PROPERTIES']['SIZE']['VALUE_XML_ID'];
			$sizexml = $offer['PROPERTIES']['SIZE']['VALUE_XML_ID'];
			$arResult['SIZE'][$sizexml] = array();
			$arResult['SIZE'][$sizexml]['NAME'] = $offer['PROPERTIES']['SIZE']['VALUE'];
			$arResult['SIZE'][$sizexml]['SELECTED'] = $selected;
		}
	}

	$arResult['JSON_OFFERS'] = json_encode($jsonOffers);
}






