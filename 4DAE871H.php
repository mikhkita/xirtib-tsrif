<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

if( $_REQUEST['login'] == 'sergey' && $_REQUEST['pass'] == '6JYVIi7K' )
{
	if ( isset( $_REQUEST['e'] ) && $_REQUEST['e'] == 'send' && isset( $_REQUEST['id_start'] ) && isset( $_REQUEST['id_end'] ) )
	{
		$ids = array();
		$_REQUEST['id_start'] = intval($_REQUEST['id_start']);
		$_REQUEST['id_end'] = intval($_REQUEST['id_end']);
		$start = $_REQUEST['id_end'] > $_REQUEST['id_start']?$_REQUEST['id_start']:$_REQUEST['id_end'];
		$end = $_REQUEST['id_end'] > $_REQUEST['id_start']?$_REQUEST['id_end']:$_REQUEST['id_start'];
		for( $i = $start; $i <= $end; $i++ ){
			array_push($ids, $i);
		}

		$result = resendOrders($ids);
		echo $result?"Письма успешно высланы":"Заказы не найдены";
	}
}
die();