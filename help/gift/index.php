<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Дисконтные карты и подарочные сертификаты");?>

<div class="b-subcategory b-gift-cert-block wave-bottom">
	<div class="b-block">
		<div class="b-1-by-3-blocks">
			<div class="b-block-1">
				<div class="b-category-left-list">
					<?$APPLICATION->IncludeComponent("bitrix:menu", "help", Array(
							"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
								"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
								"DELAY" => "N",	// Откладывать выполнение шаблона меню
								"MAX_LEVEL" => "2",	// Уровень вложенности меню
								"MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
									0 => "",
								),
								"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
								"MENU_CACHE_TYPE" => "N",	// Тип кеширования
								"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
								"ROOT_MENU_TYPE" => "help",	// Тип меню для первого уровня
								"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
							),
					false);
					?>
				</div>
			</div>
			<div class="b-block-2">
				<div class="b-gift-block-container">
					<div class="b-gift-description">
						В нашем магазине Вы можете приобрести подарочные сертификаты.<br>
						Подобный сертификат может стать отличным подарком на любой праздник.<br>
						По желанию выпускаются сертификаты на нужную Вам сумму.<br>
						Дарите радость родным и близким.
					</div>
					<div class="b-catalog-list b-catalog-fullsize-img">
						<div class="b-catalog-item">
							<a href="#" class="item-link"></a>
							<div class="b-catalog-back"></div>
							<div class="b-catalog-img" style="background-image:url('<?=SITE_TEMPLATE_PATH?>/i/certificate.jpg');"></div>
							<div class="b-catalog-item-top">
								<h6>Подарочный сертификат на 1&nbsp;000 рублей</h6>
							</div>
							<div class="b-catalog-item-bottom">
								<div class="price-container">
									<p class="price icon-rub">1 000</p>
								</div>
								<a href="#" class="b-btn icon-cart b-btn-to-cart" onclick="return false;"><span>В корзину</span></a>
								<?/*?>
								<div class="b-one-click-buy">
									<a href="#" class="dashed pink">Купить в один клик</a>
								</div>
								<?*/?>
							</div>
						</div>
						<div class="b-catalog-item">
							<a href="#" class="item-link"></a>
							<div class="b-catalog-back"></div>
							<div class="b-catalog-img" style="background-image:url('<?=SITE_TEMPLATE_PATH?>/i/certificate.jpg');"></div>
							<div class="b-catalog-item-top">
								<h6>Подарочный сертификат на 2&nbsp;000 рублей</h6>
							</div>
							<div class="b-catalog-item-bottom">
								<div class="price-container">
									<p class="price icon-rub">2 000</p>
								</div>
								<a href="#" class="b-btn icon-cart b-btn-to-cart" onclick="return false;"><span>В корзину</span></a>
								<?/*?>
								<div class="b-one-click-buy">
									<a href="#" class="dashed pink">Купить в один клик</a>
								</div>
								<?*/?>
							</div>
						</div>
						<div class="b-catalog-item">
							<a href="#" class="item-link"></a>
							<div class="b-catalog-back"></div>
							<div class="b-catalog-img" style="background-image:url('<?=SITE_TEMPLATE_PATH?>/i/certificate.jpg');"></div>
							<div class="b-catalog-item-top">
								<h6>Подарочный сертификат на 3&nbsp;000 рублей</h6>
							</div>
							<div class="b-catalog-item-bottom">
								<div class="price-container">
									<p class="price icon-rub">3 000</p>
								</div>
								<a href="#" class="b-btn icon-cart b-btn-to-cart" onclick="return false;"><span>В корзину</span></a>
								<?/*?>
								<div class="b-one-click-buy">
									<a href="#" class="dashed pink">Купить в один клик</a>
								</div>
								<?*/?>
							</div>
						</div>
					</div>
				</div>
				<div class="b-gift-block-container b-bottom-gift-block">
					<div class="b-gift-description">
						Так же в нашем магазине Вы можете приобрести дисконтную карту. С каждой покупки в розничных магазинах на карту начисляется 1% от стоимости заказа. При достижении суммы 1000 рублей Вы можете оплатить ею заказ.
					</div>
					<div class="b-catalog-list b-catalog-fullsize-img">
						<div class="b-catalog-item">
							<a href="#" class="item-link"></a>
							<div class="b-catalog-back"></div>
							<div class="b-catalog-img" style="background-image:url('<?=SITE_TEMPLATE_PATH?>/i/discount-card.jpg');"></div>
							<div class="b-catalog-item-top">
								<h6>Дисконтная карта</h6>
							</div>
							<div class="b-catalog-item-bottom">
								<div class="price-container">
									<p class="price icon-rub">200</p>
								</div>
								<a href="#" class="b-btn icon-cart b-btn-to-cart" onclick="return false;"><span>В корзину</span></a>
								<?/*?>
								<div class="b-one-click-buy">
									<a href="#" class="dashed pink">Купить в один клик</a>
								</div>
								<?*/?>
							</div>
						</div>
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

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>