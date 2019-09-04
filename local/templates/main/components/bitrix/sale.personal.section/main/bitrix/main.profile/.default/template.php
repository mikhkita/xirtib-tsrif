<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use Bitrix\Main\Localization\Loc;

$userID = $USER->GetID();
$rsUser = CUser::GetByID($userID);
$arUser = $rsUser->Fetch();
$photo = array();
if ($arUser['PERSONAL_PHOTO']){
	$photo = CFile::ResizeImageGet($arUser['PERSONAL_PHOTO'], Array("width" => 266, "height" => 266), BX_RESIZE_IMAGE_EXACT, false, $arFilters );
}?>

<div class="b-cabinet wave-bottom">
	<div class="b-block">
		<div class="b-cabinet-left sticky">
			<div class="b-profile clearfix">
				<?if(!empty($photo)):?>
					<div class="b-profile-photo has-photo" style="background-image: url(<?=$photo['src']?>);"></div>
				<?else:?>
					<a href="edit" class="b-profile-photo icon-add-photo"></a>
				<?endif;?>
				<div class="b-profile-name"><?=$arUser['NAME']." ".$arUser["SECOND_NAME"]." ".$arUser['LAST_NAME']?></div>
				<?
				// <div class="b-profile-bonus-text">Мои бонусные баллы</div>
				// <div class="b-profile-bonus-count">125</div>
				?>
				<a href="edit" class="b-btn">Редактировать профиль</a>
			</div>
			<?
			// <div class="b-get-bonus">
			// 	<div class="b-get-bonus-text">Получить бонусные баллы</div>
			// 	<form action="/getBonus.php" method="POST" class="b-one-string-form">
			// 		<div class="b-get-bonus-input-container">
			// 			<input type="text" placeholder="Ссылка на селфи">
			// 			<a href="#" class="pink ajax">Получить</a>
			// 		</div>
			// 		<div class="b-get-bonus-input-container">
			// 			<input type="text" placeholder="Ссылка на отзыв">
			// 			<a href="#" class="pink ajax">Получить</a>
			// 		</div>
			// 		<div class="b-get-bonus-input-container">
			// 			<input type="text" placeholder="Ссылка на мастер-класс">
			// 			<a href="#" class="pink ajax">Получить</a>
			// 		</div>
			// 	</form>
			// </div>
			?>
		</div>
		<div class="b-cabinet-right">
			<div class="b-cabinet-hello">Здравствуйте, <?=$arUser['NAME']?>!</div>
			<div class="b-orders">
				<?$APPLICATION->IncludeComponent(
					"bitrix:sale.personal.order.list",
					"main",
					Array(
						"DEFAULT_SORT" => 'ID',
				        "STATUS_COLOR_N" => "green",
				        "STATUS_COLOR_P" => "yellow",
				        "STATUS_COLOR_F" => "gray",
				        "STATUS_COLOR_PSEUDO_CANCELLED" => "red",
				        "PATH_TO_DETAIL" => "order_detail.php?ID=#ID#",
				        "PATH_TO_COPY" => "basket.php",
				        "PATH_TO_CANCEL" => "order_cancel.php?ID=#ID#",
				        "PATH_TO_BASKET" => "basket.php",
				        "PATH_TO_PAYMENT" => "payment.php",
				        "ORDERS_PER_PAGE" => 20,
				        "ID" => $ID,
				        "SET_TITLE" => "Y",
				        "SAVE_IN_SESSION" => "Y",
				        "NAV_TEMPLATE" => "",
				        "CACHE_TYPE" => "A",
				        "CACHE_TIME" => "3600",
				        "CACHE_GROUPS" => "Y",
				        "HISTORIC_STATUSES" => array(),
				        "ACTIVE_DATE_FORMAT" => "d.m.Y",
				    )
				);?>
				<div class="b-orders-header">Текущие заказы</div>
				<div class="b-orders-list">
					<div class="b-orders-container">
						<div class="b-order-item">
							<div class="b-order-date b-order-text">03.12.2018 г.</div>
							<div class="b-order-img" style="background-image: url('<?=SITE_TEMPLATE_PATH?>/i/catalog-item-5.jpg');"></div>
							<div class="b-order-name b-order-text">Силиконовая форма для кекса и маффина</div>
							<div class="b-order-count b-order-text">15</div>
							<div class="b-order-sum b-order-text">2 700 ₽</div>
							<div class="b-order-status b-order-text green">Доставлено</div>
							<a href="#" class="b-order-repeat icon-thin-reload"></a>
							<a href="#" class="b-order-delete icon-delete"></a>
						</div>
						<div class="b-order-item">
							<div class="b-order-date b-order-text">03.12.2018 г.</div>
							<div class="b-order-img" style="background-image: url('<?=SITE_TEMPLATE_PATH?>/i/catalog-item-5.jpg');"></div>
							<div class="b-order-name b-order-text">Силиконовая форма для кекса и маффина</div>
							<div class="b-order-count b-order-text">15</div>
							<div class="b-order-sum b-order-text">2 700 ₽</div>
							<div class="b-order-status b-order-text green">Доставлено</div>
							<a href="#" class="b-order-repeat icon-thin-reload"></a>
							<a href="#" class="b-order-delete icon-delete"></a>
						</div>
					</div>
					<!-- <div class="b-btn-container">
						<a href="#" class="b-load-more icon-load">
							<p class="pink dashed">Показать все</p>
						</a>
					</div> -->
				</div>
				<div class="b-orders-header">История заказов</div>
				<div class="b-orders-list">
					<div class="b-orders-container">
						<div class="b-order-item">
							<div class="b-order-date b-order-text">03.12.2018 г.</div>
							<div class="b-order-img" style="background-image: url('<?=SITE_TEMPLATE_PATH?>/i/catalog-item-5.jpg');"></div>
							<div class="b-order-name b-order-text">Силиконовая форма для кекса и маффина</div>
							<div class="b-order-count b-order-text">15</div>
							<div class="b-order-sum b-order-text">2 700 ₽</div>
							<div class="b-order-status b-order-text green">Доставлено</div>
							<a href="#" class="b-order-repeat icon-thin-reload"></a>
							<a href="#" class="b-order-delete icon-delete"></a>
						</div>
						<div class="b-order-item">
							<div class="b-order-date b-order-text">03.12.2018 г.</div>
							<div class="b-order-img" style="background-image: url('<?=SITE_TEMPLATE_PATH?>/i/catalog-item-5.jpg');"></div>
							<div class="b-order-name b-order-text">Силиконовая форма для кекса и маффина</div>
							<div class="b-order-count b-order-text">15</div>
							<div class="b-order-sum b-order-text">2 700 ₽</div>
							<div class="b-order-status b-order-text green">Доставлено</div>
							<a href="#" class="b-order-repeat icon-thin-reload"></a>
							<a href="#" class="b-order-delete icon-delete"></a>
						</div>
					</div>
					<div class="b-btn-container">
						<a href="#" class="b-load-more icon-load">
							<p class="pink dashed">Показать все</p>
						</a>
					</div>
				</div>
			</div>
			<div class="b-tabs">
				<div id="b-cabinet-tab-slider" class="b-tabs-container b-tabs-container-underline tacenter">
					<div class="b-tab active" data-tab="myworks">Мои работы</div>
					<div class="b-tab" data-tab="myreviews">Мои отзывы</div>
					<div class="b-tab" data-tab="myquestions">Мои вопросы</div>
				</div>
				<div class="b-tab-item" id="myworks">
					<div class="myreviews-header">Мои работы</div>
					<div class="b-works-list b-cabinet-works-list">
						<div class="b-works-item-container">
							<a href="work.php" class="b-works-item">
								<div class="b-works-back" style="background-image:url('<?=SITE_TEMPLATE_PATH?>/i/works-4.jpg');"></div>
								<div class="b-works-back-gradient"></div>
								<div class="b-works-item-icons">
									<div class="b-works-item-icon icon-photo">21</div>
									<div class="b-works-item-icon icon-works-like">1500</div>
									<div class="b-works-item-icon icon-comment">350</div>
								</div>
							</a>
							<div class="b-work-name">Торт «Максимка»</div>
						</div>
						<div class="b-works-item-container">
							<a href="work.php" class="b-works-item">
								<div class="b-works-back" style="background-image:url('<?=SITE_TEMPLATE_PATH?>/i/works-2.jpg');"></div>
								<div class="b-works-back-gradient"></div>
								<div class="b-works-item-icons">
									<div class="b-works-item-icon icon-photo">1</div>
									<div class="b-works-item-icon icon-works-like">5</div>
									<div class="b-works-item-icon icon-comment">3</div>
								</div>
							</a>
							<div class="b-work-name">Торт «Максимка»</div>
						</div>
						<div class="b-works-item-container">
							<a href="work.php" class="b-works-item">
								<div class="b-works-back" style="background-image:url('<?=SITE_TEMPLATE_PATH?>/i/works-3.jpg');"></div>
								<div class="b-works-back-gradient"></div>
								<div class="b-works-item-icons">
									<div class="b-works-item-icon icon-photo">1</div>
									<div class="b-works-item-icon icon-works-like">5</div>
									<div class="b-works-item-icon icon-comment">3</div>
								</div>
							</a>
							<div class="b-work-name">Торт «Максимка»</div>
						</div>
						<div class="b-works-item-container">
							<a href="work.php" class="b-works-item">
								<div class="b-works-back" style="background-image:url('<?=SITE_TEMPLATE_PATH?>/i/works-1.jpg');"></div>
								<div class="b-works-back-gradient"></div>
								<div class="b-works-item-icons">
									<div class="b-works-item-icon icon-photo">1</div>
									<div class="b-works-item-icon icon-works-like">5</div>
									<div class="b-works-item-icon icon-comment">3</div>
								</div>
							</a>
							<div class="b-work-name">Торт «Максимка»</div>
						</div>
					</div>
					<div class="b-works-upload">
						<a href="#" class="b-load-more icon-load">
							<p class="pink dashed">Показать все</p>
						</a>
					</div>
				</div>
				<div class="b-tab-item hide" id="myreviews">
					<div class="myreviews-header">Мои отзывы</div>
					<div class="myreviews-list">
						<div class="myreviews-item">
							<div class="myreview-text">Приготовила на день рождения сына. Использовала кондитерские насадки 2М и 4М и плунжеры Бабочки, купленные в Первом магазине для кондитеров. Инструмент и ингедиенты качественные, все вышло отлично! Сын в восторге. Спасибо, что вы есть!</div>
							<div class="myreview-bottom">
								<div class="myreview-bottom-left">
									<a href="#" class="dashed">Посмотреть на странице</a>
								</div>
								<div class="myreview-bottom-right">
									<a href="#" class="myreview-like icon-like-up">5</a>
									<a href="#" class="myreview-dislike icon-dislike">3</a>
								</div>
							</div>
						</div>
						<div class="myreviews-item">
							<div class="myreview-text">Приготовила на день рождения сына. Использовала кондитерские насадки 2М и 4М и плунжеры Бабочки, купленные в Первом магазине для кондитеров. Инструмент и ингедиенты качественные, все вышло отлично! Сын в восторге. Спасибо, что вы есть!</div>
							<div class="myreview-bottom">
								<div class="myreview-bottom-left">
									<a href="#" class="dashed">Посмотреть на странице</a>
								</div>
								<div class="myreview-bottom-right">
									<a href="#" class="myreview-like icon-like-up">5</a>
									<a href="#" class="myreview-dislike icon-dislike">3</a>
								</div>
							</div>
						</div>
					</div>
					<div class="b-btn-container">
						<a href="#" class="b-load-more icon-load">
							<p class="pink dashed">Показать все</p>
						</a>
					</div>
				</div>
				<div class="b-tab-item hide" id="myquestions">
					<div class="myreviews-header">Мои Вопросы</div>
					<div class="b-faq-list">
						<div class="b-faq-item no-img">
							<div class="b-faq-header">Когда мне доставят заказ?
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
								<div class="b-faq-item-text no-answer">Администратор еще не ответил на ваш вопрос</div>
							</div>
						</div>
					</div>
					<div class="b-works-upload">
						<a href="#" class="b-load-more icon-load">
							<p class="pink dashed">Показать все</p>
						</a>
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