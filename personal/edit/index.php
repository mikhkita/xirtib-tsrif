<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Редактирование профиля");?>
<? 

if (isAuth()): 
	$rsUser = CUser::GetByID($USER->GetID());
	$arUser = $rsUser->Fetch();
	$photo = array();
	if ($arUser['PERSONAL_PHOTO']){
		$photo = CFile::ResizeImageGet($arUser['PERSONAL_PHOTO'], Array("width" => 266, "height" => 266), BX_RESIZE_IMAGE_EXACT, false, $arFilters );
	}
	$fullName = trim($arUser['NAME']);
?>

<div class="b-cabinet b-cabinet-edit">
	<div class="b-block">
		<div class="b-cabinet-profile">
			<?if(!empty($photo)):?>
				<div class="b-profile-photo has-photo" id="pickfilesEdit" style="background-image: url(<?=$photo['src']?>);">
			<?else:?>
				<div class="b-profile-photo icon-add-photo" id="pickfilesEdit">
			<?endif;?>
					<div class="b-profile-photo-back">
						<div class="icon-add-photo"></div>
						<div class="icon-change-photo hide"></div>
					</div>
				</div>
		</div>
		<div class="b-cabinet-content">
			<form action="/personal/?action=updateUser" method="POST" id="editForm" data-file-action="/addFile.php">
				<div class="b-inputs-3 clearfix">
					<div class="b-input">
						<input type="text" name="user[NAME]" placeholder="Фамилия Имя Отчество" value="<?=$fullName?>" required>
					</div>
					<div class="b-input">
						<input type="text" name="user[PERSONAL_PHONE]" placeholder="+7 (999) 999 0000" value="<?=convertPhoneNumber($arUser['PERSONAL_PHONE'])?>" required>
					</div>
					<div class="b-input">
						<input type="text" name="user[EMAIL]" placeholder="example@yandex.ru" value="<?=$arUser['EMAIL']?>" required>
					</div>
				</div>
				<div class="b-inputs-3 clearfix">
					<div class="b-checkbox edit-checkbox">
						<input type="checkbox" id="change_pass" name="change_pass">
						<label for="change_pass">Хочу сменить пароль</label>
					</div>
					<div class="pass-error red hide">
						<p>Минимальная длина пароля - 6&nbsp;символов</p>
					</div>
				</div>
				<div class="b-inputs-3 clearfix edit-pass-cont hide">
					<div class="b-input">
						<input type="password" id="pass" name="user[PASSWORD]" placeholder="Новый пароль" disabled>
					</div>
					<div class="b-input">
						<input type="password" id="confpass" name="user[CONFIRM_PASSWORD]" placeholder="Подтверждение пароля" disabled>
					</div>
				</div>
				<div class="b-inputs-3 clearfix">
					<div class="b-input b-input-btn">
						<a href="#" class="b-btn b-btn-save ajax">Сохранить изменения</a>
					</div>
				</div>
				
				<a href="#b-popup-save-success" class="b-thanks-link fancy" style="display:none;"></a>
				<a href="#b-popup-error-reg" class="b-error-link fancy" style="display:none;"></a>
			</form>
		</div>
	</div>
</div>
<? else: ?>
	<?LocalRedirect("/personal/");?>
<? endif; ?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>