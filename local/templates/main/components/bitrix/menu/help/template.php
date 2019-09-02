<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
	<ul>
		<?foreach($arResult as $i => $arItem):?>
			<li><a href="<?=$arItem["LINK"]?>"<?if($arItem["SELECTED"]):?> class="active"<?endif;?>><?=$arItem["TEXT"]?></a></li>
		<?endforeach;?>
	</ul>
<?endif?>