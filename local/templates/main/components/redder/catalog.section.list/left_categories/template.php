<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<?if( count($arResult["SECTIONS"]) ): ?>
	<a href="#" id="catalog-menu-btn" class="category-btn">Каталог товаров</a>
	<ul>
		<?foreach($arResult["SECTIONS"] as $arItem):?>
			<? if($arItem["ID"] == 1144 || $arItem["UF_HIDE"] ){
				continue;
			} ?>
			<? if( !$arItem["PICTURE"] ): ?>
				<? $isSectionActive = isSectionActive($arItem["ID"]); ?>
				<li>
					<? $arrUrl = explode('/', $arItem["SECTION_PAGE_URL"]); ?>
					<? if ($arrUrl[2] == 'wholesale'): ?>
						<? $url = '/wholesale/'; ?>
					<? else: ?>
						<? $url = '/'.$arrUrl[1].'/'.$arrUrl[2].'/'; ?>
					<? endif; ?>
					<a href="<?=$url?>" class="<? if( $GLOBALS["SECTION_ID"] == $arItem["ID"] ): ?>active<? endif; ?><?=(($arItem["UF_HIGHLIGHT"])?" highlight":"")?>">
						<?=$arItem["NAME"]?>
					</a>
					<?
					if( $isSectionActive ){
						$property = ($GLOBALS["isWholesale"])?array( "WHOLESALE" => 78 ):Array();
						if( ($GLOBALS["isSale"]) ){
							$property = array("SALE" => 79);
						}
						$APPLICATION->IncludeComponent("redder:catalog.section.list", "left_categories", Array(
							"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
								"CACHE_GROUPS" => "Y",	// Учитывать права доступа
								"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
								"CACHE_TYPE" => "N",	// Тип кеширования
								"COUNT_ELEMENTS" => "Y",	// Показывать количество элементов в разделе
								"IBLOCK_ID" => "1",	// Инфоблок
								"IBLOCK_TYPE" => "content",	// Тип инфоблока
								"SECTION_CODE" => "",	// Код раздела
								"SECTION_FIELDS" => array(	// Поля разделов
									0 => "NAME",
								),
								"SECTION_ID" => $arItem["ID"],	// ID раздела
								"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
								"SECTION_USER_FIELDS" => array(	// Свойства разделов
								),
								"SHOW_PARENT_NAME" => "Y",	// Показывать название раздела
								"TOP_DEPTH" => "1",	// Максимальная отображаемая глубина разделов
								"VIEW_MODE" => "LINE",	// Вид списка подразделов
								"PROPERTY" => $property,
							),
							false
						);
					}
					?>
				</li>
			<? endif; ?>
		<?endforeach;?>
		<? if ($arParams["SECTION_ID"] == 1): ?>
			<li>
				<a href="/sale/" class="highlight">Распродажа</a>
			</li>		
		<? endif; ?>
	</ul>
<? endif; ?>