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
<?if( count($arResult["SECTIONS"]) ): ?>
<div class="b-category wave-bottom">
	<div class="b-block">
		<div class="b-category-list">
			<?foreach($arResult["SECTIONS"] as $key => $arItem):?>
				<?
				$arFilter = array('SECTION_ID' => intval($arItem['ID'])); // выберет потомков без учета активности
				$rsSect = CIBlockSection::GetList(array('left_margin' => 'asc'),$arFilter);
				$arSect = array();
				while ($arSect[] = $rsSect->GetNext()):
				endwhile;
				$isEmpty = 'empty-item';
				if (count($arSect) > 1) {
				 	$isEmpty = '';
				} 
				?>
					<div class="b-catalog-item b-category-item">
					<? if($arItem['PICTURE']['SRC']): ?>
						<? $renderImage = CFile::ResizeImageGet($arItem['PICTURE'], Array("width" => 267, "height" => 178), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false, $arFilters ); ?>
						<a href="<?=detailPageUrl($arItem["SECTION_PAGE_URL"])?>" class="b-catalog-img" style="background-image:url('<?=$renderImage['src']?>');"></a>
					<? else: ?>
						<a href="<?=detailPageUrl($arItem["SECTION_PAGE_URL"])?>" class="b-catalog-img" style="background-image:url('<?=SITE_TEMPLATE_PATH?>/i/about-img.jpg');"></a>
					<? endif; ?>
					<div class="b-catalog-item-top <?=$isEmpty?>">
						<div class="b-category-item-back"></div>
						<div class="b-category-item-outer">
							<h6><a href="<?=detailPageUrl($arItem["SECTION_PAGE_URL"])?>"><?=$arItem['NAME']?></a></h6>
							<p class="b-category-count icon-tick">(<?=count($arSect)-1?>)</p>
						</div>
						<div class="b-category-item-inner">
							<ul>
								<?foreach ($arSect as $section):?>
									<li><a href="<?=detailPageUrl($section["SECTION_PAGE_URL"])?>"><?=$section['NAME']?></a></li>
								<?endforeach;?>
							</ul>
						</div>
					</div>
				</div>
			<?endforeach;?>
		</div>
	</div>	
</div>
<? endif; ?>