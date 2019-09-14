<?if ( !$isMain):?>
	</div>
<?endif;?>
<div class="b-footer wave-top">
	<div class="b-block">
		<div class="b-bottom-menu">
			<div class="b-bottom-menu-list">
				<h4>О компании</h4>
				<ul>
					<?$APPLICATION->IncludeComponent("bitrix:menu", "bottom_menu", array(
						"ROOT_MENU_TYPE" => "footer-1",
						"MAX_LEVEL" => "1",
						"MENU_CACHE_TYPE" => "A",
						"CACHE_SELECTED_ITEMS" => "N",
						"MENU_CACHE_TIME" => "36000000",
						"MENU_CACHE_USE_GROUPS" => "Y",
						"MENU_CACHE_GET_VARS" => array(),
					),
						false
					);?>
					<!-- <li><a href="#" class="underline">О нас</a></li>
					<li><a href="#" class="underline">Новости магазина</a></li>
					<li><a href="#" class="underline">Сертификаты</a></li>
					<li><a href="#" class="underline">Преимущества</a></li>
					<li><a href="#" class="underline">Вакансии</a></li>
					<li><a href="#" class="underline">Блог</a></li> -->
				</ul>
			</div>
			<div class="b-bottom-menu-list">
				<h4>Покупателям</h4>
				<ul>
					<?$APPLICATION->IncludeComponent("bitrix:menu", "bottom_menu", array(
						"ROOT_MENU_TYPE" => "footer-2",
						"MAX_LEVEL" => "1",
						"MENU_CACHE_TYPE" => "A",
						"CACHE_SELECTED_ITEMS" => "N",
						"MENU_CACHE_TIME" => "36000000",
						"MENU_CACHE_USE_GROUPS" => "Y",
						"MENU_CACHE_GET_VARS" => array(),
					),
						false
					);?>
				</ul>
			</div>
			<?/*?>
			<div class="b-bottom-menu-list">
				<h4>Сотрудничество</h4>
				<ul>
					<li><a href="#" class="underline">Поставщикам</a></li>
					<li><a href="#" class="underline">Партнеры</a></li>
					<li><a href="#" class="underline">Франшиза</a></li>
				</ul>
			</div>
			<?*/?>
			<div class="b-bottom-menu-list">
				<h4>Следуйте за нами</h4>
				<div class="b-soc">
					<a href="http://vk.com" target="_blank" class="b-soc-item icon-vk"></a>
					<a href="http://facebook.com" target="_blank" class="b-soc-item icon-facebook"></a>
					<a href="http://instagram.com" target="_blank" class="b-soc-item icon-instagram"></a>
				</div>
			</div>
		</div>
		<div class="b-underfooter">
			<div class="b-underfooter-item left-underfooter-item">
				© 2002–2018 <a href="1KONDITER.RU" target="_blank" class="underline underfooter-link">1KONDITER.RU</a> – Первый магазин для кондитеров.<br>
				Все права защищены. Доставка по всей России!
			</div>
			<div class="b-underfooter-item">
				<a href="/politics/" class="underline politics-link">Политика конфиденциальности</a>
			</div>
		</div>
	</div>
