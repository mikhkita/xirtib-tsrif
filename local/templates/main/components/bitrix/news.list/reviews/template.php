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
	<div class="b-review-list">
		<?foreach($arResult["ITEMS"] as $arItem):

			$rsUser = CUser::GetByID($arItem['CODE']);
			$arUser = $rsUser->Fetch();

			if ($arUser["PERSONAL_PHOTO"]) {
				$renderImage = CFile::ResizeImageGet($arUser["PERSONAL_PHOTO"], Array("width" => 85, "height" => 85), BX_RESIZE_IMAGE_EXACT, false, $arFilters );
			} else {
				$renderImage['src'] = SITE_TEMPLATE_PATH.'/i/icon-man.svg';
			}

			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>

			<div class="b-comment-item clearfix parrent-comment">
				<div class="b-comment-author-photo" style="background-image: url('<?=$renderImage['src']?>');"></div>
				<div class="b-comment-body clearfix">
					<div class="b-comment-author-name"><?=$arItem['NAME']?></div>
					<div class="b-comment-text"><?=$arItem['PREVIEW_TEXT']?></div>
				</div>
			</div>
		<?endforeach;?>
	</div>
	<? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
		<div class="b-load-more-container">
			<?=$arResult["NAV_STRING"];?>
		</div>
	<?endif;?>
<? endif; ?>