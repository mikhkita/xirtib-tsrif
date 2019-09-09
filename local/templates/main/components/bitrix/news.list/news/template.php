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
$this->setFrameMode(true);

?>

<? $curPage = $APPLICATION->GetCurPage(); ?>
<? $isMain = ( $curPage == "/" )?true:false; ?>

<? if(count($arResult["ITEMS"])): ?>
	<? if( $isMain ): ?>
		<div class="b-news-preview wave-top wave-bottom">
			<div class="b-block">
				<div class="b-big-tabs clearfix">
					<h2>Новости магазина</h2>
					<a href="/news" class="underline icon-arrow">Смотреть все</a>
				</div>
				<div class="b-news-list">
					<?foreach($arResult["ITEMS"] as $arItem):?>

					<? if ($arItem["PREVIEW_PICTURE"]) {
						$renderImage = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], Array("width" => 267, "height" => 189), BX_RESIZE_IMAGE_PROPORTIONAL, false, $arFilters ); 
					} else {
						$renderImage['src'] = "".SITE_TEMPLATE_PATH."/i/certificate.jpg";
					} ?>
					<?
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					?>
					<div class="b-news-item">
						<div class="b-news-img">
							<img src="<?=$renderImage["src"]?>">
						</div>
						<div class="b-news-item-text">
							<p class="date"><?=$arItem["ACTIVE_FROM"]?></p>
							<h6><?=$arItem['NAME']?></h6>
							<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="icon-arrow pink">Подробнее</a>
						</div>
					</div>
					<?endforeach;?>
				</div>
			</div>
		</div>
	<? else: ?>
		<div class="b-news-list">
			<?foreach($arResult["ITEMS"] as $arItem):?>

			<? if ($arItem["PREVIEW_PICTURE"]) {
				$renderImage = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], Array("width" => 267, "height" => 189), BX_RESIZE_IMAGE_PROPORTIONAL, false, $arFilters ); 
			} else {
				$renderImage['src'] = "".SITE_TEMPLATE_PATH."/i/certificate.jpg";
			}

			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<div class="b-news-item">
				<div class="b-news-item-left">
					<div class="b-news-item-img" style="background-image: url('<?=$renderImage["src"]?>');"></div>
					<?/*?>
					<div class="b-news-item-soc-container">
						<a href="#" class="b-news-item-soc-item icon-vk"></a>
						<a href="#" class="b-news-item-soc-item icon-instagram"></a>
						<a href="#" class="b-news-item-soc-item icon-twitter"></a>
						<a href="#" class="b-news-item-soc-item icon-facebook"></a>
					</div>
					<?*/?>
				</div>
				<div class="b-news-item-right">
					<div class="b-news-item-head"><?=$arItem['NAME']?></div>
					<div class="b-news-item-date"><?=$arItem["ACTIVE_FROM"]?></div>
					<div class="b-news-item-text"><?=$arItem["PREVIEW_TEXT"]?></div>
					<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="b-news-detail-link dashed">Читать далее</a>
				</div>
			</div>
			<?endforeach;?>
		</div>
	<? endif; ?>
<? endif; ?>