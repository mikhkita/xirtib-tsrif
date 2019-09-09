<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Часто задаваемые вопросы");?>

<div class="b-subcategory b-faq-block">
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
				<h3>Ответы на самые популярные вопросы</h3>
				<div class="b-faq-list">
					<div class="b-faq-item with-img">
						<div class="b-faq-header">Когда мне доставят заказ?
							<div class="b-faq-header-icon">
								<div class="b-faq-header-icon-line"></div>
								<div class="b-faq-header-icon-line"></div>
							</div>
						</div>
						<div class="b-faq-content">
							<div class="b-faq-img" style="background-image:url('<?=SITE_TEMPLATE_PATH?>/i/catalog-item-1.jpg')"></div>
							<div class="b-faq-item-text">Сборка товаров начинается послеподтверждения факта оплаты и длится от 1 часа до 10 дней в зависимости от объема. После сборки заказ отправляется выбранным вами способом. Доставка зависит от политики компании-доставщика. В среднем доставка по России занимает не более 10 дней.</div>
						</div>
					</div>
					<div class="b-faq-item no-img">
						<div class="b-faq-header">Менеджер поможет с выбором товара?
							<div class="b-faq-header-icon">
								<div class="b-faq-header-icon-line"></div>
								<div class="b-faq-header-icon-line"></div>
							</div>
						</div>
						<div class="b-faq-content">
							<div class="b-faq-item-text">Сборка товаров начинается послеподтверждения факта оплаты и длится от 1 часа до 10 дней в зависимости от объема. После сборки заказ отправляется выбранным вами способом. Доставка зависит от политики компании-доставщика. В среднем доставка по России занимает не более 10 дней.</div>
						</div>
					</div>
					<div class="b-faq-item no-img">
						<div class="b-faq-header">Как быстро мне доставят заказ?
							<div class="b-faq-header-icon">
								<div class="b-faq-header-icon-line"></div>
								<div class="b-faq-header-icon-line"></div>
							</div>
						</div>
						<div class="b-faq-content">
							<div class="b-faq-item-text">Сборка товаров начинается послеподтверждения факта оплаты и длится от 1 часа до 10 дней в зависимости от объема. После сборки заказ отправляется выбранным вами способом. Доставка зависит от политики компании-доставщика. В среднем доставка по России занимает не более 10 дней.</div>
						</div>
					</div>
					<div class="b-faq-item no-img">
						<div class="b-faq-header">Как быстро мне доставят заказ?
							<div class="b-faq-header-icon">
								<div class="b-faq-header-icon-line"></div>
								<div class="b-faq-header-icon-line"></div>
							</div>
						</div>
						<div class="b-faq-content">
							<div class="b-faq-item-text">Сборка товаров начинается послеподтверждения факта оплаты и длится от 1 часа до 10 дней в зависимости от объема. После сборки заказ отправляется выбранным вами способом. Доставка зависит от политики компании-доставщика. В среднем доставка по России занимает не более 10 дней.</div>
						</div>
					</div>
					<div class="b-faq-item no-img">
						<div class="b-faq-header">Как быстро мне доставят заказ?
							<div class="b-faq-header-icon">
								<div class="b-faq-header-icon-line"></div>
								<div class="b-faq-header-icon-line"></div>
							</div>
						</div>
						<div class="b-faq-content">
							<div class="b-faq-item-text">Сборка товаров начинается послеподтверждения факта оплаты и длится от 1 часа до 10 дней в зависимости от объема. После сборки заказ отправляется выбранным вами способом. Доставка зависит от политики компании-доставщика. В среднем доставка по России занимает не более 10 дней.</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="b-faq-form-block wave-bottom">
	<div class="b-block">
		<div class="b-1-by-3-blocks">
			<div class="b-block-1">
				<div class="b-faq-form-man">
					<div class="b-faq-form-man-img" style="background-image: url('<?=SITE_TEMPLATE_PATH?>/i/faq.jpg');"></div>
					<div class="b-faq-form-man-name">Инна Потапова</div>
					<div class="b-faq-form-man-post">Менеджер</div>
				</div>
			</div>
			<div class="b-block-2">
				<h4>Задайте свой вопрос</h4>
				<div class="b-faq-form">
					<form action="/ajax/?action=ADDQUESTION" method="POST">
						<div class="b-faq-form-textarea">
							<textarea name="question" rows="4" placeholder="Введите вопрос" required></textarea>
							<input type="text" name="MAIL">
						</div>
						<div class="b-faq-form-bottom">
							<? if (isAuth()): ?>
								<a href="#" class="b-btn ajax">Задать вопрос</a>
							<? else: ?>
								<a href="#b-popup-auth" class="b-btn fancy">Войти</a>
							<? endif; ?>
						</div>
						<a href="#b-question-success" class="b-thanks-link fancy" style="display:none;"></a>
					</form>
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