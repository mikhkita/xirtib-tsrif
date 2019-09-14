<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="b-popup b-popup-auth b-auth-page-form" id="b-popup-auth">
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