<?include ('header.php');?>

	<div class="b-404 wave-bottom">
		<div class="b-block">
			<div class="b-404-left b-404-block">
				<div class="b-404-img"></div>
			</div>
			<div class="b-404-right b-404-block">
				<h2>Страницы с таким адресом не&nbsp;сущесвует</h2>
				<p>Если вы искали какой-то товар, то воспользуйтесь поиском по магазину.</p>
				<form action="/search/" class="b-search-form">
					<?$APPLICATION->IncludeComponent("bitrix:search.title", "header", Array(
						"CATEGORY_0" => array(	// Ограничение области поиска
								0 => "iblock_content",
							),
							"CATEGORY_0_TITLE" => "",	// Название категории
							"CATEGORY_0_forum" => array(
								0 => "all",
							),
							"CATEGORY_0_iblock_content" => array(	// Искать в информационных блоках типа "iblock_content"
								0 => "1",
							),
							"CATEGORY_0_main" => array(
								0 => "",
							),
							"CHECK_DATES" => "N",	// Искать только в активных по дате документах
							"CONTAINER_ID" => "title-search",	// ID контейнера, по ширине которого будут выводиться результаты
							"CONVERT_CURRENCY" => "N",	// Показывать цены в одной валюте
							"INPUT_ID" => "title-search-input",	// ID строки ввода поискового запроса
							"NUM_CATEGORIES" => "1",	// Количество категорий поиска
							"ORDER" => "rank",	// Сортировка результатов
							"PAGE" => "#SITE_DIR#search/",	// Страница выдачи результатов поиска (доступен макрос #SITE_DIR#)
							"PREVIEW_HEIGHT" => "75",	// Высота картинки
							"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода
							"PREVIEW_WIDTH" => "75",	// Ширина картинки
							"PRICE_CODE" => "",	// Тип цены
							"PRICE_VAT_INCLUDE" => "Y",	// Включать НДС в цену
							"SHOW_INPUT" => "Y",	// Показывать форму ввода поискового запроса
							"SHOW_OTHERS" => "N",	// Показывать категорию "прочее"
							"SHOW_PREVIEW" => "Y",	// Показать картинку
							"TEMPLATE_THEME" => "blue",
							"TOP_COUNT" => "8",	// Количество результатов в каждой категории
							"USE_LANGUAGE_GUESS" => "Y",	// Включить автоопределение раскладки клавиатуры
						),
						false
					);?>
				</form>
				<p>Вы можете вернуться на <a href="/">Главную страницу</a> или посетить другие разделы нашего магазина:</p>
				<div class="b-404-menu">
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
					</ul>
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
					<ul></ul>
					<?/*?>
					<ul>
						<li><a href="#">Акции и скидки</a></li>
						<li><a href="#">Новинки</a></li>
						<li><a href="#">Галерея</a></li>
						<li><a href="#">Бонусная программа</a></li>
					</ul>
					<ul>
						<li><a href="#">Новости</a></li>
						<li><a href="#">Видеообзоры</a></li>
						<li><a href="#">Блог</a></li>
						<li><a href="#">Каталог</a></li>
					</ul>
					<ul>
						<li><a href="#">Контакты</a></li>
						<li><a href="#">Оплата и доставка</a></li>
						<li><a href="#">Вопросы и ответы</a></li>
						<li><a href="#">Франшиза</a></li>
					</ul>
					<?*/?>
				</div>
			</div>
		</div>
	</div>
	<div class="b-delivery-advantages">
		<? includeArea('advantages'); ?>
	</div>
	<?/*?>
	<div class="b-bottom-catalog b-404-bottom-catalog">
		<div class="b-block">
			<div id="b-category-tab-slider" class="b-tabs-container b-tabs-container-underline">
				<div class="b-tab active" data-tab="about">О магазине</div>
				<div class="b-tab" data-tab="inventory">Инвентарь</div>
				<div class="b-tab" data-tab="regs">Ингредиенты</div>
				<div class="b-tab" data-tab="colors">Красители</div>
				<div class="b-tab" data-tab="brands">Бренды</div>
				<div class="b-tab" data-tab="forms">Формы</div>
			</div>
			<div class="b-tab-item b-tab-about" id="about">
				<p>Самый большой интернет-магазин кондитерского инвентаря и ингредиентов. Мы предлагаем только то, что используем сами. В каталоге нашего магазина вы найдете товары для профессионалов и для домашней выпечки.<br><br>
				Самый большой интернет-магазин кондитерского инвентаря и ингредиентов. Мы предлагаем только то, что используем сами. В каталоге нашего магазина вы найдете товары для профессионалов и для домашней выпечки. Самый большой интернет-магазин кондитерского инвентаря и ингредиентов. Инвентаря и ингредиентов.</p>
			</div>
		</div>
	</div>
	<?*/?>
	<? includeArea('subscribe'); ?>
	
<?include ('footer.php');?>