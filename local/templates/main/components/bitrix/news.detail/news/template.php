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

<? if ($arResult): ?>
	<? $arDate = explode('.', $arResult['CREATED_DATE']); ?>
	<? $date = $arDate[2].'.'.$arDate[1].'.'.$arDate[0]; ?>
	<div class="news-more-article">
		<div class="news-more-date"><?=$date?></div>
		<div class="article-text b-text"><?=$arResult['DETAIL_TEXT']?></div>
	</div>
<? endif; ?>