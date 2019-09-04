<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");

if( isset($_REQUEST["action"]) ){
	$APPLICATION->RestartBuffer();
	switch ($_REQUEST["action"]) {
		case "regSite":
			global $USER;
			$email = $_POST["reg_mail"];
			$password = $_POST["reg_pass"];
			$confirmPassword = $_POST["reg_pass2"];
			$post = $_POST["reg_post"];
			$uni = ($_POST['mod'] == "uni");
			$name = $_POST["reg_name"];

			if( $uni ){
				if( !$name ){
					echo json_encode(array('error' => array('reg_name' => 'Укажите ФИО'))); die();
				}
				if( !$email ){
					echo json_encode(array('error' => array('reg_mail' => 'Вы не ввели e-mail'))); die();
				}
				if( $password != $confirmPassword ){
					echo json_encode(array('error' => array('reg_pass' => 'Пароли не совпадают'))); die();
				}
				if( strlen($password) < 8 ){
					echo json_encode(array('error' => array('reg_pass' => 'Пароль не может быть меньше 8 символов'))); die();
				}
			}

			$arResult = $USER->Register($email, $name, "", $password, $confirmPassword, $email);

			if( $arResult["TYPE"] == "OK" ){
				$userId = intval($arResult["ID"]);

				$user = new CUser;
				$arFields = Array(
					"WORK_POSITION" => $post
				);

				$user->Update($userId, $arFields);

				if( $uni ){
					echo json_encode(array('success' => true, 'message' => 'Вы зарегистрировались. На вашу почту отправлено письмо для активации аккаунта.', 'action' => 'registration'));
				}else{
					echo json_encode(array(
						"error" => 0,
						"message" => "Вы зарегистрировались. На вашу почту отправлено письмо для активации аккаунта."
					));
				}
			}else{
				if( $uni ){
					echo json_encode(array('error' => array('reg_name' => $arResult["MESSAGE"])));
				}else{
					echo json_encode(array(
						"error" => 1,
						"message" => $arResult["MESSAGE"]
					));
				}
			}
			break;
		case "authSite":
			$APPLICATION->IncludeComponent(
				"bitrix:system.auth.form",
				"main",
				Array(
					"FORGOT_PASSWORD_URL" => "",
					"PROFILE_URL" => "/personal",
					"REGISTER_URL" => "",
					"SHOW_ERRORS" => "N"
				)
			);
			break;
		case "pwdSite":
			$login = $_REQUEST["pwd_mail"];

			$rsUser = CUser::GetByLogin($login);
			if( $arUser = $rsUser->Fetch() ){
				$hash = md5(rand().time());
				$data = array(
					"EMAIL" => $login,
					"USER_ID" => $arUser["ID"],
					"HASH" => $arUser["CHECKWORD"]
				);

				CEvent::Send("USER_PASS_REQUEST", "s1", $data);

				echo json_encode(array(
					"error" => 0,
					"message" => "На вашу почту отправлен новый пароль."
				));
			}else{
				echo json_encode(array(
					"error" => 1,
					"message" => "Введенный email не найден."
				));
			}
			break;
		case "updatePWD":
			$hash = $_REQUEST["hash"];
			$userId = $_REQUEST["user_id"];
			$newPass = $_REQUEST["new_pass"];

			$rsUser = CUser::GetByID($userId);
			$arUser = $rsUser->Fetch();

			if( $arUser["CHECKWORD"] == $hash ){
				$user = new CUser;
				$arFields = Array(
					"PASSWORD" => $newPass
				);

				if( $user->Update($userId, $arFields) ){
					echo json_encode(array(
						"error" => 0,
						"message" => "Пароль сохранён, войдите под новым паролем"
					));
				}else{
					echo json_encode(array(
						"error" => 1,
						// "message" => $arResult["MESSAGE"]
						"message" => "Ошибка смены пароля."
					));
				}
			}else{
				echo json_encode(array(
					"error" => 1,
					"message" => "Ошибка смены пароля."
				));
			}

			break;
		case "updateUser":

			$userID = $USER->GetID();

			$rsUser = CUser::GetByID($userID);
			$arUser = $rsUser->Fetch();

			$user = new CUser;
			$arFields = $_REQUEST['user'];

			if (empty($arFields['PASSWORD']) || $_REQUEST['change_pass'] !== 'on') {
				unset($arFields['PASSWORD']);
				unset($arFields['CONFIRM_PASSWORD']);
			}

			if ($arFields['PERSONAL_PHOTO']) {
				$arFile = CFile::MakeFileArray($_SERVER['DOCUMENT_ROOT'].'/upload/tmp/'.$arFields['PERSONAL_PHOTO']);
		        $arFile['del'] = "Y";           
		        $arFile['old_file'] = $arUser['PERSONAL_PHOTO']; 
		        $arFile["MODULE_ID"] = "main";
		        $arFields['PERSONAL_PHOTO'] = $arFile;	
			}

			if( $user->Update($userID, $arFields) ){
				// echo "1";
				echo json_encode(array(
					"result" => "success",
					"action" => "redirect",
					"redirect" => "/personal/"
				));
			}else{
				echo "0";
				// echo json_encode(array(
				// 	"error" => 1,
				// 	"message" => $arResult["MESSAGE"],
				// 	"message" => "Ошибка."
				// ));
			}

			break;
		case "logout":
			$USER->Logout();
			LocalRedirect($_REQUEST["redirect"]);
			break;
		
		default:
			# code...
			break;
	}
	die();
}

