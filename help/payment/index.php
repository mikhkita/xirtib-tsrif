<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оплата");?>

<div class="b-subcategory b-rounded-tiles-block b-payment-block">
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
				<h3>Выберите интересущий вас способ оплаты</h3>
				<div class="b-rounded-tile-list">
					<a href="#" class="b-rounded-tile-item">
						<div class="b-rounded-tile-img icon-visa"></div>
						<div class="b-rounded-tile-name-container">
							<div class="b-rounded-tile-name">Онлайн банковской картой</div>
						</div>
					</a>
					<a href="#" class="b-rounded-tile-item">
						<div class="b-rounded-tile-img icon-spasibo"></div>
						<div class="b-rounded-tile-name-container">
							<div class="b-rounded-tile-name">СПАСИБО от Сбербанка</div>
						</div>
					</a>
					<a href="#" class="b-rounded-tile-item">
						<div class="b-rounded-tile-img icon-bank"></div>
						<div class="b-rounded-tile-name-container">
							<div class="b-rounded-tile-name">Банковский перевод</div>
						</div>
					</a>
					<a href="#" class="b-rounded-tile-item">
						<div class="b-rounded-tile-img icon-sber"></div>
						<div class="b-rounded-tile-name-container">
							<div class="b-rounded-tile-name">Сбербанк Онлайн</div>
						</div>
					</a>
					<a href="#" class="b-rounded-tile-item">
						<div class="b-rounded-tile-img icon-paypal"></div>
						<div class="b-rounded-tile-name-container">
							<div class="b-rounded-tile-name">PayPal</div>
						</div>
					</a>
					<a href="#" class="b-rounded-tile-item">
						<div class="b-rounded-tile-img icon-yandex"></div>
						<div class="b-rounded-tile-name-container">
							<div class="b-rounded-tile-name">Яндекс.Деньги</div>
						</div>
					</a>
					<a href="#" class="b-rounded-tile-item">
						<div class="b-rounded-tile-img icon-webmoney"></div>
						<div class="b-rounded-tile-name-container">
							<div class="b-rounded-tile-name">WebMoney</div>
						</div>
					</a>
					<a href="#" class="b-rounded-tile-item">
						<div class="b-rounded-tile-img icon-qiwi"></div>
						<div class="b-rounded-tile-name-container">
							<div class="b-rounded-tile-name">Киви Кошелек</div>
						</div>
					</a>
					<a href="#" class="b-rounded-tile-item">
						<div class="b-rounded-tile-img icon-cash"></div>
						<div class="b-rounded-tile-name-container">
							<div class="b-rounded-tile-name">Наличными</div>
						</div>
					</a>
					<a href="#" class="b-rounded-tile-item">
						<div class="b-rounded-tile-img icon-deliverycash"></div>
						<div class="b-rounded-tile-name-container">
							<div class="b-rounded-tile-name">Наложенный платеж</div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="b-question-block b-payment-question-block wave-top wave-bottom">
	<div class="b-block">
		<div class="b-question-block-left">
			<div class="b-question-img"></div>
			<div class="b-question-block-text">
				<div class="b-question-block-head-text">Остались вопросы?</div>
				<div class="b-question-block-other-text">Закажите обратный звонок.<br>Мы позвоним вам и подробно проконсультируем.</div>
			</div>
		</div>
		<div class="b-question-form">
			<form action="/kitsend.php" class="b-one-string-form">
				<input type="text" placeholder="Номер телефона">
				<a href="#" class="pink">Заказать звонок</a>
			</form>
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