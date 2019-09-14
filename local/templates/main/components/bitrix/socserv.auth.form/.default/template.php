<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
$arAuthServices = $arPost = array();

if(is_array($arParams["~AUTH_SERVICES"]))
{
	$arAuthServices = $arParams["~AUTH_SERVICES"];
}
if(is_array($arParams["~POST"]))
{
	$arPost = $arParams["~POST"];
}

?>
<div class="bx-auth">
	<form method="post" name="bx_auth_services<?=$arParams["SUFFIX"]?>" target="_top" action="<?=$arParams["AUTH_URL"]?>">
		<?foreach($arAuthServices as $service):?>
			<a href="javascript:void(0)" onclick="<?=$service['ONCLICK']?>" class="b-soc-item icon-<?=$service['ICON']?>"></a>
		<?endforeach?>
		<?foreach($arPost as $key => $value):?>
			<?if(!preg_match("|OPENID_IDENTITY|", $key)):?>
				<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
			<?endif;?>
		<?endforeach?>
		<input type="hidden" name="auth_service_id" value="" />
	</form>
</div>