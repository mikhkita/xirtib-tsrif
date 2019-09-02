<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Бонусная программа");?>

<div class="b-subcategory b-bonus-block wave-bottom">
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
						false
					);?>
				</div>
			</div>
			<div class="b-block-2">
				<div class="b-bonus-description">Станьте участником бонусной программы Вкусного магазина, накапливайте бонусы и приобретайте кондитерский инструмент со скидкой!</div>
				<div class="b-bonus-title">Как это работает?</div>
				<div class="b-bonus-list">
					<div class="b-bonus-item">
						<div class="b-bonus-item-img" style="background-image:url('<?=SITE_TEMPLATE_PATH?>/i/bonus-img-1.jpg')"></div>
						<div class="b-bonus-item-name">Зарегистрируйтесь</div>
						<div class="b-bonus-item-description">Участниками бонусной программы&nbsp;могут быть только зарегистрированные покупатели</div>
					</div>
					<div class="b-bonus-item">
						<div class="b-bonus-item-img" style="background-image:url('<?=SITE_TEMPLATE_PATH?>/i/bonus-img-2.jpg')"></div>
						<div class="b-bonus-item-name">Сделайте заказ</div>
						<div class="b-bonus-item-description">Сумма вашего заказа неограничена</div>
					</div>
					<div class="b-bonus-item">
						<div class="b-bonus-item-img" style="background-image:url('<?=SITE_TEMPLATE_PATH?>/i/bonus-img-3.jpg')"></div>
						<div class="b-bonus-item-name">Копите бонусы</div>
						<div class="b-bonus-item-description">За каждую покупку в магазине вы получаете бонусные баллы. 1&nbsp;балл = 1 рубль</div>
					</div>
					<div class="b-bonus-item">
						<div class="b-bonus-item-img" style="background-image:url('<?=SITE_TEMPLATE_PATH?>/i/bonus-img-4.jpg')"></div>
						<div class="b-bonus-item-name">Проверяйте баланс</div>
						<div class="b-bonus-item-description">Баллы начисляются в&nbsp;течение&nbsp;трех дней после покупки на ваш внутренний счет</div>
					</div>
					<div class="b-bonus-item">
						<div class="b-bonus-item-img" style="background-image:url('<?=SITE_TEMPLATE_PATH?>/i/bonus-img-5.jpg')"></div>
						<div class="b-bonus-item-name">Оплачивайте покупки</div>
						<div class="b-bonus-item-description">Используйте бонусы, оплачивая&nbsp;ими до 50% от стоимости заказа</div>
					</div>
				</div>
				<div class="b-bonus-text-container">
					<div class="b-bonus-title">Что такое бонусная программа?</div>
					<div class="b-bonus-text">Бонусная программа – это программа, позволяющая получать бонусы за каждую покупку, отзывы на сайте, рекомендации друзьям и прочее, и использовать их в качестве скидки на последующий заказ.</div>
					<div class="b-bonus-title">Как потратить бонусы?</div>
					<div class="b-bonus-text">Чтобы воспользоваться оплатой накопленными бонусными баллами, вы должны быть авторизованы в своем личном кабинете. Любую покупку можно оплачивать бонусами, имеющимися на счете, но не более 50% от стоимости заказа. Списание бонусов происходит в момент оформления заказа. Оформить новый заказ и воспользоваться начисленными бонусами можно уже в тот же день, как бонусы зачислятся на счет.<br><br>
					Бонусы нельзя использовать для получения скидки на стоимость. Возврат бонусных баллов в денежном эквиваленте невозможен. При возварте товара бонусные баллы не возвращаются. Бонусы не начисляются при оформлении товара по телефону. </div>
					<div class="b-bonus-title">Сколько у меня бонусов?</div>
					<div class="b-bonus-text">Узнать свой текущий бонусный счет можно в личном кабинете.</div>
					<div class="b-bonus-title">Как получить бонусные баллы?</div>
					<div class="b-bonus-text"><b><span class="pink">100 баллов</span> при регистрации</b><br><br>
					При регистрации на нашем сайте на бонусный счет вашего личного кабинета зачисляется 100 бонусных баллов.<br><br>
					<b>По <span class="pink">1 баллу</span> за каждые потраченные <span class="pink">30 рублей</span></b><br><br>
					За каждые потраченные 30 рублей (кроме услуг доставки) вы автоматически получаете 1 балл.<br><br>
					<b><span class="pink">50 баллов</span> за селфи</b><br><br>
					Сделайте селфи на фоне распакованной посылки из нашего магазина и выложите в социальных сетях с хэштегом #первыймагазиндлякондитеров и получите на счет вашего личного кабинета 50 баллов.<br><br>
					<b><span class="pink">50 баллов</span> за собственный мастер-класс</b><br><br>
					При размещении собственного бесплатного мастер-класса с указанием ссылки на наш магазин, где можно приобрести используемые в мастер-классе инструменты вы получите на счет вашего личного кабинета 50 баллов.<br><br>
					<b><span class="pink">100 баллов</span> за отзывы</b><br><br>
					Оставляйте отзывы о товаре и магазине как на страничке самого магазина, так и на различных форумах и сайтах с ссылками на магазин! Отзыв должен быть содержательным, полезным для посетителей магазина. Обязательно указывайте номер Вашего заказа в отзыве, чтобы мы смогли определить автора отзыва.<br><br>
					Баллы не начисляются за отзывы без указанного номера заказа.  Магазин оставляет за собой право не начислять бонусы, если отзыв недостаточно информативный.</div>
				</div>
				<div class="b-important-info">
					<div class="b-important-img" style="background-image: url('<?=SITE_TEMPLATE_PATH?>/i/important-icon.jpg');"></div>
					<div class="b-important-text">Условия настоящей Бонусной Программы действительны на февраль 2018 года. Магазин оставляет за собой право изменить условия Бонусной Программы в любое время, опубликовав новую редакцию на сайте</div>
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