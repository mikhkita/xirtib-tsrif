<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Галерея");
?>

<div class="b-my-works-block wave-bottom">
	<div class="b-block">
		<div class="b-my-works-top">
			<p>В этом разделе вы можете делиться фотографиями своих сладких шедевров, которые приготовлены при помощи инструментов, купленных в нашем магазине, с другими покупателями.</p>
		</div>
		<div class="b-works-sort">
			<a href="#b-popup-add-work" class="b-btn fancy"><p class="icon-upload">Загрузить работу</p></a>
			<div class="b-gallery-sort">
				<form action="" method="POST">
					<div class="b-works-sort-item b-sort-item">
						<p><b>Сортировать по:</b></p>
						<div class="b-sort-select">
							<select name="sort">
								<option value="PROPERTY_LIKES">Популярности</option>
								<option value="ID">Обсуждению</option>
							</select>
						</div>
					</div>
					<div class="b-works-sort-item b-sort-item">
						<p><b>Показывать по:</b></p>
						<div class="b-sort-select">
							<select name="count">
								<option value="12">12</option>
								<option value="24">24</option>
								<option value="48">48</option>
							</select>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="b-works-list-container pagination-container">
			<?$APPLICATION->IncludeComponent(
				"bitrix:news.list", 
				"gallery", 
				array(
					"ACTIVE_DATE_FORMAT" => "d.m.Y",
					"ADD_SECTIONS_CHAIN" => "N",
					"AJAX_MODE" => "N",
					"AJAX_OPTION_ADDITIONAL" => "",
					"AJAX_OPTION_HISTORY" => "N",
					"AJAX_OPTION_JUMP" => "N",
					"AJAX_OPTION_STYLE" => "Y",
					"CACHE_FILTER" => "N",
					"CACHE_GROUPS" => "Y",
					"CACHE_TIME" => "36000000",
					"CACHE_TYPE" => "A",
					"CHECK_DATES" => "Y",
					"DETAIL_URL" => "",
					"DISPLAY_BOTTOM_PAGER" => "Y",
					"DISPLAY_DATE" => "Y",
					"DISPLAY_NAME" => "Y",
					"DISPLAY_PICTURE" => "Y",
					"DISPLAY_PREVIEW_TEXT" => "Y",
					"DISPLAY_TOP_PAGER" => "N",
					"FIELD_CODE" => array(
						0 => "",
						1 => "",
					),
					"FILTER_NAME" => "",
					"HIDE_LINK_WHEN_NO_DETAIL" => "N",
					"IBLOCK_ID" => "11",
					"IBLOCK_TYPE" => "content",
					"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
					"INCLUDE_SUBSECTIONS" => "Y",
					"MESSAGE_404" => "",
					"NEWS_COUNT" => isset($_GET['count']) ? $_GET['count'] : 12,
					"PAGER_BASE_LINK_ENABLE" => "N",
					"PAGER_DESC_NUMBERING" => "N",
					"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
					"PAGER_SHOW_ALL" => "N",
					"PAGER_SHOW_ALWAYS" => "N",
					"PAGER_TEMPLATE" => "main",
					"PAGER_TITLE" => "Новости",
					"PARENT_SECTION" => "",
					"PARENT_SECTION_CODE" => "",
					"PREVIEW_TRUNCATE_LEN" => "",
					"PROPERTY_CODE" => array(
						0 => "PHOTOS",
						1 => "",
					),
					"SET_BROWSER_TITLE" => "N",
					"SET_LAST_MODIFIED" => "N",
					"SET_META_DESCRIPTION" => "N",
					"SET_META_KEYWORDS" => "N",
					"SET_STATUS_404" => "N",
					"SET_TITLE" => "N",
					"SHOW_404" => "N",
					"SORT_BY1" => isset($_GET['sort'])?$_GET['sort']:"PROPERTY_LIKES",
					"SORT_BY2" => "SORT",
					"SORT_ORDER1" => "DESC",
					"SORT_ORDER2" => "ASC",
					"STRICT_SECTION_CHECK" => "N",
					"COMPONENT_TEMPLATE" => "news"
				),
				false
			);?>
		</div>
	</div>
</div>

<? includeArea('subscribe'); ?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>