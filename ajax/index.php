<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
// use Bitrix\Sale;

\Bitrix\Main\Data\StaticHtmlCache::getInstance()->markNonCacheable();

$GLOBALS['APPLICATION']->RestartBuffer();

$action = (isset($_GET["action"]))?$_GET["action"]:NULL;
$action = (isset($_GET["actions"]))?$_GET["actions"]:$action;
$review_id = (isset($_GET["review_id"]))?$_GET["review_id"]:NULL;
$product_id = (isset($_GET["product_id"]))?$_GET["product_id"]:NULL;
$isBasket = isset($_GET["basket"]);
$hashKey = 481516;

switch ($action) {
	case 'BUY':
	case 'ADD2BASKET':
		$productId = $_GET["ELEMENT_ID"];
		$quantity = (isset($_GET["quantity"]))?$_GET["quantity"]:1;

		if (CModule::IncludeModule("catalog")){
		    if (($action == "ADD2BASKET" || $action == "BUY")){
		        Add2BasketByProductID(
	                $productId,
	                $quantity
	            );
		    }
		}
			
		$result = getBasketCount();

		if( isset($_GET["gift"]) ){
			$result["action"] = "reload";
		}

		returnSuccess( $result );

		break;

	case 'FAVOURITE_REMOVE':
		if( intval($_REQUEST['ID']) > 0 ){
	    	$itemID = intval($_REQUEST['ID']);

	    	if( empty($itemID) ){
	    		die("param ID not found");
	    	}
	    	               
	    	if( $USER->IsAuthorized() ){
	    		$idUser = $USER->GetID();
	    		$rsUser = CUser::GetByID($idUser);
	    		$arUser = $rsUser->Fetch();
	    		$arElements = unserialize($arUser['UF_FAVOURITE']);
	    		$arElements[ $itemID ] = "N";

	    		if( $USER->Update($idUser, Array("UF_FAVOURITE" => serialize($arElements))) ){
	    			returnSuccess();
	    		}else{
					returnError("Ошибка удаления товара из избранного");
	    		}
	    	}      
	   	}
		break;

	case 'REMOVE':
		if( !isset($_GET["ELEMENT_ID"]) ){
			returnError("Не указан ID товара");
		}
		$productId = $_GET["ELEMENT_ID"];

		//Получение корзины текущего пользователя
		$basket = \Bitrix\Sale\Basket::loadItemsForFUser(
		   \Bitrix\Sale\Fuser::getId(), 
		   \Bitrix\Main\Context::getCurrent()->getSite()
		);

		// Получение товара корзины по ID товара
		if( !$basket->getItemById($productId)->delete() ){
			returnError("Не найден товар с ID равным ".$productId);
		}	

		//Сохранение изменений
		if( $basket->save() ){
			$result = "error";
			returnSuccess(array(
				"sum" => number_format( getBasketSum(), 0, ',', ' ' )
			));
		}else{
			returnError("Ошибка сохранения товара");
		}
		break;

	case 'QUANTITY':
		// sleep(rand(1, 3));

		if( !isset($_GET["ELEMENT_ID"]) ){
			returnError("Не указан ID товара");
		}
		if( !isset($_GET["QUANTITY"]) ){
			returnError("Неверно передно количество");
		}
		$productId = $_GET["ELEMENT_ID"];
		$quantity = $_GET["QUANTITY"];

		//Получение корзины текущего пользователя
		$basket = \Bitrix\Sale\Basket::loadItemsForFUser(
		   \Bitrix\Sale\Fuser::getId(), 
		   \Bitrix\Main\Context::getCurrent()->getSite()
		);

		foreach ($basket as $basketItem) {
		    if( $basketItem->getProductId() == $productId ){
		    	if( intval($quantity) == 0 ){
		    		if( $basketItem->delete() && $basket->save() ){
		    			$basketInfo = getBasketCount();
		    			returnSuccess(array(
							"id" => $productId,
							"quantity" => 0,
							"count" => $basketInfo["count"],
							"sum" => $basketInfo["sum"],
						));
		    		}else{
		    			returnError("Ошибка удаления товара из корзины");
		    		}
		    	}else{
		    		$basketItem->setField("QUANTITY", $quantity);

			    	// Сохранение изменений
			    	if( $basketItem->save() ){
			    		$basketInfo = getBasketCount();
			    		returnSuccess(array(
							"id" => $productId,
							"quantity" => intval($basketItem->getField("QUANTITY")),
							"count" => $basketInfo["count"],
							"sum" => $basketInfo["sum"],
						));
			    	}else{
			    		returnError("Не удалось сохранить товар");
			    	}
		    	}
		    }
		}

		if (CModule::IncludeModule("catalog")){
	        Add2BasketByProductID(
                $productId,
                $quantity
            );

	        $basketInfo = getBasketCount();
            returnSuccess(array(
				"id" => $productId,
				"quantity" => $quantity,
				"count" => $basketInfo["count"],
				"sum" => $basketInfo["sum"],
			));
		}

		returnError("Не найден товар с ID равным ".$productId);

		break;
	case 'ADDREVIEW':

		if (empty($_POST["MAIL"])){
			if (empty($_POST['comment'])) {
				$spam = true;
			} else {
				$spam = false;
			}
		}else{
			$spam = true;
		}

		if (!$spam) {
			CModule::IncludeModule("iblock");
			$el = new CIBlockElement;

			$PROP = array();

			$PROP["EMAIL"]['VALUE'] = $_POST["email"];
			$PROP["PHONE"]['VALUE'] = $_POST["phone"];
			$userID = $USER->GetID()?$USER->GetID():"";

			if (isAuth()) {
				$rsUser = CUser::GetByID($userID);
				$arUser = $rsUser->Fetch();

				$_POST["name"] = $arUser["NAME"];
				$PROP["EMAIL"]['VALUE'] = $arUser["EMAIL"];
				$PROP["PHONE"]['VALUE'] = $arUser["PERSONAL_PHONE"];
			}
			
			if ($product_id) {

				$PROP["PRODUCT_ID"]['VALUE'] = $product_id;
				$PROP["RATING"]['VALUE'] = $_POST["item-quality"];

				$arLoadProductArray = Array(
				  "IBLOCK_ID"      => 2,
				  "PROPERTY_VALUES"=> $PROP,
				  "NAME"           => $_POST["name"],
				  "CODE"		   => $userID,
				  "ACTIVE"         => "N",
				  "PREVIEW_TEXT"   => $_POST['comment'],
				  "DATE_ACTIVE_FROM" => ConvertTimeStamp(time(), "FULL"),
				  "PREVIEW_PICTURE" => CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"]."/upload/tmp/".$_POST["random_filename"])
				);

			} else {

				$PROP["STORE_QUALITY"]['VALUE'] = $_POST["store-quality"];
				$PROP["GOODS_QUALITY"]['VALUE'] = $_POST["goods-quality"];
				$PROP["MANAGER_QUALITY"]['VALUE'] = $_POST["manager-quality"];
				$PROP["PACK_QUALITY"]['VALUE'] = $_POST["pack-quality"];
				$PROP["COURIER_QUALITY"]['VALUE'] = $_POST["courier-quality"];

				// $round = round(($_POST["store-quality"] + $_POST["goods-quality"] + $_POST["manager-quality"] + $_POST["pack-quality"] + $_POST["courier-quality"])/5);

				$arLoadProductArray = Array(
				  "IBLOCK_SECTION_ID" => $review_id,
				  "IBLOCK_ID"      => 3,
				  "PROPERTY_VALUES"=> $PROP,
				  "NAME"           => $_POST["name"],
				  "CODE"		   => $userID,
				  "ACTIVE"         => "N",
				  "PREVIEW_TEXT"   => $_POST['comment'],
				  "DATE_ACTIVE_FROM" => ConvertTimeStamp(time(), "FULL")
				);

			}

			if (isAuth()) {
				$arLoadProductArray['MODIFIED_BY'] = $USER->GetID();
				$arLoadProductArray['NAME'] = $USER->GetFullName();
			}
			
			if ($id = $el->Add($arLoadProductArray)) {

				if ($product_id) {
					$href = "https://www.nevkusno.ru/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=2&type=content&ID=".$id."&lang=ru&find_section_section=-1&WF=Y";
				} else {
					$href = "https://www.nevkusno.ru/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=3&type=content&ID=".$id."&lang=ru&find_section_section=".$review_id ."&WF=Y";
				}

				$message = "";
				$name = isAuth()?$USER->GetFullName():$_POST["name"];
				$email = isAuth()?$USER->GetEmail():$_POST["email"];
				$mark = isset($round)?$round:$_POST["item-quality"];

				$message .= "От кого: ".$name."<br>";
				// $message .= "e-mail: ".$email."<br>";

				if (!isAuth()) {
					$message .= "Номер телефона: ".$_POST["phone"]."<br>";
				}

				$message .= "Отзыв: ".$_POST['comment']."<br>";
				$message .= "Оценка: ".$mark."<br>";
				$message .= "<a href='".$href."'>Ссылка на отзыв</a>";


				if(CEvent::Send("NEW_REVIEW", "s1", array("MESSAGE" => $message))){
					echo "1";
				} else {
					echo "0";
				}
			}
		}else{
			echo "1";
		}

		break;

	case 'ASK':

		if (empty($_POST["MAIL"])){
			if (empty($_POST['ask-name']) || empty($_POST['ask-email']) || empty($_POST['ask-phone'])) {
				$spam = true;
			}
			else {
				$spam = false;
			}
		}else{
			$spam = true;
		}

		if (!$spam) {

			$name = $_POST['ask-name'];
			$email = $_POST['ask-email'];
			$phone = $_POST['ask-phone'];
			$question = $_POST['question'];

			if(CEvent::Send("NEW_ASK", "s1", array('NAME' => $name, 'EMAIL' => $email, 'PHONE' => $phone, 'QUESTION' => $question,))){
				echo "1";
			} else {
				echo "0";
			}
		}else{
			echo "1";
		}

		break;

	case 'PHONE':

		if (empty($_POST["MAIL"])){
			if (empty($_POST['phone-name']) || empty($_POST['phone-phone'])) {
				$spam = true;
			}
			else {
				$spam = false;
			}
		}else{
			$spam = true;
		}

		if (!$spam) {

			$name = $_POST['phone-name'];
			$phone = $_POST['phone-phone'];

			if(CEvent::Send("NEW_PHONE", "s1", array('NAME' => $name, 'PHONE' => $phone))){
				echo "1";
			} else {
				echo "0";
			}
		}else{
			echo "1";
		}

		break;
	case 'REG':

		if ($_POST["MAIL"] == ""){
			$spam = false;
		} else {
			$spam = true;
		}

		if (!$spam) {

			$filter = Array("EMAIL" => $_POST['email']);
			$rsUser = CUser::GetList(($by="id"), ($order="desc"), $filter);
			$arUser = $rsUser->Fetch();

			if(!$arUser){

				$email = $_POST['email'];
				$password = $_POST['password'];
				$user = new CUser;
				$hash = md5($email.$hashKey);
				
				$link = "https://www.nevkusno.ru/ajax/?action=CONFIRM_USER&email=".$email."&hash=".$hash;

				$arFields = Array(
				  // "NAME"              => "Пользователь",
				  "EMAIL"             => $email,
				  "LOGIN"             => $email,
				  "LID"               => "ru",
				  "ACTIVE"            => "N",
				  "PASSWORD"          => $password,
				  "CONFIRM_PASSWORD"  => $password,
				);

				if ($user->Add($arFields)){
				    if(CEvent::Send("NEW_USER_CONFIRM", "s1", array('EMAIL' => $email, "LINK" => $link))){
						echo "1";
					} else {
						returnError("Ошибка регистрации.");
					}
				}
				else{
				    echo "0";
				}
			} else {
				returnError("Пользователь с таким E-mail уже зарегистрирован.");
			}
		}else{
			echo "0";
		}

		break;
	case 'CONFIRM_USER':

		$email = $_GET['email'];
		$userHash = $_GET['hash'];
		$hash = md5($email.$hashKey);

		if ($userHash == $hash) {

			$filter = Array("EMAIL" => $email);
			$rsUser = CUser::GetList(($by="id"), ($order="desc"), $filter);
			$arUser = $rsUser->Fetch();

			$user = new CUser;
			$fields = Array(
			  "ACTIVE" => "Y",
			);
			
			if ($user->Update($arUser["ID"], $fields)) {
				$USER->Authorize($arUser["ID"]);
			 	LocalRedirect("/personal/");
			} 
			else {
				LocalRedirect("/");
			}

		}	

		break;
	case 'ADD2RESERVE':
		$userID = $USER->GetID()?$USER->GetID():0;

		if ($userID != 0) {

			$arFilter = Array(
				"IBLOCK_ID" => 9,
				"ACTIVE_DATE" => "Y",
				"ACTIVE" => "Y",
				"CODE" => $_REQUEST["id"],
				"PROPERTY_USER_VALUE" => $userID,
			);

			$res = CIBlockElement::GetList(array(), $arFilter, array(), false, array());

			if (isset($res) && $res == 0) {

				$el = new CIBlockElement;

				$PROP["USER"]['VALUE'] = $userID;
				$name = str_replace("_", " ", $_REQUEST["name"]);

				$arLoadProductArray = Array(
				  "IBLOCK_ID"      => 9,
				  "PROPERTY_VALUES"=> $PROP,
				  "NAME"           => $name,
				  "CODE"           => $_REQUEST["id"],
				);

				if($PRODUCT_ID = $el->Add($arLoadProductArray))
				  echo "success";
				else
				  echo "error";
			} else {
				echo "already-reserved";
			}
		}
		break;
	case 'ADDWORK':
		CModule::IncludeModule("iblock");
		$el = new CIBlockElement;

		$PROP = array();
		$arFile = array();

		foreach ($_POST as $key => $value) {
			if(substr($key, 0, 4) == "work"){
				array_push($arFile, array("VALUE" => CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"].'/upload/tmp/'.$value),"DESCRIPTION"=>""));
			}
		}


		$ENUM_ID = '292'; // id значения свойства(Y)
		$PROP["PHOTOS"] = $arFile;
		$PROP["AUTHOR"]["VALUE"] = $USER->GetID();
		if ($_POST['no-comment'] == "on") {
			$PROP["DISALLOW_COMMENTS"] = array("VALUE" => $ENUM_ID);
		}

		$arParams = array("replace_space"=>"-","replace_other"=>"-");
		$name = Cutil::translit($_POST["work-name"],"ru",$arParams);

		$arLoadProductArray = Array(
		  "MODIFIED_BY"    => $USER->GetID(),
		  "IBLOCK_ID"      => 11,
		  "PROPERTY_VALUES"=> $PROP,
		  "NAME"           => $_POST["work-name"],
		  "CODE"		   => $name,
		  "ACTIVE"         => "Y",
		  "PREVIEW_TEXT"   => $_POST['text'],
		  "DATE_ACTIVE_FROM" => ConvertTimeStamp(time(), "FULL")
		);

		echo $out = ($el->Add($arLoadProductArray)) ? '1' : '0';
		
		break;
	case 'ADDLIKETOWORK':
		CModule::IncludeModule("iblock");
		$el = new CIBlockElement;

		$PROP = array();
		$isLikedBefore = false;
		$userID = $USER->GetID();

	    $res = CIBlockElement::GetProperty(11, $_GET['id'], "sort", "asc", array("CODE" => "LIKES"));
	    while ($ob = $res->GetNext())
	    {	
	        if ($ob['VALUE'] != $userID) {
	        	$PROP['LIKES'][] = $ob['VALUE'];
	        } else {
	        	$isLikedBefore = true;
	        }
	    }

	    if (!$isLikedBefore) {
	    	array_push($PROP['LIKES'], intval($userID)) ;
	    }

		$arLoadProductArray = Array(
		  "PROPERTY_VALUES"=> $PROP,
		);

		if($el->Update($_GET['id'], $arLoadProductArray)){
			echo count($PROP['LIKES']);
		}
		break;
	case 'ADDLIKETOCOMMENT':
		CModule::IncludeModule("iblock");
		$el = new CIBlockElement;

		$PROP = array();
		$isLikedBefore = false;
		$isDislikedBefore = false;
		$userID = $USER->GetID();
		$mark = $_GET['mark'];

		$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_*");
		$arFilter = Array("ID"=>$_GET['id'], "IBLOCK_ID"=>12);
		$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
		while($ob = $res->GetNextElement())
		{
			$item = $ob->GetProperties();
		}

		if (is_array($item['LIKES']['VALUE'])){
			foreach ($item['LIKES']['VALUE'] as $key => $user) {
				if ($user == $userID) {
		        	$isLikedBefore = true;
		        }
			}
		} 

		if (is_array($item['DISLIKES']['VALUE'])){
			foreach ($item['DISLIKES']['VALUE'] as $key => $user) {
				if ($user == $userID) {
		        	$isDislikedBefore = true;
		        }
			}
		} 

		if (!$isLikedBefore && !$isDislikedBefore) {
			$item[$mark]['VALUE'][] = $userID;
	    	// var_dump("1");
	    } elseif (!$isLikedBefore && $isDislikedBefore && $mark == "LIKES") {
	    	$item['LIKES']['VALUE'][] = $userID;
	    	foreach ($item['DISLIKES']['VALUE'] as $key => $value) {
	    		if ($value == $userID) {
	    			array_splice($item['DISLIKES']['VALUE'], $key, 1);
	    		}
	    	}
	    	// var_dump("2");
	    } elseif($isLikedBefore && !$isDislikedBefore && $mark == "DISLIKES") {
	    	$item['DISLIKES']['VALUE'][] = $userID;
	    	foreach ($item['LIKES']['VALUE'] as $key => $value) {
	    		if ($value == $userID) {
	    			array_splice($item['LIKES']['VALUE'], $key, 1);
	    		}
	    	}
	    	array_splice($item['LIKES']['VALUE'], $userID, 1);
	    	// var_dump("3");
	    } elseif ($isLikedBefore && !$isDislikedBefore && $mark == "LIKES") {
	    	foreach ($item['LIKES']['VALUE'] as $key => $value) {
	    		if ($value == $userID) {
	    			array_splice($item['LIKES']['VALUE'], $key, 1);
	    		}
	    	}
	    	// var_dump('4');
	    } elseif (!$isLikedBefore && $isDislikedBefore && $mark == "DISLIKES") {
	    	foreach ($item['DISLIKES']['VALUE'] as $key => $value) {
	    		if ($value == $userID) {
	    			array_splice($item['DISLIKES']['VALUE'], $key, 1);
	    		}
	    	}
	    	// var_dump('5');
	    }

	 //    var_dump('isLikedBefore');
	 //    var_dump($isLikedBefore);
		// var_dump('isDislikedBefore');
		// var_dump($isDislikedBefore);

	 //    var_dump("dislikes");
	 //    var_dump($item['DISLIKES']['VALUE']);
	 //    var_dump("likes");
	 //    var_dump($item['LIKES']['VALUE']);

	    if(count($item['LIKES']['VALUE']) == 0){
	    	$item['LIKES']['VALUE'] = false;
	    }
	    if(count($item['DISLIKES']['VALUE']) == 0){
	    	$item['DISLIKES']['VALUE'] = false;
	    }

	    CIBlockElement::SetPropertyValuesEx($_GET['id'], false, array("LIKES" => $item['LIKES']['VALUE'], 'DISLIKES' => $item['DISLIKES']['VALUE']));

		break;
	case 'ADDCOMMENT':
		CModule::IncludeModule("iblock");
		$el = new CIBlockElement;

		$PROP = array();
		$userID = $USER->GetID();
		$PROP['WORK_ID'] = $_POST['id'];
		$PROP['USER_ID'] = $userID;
		$PROP['PARENT_COMMENT'] = $_POST['parent_comment'];

		$arLoadProductArray = Array(
		  "IBLOCK_ID"      => 12,
		  "PROPERTY_VALUES"=> $PROP,
		  "NAME"           => $_POST["comment_textarea"],
		  "ACTIVE"         => "Y",
		  "DATE_ACTIVE_FROM" => ConvertTimeStamp(time(), "FULL")
		);

		echo $out = $el->Add($arLoadProductArray) ? '1' : '0';

		break;
	case 'ADDEMAIL':

		if (empty($_POST["MAIL"])){
			if (empty($_POST['email'])) {
				$spam = true;
			} else {
				$spam = false;
			}
		}else{
			$spam = true;
		}

		if (!$spam) {

			$res = CIBlockElement::GetList(Array(), array("IBLOCK_ID"=> 14, 'NAME' => $_POST['email']), array(), array("nPageSize"=>50), array());

			if ($res == 0) {
				CModule::IncludeModule("iblock");
				$el = new CIBlockElement;

				$arLoadProductArray = Array(
				  "IBLOCK_ID"      => 14,
				  "NAME"           => $_POST["email"],
				  "ACTIVE"         => "Y",
				  "DATE_ACTIVE_FROM" => ConvertTimeStamp(time(), "FULL")
				);

				echo $out = $el->Add($arLoadProductArray) ? '1' : '0';
			} else {
				returnError('Такой e-mail уже подписан на рассылку');
			}
		} else {
			echo '1';
		}

		break;
	case 'ADDQUESTION':

		if (empty($_POST["MAIL"])){
			if (empty($_POST['question'])) {
				$spam = true;
			} else {
				$spam = false;
			}
		}else{
			$spam = true;
		}

		if (!$spam) {

			$PROP = array();

			$PROP['PHONE'] = $_POST['phone'];
			$PROP['EMAIL'] = $_POST['email'];
			$PROP['USER'] = $userID = $USER->GetID();

			if (isset($userID) && !empty($userID)) {
				
				$rsUser = CUser::GetByID($userID);
				$arUser = $rsUser->Fetch();	

				if (empty($_POST['name']) || (!isset($_POST['name']))) {
					$_POST['name'] = $arUser["NAME"];
				}

				if (empty($PROP['EMAIL']) || (!isset($PROP['EMAIL']))) {
					$PROP['EMAIL'] = $arUser["EMAIL"];
				}
				
				if (empty($PROP['PHONE']) || (!isset($PROP['PHONE']))) {
					$PROP['PHONE'] = $arUser["PERSONAL_PHONE"];
				}

			}

			CModule::IncludeModule("iblock");
			$el = new CIBlockElement;

			$arLoadProductArray = Array(
			  "IBLOCK_ID"        => 16,
			  "NAME"             => $_POST["name"],
			  "PREVIEW_TEXT"     => $_POST["question"],
			  "PROPERTY_VALUES"  => $PROP,
			  "ACTIVE"           => "N",
			  "DATE_ACTIVE_FROM" => ConvertTimeStamp(time(), "FULL")
			);

			echo $out = $el->Add($arLoadProductArray) ? '1' : '0';

		} else {
			echo '1';
		}

		break;
	default:
		break;
}
die();

function returnError( $text ){
	echo json_encode(array(
		"result" => "error",
		"error" => $text
	));
	die();
}

function returnSuccess( $array = array() ){
	$arResult = array(
		"result" => "success"
	);
	$arResult = $arResult + $array;

	echo json_encode($arResult);
	die();
}

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>