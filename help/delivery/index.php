<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Доставка и оплата");?>

<div class="b-subcategory b-rounded-tiles-block b-delivery-block">
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
				<h3>Доставляем в 1100 городов России и в страны СНГ</h3>
				<div class="b-delivery-select-container">
					<?/*?>
					<div class="b-delivery-select b-sort-item">
						<div class="b-sort-select icon-marker">
							<select name="type">
								<option value="spb">Санкт-Петербург</option>
								<option value="tomsk">Томск</option>
								<option value="moscow">Москва</option>
							</select>
						</div>
					</div>
					<div class="b-delivery-select-label">
						Закажите до 14:00 – доставим завтра
					</div>
					<?*/?>
				</div>
				<div class="b-rounded-tile-list">
					<a href="#delivery-1" class="b-rounded-tile-item fancy">
						<div class="b-rounded-tile-img icon-pickup"></div>
						<div class="b-rounded-tile-name-container">
							<div class="b-rounded-tile-name">Самовывоз.<br>15 точек в Москве</div>
						</div>
					</a>
					<a href="#delivery-2" class="b-rounded-tile-item fancy">
						<div class="b-rounded-tile-img icon-post"></div>
						<div class="b-rounded-tile-name-container">
							<div class="b-rounded-tile-name">Курьер в Подмосковье, за МКАД</div>
						</div>
					</a>
					<a href="#delivery-3" class="b-rounded-tile-item fancy">
						<div class="b-rounded-tile-img icon-courier"></div>
						<div class="b-rounded-tile-name-container">
							<div class="b-rounded-tile-name">Курьер по Москве, в&nbsp;пределах МКАД</div>
						</div>
					</a>
					<a href="#delivery-4" class="b-rounded-tile-item fancy">
						<div class="b-rounded-tile-img icon-urgently"></div>
						<div class="b-rounded-tile-name-container">
							<div class="b-rounded-tile-name">Срочная курьерская доставка по Москве день&nbsp;в&nbsp;день</div>
						</div>
					</a>
					<a href="#delivery-5" class="b-rounded-tile-item fancy">
						<div class="b-rounded-tile-img icon-rus-post"></div>
						<div class="b-rounded-tile-name-container">
							<div class="b-rounded-tile-name">Почта России</div>
						</div>
					</a>
					<a href="#delivery-6" class="b-rounded-tile-item fancy">
						<div class="b-rounded-tile-img icon-ems"></div>
						<div class="b-rounded-tile-name-container">
							<div class="b-rounded-tile-name">ЕМС почта</div>
						</div>
					</a>
					<a href="#delivery-7" class="b-rounded-tile-item fancy">
						<div class="b-rounded-tile-img icon-autopost"></div>
						<div class="b-rounded-tile-name-container">
							<div class="b-rounded-tile-name">PickPoint</div>
						</div>
					</a>
					<a href="#delivery-8" class="b-rounded-tile-item fancy">
						<div class="b-rounded-tile-img icon-sdek"></div>
						<div class="b-rounded-tile-name-container">
							<div class="b-rounded-tile-name">СДЭК. Самовывоз и доставка</div>
						</div>
					</a>
					<?/*?>
					<a href="#delivery-" class="b-rounded-tile-item fancy">
						<div class="b-rounded-tile-img icon-tc"></div>
						<div class="b-rounded-tile-name-container">
							<div class="b-rounded-tile-name">Наложенный платеж</div>
						</div>
					</a>
					<?*/?>
					<a href="#delivery-9" class="b-rounded-tile-item fancy">
						<div class="b-rounded-tile-img icon-boxberry"></div>
						<div class="b-rounded-tile-name-container">
							<div class="b-rounded-tile-name">Boxberry. Курьер и самовывоз</div>
						</div>
					</a>
					<a href="#delivery-10" class="b-rounded-tile-item fancy">
						<div class="b-rounded-tile-img icon-grastin"></div>
						<div class="b-rounded-tile-name-container">
							<div class="b-rounded-tile-name">Grastin. Курьер и самовывоз</div>
						</div>
					</a>
				</div>
				<div style="display: none;">
					<div class="b-popup b-delivery-popup" id="delivery-1">
						<div class="b-popup-header">
							<h3>Самовывоз</h3>
							<p>15 точек в Москве</p>
						</div>
						<div class="b-text">
							<ul>
								<li>Марьинский У-г</li>
								<li>Апрелевка</li>
								<li>Домодедово</li>
								<li>Мытищи</li>
								<li>Бутово</li>
								<li>Зеленоград</li>
								<li>Китай-город</li>
								<li>Красногорск</li>
								<li>Марьино</li>
								<li>Маяковская</li>
								<li>Новокосино</li>
								<li>Октябрьское поле</li>
								<li>Реутов</li>
								<li>Сокольники</li>
								<li>Рассказовка</li>
								<li>Электрозаводская</li>
								<li>Чертановская</li>
								<li>Шоссе Энтузиастов</li>
							</ul>
						</div>
					</div>
					<div class="b-popup" id="delivery-2">
						<div class="b-popup-header">
							<h3>Курьер в Подмосковье, за МКАД</h3>
						</div>
						<div class="b-text">
							<p><b>Преимущества - доставка на следующий день</b> после заказа на дом, возможны замороженные продукты в заказе.</p>
							<ul>
								<li>Стоимость доставки за МКАД составляет 25 руб. за км.<br>
								Доставка за МКАД осуществляется в течении 1-3 рабочих дней после подтверждения заказа. </li>
							</ul>
							<p><br>Вы получаете заказанный товар, кассовый чек и товарный чек и, проверив соответствие привезённого товара сопроводительным документам, оплачиваете товар наличными рублями.<br> Все товары сертифицированы.<br><br></p>
							<p><b>Внимание!</b><br>Внимательно проверяйте соответствие заказа с бланком заказа.</p>
							<p>После того, как Вы поставили подпись в бланке, что Товар получен полностью. Претензий к внешнему виду и составу заказа не имею, претензии по составу заказа и внешнему виду товара не принимаются. Просим с пониманием отнестись к данным правилам.</p>
						</div>
					</div>
					<div class="b-popup" id="delivery-3">
						<div class="b-popup-header">
							<h3>Курьер по Москве, в&nbsp;пределах МКАД</h3>
						</div>
						<div class="b-text">
							<p><b>Преимущества - доставка на следующий день</b> после заказа на дом, возможны замороженные продукты в заказе.</p>
							<ul>
								<li>Стоимость доставки в пределах МКАД - 359 руб.<br>
								 Доставка осуществляется в выбранный покупателем день. </li>
							</ul>
							<p><br>Вы получаете заказанный товар, кассовый чек и товарный чек и, проверив соответствие привезённого товара сопроводительным документам, оплачиваете товар наличными рублями.<br> Все товары сертифицированы.<br><br></p>
							<p><b>Внимание!</b><br>Внимательно проверяйте соответствие заказа с бланком заказа.</p>
							<p>После того, как Вы поставили подпись в бланке, что Товар получен полностью. Претензий к внешнему виду и составу заказа не имею, претензии по составу заказа и внешнему виду товара не принимаются. Просим с пониманием отнестись к данным правилам.</p>
						</div>
					</div>
					<div class="b-popup" id="delivery-4">
						<div class="b-popup-header">
							<h3>Курьер по Москве, в&nbsp;пределах МКАД</h3>
						</div>
						<div class="b-text">
							<p><b>Преимущества - доставка день в день</b><br>Стоимость доставки в пределах МКАД - 499 руб. Вес посылки до 15 кг. Предоплата<br>Заказ должен быть отправлен до 14.00</p>
						</div>
					</div>
					<div class="b-popup" id="delivery-5">
						<div class="b-popup-header">
							<h3>Почта России</h3>
						</div>
						<div class="b-text">
							<ul>
								<li>Почта России (доставка до 30 дней в местное отделение связи)</li>
							</ul>
							<p><br>Стоимость доставки в таблице:<br></p>
							<img src="http://www.nevkusno.ru/images/image/%D0%B4%D0%BE%D1%81%D1%82%D0%B0%D0%B2%D0%BA%D0%B0.jpg" style="width: 504px; height: 85px;">
							<p>Стоимость доставки в Дальневосточный, Сибирский, Северо-западный (Коми, Мурманск) и Уральский федеральные округа, указанная в таблице, умножается на 2 <br><br>Амурская область, Камчатский край, Магаданская область, Приморский край, Сахалинская область, Саха (Якутия), Хабаровский край, Чукотский округ, Алтайский край, Забайкальский край, Иркутская область, Красноярский край, Кемеровская область, Новосибирская область, Омская область, Республика Алтай, Республика Бурятия, Республика Тыва, Республика Хакасия, Томская область, Курганская область, Свердловская область, Тюменская область, Ханты-Мансийский автономный округ, Челябинская область, Ямало-ненецкий автономный округ<br><br> <b>Примечание:</b> стоимость доставки заказа от 20 000 руб. и с весом посылки свыше 10 кг., а также Саратов, Саратовская область, Норильск и Магадан - рассчитывается отдельно оператором.<br><br><b>Внимание!</b> Счет резервируется в течении 3-х дней с даты выставления!<br>
							После прихода денег на наш счет мы отправляем товар в течении 1 - 4 рабочих дней.<br>Мы не отправляем сиропы и гели по России, потому что были случаи, когда банки лопались и содержимое заливало всю посылку.</p>
						</div>
					</div>
					<div class="b-popup" id="delivery-6">
						<div class="b-popup-header">
							<h3>EMS почта</h3>
						</div>
						<div class="b-text">
							<ul>
								<li>Почта EMS (доставка до 7 дней до дверей квартиры)</li>
							</ul>
							<p><br>Стоимость доставки в таблице:<br></p>
							<img src="http://www.nevkusno.ru/images/image/%D0%B4%D0%BE%D1%81%D1%82%D0%B0%D0%B2%D0%BA%D0%B0.jpg" style="width: 504px; height: 85px;">
							<p>Стоимость доставки в Дальневосточный, Сибирский, Северо-западный (Коми, Мурманск) и Уральский федеральные округа, указанная в таблице, умножается на 2 <br><br>Амурская область, Камчатский край, Магаданская область, Приморский край, Сахалинская область, Саха (Якутия), Хабаровский край, Чукотский округ, Алтайский край, Забайкальский край, Иркутская область, Красноярский край, Кемеровская область, Новосибирская область, Омская область, Республика Алтай, Республика Бурятия, Республика Тыва, Республика Хакасия, Томская область, Курганская область, Свердловская область, Тюменская область, Ханты-Мансийский автономный округ, Челябинская область, Ямало-ненецкий автономный округ<br><br> <b>Примечание:</b> стоимость доставки заказа от 20 000 руб. и с весом посылки свыше 10 кг., а также Саратов, Саратовская область, Норильск и Магадан - рассчитывается отдельно оператором.<br><br><b>Внимание!</b> Счет резервируется в течении 3-х дней с даты выставления!<br>
							После прихода денег на наш счет мы отправляем товар в течении 1 - 4 рабочих дней.<br>Мы не отправляем сиропы и гели по России, потому что были случаи, когда банки лопались и содержимое заливало всю посылку.</p>
						</div>
					</div>
					<div class="b-popup" id="delivery-7">
						<div class="b-popup-header">
							<h3>PickPoint</h3>
						</div>
						<div class="b-text">
							<p>
								<b>Преимущества - более 1500 пунктов выдачи по всей России</b>, по Москве и Подмосковью не требуется предоплата, фиксированная стоимость доставки. Возможна оплатой картой при получении.<br>
								<br>
								<b>Стоимость доставки:</b><br>
								Москва и Санкт Петербург - 420 руб.<br>
								Доставка в Регионы - расчет производит оператор.<br>
								Вес посылки до 10 кг.<br>
								<br>
								<b>Внимание!</b> Посылки по Москве и Подмосковью отправляются без предоплаты, покупатель оплачивает при получении. Посылки в Регионы отправляются по 100% предоплате.<br>
								Постамат – автоматизированный посылочный терминал, куда доставляется Ваш заказ. Далее Вы самостоятельно забираете заказ в удобное Вам время, следуя инструкциям в меню терминала.<br>
								<br>
							</p>
							<iframe width="560" height="315" src="https://www.youtube.com/embed/_zPEx5cTmOI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
							<p>
								<b>5 простых шагов:</b><br>
								1. Выбираете ближайший к Вам постамат.<br>
								2. В момент доставки заказа в постамат Вам приходит SMS с кодом получения заказа.<br>
								3. В удобное время Вы приходите к выбранному постамату и вводите код, присланный в SMS-сообщении.<br>
								4. Оплачиваете товар наличными или пластиковой картой непосредственно у терминала 5. Забираете свой заказ.<br>
								<br>
								<b>ГДЕ?</b> Постаматы установлены в торговых центрах, крупных розничных сетях и супермаркетах (<a href="http://pickpoint.ru/postamats/" target="_blank">Найдите свой город на карте PickPoint</a>).<br>
								<b>КАК?</b> Оплатить за заказ Вы можете наличными или пластиковой картой<br>
								<b>КОГДА?</b> Вы сами выбираете удобное Вам время, чтобы забрать свой заказ (<a href="http://pickpoint.ru/monitoring/?shop=23666118_923" target="_blank">Мониторинг отправления</a>)<br>
								Если у вас возникнут сложности с получением заказов в постамате PickPoint, ЗВОНИТЕ: <a href="tel:88007007909">8-800-700-79-09</a>
							</p>
						</div>
					</div>
					<div class="b-popup" id="delivery-8">
						<div class="b-popup-header">
							<h3>СДЭК. Самовывоз и доставка</h3>
						</div>
						<div class="b-text">
							<p><b>Преимущества - более 1000 пунктов выдачи по всей России.</b><br>Выдача в пунктах самовывоза и доставка до двери. Низкая стоимость. Расчет доставки при оформлении заказа на сайте. Стоимость доставки автоматически рассчитывается в корзине на сайте, в зависимости от веса посылки.<br>Вес посылки до 30 кг.</p>
						</div>
					</div>
					<div class="b-popup" id="delivery-9">
						<div class="b-popup-header">
							<h3>Boxberry. Курьер и самовывоз</h3>
						</div>
						<div class="b-text">
							<p>Преимущества - более 1500 пунктов выдачи по всей России.<br>Выдача в пунктах самовывоза и доставка до двери. Низкая стоимость. Стоимость доставки автоматически рассчитывается в корзине на сайте, в зависимости от веса посылки.<br>Вес посылки до 30 кг.</p>
						</div>
					</div>
					<div class="b-popup" id="delivery-10">
						<div class="b-popup-header">
							<h3>Grastin. Курьер и самовывоз</h3>
						</div>
						<div class="b-text">
							<p>Преимущества – низкая стоимость самовывоза по Москве и Подмосковью.<br>Выдача в пунктах самовывоза и доставка до двери. Стоимость доставки автоматически рассчитывается в корзине на сайте, в зависимости от веса посылки.<br>Вес посылки до 30 кг.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- 
<div class="b-question-block wave-top wave-bottom">
	<div class="b-block">
		<div class="b-question-block-left">
			<div class="b-question-img"></div>
			<div class="b-question-block-text">
				<div class="b-question-block-head-text">Остались вопросы?</div>
				<div class="b-question-block-other-text">Закажите обратный звонок.<br>Мы позвоним вам и подробно проконсультируем.</div>
			</div>
		</div>
		<div class="b-question-form">
			<form action="/kitsend.php" class="b-one-string-form">
				<input type="text" placeholder="Номер телефона">
				<a href="#" class="pink">Заказать звонок</a>
			</form>
		</div>
	</div>
</div>
 -->

<div class="b-delivery-advantages">
	<? includeArea('advantages'); ?>
</div>

<? includeArea('subscribe'); ?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>