</div>
<div class="b-menu-overlay" id="b-menu-overlay" style="display: none;"></div>
</div>
	<div style="display:none;">
		<a href="#b-popup-error" class="b-error-link fancy" style="display:none;"></a>
		
		<?$APPLICATION->IncludeComponent(
		   "bitrix:system.auth.authorize",
		   "",
		   Array(
		      "REGISTER_URL" => "",
		      "PROFILE_URL" => "/personal/",
		      "SHOW_ERRORS" => "Y",
		      "POPUP_ID" => 'b-popup-auth'
		   ),
		false
		);?>

		<?/*?>

		<div class="b-popup b-popup-auth" id="b-popup-auth">
			<div class="b b-addressee">
                <a href="#" class="b-addressee-switch"></a>
                <div class="b-btn-switch b-addressee-left active">Вход</div>
                <div class="b-btn-switch b-addressee-right">Регистрация</div>
                <div class="b-btn-addressee"></div>
            </div>
			<div class="b-form-container">
				<div id="b-form-auth" class="b-form-auth">
					<div class="b-underbtn-text">Войти через соцсети</div>
					<div class="b-popup-soc b-soc">
						<?
					    $arResult["AUTH_SERVICES"] = false;
					    if(CModule::IncludeModule("socialservices")) {
					      $oAuthManager = new CSocServAuthManager();
					      $arServices = $oAuthManager->GetActiveAuthServices($arResult);
					      if(!empty($arServices)) $arResult["AUTH_SERVICES"] = $arServices;
					    }

						if($arResult["AUTH_SERVICES"] && COption::GetOptionString("main", "allow_socserv_authorization", "Y") != "N"):?>
						      <?$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "",
						        array(
						          "AUTH_SERVICES"=>$arResult["AUTH_SERVICES"],
						          "AUTH_URL"=>$arResult["AUTH_URL"],
						          "POST"=>$arResult["POST"],
						          "POPUP"=>"Y",
						          "SUFFIX"=>"form",
						        ),
						        $component,
						        array("HIDE_ICONS"=>"Y")
						      );?>
						<?endif?>
						<!-- <a href="javascript:void(0)" onclick="BxShowAuthFloat('VKontakte', 'form')" class="b-soc-item icon-vk"></a> -->
						<!-- <a href="http://instagram.com" target="_blank" class="b-soc-item icon-ok"></a> -->
						<!-- <a href="http://facebook.com" target="_blank" class="b-soc-item icon-facebook"></a> -->
						<!-- <a href="http://google.com" target="_blank" class="b-soc-item icon-google"></a> -->
					</div>
					<form action="/personal/?action=authSite&login=yes" method="POST">
						<div class="b-msg-error"></div>
						<div class="b-popup-form">
							<input type="hidden" name="AUTH_FORM" value="Y">
			                <input type="hidden" name="TYPE" value="AUTH">
			                <input type="hidden" name="Login" value="Войти">
							<div class="b-input-string">
								<input type="text" class="b-popup-input" name="USER_LOGIN" placeholder="E-mail" required>
							</div>
							<div class="b b-input-string">
								<input type="password" class="b-popup-input" name="USER_PASSWORD" placeholder="Пароль" required>
								<a href="#" class="icon-eye"></a>
							</div>
							<div class="b-popup-checkbox-cont">
								<label class="checkbox">
									<input type="checkbox" value="remember">
									<span>Запомнить на этом компьютере</span>
								</label>
							</div>
							<input type="text" name="MAIL">
							<input type="submit" style="display:none;">
							<a href="#b-popup-success" class="b-thanks-link fancy" style="display:none;"></a>
						</div>
						<div class="b-btn-container">
							<a href="#" class="b-btn ajax">Войти</a>
						</div>
					</form>
				</div>
				<form action="/ajax/?action=REG" method="POST" id="b-form-reg" class="b-form-reg hide">
					<div class="b-msg-error"></div>
					<div class="b-popup-form">
						<div class="b-input-string">
							<input type="text" name="email" class="b-popup-input" placeholder="E-mail*" required>
						</div>
						<div class="b-input-string">
							<input type="password" name="password" class="b-popup-input" placeholder="Пароль" required>
						</div>
						<div class="b-popup-checkbox-cont"></div>
						<!-- <label class="checkbox">
							<input type="checkbox" value="exclusive">
							<span>Я хочу получать эксклюзивные предложения</span>
						</label>
						<label class="checkbox">
							<input type="checkbox" value="politics" required checked>
							<span>Я согласен с <a href="#" class="dashed">Политикой конфиденциальности</a></span>
						</label> -->
						<input type="text" name="MAIL">
						<input type="submit" style="display:none;">
						<a href="#b-popup-success" class="b-thanks-link fancy" style="display:none;"></a>
					</div>
					<div class="b-btn-container">
						<a href="#" class="b-btn ajax">Зарегистироваться</a>
					</div>
				</form>
			</div>
		</div>

		<div class="b-popup b-popup-auth" id="b-popup-auth">
			<div class="b-popup-header"><h3>Войдите</h3> или <a href="#b-popup-reg" onclick="$.fancybox.close();" class="fancy dashed">зарегистрируйтесь</a></div>
			<form action="/personal/?action=authSite&login=yes" method="POST" id="b-form-auth">
				<div class="b-msg-error"></div>
				<div class="b-popup-form">
					<input type="hidden" name="AUTH_FORM" value="Y">
	                <input type="hidden" name="TYPE" value="AUTH">
	                <input type="hidden" name="Login" value="Войти">
					<div class="b-input-container">
						<div class="b-input-string">
							<input type="text" id="login" name="USER_LOGIN" placeholder="Логин" required/>
						</div>
						<div class="b-input-string">
							<input type="password" id="password" name="USER_PASSWORD" placeholder="Пароль" required/>
						</div>
					</div>
					<a href="#b-popup-forget-password" class="fancy dashed forget" onclick="$.fancybox.close();">Забыли пароль?</a>
					<input type="submit" style="display:none;">
					<div class="b-btn-container">
						<a href="#" class="b-btn ajax">Войти</a>
					</div>
					<!-- <a href="#b-popup-success" class="b-thanks-link fancy" style="display:none;"></a> -->
				</div>
			</form>
		</div>

		<div class="b-popup" id="b-popup-reg">
			<div class="b-popup-header"><h3>Регистрация</h3></div>
			<form action="kitsend.php"method="POST" id="b-form-reg">
				<div class="b-popup-form">
					<div class="b-input-container">
						<div class="b-input-string">
							<input type="text" id="email" name="email" placeholder="E-mail" required/>
						</div>
						<div class="b-input-string">
							<input type="password" id="password" name="password" placeholder="Пароль" required/>
						</div>
					</div>
					<input type="submit" style="display:none;">
					<div class="b-btn-container">
						<a href="#" class="b-btn not-ajax">Готово</a>
					</div>
				</div>
			</form>
		</div>
		<?*/?>

		<div class="b-popup" id="b-popup-question">
			<div class="b-popup-header">
				<h3>У Вас есть вопрос?</h3>
				<p>Спросите - мы обязательно вам ответим!</p></div>
			<form action="/ajax/?action=ASK" method="POST" id="b-form-ask">
				<div class="b-popup-form">
					<div class="b-input-container">
						<div class="b-input-string">
							<input class="b-popup-input" type="text" name="ask-name" placeholder="Имя" required/>
						</div>
						<div class="b-input-string">
							<input class="b-popup-input" type="text" name="ask-email" placeholder="E-mail" required/>
						</div>
						<div class="b-input-string">
							<input class="b-popup-input" type="text" name="ask-phone" placeholder="Телефон" required/>
						</div>
						<div class="b-input-string">
							<textarea name="question" class="b-popup-input" placeholder="Ваш вопрос" rows="5"></textarea>
						</div>
						<input type="text" name="MAIL">
					</div>
					<input type="submit" style="display:none;">
					<div class="b-btn-container">
						<a href="#" class="b-btn ajax">Отправить</a>
					</div>
					<a href="#b-popup-success" class="b-thanks-link fancy" style="display:none;"></a>
				</div>
			</form>
		</div>

		<div class="b-popup" id="b-popup-phone">
			<div class="b-popup-header">
				<h3>Не дозвонились?</h3>
				<p>Оставьте заявку - мы обязательно вам перезвоним!</p></div>
			<form action="/ajax/?action=PHONE" method="POST" id="b-form-phone">
				<div class="b-popup-form">
					<div class="b-input-container">
						<div class="b-input-string">
							<input type="text" class="b-popup-input" name="phone-name" placeholder="Имя" required/>
						</div>
						<div class="b-input-string">
							<input type="text" class="b-popup-input" name="phone-phone" placeholder="Телефон" required/>
						</div>
						<input type="text" name="MAIL">
					</div>
					<input type="submit" style="display:none;">
					<div class="b-btn-container">
						<a href="#" class="b-btn ajax">Отправить</a>
					</div>
					<a href="#b-popup-success" class="b-thanks-link fancy" style="display:none;"></a>
				</div>
			</form>
		</div>
		<div class="b-popup b-popup-forget-password" id="b-popup-forget-password">
			<div class="b-popup-header"><h3>Восстановление пароля</h3></div>
			<form action="kitsend.php"method="POST" id="b-form-forget-pass">
				<div class="b-popup-form">
					<div class="b-input-container">
						<div class="b-input-string">
							<input type="text" name="name" placeholder="Имя или e-mail" required/>
						</div>
					</div>
					<input type="submit" style="display:none;">
					<div class="b-btn-container">
						<a href="#" class="b-btn not-ajax">Отправить</a>
					</div>
				</div>
			</form>
		</div>
		
		<?/*?>
		<div class="b-popup b-review-popup" id="b-review-form">
			<div class="b-popup-header"><h3>Оставьте отзыв</h3></div>
			<?if ($urlArr[2] == "assortment"):?>
			<form action="/ajax/?action=ADDREVIEW&review_id=1835" method="POST" id="b-form-review">
			<?elseif($urlArr[2] == "quality"):?>
			<form action="/ajax/?action=ADDREVIEW&review_id=1834" method="POST" id="b-form-review">
			<?else:?>
			<form action="/ajax/?action=ADDREVIEW&product_id=" method="POST" data-file-action="/local/templates/main/addFile.php" id="b-form-review">
			<?endif;?>
			<?if ($urlArr[1] == "catalog"):?>
				<div class="b-review-input">
					Насколько вы довольны покупкой?
					<div class="b-stars-detail">
						<div class="b-star"></div>
						<div class="b-star"></div>
						<div class="b-star"></div>
						<div class="b-star"></div>
						<div class="b-star"></div>
					</div>
					<input type="text" name="item-quality" required>
				</div>
			<?else:?>
				<div class="b-review-input">
					Насколько вы довольны магазином?
					<div class="b-stars-detail">
						<div class="b-star"></div>
						<div class="b-star"></div>
						<div class="b-star"></div>
						<div class="b-star"></div>
						<div class="b-star"></div>
					</div>
					<input type="text" name="store-quality" required>
				</div>
				<div class="b-review-input">
					Оцените качество товара.
					<div class="b-stars-detail">
						<div class="b-star"></div>
						<div class="b-star"></div>
						<div class="b-star"></div>
						<div class="b-star"></div>
						<div class="b-star"></div>
					</div>
					<input type="text" name="goods-quality" required>
				</div>
				<div class="b-review-input">
					Оцените вежливость и профессионализм операторов и менеджеров.
					<div class="b-stars-detail">
						<div class="b-star"></div>
						<div class="b-star"></div>
						<div class="b-star"></div>
						<div class="b-star"></div>
						<div class="b-star"></div>
					</div>
					<input type="text" name="manager-quality" required>
				</div>
				<div class="b-review-input">
					Оцените качество упаковки.
					<div class="b-stars-detail">
						<div class="b-star"></div>
						<div class="b-star"></div>
						<div class="b-star"></div>
						<div class="b-star"></div>
						<div class="b-star"></div>
					</div>
					<input type="text" name="pack-quality" required>
				</div>
				<div class="b-review-input">
					Оцените быстроту доставки и качество работы курьеров.
					<div class="b-stars-detail">
						<div class="b-star"></div>
						<div class="b-star"></div>
						<div class="b-star"></div>
						<div class="b-star"></div>
						<div class="b-star"></div>
					</div>
					<input type="text" name="courier-quality" required>
				</div>
			<?endif;?>
				<div class="b-input-string b-review-textarea">
					<textarea name="comment" cols="30" rows="5" placeholder="Комментарий покупателя. Опишите общее впечатление от конкретной покупки" required></textarea>
				</div>
				<div class="b-popup-form">
					<? if(!isAuth()): ?>
					<div class="b-input-container">
						<div class="b-input-string">
							<input type="text" name="name" placeholder="Ваше имя*" required/>
						</div>
						<div class="b-input-string">
							<input type="text" name="phone" placeholder="Ваш телефон*" required/>
						</div>
					</div>
					<?endif;?>
					<?if ($urlArr[1] == "catalog"):?>
					<div id="pluploadCont" class="b-btn b-brown-btn">
						<input id="original_filename" type="hidden" name="original_filename">
						<input id="random_filename" type="hidden" name="random_filename">
						<a class="attach" href="javascript:;" id="pickfiles">
							Выберите файл
						</a>
					</div>
				<?endif;?>
					<input type="text" name="MAIL">
					<input type="submit" style="display:none;">
					<div class="b-btn-container">
						<a href="#" class="b-btn ajax">Отправить</a>
					</div>
					<a href="#b-popup-success-review" class="b-thanks-link fancy" style="display:none;"></a>
				</div>
			</form>
		</div>
		<?*/?>

		<div class="b-thanks b-popup" id="b-popup-success">
			<div class="b-popup-header">
				<h3>Спасибо!</h3>
				<p>Ваша заявка успешно отправлена.<br/>Наш менеджер свяжется с Вами в течение часа.</p>
			</div>
			<div class="b-btn-container">
				<a href="#" class="b-btn ajax" onclick="$.fancybox.close(); return false;">Закрыть</a>
			</div>
		</div>
		<div class="b-thanks b-popup" id="b-gallery-success">
			<div class="b-popup-header">
				<h3>Спасибо!</h3>
				<p>Ваша работа успешно загружена.</p>
			</div>
			<div class="b-btn-container">
				<a href="#" class="b-btn ajax" onclick="$.fancybox.close(); return false;">Закрыть</a>
			</div>
		</div>
		<div class="b-thanks b-popup" id="b-email-success">
			<div class="b-popup-header">
				<h3>Спасибо!</h3>
				<p>Вы успешно подписались на рассылку новостей.</p>
			</div>
			<div class="b-btn-container">
				<a href="#" class="b-btn ajax" onclick="$.fancybox.close(); return false;">Закрыть</a>
			</div>
		</div>
		<div class="b-thanks b-popup" id="b-popup-error">
			<div class="b-popup-header">
				<h3>Ошибка!</h3>
			</div>
			<div class="b-btn-container">
				<a href="#" class="b-btn ajax" onclick="$.fancybox.close(); return false;">Закрыть</a>
			</div>
		</div>
		<div class="b-thanks b-popup" id="b-popup-success-review">
			<div class="b-popup-header">
				<h3>Спасибо!</h3>
				<p>Ваш отзыв успешно отправлен и будет опубликован после проверки модератором.</p>
			</div>
			<div class="b-btn-container">
				<a href="#" class="b-btn ajax" onclick="$.fancybox.close(); return false;">Закрыть</a>
			</div>
		</div>
		<div class="b-thanks b-popup" id="b-popup-success-comment">
			<div class="b-popup-header">
				<h3>Спасибо!</h3>
				<p>Ваш комментарий успешно отправлен и будет опубликован после проверки модератором.</p>
			</div>
			<div class="b-btn-container">
				<a href="#" class="b-btn ajax" onclick="$.fancybox.close(); return false;">Закрыть</a>
			</div>
		</div>
		<div class="b-thanks b-popup" id="b-popup-success-reserved">
			<div class="b-popup-header">
				<h3>Заявка оставлена!</h3>
				<p>Когда товар будет в наличии, Вам автоматически придет письмо на почту.</p>
			</div>
			<div class="b-btn-container">
				<a href="#" class="b-btn ajax" onclick="$.fancybox.close(); return false;">Закрыть</a>
			</div>
		</div>
		<div class="b-thanks b-popup" id="b-popup-error-reserved">
			<div class="b-popup-header">
				<h3>Произошла ошибка</h3>
				<p>Попробуйте оставить заявку на товар позднее.</p>
			</div>
			<div class="b-btn-container">
				<a href="#" class="b-btn ajax" onclick="$.fancybox.close(); return false;">Закрыть</a>
			</div>
		</div>
		<div class="b-thanks b-popup" id="b-question-success">
			<div class="b-popup-header">
				<h3>Вопрос отправлен!</h3>
				<p>Наш менеджер ответит вам в ближайшее время.</p>
			</div>
			<div class="b-btn-container">
				<a href="#" class="b-btn ajax" onclick="$.fancybox.close(); return false;">Закрыть</a>
			</div>
		</div>



		<div class="b-popup b-popup-city" id="b-popup-city">
			<div class="b-popup-h3">Выбор города</div>
			<form action="kitsend.php" method="POST" id="b-form-city">
				<div class="b-popup-form">
					<div class="b-input-string icon-search">
						<input type="text" class="b-popup-input" placeholder="Где вы находитесь?" required>
					</div>
					<div class="b-btn-container">
						<a href="#" class="b-btn b-btn-white ajax">Выбрать</a>
					</div>
					<input type="hidden" name="subject" value="Заказ"/>
					<input type="submit" style="display:none;">
					<a href="#b-popup-success" class="b-thanks-link fancy" style="display:none;"></a>
				</div>
			</form>
			<div class="b-popup-text">Найдите свой город через поиск или выберите из списка.</div>
			<div class="b-popup-city-list">
				<ul>
					<li><a href="#">Москва</a></li>
					<li><a href="#">Санкт-Петербург</a></li>
					<li><a href="#">Новосибирск</a></li>
					<li><a href="#">Ульяновск</a></li>
				</ul>
				<ul>
					<li><a href="#">Краснодар</a></li>
					<li><a href="#">Тюмень</a></li>
					<li><a href="#">Челябинск</a></li>
					<li><a href="#">Хабаровск</a></li>
				</ul>
				<ul>
					<li><a href="#">Томск</a></li>
					<li><a href="#">Нижний Новгород</a></li>
					<li><a href="#">Пермь</a></li>
					<li><a href="#">Иркутск</a></li>
				</ul>
			</div>
		</div>
		<div class="b-popup b-popup-present" id="b-popup-present">
			<div class="b-popup-present-top">
				<div class="b-popup-present-img" style="background-image: url('<?=SITE_TEMPLATE_PATH?>/i/catalog-item-2.jpg');"></div>
				<div class="b-popup-present-right">
					<div class="b-popup-h3">Молд силиконовый для выпечки «Доляна»</div>
					<div class="b-popup-text">При покупке от 2 000 рублей</div>
					<div class="b-popup-limit-text">Акция действует до 15 августа</div>
				</div>
			</div>
			<div class="b-popup-present-bottom">
				<div class="b-popup-text">Для получения подарка необходимо приобрести товары из этой подборки на сумму от 1 600 рублей. Все товары, учавствующие в накоплении, имеют специальную отметку. Акция проходит только в интернет-магазине и завершается с окончанием подарков. Количество подарков ограничено.</div>
			</div>
			<div class="b-btn-container">
				<a href="#" onclick="$.fancybox.close(); return false;" class="b-btn b-btn-close">Закрыть</a>
			</div>
		</div>
		<div class="b-popup b-popup-sale" id="b-popup-sale">
			<div class="b-popup-sale-img" style="background-image: url(i/news-item-4.jpg);"></div>
			<div class="b-popup-sale-header">Время работает на вас!</div>
			<div class="b-popup-sale-limit">Акция действует до 25 августа</div>
			<div class="b-popup-sale-text"><b>Скидка 5% при оплате в день заказа.</b> Оплатите товар в день заказа и получите скидку 5%. Акция не распространяется на товары со скидкой.</div>
			<div class="b-btn-container">
				<a href="#" onclick="$.fancybox.close(); return false;" class="b-btn b-btn-close">Закрыть</a>
			</div>
		</div>
		<div class="b-popup b-popup-pay" id="b-popup-pay">
			<div class="b-btn-container">
				<div class="b-popup-h3">Оплата банковской картой Онлайн</div>
			</div>
			<div class="b-popup-pay-text">Вы можете оплатить покупку на сайте в момент оформления заказа или воспользоваться сервисом Сбербанк Онлайн. Комиссия при переводе через Сбребанк Онлайн составляет 1% от суммы. Возможна отправка в долларах и евро по курсу банка.</div>
			<div class="b-btn-container">
				<a href="#" onclick="$.fancybox.close(); return false;" class="b-btn b-btn-close">Закрыть</a>
			</div>
		</div>
		<div class="b-popup b-popup-work" id="b-popup-work">
			<div class="b-popup-work-top">
				<div class="b-popup-work-img" style="background-image: url('<?=SITE_TEMPLATE_PATH?>/i/works-1.jpg');"></div>
				<div class="b-popup-work-right">
					<div class="b-popup-h3">Торт «Максимка»</div>
					<div class="b-popup-text">Приготовила на день рождения сына. Использовала кондитерские насадки 2М и 4М и плунжеры Бабочки, купленные в Первом магазине для кондитеров. Инструмент и ингедиенты качественные, все вышло отлично! Сын в восторге. Спасибо, что вы есть!</div>
				</div>
			</div>
			<div class="b-popup-work-bottom">
				<div class="b-popup-text">Для получения подарка необходимо приобрести товары из этой подборки на сумму от 1 600 рублей. Все товары, учавствующие в накоплении, имеют специальную отметку. Акция проходит только в интернет-магазине и завершается с окончанием подарков. Количество подарков ограничено.</div>
			</div>
			<div class="b-btn-container">
				<a href="#" onclick="$.fancybox.close(); return false;" class="b-btn b-btn-close">Закрыть</a>
			</div>
		</div>
		<div class="b-popup b-popup-add-work" id="b-popup-add-work">
			<h4>Загрузить работу</h4>
			<form action="/ajax/?action=ADDWORK" method="POST" id="b-popup-add-work-form" class="b-popup-add-work-form" data-file-action="/local/templates/main/addFile.php">
				<div class="b-popup-add-work-block b-popup-add-work-block-left">
					<div id="add-photo">
						<a href="javascript:;" id="pickfiles" class="b-popup-add-link b-popup-add-link__big icon-add-photo attach"></a>
					</div>
					<div id="b-popup-add-photo-list" class="b-popup-add-photo-list">
						
					</div>
				</div>
				<div class="b-popup-add-work-block">
					<div class="b-input-string">
						<input type="text" id="work-name" class="b-popup-input" name="work-name" placeholder="Название работы*" required/>
					</div>
					<div class="b-input-string">
						<textarea name="text" id="work-comment" rows="5" class="b-popup-input" placeholder="Описание работы"></textarea>
					</div>
					<div class="b-input-string">
						<label class="checkbox">
						  <input type="checkbox" name="no-comment">
						  <span>Запретить комментарии</span>
						</label>
					</div>
					<div class="b-btn-container">
						<a href="#" class="b-btn ajax">
							<p class="icon-upload">Опубликовать</p>
						</a>
					</div>
				</div>
				<a href="#b-gallery-success" class="b-thanks-link fancy" style="display:none;"></a>
			</form>
			<div class="b-btn-container">
				<a href="#" onclick="$.fancybox.close(); return false;" class="b-btn b-btn-close">Закрыть</a>
			</div>
		</div>
		<div class="b-popup b-popup-delete" id="b-popup-delete">
			<div class="b-popup-sale-header">Вы точно хотите удалить работу?</div>
			<div class="b-btn-container">
				<a href="#" onclick="$.fancybox.close(); return false;" class="b-btn icon-delete">Удалить</a>
			</div>
			<div class="b-btn-container">
				<a href="#" onclick="$.fancybox.close(); return false;" class="b-btn b-btn-close icon-arrow">Отменить</a>
			</div>
		</div>
	</div>
	<!-- <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery-3.2.1.min.js"></script> -->

	<script type="text/javascript" src="/bitrix/js/main/jquery/jquery-1.8.3.min.js"></script>
	
	<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery.fancybox.min.js"></script>
	<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery.formstyler.min.js"></script>
	<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/chosen.jquery.min.js"></script>
	<script type="text/javascript" src="//maps.google.com/maps/api/js?sensor=false&key=AIzaSyD6Sy5r7sWQAelSn-4mu2JtVptFkEQ03YI"></script>
	<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery.touch.min.js"></script>
	<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery.maskedinput.min.js"></script>
	<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery-ui.min.js"></script>
	<!-- <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/jquery.autosize.input.min.js"></script> -->
	<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/autosize.min.js"></script>
	<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/plupload.full.min.js"></script>
	<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/KitAnimate.js"></script>
	<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/KitProgress.js"></script>
	<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/slideout.min.js"></script>
	<? if( !(strpos($_SERVER['HTTP_USER_AGENT'],'MSIE')!==false || strpos($_SERVER['HTTP_USER_AGENT'],'rv:11.0')!==false) ): ?>
	<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/mask.js"></script>
	<? endif; ?>
	<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/KitSend.js?<?=$GLOBALS["version"]?>"></script>
	<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/slick.js"></script>
	<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/stickyfill.js"></script>
	<? if( isset( $GLOBALS["depends"][$GLOBALS["page"]] ) ): ?>
		<? foreach ($GLOBALS["depends"][$GLOBALS["page"]]["js"] as $scriptName): ?>
			<script type="text/javascript" src="<?=$scriptName?>"></script>
		<? endforeach; ?>
	<? endif; ?>
	<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/main.js?<?=$GLOBALS["version"]?>"></script>
</body>
</html>

<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
if(defined("ERROR_404") && ERROR_404 == "Y" && $APPLICATION->GetCurPage(true) !='/404.php') LocalRedirect('/404.php');
?>