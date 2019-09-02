<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$GLOBALS['APPLICATION']->RestartBuffer();

if( isset($_REQUEST["ID"]) ){
	$ids = explode(",", $_REQUEST["ID"]);
	foreach ($ids as $key => $id) {
		$ids[$key] = intval(trim($id));
	}

	$result = resendOrders($ids);

	if( count( $ids ) > 1 ){
		echo $result?"Заказы успешно переотправлены":"Заказы не найдены";
	}else if( count( $ids ) == 1 ){
		echo $result?"Заказ успешно переотправлен":"Заказ не найден";
	}else{
		echo "Номер заказа не передан";
	}
}
die();

?>