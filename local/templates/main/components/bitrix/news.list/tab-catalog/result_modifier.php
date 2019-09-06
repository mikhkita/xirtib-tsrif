<? 	
	$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_*");
	$arFilter = Array("IBLOCK_ID"=>7, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "PROPERTY_WORK_ID" => $arResult['ITEMS'][0]["PROPERTIES"]["WORK_ID"]["VALUE"], "!PROPERTY_PARENT_COMMENT" => false,);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
	$i = 0;
	while($ob = $res->GetNextElement())
	{
		$childs[$i] = $ob->GetFields();
		$childs[$i] += $ob->GetProperties();
		$i++;
	}

	foreach ($arResult['ITEMS'] as $key => $arItem) {
		foreach($childs as $child){
			if ($arItem['ID'] == $child["PARENT_COMMENT"]["VALUE"]) { 
				$arResult['ITEMS'][$key]['CHILDS'][] = $child;
			}
		}
	}
?>