?><?$APPLICATION->IncludeComponent(
	"bitrix:sale.personal.section",
	"main",
	Array(
		"ACCOUNT_PAYMENT_ELIMINATED_PAY_SYSTEMS" => array("0"),
		"ACCOUNT_PAYMENT_PERSON_TYPE" => "1",
		"ACCOUNT_PAYMENT_SELL_SHOW_FIXED_VALUES" => "Y",
		"ACCOUNT_PAYMENT_SELL_TOTAL" => array("100","200","500","1000","5000",""),
		"ACCOUNT_PAYMENT_SELL_USER_INPUT" => "Y",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ALLOW_INNER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CHECK_RIGHTS_PRIVATE" => "N",
		"COMPATIBLE_LOCATION_MODE_PROFILE" => "N",
		"CUSTOM_PAGES" => "",
		"CUSTOM_SELECT_PROPS" => array(""),
		"MAIN_CHAIN_NAME" => "",
		"NAV_TEMPLATE" => "",
		"ONLY_INNER_FULL" => "N",
		"ORDERS_PER_PAGE" => "5",
		"ORDER_DEFAULT_SORT" => "STATUS",
		"ORDER_HIDE_USER_INFO" => array("0"),
		"ORDER_HISTORIC_STATUSES" => array("F"),
		"ORDER_REFRESH_PRICES" => "N",
		"ORDER_RESTRICT_CHANGE_PAYSYSTEM" => array("0"),
		"PATH_TO_BASKET" => "/personal/cart",
		"PATH_TO_CATALOG" => "/catalog/",
		"PATH_TO_CONTACT" => "/about/contacts",
		"PATH_TO_PAYMENT" => "/personal/order/payment",
		"PER_PAGE" => "20",
		"PROFILES_PER_PAGE" => "20",
		"PROP_1" => array(),
		"PROP_2" => array(),
		"SAVE_IN_SESSION" => "Y",
		"SEF_FOLDER" => "/personal/",
		"SEF_MODE" => "Y",
		"SEF_URL_TEMPLATES" => Array("account"=>"account/","index"=>"index.php","order_cancel"=>"cancel/#ID#","order_detail"=>"orders/#ID#","orders"=>"orders/","private"=>"private/","profile"=>"profiles/","profile_detail"=>"profiles/#ID#","subscribe"=>"subscribe/"),
		"SEND_INFO_PRIVATE" => "N",
		"SET_TITLE" => "Y",
		"SHOW_ACCOUNT_COMPONENT" => "N",
		"SHOW_ACCOUNT_PAGE" => "N",
		"SHOW_ACCOUNT_PAY_COMPONENT" => "N",
		"SHOW_BASKET_PAGE" => "N",
		"SHOW_CONTACT_PAGE" => "N",
		"SHOW_ORDER_PAGE" => "N",
		"SHOW_PRIVATE_PAGE" => "Y",
		"SHOW_PROFILE_PAGE" => "N",
		"SHOW_SUBSCRIBE_PAGE" => "N",
		"USER_PROPERTY_PRIVATE" => array(),
		"USE_AJAX_LOCATIONS_PROFILE" => "N"
	)
);?>
$userID = $USER->GetID();
$rsUser = CUser::GetByID($userID);
$arUser = $rsUser->Fetch();
$photo = array();
if ($arUser['PERSONAL_PHOTO']){
	$photo = CFile::ResizeImageGet($arUser['PERSONAL_PHOTO'], Array("width" => 266, "height" => 266), BX_RESIZE_IMAGE_EXACT, false, $arFilters );
}
?>

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
				<div class="b-orders-header">Текущие заказы</div>
				<div class="b-orders-list">
					<div class="b-orders-container">
						<div class="b-order-item">
							<div class="b-order-date b-order-text">03.12.2018 г.</div>
							<div class="b-order-img" style="background-image: url('<?=SITE_TEMPLATE_PATH?>/i/catalog-item-5.jpg');"></div>
							<div class="b-order-name b-order-text">Силиконовая форма для кекса и маффина</div>
							<div class="b-order-count b-order-text">15</div>
							<div class="b-order-sum b-order-text">2 700 ₽</div>
							<div class="b-order-status b-order-text pink">Ждет оплаты</div>
							<a href="#" class="b-order-repeat icon-thin-reload"><div class="b-hint">Повторить&nbsp;заказ</div></a>
							<a href="#" class="b-order-delete icon-delete"><div class="b-hint">Удалить&nbsp;заказ</div></a>
						</div>
						<div class="b-order-item">
							<div class="b-order-date b-order-text">03.12.2018 г.</div>
							<div class="b-order-img" style="background-image: url('<?=SITE_TEMPLATE_PATH?>/i/catalog-item-5.jpg');"></div>
							<div class="b-order-name b-order-text">Силиконовая форма для кекса и маффина</div>
							<div class="b-order-count b-order-text">15</div>
							<div class="b-order-sum b-order-text">2 700 ₽</div>
							<div class="b-order-status b-order-text blue">Оплачено</div>
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

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>