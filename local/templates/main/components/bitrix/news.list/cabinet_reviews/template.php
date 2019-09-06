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
		<?foreach($arResult["ITEMS"] as $arItem):?>

			<? $res = CIBlockElement::GetByID($arItem['PROPERTIES']['PRODUCT_ID']['VALUE']);
			if($ar_res = $res->GetNext()){
				$arItem['DETAIL_PAGE_URL'] = $ar_res['DETAIL_PAGE_URL'];
			} ?>

			<div class="myreviews-item">
				<div class="myreview-text"><?=$arItem['PREVIEW_TEXT']?></div>
				<div class="myreview-bottom">
					<div class="myreview-bottom-left">
						<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="dashed">Посмотреть на странице</a>
					</div>
				</div>
			</div>
		<?endforeach;?>
	</div>
	<? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
		<div class="b-load-more-container">
			<?=$arResult["NAV_STRING"];?>
		</div>
	<?endif;?>
<? else: ?>
	<p>Вы ещё не оставили ни одного отзыва</p>
<? endif; ?>