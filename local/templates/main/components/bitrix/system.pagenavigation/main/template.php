<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if(!$arResult["NavShowAlways"])
{
	if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false))
		return;
}
?>

<?
$strNavQueryString = ($arResult["NavQueryString"] != "" ? $arResult["NavQueryString"]."&amp;" : "");
$strNavQueryStringFull = ($arResult["NavQueryString"] != "" ? "?".$arResult["NavQueryString"] : "");
?>

<?if( ($arResult["NavPageNomer"] < $arResult["NavPageCount"]) && (!$GLOBALS["isPersonal"])):?>

	<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>" class="b-load-more b-load-more-works icon-load">
		<p class="pink dashed">Загрузить еще</p>
	</a>
	
<? endif; ?>

<div class="b-pagination">
	<? if($arResult["NavPageNomer"] != 1): ?>
	<a class="pagination-arrow arrow-back icon-arrow" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>"></a>
	<? endif; ?>
	<div class="b-pagination-container">
		<? do{ ?>
		<? if ($arResult["nStartPage"] == $arResult["NavPageNomer"]): ?>
		<span class="b-pagination-item active"><?=$arResult["nStartPage"]?></span>
		<? elseif($arResult["nStartPage"] == 1 && $arResult["bSavePage"] == false): ?>
		<a href="<?=$arResult["sUrlPath"]?><?=$strNavQueryStringFull?>" class="b-pagination-item"><?=$arResult["nStartPage"]?></a>
		<? else: ?>
		<a href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=$arResult["nStartPage"]?>" class="b-pagination-item"><?=$arResult["nStartPage"]?></a>
		<? endif; ?>
			<? $arResult["nStartPage"]++; ?>
			<? $bFirst = false; ?>
		<? } while($arResult["nStartPage"] <= $arResult["nEndPage"]); ?>
	</div>
	<? if( $arResult["NavPageNomer"] < $arResult["NavPageCount"] ): ?>
	<a class="pagination-arrow arrow-next icon-arrow" href="<?=$arResult["sUrlPath"]?>?<?=$strNavQueryString?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>"></a>
	<? endif; ?>
</div>