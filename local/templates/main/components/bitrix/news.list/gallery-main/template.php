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
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<div class="b-1-by-3-item">
			<? if(is_array($arItem["PROPERTIES"]["PHOTOS"]["VALUE"])): ?>
				<?$renderImage = CFile::ResizeImageGet($arItem["PROPERTIES"]["PHOTOS"]["VALUE"][0], Array("width" => 534, "height" => 534), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false, $arFilters ); ?>
			<? else: ?>
				<? $renderImage['src'] = SITE_TEMPLATE_PATH.'/i/works-4.jpg'; ?>
			<? endif; ?>
			<a href="<?=$arItem['DETAIL_PAGE_URL'];?>" class="gallery-preview-img" style="background-image:url('<?=$renderImage['src']?>');"></a>
			<?if (isAuth()):?>
				<?if (is_array($arItem["PROPERTIES"]["LIKES"]["VALUE"])):?>
					<?$userID = $USER->GetID();?>
					<?$active = '';?>
					<? foreach ($arItem["PROPERTIES"]["LIKES"]["VALUE"] as $key => $value): ?>
					 	<?if ($value == $userID):?>
					 		<?$active = 'active';?>
					 	<?endif;?>
					<? endforeach; ?>
					<a href="/ajax/?action=ADDLIKETOWORK&id=<?=$arItem['ID']?>" class="b-like icon-like <?=$active?>"><?=count($arItem["PROPERTIES"]["LIKES"]["VALUE"])?></a>
				<?else:?>
					<a href="/ajax/?action=ADDLIKETOWORK&id=<?=$arItem['ID']?>" class="b-like icon-like">0</a>
				<?endif;?>
			<?else:?>
				<div class="b-like icon-like active"><?=count($arItem["PROPERTIES"]["LIKES"]["VALUE"])?></div>
			<?endif;?>
			<?/*?><div class="b-like icon-like">
				<? echo $likes = is_array($arItem["PROPERTIES"]["LIKES"]["VALUE"]) ? count($arItem["PROPERTIES"]["LIKES"]["VALUE"]) : '0'?>
			</div><?*/?>
		</div>
	<?endforeach;?>
<? endif; ?>