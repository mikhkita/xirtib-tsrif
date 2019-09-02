<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

global $APPLICATION;

if ($arResult['JSON_OFFERS']):
	?><script>
		var offers = <?=$arResult['JSON_OFFERS']?>;
	</script><?
endif;

$this->setFrameMode(true);
$APPLICATION->SetPageProperty('title', $arResult["NAME"]);
$APPLICATION->AddHeadString('<link rel="canonical" href="https://nevkusno.ru' . $arResult["DETAIL_PAGE_URL"] . '" />'); 

$arImg = getElementImages($arResult);
$bigImage = $arImg['DETAIL_PHOTO'][0]['BIG'];
$isSliderImg = false;
$quantity = intval($arResult['OFFERS'] ? $arResult['OFFERS'][0]["PRODUCT"]["QUANTITY"] : $arResult["PRODUCT"]["QUANTITY"]);
$id = $arResult['OFFERS'] ? $arResult['OFFERS'][0]['ID'] : $arResult['ID'];

foreach ($arImg['DETAIL_PHOTO'] as $img) {
	if ($bigImage != $img['BIG']) {
		$isSliderImg = true;	
	}
}

if ($arResult["OFFERS"]){
	foreach ($arResult["OFFERS"] as $key => $offer){

		if ($key == 0){
			$price = $offer["PRICES"]["PRICE"]["VALUE"];
			$discountPrice = $offer["PRICES"]["PRICE"]["DISCOUNT_VALUE"];
		}

		if($offer["PRICES"]["PRICE"]["DISCOUNT_VALUE"] != $offer["PRICES"]["PRICE"]["VALUE"]){
			$discountClass = "b-discount-price";
		}
	}
} else {

	if( $arResult["PRICES"]["PRICE"]["DISCOUNT_VALUE"] != $arResult["PRICES"]["PRICE"]["VALUE"] ){
		$discountClass = "b-discount-price";
	}

	$price = $arResult["PRICES"]["PRICE"]["VALUE"];
	$discountPrice = $arResult["PRICES"]["PRICE"]["DISCOUNT_VALUE"];
}

if (isset($discountClass)) {
	$discount = round(100 - ($discountPrice * 100 / $price));
}

?>

