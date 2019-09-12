<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);?>

<? if(count($arResult["ITEMS"])): ?>
	<div class="b-news-list b-stock-list">
		<?foreach($arResult["ITEMS"] as $arItem):

		if ($arItem["PREVIEW_PICTURE"]) {
			$renderImage = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], Array("width" => 267, "height" => 189), BX_RESIZE_IMAGE_PROPORTIONAL, false, $arFilters ); 
		} else {
			$renderImage['src'] = "".SITE_TEMPLATE_PATH."/i/logo.svg";
		}

		if (isset($arItem["ACTIVE_TO"])) {
			$arDate = explode('.', $arItem["ACTIVE_TO"]);
			$arItem["ACTIVE_TO"] = 'Акция действует до '.$arDate[0].' '.getRusMonth($arDate[1]);
		}

		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>

		<div class="b-news-item">
			<div class="b-news-item-left">
				<div class="b-news-item-img" style="background-image: url('<?=$renderImage["src"]?>');"></div>
			</div>
			<div class="b-news-item-right">
				<div class="b-news-item-head"><?=$arItem['NAME']?></div>
				<div class="b-news-item-date pink"><?=$arItem["ACTIVE_TO"]?></div>
				<div class="b-news-item-text"><?=$arItem["PREVIEW_TEXT"]?></div>
			</div>
		</div>
		<?endforeach;?>
	</div>
<? endif; ?>