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
	<div class="b-works-list pagination-list">
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<? if ($arItem["PREVIEW_PICTURE"]) {
				$renderImage = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], Array("width" => 267, "height" => 189), BX_RESIZE_IMAGE_PROPORTIONAL, false, $arFilters ); 
			} else {
				$renderImage['src'] = "".SITE_TEMPLATE_PATH."/i/certificate.jpg";
			} 
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<div class="b-works-item-container">
				<a href="<?=$arItem["DETAIL_PAGE_URL"];?>" class="b-works-item">
					<? if(is_array($arItem["PROPERTIES"]["PHOTOS"]["VALUE"])): ?>
						<?$renderImage = CFile::ResizeImageGet($arItem["PROPERTIES"]["PHOTOS"]["VALUE"][0], Array("width" => 534, "height" => 534), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false, $arFilters ); ?>
					<? else: ?>
						<?=$renderImage['src'] = SITE_TEMPLATE_PATH.'/i/works-4.jpg'; ?>
					<? endif; ?>
					<div class="b-works-back" style="background-image:url('<?=$renderImage['src']?>');"></div>
					<div class="b-works-back-gradient"></div>
					<div class="b-works-item-icons">
						<div class="b-works-item-icon icon-photo">
							<? echo $photos = is_array($arItem["PROPERTIES"]["PHOTOS"]["VALUE"]) ? count($arItem["PROPERTIES"]["PHOTOS"]["VALUE"]) : '0';  ?>
						</div>
						<div class="b-works-item-icon icon-works-like">
							<? echo $likes = is_array($arItem["PROPERTIES"]["LIKES"]["VALUE"]) ? count($arItem["PROPERTIES"]["LIKES"]["VALUE"]) : '0'?>
						</div>
						<div class="b-works-item-icon icon-comment">
							<? 
								$arFilter = Array("IBLOCK_ID"=>12, "ACTIVE"=>"Y", "PROPERTY_WORK_ID" => $arItem['ID']);
								echo $commentCount = CIBlockElement::GetList(Array(), $arFilter, array(), Array("nPageSize"=>50), array());
							?>
						</div>
					</div>
				</a>
				<div class="b-work-name"><?=$arItem['NAME']?></div>
			</div>
		<? endforeach; ?>
		<? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
			<div class="b-load-more-container">
			<?=$arResult["NAV_STRING"];?>
			</div>
		<?endif;?>
	</div>
<? else: ?>
	<p>У вас ещё нет загруженных работ</p>
<? endif; ?>