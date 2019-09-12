<?

$presentIterators = Bitrix\Sale\Internals\DiscountTable::getList(array(
    'select' => array('ACTIONS_LIST', 'CONDITIONS_LIST', 'ACTIVE_TO'),
    'filter' => array('XML_ID' => "PRESENT"),
    'order' => array('ACTIVE_TO' => "ASC")
));

$i = 0;
$arPresentItems = array();

// vardump($arResult['ITEMS'][0]['NAME']);

while ($present = $presentIterators->fetch()) {
    foreach($present['ACTIONS_LIST']["CHILDREN"][0]["CHILDREN"][0]["DATA"]["Value"] as $itemID){
		$arPresentItems[$i]['ID'] = $itemID;

		foreach($arResult['ITEMS'] as $arItem){

			if ($arItem['ID'] == $itemID) {
				$images = getElementImages($arItem, true);
				$arPresentItems[$i]['NAME'] = $arItem['NAME'];
				$arPresentItems[$i]['IMG'] = $images["DETAIL_PHOTO"][0]["SMALL"];
				$arPresentItems[$i]['DETAIL_PAGE_URL'] = $arItem['DETAIL_PAGE_URL'];
			}

		}

		$arPresentItems[$i]['PRICE'] = $present['CONDITIONS_LIST']["CHILDREN"][0]["DATA"]["Value"];
		if (isset($present['ACTIVE_TO'])){
			$arPresentItems[$i]['ACTIVE_TO_DAY'] = $present['ACTIVE_TO']->format("d");
			$arPresentItems[$i]['ACTIVE_TO_MONTH'] = getRusMonth($present['ACTIVE_TO']->format("m"));
		}
		$i ++;
	}
}

$arResult['PRESENT_ITEMS'] = $arPresentItems;


?>
