<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Подарки");?>

<div class="b-block">
	<div class="b-tabs-container-underline b-tab-links">
		<a href="/stocks/" class="b-tab">
			<span>Акции</span>
		</a>
		<a href="/presents/" class="b-tab active">
			<span>Подарки</span>
		</a>
		<a href="/sale/" class="b-tab">
			<span>Товары со скидкой</span>
		</a>
	</div>
	<div class="b-catalog-preview b-subcategory-catalog-preview pagination-container">
		<div class="b-presents-text">
			<h3>Подарки с покупкой</h3>
			<p>Вы покупаете — мы благодарим: приобретайте товары со значком + Подарок на определённую сумму и получайте презенты! Внимательно ознакомьтесь с условиями акции.</p>
		</div>
		<?
			$discountIterator = Bitrix\Sale\Internals\DiscountTable::getList(array(
                'select' => array('*'),
                'filter' => array('XML_ID' => "GIFT"),
                'order' => array('ACTIVE_TO' => "ASC")
            ));

            $i = 0;
            $arDiscountItems = array();

            while ($discount = $discountIterator->fetch()) {

                foreach($discount['ACTIONS_LIST']["CHILDREN"][0]["CHILDREN"][0]["DATA"]["Value"] as $itemID){
					$arDiscountItems[$i]['ID'] = $itemID;

					$res = CIBlockElement::GetByID($itemID);
					if($arRes = $res->GetNext()){
						$images = getElementImages($arRes, true);
						$arDiscountItems[$i]['NAME'] = $arRes['NAME'];
						$arDiscountItems[$i]['IMG'] = $images["DETAIL_PHOTO"][0]["SMALL"];
						$arDiscountItems[$i]['DETAIL_PAGE_URL'] = $arRes['DETAIL_PAGE_URL'];
					}

					$arDiscountItems[$i]['PRICE'] = $discount['CONDITIONS_LIST']["CHILDREN"][0]["DATA"]["Value"];
					if (isset($discount['ACTIVE_TO'])){
						$arDiscountItems[$i]['ACTIVE_TO_DAY'] = $discount['ACTIVE_TO']->format("d");
						$arDiscountItems[$i]['ACTIVE_TO_MONTH'] = getRusMonth($discount['ACTIVE_TO']->format("m"));
					}

					$i ++;
				}
            }

		?>
		<div class="b-catalog-list">
			<? foreach ($arDiscountItems as $key => $discount): ?>
				<a href="<?=$discount['DETAIL_PAGE_URL']?>" class="b-catalog-item b-present-item">
					<div class="b-catalog-back"></div>
					<div class="b-catalog-img" style="background-image:url('<?=$discount['IMG']?>');"></div>
					<div class="b-catalog-item-top">
						<? if (isset($discount['ACTIVE_TO_DAY']) && isset($discount['ACTIVE_TO_MONTH'])): ?>
							<p class="red-text">Акция действует до <?=$discount['ACTIVE_TO_DAY']?> <?=$discount['ACTIVE_TO_MONTH']?></p>
						<? endif; ?>
						<h6><?=$discount['NAME']?></h6>
						<p>При покупке от <?=convertPrice($discount['PRICE'])?> рублей</p>
					</div>
				</a>
			<? endforeach; ?>
		</div>

	</div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>