<div class="b-detail-item">
	<div class="b-block">
		<div class="b-detail-left-block">
			<div class="b-detail-top-slider">
				<? if ($arResult["OFFERS"]): ?>
					<? foreach ($arResult['OFFERS'] as $key => $offer): ?>
						<div class="b-detail-big-pic" style="background-image: url('<?=$arImg["DETAIL_PHOTO"][$key]["BIG"]?>');" data-id="<?=$offer['ID']?>"></div>
					<? endforeach; ?>
				<? else: ?>
					<div class="b-detail-big-pic" style="background-image: url('<?=$arImg["DETAIL_PHOTO"][0]["BIG"]?>');"></div>
				<? endif; ?>
			</div>
			<? if ($arResult["OFFERS"] && $isSliderImg): ?>
				<div class="b-detail-bottom-slider">
					<? foreach ($arResult['OFFERS'] as $key => $offer): ?>
						<div class="b-detail-small-pic" style="background-image: url('<?=$arImg["DETAIL_PHOTO"][$key]["SMALL"]?>" data-id="<?=$offer['ID']?>"></div>
					<? endforeach; ?>
				</div>
			<? endif; ?>
		</div>
		<div class="b-detail-right-block">
			<h3><?$APPLICATION->ShowTitle();?></h3>
			<div class="b-detail-bonus-container">
				<div class="b-detail-bonus green-bonus">-5% при оплате онлайн</div>
				<div class="b-detail-bonus purple-bonus bonus-with-add icon-info">
					Вернем 50% от стоимости доставки
					<!-- <div class="b-detail-bonus-add">Возврат осуществляется в случае</div> -->
				</div>
			</div>
			<div class="b-detail-top-slider b-detail-mobile-slider">
				<? if ($arResult["OFFERS"]): ?>
					<? foreach ($arResult["OFFERS"] as $key => $offer): ?>
						<div class="b-detail-big-pic" style="background-image: url('<?=$arImg["DETAIL_PHOTO"][$key]["BIG"]?>');" data-color-id="<?=$offer['ID']?>"></div>
					<? endforeach; ?>
				<? else: ?>
					<div class="b-detail-big-pic" style="background-image: url('<?=$arImg["DETAIL_PHOTO"][0]["BIG"]?>');" data-color-id="<?=$offer['ID']?>"></div>
				<? endif; ?>
			</div>
			<div class="detail-price-container">
				<div class="price-container <?=$discountClass?>">
					<p class="old-price icon-rub"><?=convertPrice($price)?></p>
					<p class="new-price icon-rub"><?=convertPrice($discountPrice)?></p>
					<div class="cheaper-mobile">
						<a href="#" class="pink dashed">Купить этот товар дешевле</a>
					</div>
					<p class="app-price">Эксклюзивные цены в <a href="#" class="pink dashed">приложении</a></p>
				</div>
				<? if (isset($discount)): ?>
					<div class="b-detail-discount">
						<div class="b-detail-disount-icon icon-discount-full">-<?=$discount?>%</div>
						<div class="discount-time">17 ч : 49 м : 58 с</div>
					</div>
				<? endif; ?>
			</div>
			<div class="detail-select-block">
				<? if (!empty($arResult['COLORS'])): ?>
					<div class="b-sort-select">
						<select name="color" id="colorSelect" data-placeholder="Выберите цвет">
							<? foreach ($arResult['COLORS'] as $xmlvalue => $color): ?>
								<option data-color-id="<?=$xmlvalue?>" <?=$color['SELECTED']?>><?=$color['NAME']?></option>
							<? endforeach; ?>
						</select>
					</div>
				<? endif; ?>
				<? if (!empty($arResult['SIZE'])): ?>
					<div class="b-sort-select">
						<select name="size" id="sizeSelect" data-placeholder="Выберите размер">
							<option></option>
							<? foreach ($arResult['SIZE'] as $xmlvalue => $size): ?>
								<option data-size-id="<?=$xmlvalue?>" <?=$size['SELECTED']?>><?=$size['NAME']?></option>
							<? endforeach; ?>
						</select>
					</div>
				<? endif; ?>
			</div>
			<div class="b-detail-count-block">
				<?if($quantity <= 0){
						$inputVal = 0;
						$btnClass = "unavailable";
					} else {
						$inputVal = 1;
					}?>
				<div class="b-detail-count b-product-quantity">
					<a href="#" class="icon-plus quantity-add"></a>
					<input type="text" name="count" class="quantity-input" data-quantity="<?=$quantity?>" maxlength="3" oninput="this.value = this.value.replace(/\D/g, '')" value="<?=$inputVal?>">
					<a href="#" class="icon-minus quantity-reduce"></a>
				</div>
				<div class="b-detail-buy b-detail-buy-mobile">
					<a href="#" class="b-btn icon-cart"><p>В корзину</p></a>
				</div>
				<a href="#" class="pink dashed cheaper">Купить этот товар дешевле</a>
				<div class="b-product-quantity-info hide">
					<span>В наличии:&nbsp;</span><span id="quantity-info"><?=$quantity?></span>
				</div>
			</div>
			<div class="b-detail-buy">
				<a href="/ajax/?action=ADD2BASKET" class="b-btn b-btn-to-cart icon-cart" data-id="<?=$id?>"><p>Добавить в корзину</p></a>
				<div class="b-detail-one-click">или <a href="#" class="pink dashed">купить в один клик</a></div>
			</div>
			<div class="b-detail-tabs">
				<div id="b-detail-tabs-slider" class="b-tabs-container b-tabs-container-underline">
					<div class="b-tab active" data-tab="description">Описание</div>
					<div class="b-tab" data-tab="delivery">Доставка</div>
					<div class="b-tab" data-tab="review">Отзывы (10)</div>
					<div class="b-tab" data-tab="recipes">Рецепты с продуктом</div>
				</div>
				<div class="b-tab-item b-tab-about" id="description">
					<div class="detail-description-text">Форма на 5 ячеек для профессионального использования из силикона с пластиковым держателем.</div>
					<div class="detail-description-text"><b>Размеры:</b> диаметр 60 мм , высота 73 мм, объем 108 мл х 5 = 540 мл</div>
					<div class="detail-description-text"><b>Рекомендации по применению:</b> идеально подходят для выпечки, приготовления десертов и пирожных, холодных закусок, заливного, желе. Могут быть использованы в температурном режиме от -60 С до +230 С. После применения формы необходимо тщательно вымыть и просушить.</div>
					<div class="detail-description-text"><b>Внимание!</b> Не ставьте форму непосредственно на источник тепла. Не режьте изделия непосредственно в форме. Не используйте агрессивные моющие средства и жесткие губки. Не используйте форму в микроволновой печи в режиме "гриль". Рекомендации После выпечки нужно дать изделию полностью остыть для лучшего извлечения из формы. Рекомендуется также перед выпечкой предварительно смазывать формы маслом. Для полного устранения следов жира в форме, ее достаточно просто прокипятить в воде 10 минут.</div>
					<div class="detail-description-text"><b>Срок годности:</b> неограничен</div>
					<div class="detail-description-text"><b>Условия хранения:</b> хранить вдали от источников тепла и солнечных лучей при температуре от 15 до 25 °C</div>
				</div>
				<div class="b-tab-item b-tab-about hide" id="delivery">
					<p><b>Размеры:</b> диаметр 60 мм , высота 73 мм, объем 108 мл х 5 = 540 мл<br><br>
					<b>Рекомендации по применению:</b> идеально подходят для выпечки, приготовления десертов и пирожных, холодных закусок, заливного, желе. Могут быть использованы в температурном режиме от -60 С до +230 С. После применения формы необходимо тщательно вымыть и просушить.<br><br>
					<b>Внимание!</b> Не ставьте форму непосредственно на источник тепла. Не режьте изделия непосредственно в форме. Не используйте агрессивные моющие средства и жесткие губки. Не используйте форму в микроволновой печи в режиме "гриль". Рекомендации После выпечки нужно дать изделию полностью остыть для лучшего извлечения из формы. Рекомендуется также перед выпечкой предварительно смазывать формы маслом. Для полного устранения следов жира в форме, ее достаточно просто прокипятить в воде 10 минут.<br><br>
					<b>Срок годности:</b> неограничен<br><br>
					<b>Условия хранения:</b> хранить вдали от источников тепла и солнечных лучей при температуре от 15 до 25 °C<br><br>
					Форма на 5 ячеек для профессионального использования из силикона с пластиковым держателем.</p>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="about-advantages detail-advantages">
	<h2>При покупке этого товара вы получаете</h2>
	<div class="b-block">
		<div class="about-advantages-item" style="background-image: url('<?=SITE_TEMPLATE_PATH?>/i/about-adv-1.svg');">
			<h4>Срочная доставка</h4>
			<p>Сделали заказ до 12 часов?<br>Доставим сегодня</p>
		</div>
		<div class="about-advantages-item" style="background-image: url('<?=SITE_TEMPLATE_PATH?>/i/about-adv-2.svg');">
			<h4>Безопасная оплата</h4>
			<p>При оплате банковской картой на сайте, используется 256-битное шифрование информации</p>
		</div>
		<div class="about-advantages-item" style="background-image: url('<?=SITE_TEMPLATE_PATH?>/i/about-adv-3.svg');">
			<h4>30 дней на обмен</h4>
			<p>Не понравилась покупка?<br>Обменяем без проблем!</p>
		</div>
		<div class="about-advantages-item" style="background-image: url('<?=SITE_TEMPLATE_PATH?>/i/detail-adv-1.svg');">
			<h4>Гарантия качества</h4>
			<p>Все товары<br>сертифицированы</p>
		</div>
		<div class="about-advantages-item" style="background-image: url('<?=SITE_TEMPLATE_PATH?>/i/about-adv-6.svg');">
			<h4>Скидки и бонусы</h4>
			<p>Двойные бонусы в день<br>рождения</p>
		</div>
	</div>
