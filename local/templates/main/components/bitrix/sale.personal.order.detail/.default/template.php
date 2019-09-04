<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Localization\Loc,
	Bitrix\Main\Page\Asset;

if ($arParams['GUEST_MODE'] !== 'Y')
{
	Asset::getInstance()->addJs("/bitrix/components/bitrix/sale.order.payment.change/templates/.default/script.js");
	Asset::getInstance()->addCss("/bitrix/components/bitrix/sale.order.payment.change/templates/.default/style.css");
}
$this->addExternalCss("/bitrix/css/main/bootstrap.css");

CJSCore::Init(array('clipboard', 'fx'));

if (!empty($arResult['ERRORS']['FATAL']))
{
	foreach ($arResult['ERRORS']['FATAL'] as $error)
	{
		ShowError($error);
	}

	$component = $this->__component;

	if ($arParams['AUTH_FORM_IN_TEMPLATE'] && isset($arResult['ERRORS']['FATAL'][$component::E_NOT_AUTHORIZED]))
	{
		$APPLICATION->AuthForm('', false, false, 'N', false);
	}
}
else
{
	if (!empty($arResult['ERRORS']['NONFATAL']))
	{
		foreach ($arResult['ERRORS']['NONFATAL'] as $error)
		{
			ShowError($error);
		}
	}
	?>
	<div class="sale-order-detail">
		<div class="sale-order-detail-title-container">
			<!-- <h1 class="sale-order-detail-title-element">
				<?= Loc::getMessage('SPOD_LIST_MY_ORDER', array(
					'#ACCOUNT_NUMBER#' => htmlspecialcharsbx($arResult["ACCOUNT_NUMBER"]),
					'#DATE_ORDER_CREATE#' => $arResult["DATE_INSERT_FORMATED"]
				)) ?>
			</h1> -->
		</div>
		<?

		$date = $arResult['DATE_INSERT']->format($arParams['ACTIVE_DATE_FORMAT']);
		$arDate = explode(".", $date);
		$date = $arDate[0]." ".getRusMonth($arDate[1])." ".$arDate[2];

		foreach($arResult["BASKET"] as $item){
			$price += $item["BASE_PRICE"]*$item["QUANTITY"];
			$discount += $item["DISCOUNT_PRICE"]*$item["QUANTITY"];
		}
		
		$discount = round($discount);

		$arOrder = Bitrix\Sale\Order::load($arResult['ID']);
		$propertyCollection = $arOrder->getPropertyCollection();
		$temp = $propertyCollection->getArray(); 

		foreach ($temp["properties"] as $arProp) {
			if ($arProp["CODE"] == "STATUS_MORE") {
				if (!empty($arProp['VALUE'][0])) {
					$status = $arResult["STATUS"]['NAME']. ", ".$arProp['VALUE'][0];
				} else {
					$status = $arResult["STATUS"]['NAME'];
				}
			}
			if ($arProp["CODE"] == "TRACKING"){
				if (!empty($arProp['VALUE'][0])){
					$tracking = $arProp['VALUE'][0];
				}
			}
			if ($arProp["CODE"] == "OPERATOR"){
				if (!empty($arProp['VALUE'][0])){
					$operator = $arProp['VALUE'][0];
				}
			}
		}

		$APPLICATION->SetTitle('Заказ № '.$arResult["ACCOUNT_NUMBER"].' от '.$date);

		?>
		<div class="b-order-history-item">
			<div class="b-order-history-column b-order-history-1-column">
				<div class="b-order-history-column-top">
					Заказ № <b><?=$arResult['ACCOUNT_NUMBER']?> от <?=$date?></b>
				</div>
				<div class="b-order-history-column-bottom">
					Вид доставки: <?=$arResult['SHIPMENT'][0]["DELIVERY_NAME"]?><br>
					Номер отправления: <?=$tracking?><br>
					Оператор: <?=$operator?>
				</div>
			</div>
			<div class="b-order-history-column b-order-history-3-column">
				<div class="b-order-history-column-top">
					Статус: <div class="b-history-status"><?=$status?></div>
				</div>
				<div class="b-order-history-column-bottom">
					Сумма без скидки: <?=convertPrice($price)?> <span class="icon-rub"></span><br>
					<? if ($discount != 0 ): ?>
						Скидка: <?=convertPrice($discount)?> <span class="icon-rub"></span><br>
					<? endif; ?>
					Стоимость доставки: <?=convertPrice($arResult['SHIPMENT'][0]["PRICE_DELIVERY"])?> <span class="icon-rub"></span><br>
					Итого: <b><?=convertPrice($arResult["PRICE"])?>&nbsp;<span class="icon-rub"></span></b>
				</div>
			</div>
		</div>
		<div class="col-md-12 col-sm-12 col-xs-12 sale-order-detail-general">
			<div class="row sale-order-detail-payment-options-order-content">

				<div class="col-md-12 col-sm-12 col-xs-12 sale-order-detail-payment-options-order-content-container">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12 sale-order-detail-payment-options-order-content-title">
							<h3 class="sale-order-detail-payment-options-order-content-title-element">
								<?= Loc::getMessage('SPOD_ORDER_BASKET')?>
							</h3>
						</div>
						<div class="sale-order-detail-order-section bx-active">
							<div class="sale-order-detail-order-section-content container-fluid">
								<div class="sale-order-detail-order-table-fade sale-order-detail-order-table-fade-right">
									<div style="width: 100%; overflow-x: auto; overflow-y: hidden;">
										<div class="sale-order-detail-order-item-table">
											<div class="sale-order-detail-order-item-tr hidden-sm hidden-xs">
												<div class="sale-order-detail-order-item-td" style="padding-bottom: 5px;">
													<div class="sale-order-detail-order-item-td-title">
														<?= Loc::getMessage('SPOD_NAME')?>
													</div>
												</div>
												<div class="sale-order-detail-order-item-nth-4p1"></div>
												<div class="sale-order-detail-order-item-td sale-order-detail-order-item-properties bx-text-right" style="padding-bottom: 5px;">
													<div class="sale-order-detail-order-item-td-title">
														<?= Loc::getMessage('SPOD_PRICE')?>
													</div>
												</div>
												<?/*
												if (strlen($arResult["SHOW_DISCOUNT_TAB"]))
												{
													?>
													<div class="sale-order-detail-order-item-td sale-order-detail-order-item-properties bx-text-right"
														 style="padding-bottom: 5px;">
														<div class="sale-order-detail-order-item-td-title">
															<?= Loc::getMessage('SPOD_DISCOUNT') ?>
														</div>
													</div>
													<?
												}*/
												?>
												<div class="sale-order-detail-order-item-td sale-order-detail-order-item-properties bx-text-right" style="padding-bottom: 5px;">
													<div class="sale-order-detail-order-item-td-title">
														<?= Loc::getMessage('SPOD_QUANTITY')?>
													</div>
												</div>
												<div class="sale-order-detail-order-item-td sale-order-detail-order-item-properties bx-text-right" style="padding-bottom: 5px;">
													<div class="sale-order-detail-order-item-td-title">
														<?= Loc::getMessage('SPOD_ORDER_PRICE')?>
													</div>
												</div>
											</div>
											<?
											foreach ($arResult['BASKET'] as $basketItem)
											{
												?>
												<div class="sale-order-detail-order-item-tr sale-order-detail-order-basket-info sale-order-detail-order-item-tr-first">
													<div class="sale-order-detail-order-item-td" style="min-width: 300px;">
														<div class="sale-order-detail-order-item-block">
															<div class="sale-order-detail-order-item-img-block">
																<a href="<?=$basketItem['DETAIL_PAGE_URL']?>">
																	<?
																	if (strlen($basketItem['PICTURE']['SRC']))
																	{
																		$imageSrc = $basketItem['PICTURE']['SRC'];
																	}
																	else
																	{
																		$imageSrc = $this->GetFolder().'/images/no_photo.png';
																	}
																	?>
																	<div class="sale-order-detail-order-item-imgcontainer"
																		 style="background-image: url(<?=$imageSrc?>);
																			 background-image: -webkit-image-set(url(<?=$imageSrc?>) 1x,
																			 url(<?=$imageSrc?>) 2x)">
																	</div>
																</a>
															</div>
															<div class="sale-order-detail-order-item-content">
																<div class="sale-order-detail-order-item-title">
																	<a href="<?=$basketItem['DETAIL_PAGE_URL']?>">
																		<?=htmlspecialcharsbx($basketItem['NAME'])?>
																	</a>
																</div>
																<?
																if (isset($basketItem['PROPS']) && is_array($basketItem['PROPS']))
																{
																	foreach ($basketItem['PROPS'] as $itemProps)
																	{
																		?>
																		<div class="sale-order-detail-order-item-color">
																		<span class="sale-order-detail-order-item-color-name">
																			<?=htmlspecialcharsbx($itemProps['NAME'])?>:</span>
																			<span class="sale-order-detail-order-item-color-type">
																			<?=htmlspecialcharsbx($itemProps['VALUE'])?></span>
																		</div>
																		<?
																	}
																}
																?>
															</div>
														</div>
													</div>
													<div class="sale-order-detail-order-item-nth-4p1"></div>
													<div class="sale-order-detail-order-item-td sale-order-detail-order-item-properties bx-text-right">
														<div class="sale-order-detail-order-item-td-title col-xs-7 col-sm-5 visible-xs visible-sm">
															<?= Loc::getMessage('SPOD_PRICE')?>
														</div>
														<div class="sale-order-detail-order-item-td-text">
															<strong class="bx-price"><?=convertPrice($basketItem['BASE_PRICE'])?>&nbsp;<span class="icon-rub"></span></strong>
														</div>
													</div>
													<?/*
													if (strlen($basketItem["DISCOUNT_PRICE_PERCENT_FORMATED"]))
													{
														?>
														<div class="sale-order-detail-order-item-td sale-order-detail-order-item-properties bx-text-right">
															<div class="sale-order-detail-order-item-td-title col-xs-7 col-sm-5 visible-xs visible-sm">
																<?= Loc::getMessage('SPOD_DISCOUNT') ?>
															</div>
															<div class="sale-order-detail-order-item-td-text">
																<strong class="bx-price"><?= $basketItem['DISCOUNT_PRICE_PERCENT_FORMATED'] ?></strong>
															</div>
														</div>
														<?
													}
													elseif (strlen($arResult["SHOW_DISCOUNT_TAB"]))
													{
														?>
														<div class="sale-order-detail-order-item-td sale-order-detail-order-item-properties bx-text-right">
															<div class="sale-order-detail-order-item-td-title col-xs-7 col-sm-5 visible-xs visible-sm">
																<?= Loc::getMessage('SPOD_DISCOUNT') ?>
															</div>
															<div class="sale-order-detail-order-item-td-text">
																<strong class="bx-price"></strong>
															</div>
														</div>
														<?
													}*/
													?>
													<div class="sale-order-detail-order-item-td sale-order-detail-order-item-properties bx-text-right">
														<div class="sale-order-detail-order-item-td-title col-xs-7 col-sm-5 visible-xs visible-sm">
															<?= Loc::getMessage('SPOD_QUANTITY')?>
														</div>
														<div class="sale-order-detail-order-item-td-text">
														<span><?=$basketItem['QUANTITY']?>&nbsp;
															<?
															if (strlen($basketItem['MEASURE_NAME']))
															{
																echo htmlspecialcharsbx($basketItem['MEASURE_NAME']);
															}
															else
															{
																echo Loc::getMessage('SPOD_DEFAULT_MEASURE');
															}
															?></span>
														</div>
													</div>
													<div class="sale-order-detail-order-item-td sale-order-detail-order-item-properties bx-text-right">
														<div class="sale-order-detail-order-item-td-title col-xs-7 col-sm-5 visible-xs visible-sm"><?= Loc::getMessage('SPOD_ORDER_PRICE')?></div>
														<div class="sale-order-detail-order-item-td-text">
															<strong class="bx-price all"><?=convertPrice($basketItem['BASE_PRICE'] * $basketItem["QUANTITY"])?>&nbsp;<span class="icon-rub"></span></strong>
														</div>
													</div>
												</div>
												<?
											}
											?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row sale-order-detail-total-payment">
				<div class="col-md-7 col-md-offset-5 col-sm-12 col-xs-12 sale-order-detail-total-payment-container">
					<div class="row">
						<ul class="col-md-8 col-sm-6 col-xs-6 sale-order-detail-total-payment-list-left">
							<?
							if (floatval($arResult["ORDER_WEIGHT"]))
							{
								?>
								<li class="sale-order-detail-total-payment-list-left-item">
									<?= Loc::getMessage('SPOD_TOTAL_WEIGHT')?>:
								</li>
								<?
							}

							if ($arResult['PRODUCT_SUM_FORMATED'] != $arResult['PRICE_FORMATED'] && !empty($arResult['PRODUCT_SUM_FORMATED']))
							{
								?>
								<li class="sale-order-detail-total-payment-list-left-item">
									<?= Loc::getMessage('SPOD_COMMON_SUM')?>:
								</li>
								<?
							}

							if ($discount != 0 ):
								 ?><li class="sale-order-detail-total-payment-list-left-item">Скидка:</li><? 
							endif;

							if (strlen($arResult["PRICE_DELIVERY_FORMATED"]))
							{
								?>
								<li class="sale-order-detail-total-payment-list-left-item">
									<?= Loc::getMessage('SPOD_DELIVERY')?>:
								</li>
								<?
							}

							if ((float)$arResult["TAX_VALUE"] > 0)
							{
								?>
								<li class="sale-order-detail-total-payment-list-left-item">
									<?= Loc::getMessage('SPOD_TAX') ?>:
								</li>
								<?
							}
							?>
							<li class="sale-order-detail-total-payment-list-left-item"><?= Loc::getMessage('SPOD_SUMMARY')?>:</li>
						</ul>
						<ul class="col-md-4 col-sm-6 col-xs-6 sale-order-detail-total-payment-list-right">
							<?
							if (floatval($arResult["ORDER_WEIGHT"]))
							{
								?>
								<li class="sale-order-detail-total-payment-list-right-item"><?= $arResult['ORDER_WEIGHT_FORMATED'] ?></li>
								<?
							}

							if ($arResult['PRODUCT_SUM_FORMATED'] != $arResult['PRICE_FORMATED'] && !empty($arResult['PRODUCT_SUM_FORMATED']))
							{

								?>
								<li class="sale-order-detail-total-payment-list-right-item order-item-pr"><?=convertPrice($price)?>&nbsp;<span class="icon-rub"></span></li>
							<?
							}
							?>
							<? if ($discount != 0 ): ?>
									<li class="sale-order-detail-total-payment-list-right-item order-item-pr"><?=convertPrice($discount)?>&nbsp;<span class="icon-rub"></span></li>
							<? endif; ?>
							<?
							if (strlen($arResult["PRICE_DELIVERY_FORMATED"]))
							{
								?>
								<li class="sale-order-detail-total-payment-list-right-item order-item-pr"><?=convertPrice($arResult["PRICE_DELIVERY"]);?>&nbsp;<span class="icon-rub"></span></li>
								<?
							}

							if ((float)$arResult["TAX_VALUE"] > 0)
							{
								?>
								<li class="sale-order-detail-total-payment-list-right-item order-item-pr"><?=convertPrice($arResult["TAX_VALUE"]);?>&nbsp;<span class="icon-rub"></span></li>
								<?
							}
							?>
							<li class="sale-order-detail-total-payment-list-right-item order-item-pr"><?=convertPrice($arResult['PRICE'])?>&nbsp;<span class="icon-rub"></span></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<?
		if ($arParams['GUEST_MODE'] !== 'Y' && $arResult['LOCK_CHANGE_PAYSYSTEM'] !== 'Y')
		{
			?>
			<a class="sale-order-detail-back-to-list-link-down" href="<?= $arResult["URL_TO_LIST"] ?>">&larr; <?= Loc::getMessage('SPOD_RETURN_LIST_ORDERS')?></a>
			<?
		}
		?>
		<a class="b-repeat-order" href="<?= $arResult["URL_TO_COPY"] ?>">Повторить&nbsp;заказ</a>
	</div>
	<?
	$javascriptParams = array(
		"url" => CUtil::JSEscape($this->__component->GetPath().'/ajax.php'),
		"templateFolder" => CUtil::JSEscape($templateFolder),
		"templateName" => $this->__component->GetTemplateName(),
		"paymentList" => $paymentData
	);
	$javascriptParams = CUtil::PhpToJSObject($javascriptParams);
	?>
	<script>
		BX.Sale.PersonalOrderComponent.PersonalOrderDetail.init(<?=$javascriptParams?>);
	</script>
<?
}
?>

