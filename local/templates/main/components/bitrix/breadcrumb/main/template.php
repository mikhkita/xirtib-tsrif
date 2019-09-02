<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
// print_r($arResult);
// die();

if(empty($arResult))
	return "";

// if( $GLOBALS["isWholesale"] ){
// 	foreach ($arResult as $i => $arItem) {
// 		if( $i == 0 ){
// 			$arResult[$i]["TITLE"] = "ОПТ";
// 			$arResult[$i]["LINK"] = "/wholesale/";
// 		}else{
// 			$arResult[$i]["LINK"] = detailPageUrl($arItem["LINK"]);
// 		}
// 	}
// }

// if( $GLOBALS["isSale"] ){
// 	foreach ($arResult as $i => $arItem) {
// 		if( $i == 0 ){
// 			$arResult[$i]["TITLE"] = "Распродажа";
// 			$arResult[$i]["LINK"] = "/sale/";
// 		}else{
// 			$arResult[$i]["LINK"] = detailPageUrl($arItem["LINK"]);
// 		}
// 	}
// }

$strReturn = '';

$strReturn .= '<div class="b-breadcrumbs"><div class="b-block"><a href="/" class="icon-home"></a>';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);

	$nextRef = ($index < $itemSize-2 && $arResult[$index+1]["LINK"] <> ""? ' itemref="bx_breadcrumb_'.($index+1).'"' : '');
	$child = ($index > 0? ' itemprop="child"' : '');

	if($arResult[$index]["LINK"] <> "" && ($index != $itemSize - 1 || $tog) )
	{
		$strReturn .= '<a href="'.$arResult[$index]["LINK"].'">'.$title.'</a>';
	}
	else
	{
		$strReturn .= '<a href="#" onclick="return false;">'.$title.'</a>';
	}
}

$strReturn .= '</div></div>';

return $strReturn;