</div>
<div class="b-last-item-block b-last-detail wave-top">
	<div class="b-block">
		<h2>Вместе с этим товаром покупают</h2>
		<div class="b-catalog-slider">
			<div class="b-catalog-item">
				<a href="#" class="item-link"></a>
				<div class="b-catalog-back"></div>
				<div class="b-catalog-img" style="background-image:url('<?=SITE_TEMPLATE_PATH?>/i/catalog-item-1.jpg');">
				</div>
				<div class="b-catalog-item-top">
					<h6>Силиконовая форма Multiflex ЕЖЕВИКА и МАЛИНА 3D Mora Lampone Silikomart</h6>
					<p class="article">Арт. 4023</p>
					<p class="description">Мешок силиконовый, производство Китай. Предназначен для работы с кремом. Необходимо использования кондитерских насадок. </p>
				</div>
				<div class="b-catalog-item-bottom">
					<div class="price-container">
						<p class="price icon-rub">250</p>
					</div>
					<a href="#" class="b-btn icon-cart"><p>В корзину</p></a>
					<div class="b-one-click-buy">
						<a href="#" class="dashed pink">Купить в один клик</a>
					</div>
				</div>
			</div>
			<div class="b-catalog-item">
				<a href="#" class="item-link"></a>
				<div class="b-catalog-back"></div>
				<div class="b-catalog-img" style="background-image:url('<?=SITE_TEMPLATE_PATH?>/i/catalog-item-2.jpg');">
				</div>
				<div class="b-catalog-item-top">
					<h6>Силиконовая форма Multiflex ШИШКИ 3D 5 шт. Foresta110 Silikomart</h6>
					<p class="article">Арт. 8340</p>
				</div>
				<div class="b-catalog-item-bottom">
					<div class="price-container">
						<p class="price icon-rub">1 280</p>
					</div>
					<a href="#" class="b-btn icon-cart"><p>В корзину</p></a>
					<div class="b-one-click-buy">
						<a href="#" class="dashed pink">Купить в один клик</a>
					</div>
				</div>
			</div>
			<div class="b-catalog-item">
				<a href="#" class="item-link"></a>
				<div class="b-catalog-back"></div>
				<div class="b-catalog-img" style="background-image:url('<?=SITE_TEMPLATE_PATH?>/i/catalog-item-3.jpg');">
				</div>
				<div class="b-catalog-item-top">
					<h6>Силиконовая форма Pavocake БОМБА 3D Bombee Pavoni</h6>
					<p class="article">Арт. 8340</p>
				</div>
				<div class="b-catalog-item-bottom">
					<div class="price-container">
						<p class="price icon-rub">850</p>
					</div>
					<a href="#" class="b-btn icon-cart"><p>В корзину</p></a>
					<div class="b-one-click-buy">
						<a href="#" class="dashed pink">Купить в один клик</a>
					</div>
				</div>
			</div>
			<div class="b-catalog-item">
				<a href="#" class="item-link"></a>
				<div class="b-catalog-back"></div>
				<div class="b-catalog-img" style="background-image:url('<?=SITE_TEMPLATE_PATH?>/i/catalog-item-4.jpg');">
				</div>
				<div class="b-catalog-item-top">
					<h6>Силиконовая форма Pavocake САВАРЕН 3D Pavoni</h6>
					<p class="article">Арт. 2301</p>
				</div>
				<div class="b-catalog-item-bottom">
					<div class="price-container">
						<p class="price icon-rub">650</p>
					</div>
					<a href="#" class="b-btn icon-cart"><p>В корзину</p></a>
					<div class="b-one-click-buy">
						<a href="#" class="dashed pink">Купить в один клик</a>
					</div>
				</div>
			</div>
			<div class="b-catalog-item discount-item">
				<a href="#" class="item-link"></a>
				<div class="b-catalog-back"></div>
				<div class="b-catalog-img" style="background-image:url('<?=SITE_TEMPLATE_PATH?>/i/catalog-item-5.jpg');">
					<div class="catalog-item-discount icon-discount-full"><p>-15%</p></div>
				</div>
				<div class="b-catalog-item-top">
					<h6>Силиконовая форма Tortaflex ИГРА Game1200 Silikomart</h6>
					<p class="article">Арт. 2563</p>
				</div>
				<div class="b-catalog-item-bottom">
					<div class="price-container b-discount-price">
						<p class="old-price icon-rub">1 600</p>
						<p class="new-price pink icon-rub">1 280</p>
					</div>
					<a href="#" class="b-btn icon-cart"><p>В корзину</p></a>
					<div class="b-one-click-buy">
						<a href="#" class="dashed pink">Купить в один клик</a>
					</div>
				</div>
			</div>
			<div class="b-catalog-item">
				<a href="#" class="item-link"></a>
				<div class="b-catalog-back"></div>
				<div class="b-catalog-img" style="background-image:url('<?=SITE_TEMPLATE_PATH?>/i/catalog-item-6.jpg');">
				</div>
				<div class="b-catalog-item-top">
					<h6>Силиконовая форма Tortaflex ВОРТЕКС Vortex Silikomart</h6>
					<p class="article">Арт. 7838</p>
				</div>
				<div class="b-catalog-item-bottom">
					<div class="price-container">
						<p class="price icon-rub">2 130</p>
					</div>
					<a href="#" class="b-btn icon-cart"><p>В корзину</p></a>
					<div class="b-one-click-buy">
						<a href="#" class="dashed pink">Купить в один клик</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="b-sub-block">
	<div class="b-block">
		<h2 class="sub-title">Узнавайте об <b>акциях и новинках</b> первыми</h2>
		<h5>Подпишитесь на рассылку и покупайте с выгодой для себя</h5>
		<form action="/kitsend.php" class="b-one-string-form">
			<input type="text" placeholder="Введите ваш E-mail">
			<a href="#" class="pink">Подписаться</a>
		</form>
	</div>
</div>