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
	<div class="b-catalog-list">
		<? foreach ($arResult["PRESENT_ITEMS"] as $key => $item): ?>
			<a href="<?=$item['DETAIL_PAGE_URL']?>" class="b-catalog-item b-present-item">
				<div class="b-catalog-back"></div>
				<div class="b-catalog-img" style="background-image:url('<?=$item['IMG']?>');"></div>
				<div class="b-catalog-item-top">
					<? if (isset($item['ACTIVE_TO_DAY']) && isset($item['ACTIVE_TO_MONTH'])): ?>
						<p class="red-text">Акция действует до <?=$item['ACTIVE_TO_DAY']?> <?=$item['ACTIVE_TO_MONTH']?></p>
					<? endif; ?>
					<h6><?=$item['NAME']?></h6>
					<p>При покупке от <?=convertPrice($item['PRICE'])?> рублей</p>
				</div>
			</a>
		<? endforeach; ?>
	</div>
<? endif; ?>