<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

// //error_reporting( E_ALL | E_NOTICE );

// //ini_set('display_errors', 'On');

// $data = 'Getting data from 1c ' . date( DATE_W3C ) . "\n\n";
// ob_start();

// echo '$_GET = ';
// print_r ( $_GET );

// echo "\n\n".'$_POST=';

// print_r ( $_POST );

// echo "\n\n".'$_FILES=';

// print_r ( $_FILES );

// echo "\n\n".'$_SERVER=';

// print_r ( $_SERVER );

// //echo "\n\n".'input://';

// $data .= ob_get_clean();
// $data .= "\n\n";

// file_put_contents( $_SERVER["DOCUMENT_ROOT"]."/1C_exchange/151BE65C.log", $data, FILE_APPEND );

// $file = base64_decode( file_get_contents("php://input") );

// if ( isset( $_GET['type'] ) )
// {
// 	if ( $_GET['type'] === 'zak' )
// 	{
// 		$ext = '.xml';
// 	}
// 	elseif ( $_GET['type'] === 'ost' )
// 	{
// 		$ext = '.csv';
// 	}
// 	else
// 	{
// 		echo 'Тип файла неопознан';
// 		die;
// 	}

// 	do
// 	{
// 		$file_path = $_SERVER["DOCUMENT_ROOT"]."/1C_exchange/files/" . $_GET['type'] . '_' . date( DATE_W3C ) . $ext;
// 	}
// 	while ( file_exists( $file_path ) );


	// if ( file_put_contents( $file_path, $file ) )
	// {
	// 	chmod( $file_path, 0777 );
	// 	echo 'Файл записан как ' . $file_path . "\n";
	// 	file_put_contents( $_SERVER["DOCUMENT_ROOT"]."/1C_exchange/151BE65C.log", 'Файл записан как ' . $file_path . "\n\n", FILE_APPEND );

		$file_path = "/home/freshbt/nevkusno.ru/docs/1C_exchange/files/ost_2019-06-16T23:34:11+03:00.csv";

		if ( $_GET['type'] === 'zak' )
		{
			$file = simplexml_load_file( $file_path );

			function mb_ucfirst($text) {
			    return mb_strtoupper(mb_substr($text, 0, 1)) . mb_substr($text, 1);
			}

			foreach( $file->Заказ as $item ){
				$id = intval($item->НомерЗаказа);

				if( $id >= 7000000 ){
					continue;
				}

				$arStatus = explode(",", $item->СтатусЗаказа, 2);
				$operator = str_replace("_", " ", $item->Автор);
				$tracking = $item->НомерОтправления;
				$currentStatus = mb_strtolower($arStatus[0], 'UTF-8');
				$additionalStatus = NULL;
				$statusID = NULL;

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

				if( $statusID !== NULL ){
					$order = Bitrix\Sale\Order::load($id);

					if( $order ){
						$propertyCollection = $order->getPropertyCollection();
						$obAdditionalStatus = $propertyCollection->getItemByOrderPropertyId(25);

						$obTracking = $propertyCollection->getItemByOrderPropertyId(26);
						$obOperator = $propertyCollection->getItemByOrderPropertyId(27);

						$order->setField("STATUS_ID", $statusID);
						$obTracking->setValue($tracking);
						$obOperator->setValue($operator);

						$obAdditionalStatus->setValue($additionalStatus);

						$order->save();
					}else{
						echo "Order №".$id." not found\n";

						file_put_contents( $_SERVER["DOCUMENT_ROOT"]."/1C_exchange/151BE65C.log", "Order №".$id." not found\n\n", FILE_APPEND );	
					}
				}else{
					echo "Order №".$id." has undefined status: ".$currentStatus."\n";

					file_put_contents( $_SERVER["DOCUMENT_ROOT"]."/1C_exchange/151BE65C.log", "Order №".$id." has undefined status: ".$currentStatus."\n\n", FILE_APPEND );
				}
			}
		}
		elseif ( $_GET['type'] === 'ost' )
		{
			if ( file_exists( $file_path ) )
			{
				$row = 1;
				$keys = array();
				if (($handle = fopen($file_path, "r")) !== FALSE) {
				    while (($data = fgets($handle)) !== FALSE) {
				        $data = str_getcsv(str_replace(":::", "#", $data), "#");

				        if( $row == 1 ){
				        	$keys = $data;
				        }else{
				        	$data = array_combine($keys, $data);

				        	$productID = $data["ARTIKUL"];
				        	$weight = $data["VES"];
				        	$quantity = $data["OSTATOK"];
				        	$amount = $data["OSTATOK1"];

				        	updateStore($productID, $weight, $quantity, $amount);

				        	file_put_contents($_SERVER["DOCUMENT_ROOT"]."/1C_exchange/store_log.txt", "$row: ".$data["ARTIKUL"]."\n", FILE_APPEND);
				        }

				        $row++;
				    }
				    fclose($handle);
				}
			}
		}
		//else
		//{
		//	echo 'WTF???' . $_GET['type'] . ' === ' . 'zak';
		//	file_put_contents( '151BE65C.log', 'WTF???' . $_GET['type'] . ' === ' . 'zak', FILE_APPEND );
		//}
	// }
	// else
	// {
	// 	echo 'Ошибка записи файла' . $file_path. "\n";
	// 	file_put_contents( $_SERVER["DOCUMENT_ROOT"]."/1C_exchange/151BE65C.log", 'Ошибка записи файла' . $file_path . "\n\n", FILE_APPEND );
	// }


// }
/* 


if ( empty( $_FILES ) )
{
	echo 'Файлы не получены';
}
else
{

	foreach( $_FILES as $fkey => $item )
	{
		foreach ($_FILES[$fkey]["error"] as $key => $error) {
			if ($error == UPLOAD_ERR_OK) {
				$tmp_name = $_FILES[$fkey]["tmp_name"][$key];
				$name = $_FILES[$fkey]["name"][$key];
				move_uploaded_file($tmp_name, "xml_upload/$name");
			}
			else
			{
				echo 'Файл с полем ' . $key . ' не удалось загрузить - код ' . $error;
			}
		}
	}
	echo 'Файлы получены и занесены в лог';
}


echo "\n";

if ( empty( $_POST ) )
{
	echo 'POST данные не передавались';
}
else
{
	echo 'POST данные получены и занесены в лог';
} */