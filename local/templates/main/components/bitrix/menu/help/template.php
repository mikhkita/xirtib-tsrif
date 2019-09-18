<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
	<? if (!$arParams['WITHOUT_BTN']): ?>
		<a href="#" id="catalog-menu-btn" class="category-btn">Меню</a>
	<? endif; ?>
	<ul>
		<?foreach($arResult as $i => $arItem):?>
			<li><a href="<?=$arItem["LINK"]?>"<?if($arItem["SELECTED"]):?> class="active"<?endif;?>><?=$arItem["TEXT"]?></a></li>
		<?endforeach;?>
	</ul>
<?endif?>