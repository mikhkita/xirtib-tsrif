<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$file_path = "../test.xml";

$file = simplexml_load_file( $file_path );

function mb_ucfirst($text) {
    return mb_strtoupper(mb_substr($text, 0, 1)) . mb_substr($text, 1);
}

$id = 200;

foreach( $file->Заказ as $item ){
	// $id = intval($item->НомерЗаказа);
	$arStatus = explode(",", $item->СтатусЗаказа, 2);
	$operator = str_replace("_", " ", $item->Автор);
	$tracking = $item->НомерОтправления;
	$currentStatus = mb_strtolower($arStatus[0], 'UTF-8');
	$additionalStatus = NULL;

	switch ($currentStatus) {
		case 'заказ удален':
			$statusID = "R";
			break;
		case 'на доставке':
			$statusID = "D";
			break;
		case 'комплектуется':
			$statusID = "CM";
			break;
		case 'принят оператором':
			$statusID = "A";
			break;
		case 'обрабатывается':
			$statusID = "P";
			break;
		default:
			break;
	}

	if (isset($arStatus[1])) {
		if(stristr($arStatus[1], '_') !== false) {
		    $additionalStatus = explode("_", $arStatus[1]);
		} else {
			$additionalStatus[1] = $arStatus[1];
		}
		$additionalStatus = mb_ucfirst(trim($additionalStatus[1]));
	}

	$order = Bitrix\Sale\Order::load($id);
	$propertyCollection = $order->getPropertyCollection();
	$obAdditionalStatus = $propertyCollection->getItemByOrderPropertyId(25);
	$obTracking = $propertyCollection->getItemByOrderPropertyId(26);
	$obOperator = $propertyCollection->getItemByOrderPropertyId(27);

	$order->setField("STATUS_ID", $statusID);
	$obTracking->setValue($tracking);
	$obOperator->setValue($operator);

	if ($additionalStatus !== NULL) {
		$obAdditionalStatus->setValue($additionalStatus);
	}

	$order->save();
	die();
}

?>