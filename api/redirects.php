<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");

$arFilter = Array('IBLOCK_ID'=>1, 'GLOBAL_ACTIVE'=>'Y');
$db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter, true);
// $db_list->NavStart(20);
// echo $db_list->NavPrint($arIBTYPE["SECTION_NAME"]);
while($arSection = $db_list->GetNext()) {
	// vardump($arSection);
	echo "Redirect 301 /cat/".$arSection["ID"]." ".$arSection["SECTION_PAGE_URL"]."<br>";
}
// echo $db_list->NavPrint($arIBTYPE["SECTION_NAME"]);

?>