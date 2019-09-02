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

$arFilters = Array(
    array("name" => "watermark", "position" => "center", "size"=>"resize", "coefficient" => 0.9, "alpha_level" => 29, "file" => $_SERVER['DOCUMENT_ROOT']."/upload/wat.png"),
);

?>
			
<? if(count($arResult["ITEMS"])): ?>
	<div class="b-catalog-list clearfix <?=$arParams["CLASS"]?> <?=$_REQUEST['view']?>" id="<?=$arParams["LIST_ID"]?>">
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<? $renderImage = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"], Array("width" => 180, "height" => 180), BX_RESIZE_IMAGE_PROPORTIONAL, false, $arFilters ); ?>
			<? $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")); ?>
			<? $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>
			<? $wholesaleClass = (count($arItem["ITEM_PRICES"]) > 1) ? 'isWholesale' : ''; ?>
			<? $withNoticeClass = (intval($arItem["CATALOG_QUANTITY"]) <= 0) ? 'with-notice' : ''; ?>
			<div class="b-catalog-item clearfix <?=$wholesaleClass?> <?=$withNoticeClass?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<div class="b-catalog-back"></div>
				<a href="<?=detailPageUrl($arItem["DETAIL_PAGE_URL"])?>" class="b-catalog-img" style="background-image:url('<?=$renderImage["src"]?>');"></a>
				<div class="b-catalog-desc">
					<div class="b-catalog-item-top">
						<h6><a href="<?=detailPageUrl($arItem["DETAIL_PAGE_URL"])?>"><?=$arItem["NAME"]?></a></h6>
						<p class="article b-catalog-item-country"><?=$arItem["PROPERTIES"]["COUNTRY"]["VALUE"]?></p>
					</div>
					<? if($arParams["SHOW_REMOVE_BUTTON"] == "Y"): ?>
								<a href="/ajax/?action=FAVOURITE_REMOVE&ID=<?=$arItem['ID']?>" class="b-catalog-remove-link" title="Удалить из избранного">Удалить</a>
							<? endif; ?>
					<div class="b-catalog-item-bottom<? if($GLOBALS["isWholesale"]): ?> wholesale-item<? endif; ?>">
						<div class="price-container">
							<? if( $arItem["PRICES"]["PRICE"]["DISCOUNT_VALUE"] != $arItem["PRICES"]["PRICE"]["VALUE"] ): ?>
								<div class="b-discount-price">
									<div class="old-price icon-rub"><?=numberformat( $arItem["PRICES"]["PRICE"]["VALUE"], 0, ',', ' ' )?></div>
									<div class="new-price icon-rub"><?=numberformat( $arItem["PRICES"]["PRICE"]["DISCOUNT_VALUE"], 0, ',', ' ' )?></div>
									<? if( isset($arItem["MEASURE"]) ): ?>
										<p class="article"><?=$arItem["MEASURE"]?></p>
									<? endif; ?>
								</div>
							<? else: ?>
								<p class="price icon-rub"><?=numberformat( $arItem["PRICES"]["PRICE"]["VALUE"], 0, ',', ' ' )?></p>
								<!-- <p class="article"><?=$arItem["MEASURE"]?></p> -->
							<? endif; ?>
							<? if( count($arItem["ITEM_PRICES"]) > 1 ): ?>
								<? foreach ($arItem["ITEM_PRICES"] as $kp => $price): ?>
									<? if( $kp == 0 ) continue; ?>
									<div class="b-discount-price b-dynamic-price b-dynamic-discount-price" style="display:none;" data-from="<?=$price["QUANTITY_FROM"]?>">
										<div class="old-price icon-rub"><?=numberformat( $arItem["PRICES"]["PRICE"]["VALUE"], 0, ',', ' ' )?></div>
										<div class="new-price icon-rub"><?=numberformat( $price["PRICE"], 0, ',', ' ' )?></div>
									</div>
								<? endforeach; ?>
							<? endif; ?>
						</div>
						<div class="b-right-button b-basket-count-cont<? if( isset($arItem["BASKET"]) ): ?> b-item-in-basket<? endif; ?>">
							<? if( intval($arItem["CATALOG_QUANTITY"]) > 0 ): ?>
								<div class="b-basket-count">
									<div class="b-input-cont">
										<a href="#" class="icon-minus b-change-quantity" data-side="-"></a>
										<a href="#" class="icon-plus b-change-quantity" data-side="+"></a>
										<input type="text" name="quantity" data-min="<?=(( $GLOBALS["isWholesale"] )?$arItem["ITEM_PRICES"][1]["QUANTITY_FROM"]:1)?>" data-max="<?=$arItem["CATALOG_QUANTITY"]?>" data-id="<?=$arItem["ID"]?>" class="b-quantity-input" maxlength="3" oninput="this.value = this.value.replace(/\D/g, '')" value="<?=( (isset($arItem["BASKET"]))?$arItem["BASKET"]["QUANTITY"]:( ( isset($arItem["ITEM_PRICES"][1]["QUANTITY_FROM"]) && $GLOBALS["isWholesale"] )?$arItem["ITEM_PRICES"][1]["QUANTITY_FROM"]:$arItem["ITEM_PRICES"][0]["QUANTITY_FROM"] ) )?>">
									</div>
								</div>
								<a href="/ajax/?partial=1&ELEMENT_ID=<?=$arItem["ID"]?>&action=ADD2BASKET" class="b-btn icon-cart b-btn-to-cart"><span>В корзину</span></a>
								<div class="b-error-max-count">Доступно: <?=$arItem["CATALOG_QUANTITY"]?> шт.</div>
							<? else: ?>
								<? $isDisabled = (!isAuth())? "disabled": "" ; ?>
								<a href="/ajax/?action=ADD2RESERVE" id="<?=$arItem["ID"]?>" class="b-btn b-green-btn bx-catalog-subscribe-button <?=$isDisabled?>" data-item="<?=$arItem["ID"]?>" data-name="<?=$arItem["NAME"]?>">
									<span>Оставить&nbsp;заявку</span>
								</a>
								<a href="#b-popup-success-reserved" class="b-thanks-link fancy" style="display:none;"></a>
								<a href="#b-popup-error-reserved" class="b-error-link fancy" style="display:none;"></a>
							<? endif; ?>
						</div>
						<? if( intval($arItem["CATALOG_QUANTITY"]) > 0 ): ?>
							<div class="b-one-click-buy">
								<a href="#" class="dashed pink">Купить в один клик</a>
							</div>
						<? endif; ?>
					</div>
					<? if( $GLOBALS["isWholesale"] ): ?>
						<? if( count($arItem["ITEM_PRICES"]) > 2 ): ?>
							<div class="b-wholesale-price">
								<? foreach ($arItem["ITEM_PRICES"] as $kp => $price): ?>
									<? if( $kp == 0 || $kp == 1 ) continue; ?>
									от <?=$price["QUANTITY_FROM"]?> шт. – <span class="price icon-rub"><?=numberformat( $price["PRICE"], 0, ',', ' ' )?></span><br>
								<? endforeach; ?>
							</div>
						<? endif; ?>
					<? else: ?>
						<? if( count($arItem["ITEM_PRICES"]) > 1 ): ?>
							<div class="b-wholesale-price">
								Оптом дешевле:<br>
								<? foreach ($arItem["ITEM_PRICES"] as $kp => $price): ?>
									<? if( $kp == 0 ) continue; ?>
									от <?=$price["QUANTITY_FROM"]?> шт. – <span class="price icon-rub"><?=numberformat( $price["PRICE"], 0, ',', ' ' )?></span><br>
								<? endforeach; ?>
							</div>
						<? endif; ?>
					<? endif; ?>
					<? if( intval($arItem["CATALOG_QUANTITY"]) <= 0 ): ?>
						<? if (!isAuth()): ?>
							<div class="b-catalog-item-empty-text">Авторизуйтесь, чтобы оставить заявку. Когда товар будет в наличии, Вам автоматически придет письмо на почту.</div>
						<? else: ?>	
							<div class="b-catalog-item-empty-text green">Вы можете оставить заявку на данный товар. Когда товар будет в наличии, Вам автоматически придет письмо на почту.</div>
						<? endif; ?>
					<? endif; ?>
				</div>
			</div>
		<?endforeach;?>
		<? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
			<div class="b-load-more-container">
				<?=$arResult["NAV_STRING"];?>
			</div>
		<?endif;?>
	</div>	
<? else: ?>
	<div class="b-not-result b-text">
		<br>
		<? if( $arParams["CUSTOM_MESSAGE"] ): ?>
			<p><?=$arParams["CUSTOM_MESSAGE"]?></p>
		<? else: ?>
		<p>По Вашему запросу товаров не найдено.</p>
		<? endif; ?>
	</div>
<? endif; ?>