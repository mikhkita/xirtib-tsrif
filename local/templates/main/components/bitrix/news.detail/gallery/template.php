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

// $APPLICATION->SetTitle($arResult['NAME']);

?>
<div class="b-work-block">
	<div class="b-block">
		<div class="b-left-work-block">
			<div class="b-work-author">
				<? 
				$rsUser = CUser::GetByID($arResult["PROPERTIES"]["AUTHOR"]["VALUE"]);
				$arUser = $rsUser->Fetch(); ?>

				<?if($arUser["PERSONAL_PHOTO"]):?>
					<?$renderImage = CFile::ResizeImageGet($arUser["PERSONAL_PHOTO"], Array("width" => 85, "height" => 85), BX_RESIZE_IMAGE_EXACT, false, $arFilters ); ?>
					<div class="author-photo" style="background-image: url('<?=$renderImage["src"]?>');"></div>
				<?endif;?>

				<div class="author-name"><?=$arUser['NAME'].' '.$arUser['LAST_NAME']?></div>
			</div>
			<div class="b-work-description">
				<p><?=$arResult["PREVIEW_TEXT"]?></p>
				<div class="b-work-description-more hide">
					<a href="#" class="dashed">Читать далее</a>
				</div>
			</div>
		</div>
		<div class="b-right-work-block">
			<div class="b-work-slider">
				<div class="b-work-slider-top">
					<?foreach($arResult["PROPERTIES"]["PHOTOS"]["VALUE"] as $arPhotos):
					$renderImage = CFile::ResizeImageGet($arPhotos, Array("width" => 1114, "height" => 1206), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false, $arFilters ); ?>
					<div class="b-work-slider-top-img" style="background-image: url('<?=$renderImage['src']?>');"></div>
					<? endforeach; ?>
				</div>
				<div class="b-work-slider-bottom">
					<?foreach($arResult["PROPERTIES"]["PHOTOS"]["VALUE"] as $arPhotos):
					$renderImage = CFile::ResizeImageGet($arPhotos, Array("width" => 169, "height" => 183), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, false, $arFilters ); ?>
					<div class="b-work-slider-bottom-img" style="background-image: url('<?=$renderImage['src']?>');"></div>
					<? endforeach; ?>
				</div>
			</div>
			<div class="b-work-right-block-bottom">
				<div class="b-work-detail-like">
					<?if (isAuth()):?>
						<?if (is_array($arResult["PROPERTIES"]["LIKES"]["VALUE"])):?>
							<?$userID = $USER->GetID();?>
							<?$active = '';?>
							<? foreach ($arResult["PROPERTIES"]["LIKES"]["VALUE"] as $key => $value): ?>
							 	<?if ($value == $userID):?>
							 		<?$active = 'active';?>
							 	<?endif;?>
							<? endforeach; ?>
							<a href="/ajax/?action=ADDLIKETOWORK&id=<?=$arResult['ID']?>" class="icon-like <?=$active?>"><?=count($arResult["PROPERTIES"]["LIKES"]["VALUE"])?></a>
						<?else:?>
							<a href="/ajax/?action=ADDLIKETOWORK&id=<?=$arResult['ID']?>" class="icon-like">0</a>
						<?endif;?>
					<?else:?>
						<div class="icon-like active"><?=count($arResult["PROPERTIES"]["LIKES"]["VALUE"])?></div>
					<?endif;?>
				</div>
				<div class="b-work-soc">
					<script src="https://yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
					<script src="https://yastatic.net/share2/share.js"></script>
					<div class="ya-share2" data-services="vkontakte,facebook,twitter"></div>
					<!-- <a href="#" class="b-work-soc-item icon-vk"></a>
					<a href="#" class="b-work-soc-item icon-instagram"></a>
					<a href="#" class="b-work-soc-item icon-twitter"></a>
					<a href="#" class="b-work-soc-item icon-facebook"></a> -->
				</div>
			</div>
		</div>
	</div>
</div>
<? if($arResult["PROPERTIES"]["DISALLOW_COMMENTS"]["VALUE"] != 'Y'): ?>
	<? $placeholder = (isAuth()) ? 'Ваш комментарий' : 'Комментарии могут оставлять только зарегистрированные пользователи'; ?>
	<? $isDisabled = (isAuth()) ? '' : 'disabled'; ?>
<div class="b-comment-block wave-bottom">
	<div class="b-block">
		<div class="b-comment-block-title">
			<h3>Комментарии</h3>
			<!-- <a href="#">Оставить комментарий</a> -->
		</div>
		<div class="b-comment-block-form-container">
			<form action="/ajax/?action=ADDCOMMENT" method="POST" class="clearfix">
				<div class="b-comment-block-form-textarea">
					<textarea name="comment_textarea" placeholder="<?=$placeholder?>" rows="4" required <?=$isDisabled?>></textarea>
					<input type="hidden" name="id" value="<?=$arResult["ID"]?>">
				</div>
				<a href="#b-popup-success-comment" class="b-thanks-link fancy" style="display:none;"></a>
				<? if (isAuth()): ?>
					<a href="#" class="b-btn b-comment-btn ajax">Оставить комментарий</a>
				<? else: ?>
					<a href="#b-popup-auth" class="b-btn b-comment-btn fancy">Войти</a>
				<? endif; ?>
			</form>
		</div>
		<div class="b-comment-list-container">
		<?
			$GLOBALS["arrCommentFilter"] = array(
				"PROPERTY_WORK_ID" => $arResult["ID"],
				"PROPERTY_PARENT_COMMENT" => false,
			);
		?>
		<?$APPLICATION->IncludeComponent(
			"bitrix:news.list", 
			"comments", 
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
				"FILTER_NAME" => "arrCommentFilter",
				"HIDE_LINK_WHEN_NO_DETAIL" => "N",
				"IBLOCK_ID" => "12",
				"IBLOCK_TYPE" => "content",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"INCLUDE_SUBSECTIONS" => "Y",
				"MESSAGE_404" => "",
				"NEWS_COUNT" => "10",
				"PAGER_BASE_LINK_ENABLE" => "N",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
				"PAGER_SHOW_ALL" => "N",
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => "comments",
				"PAGER_TITLE" => "Новости",
				"PARENT_SECTION" => "",
				"PARENT_SECTION_CODE" => "",
				"PREVIEW_TRUNCATE_LEN" => "",
				"PROPERTY_CODE" => array(
					0 => "USER_ID",
					1 => "PARENT_COMMENT",
				),
				"SET_BROWSER_TITLE" => "N",
				"SET_LAST_MODIFIED" => "N",
				"SET_META_DESCRIPTION" => "N",
				"SET_META_KEYWORDS" => "N",
				"SET_STATUS_404" => "N",
				"SET_TITLE" => "N",
				"SHOW_404" => "N",
				"SORT_BY1" => "ACTIVE_FROM",
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
	<?/*?>
	<div id="comment-form" style="display: none;">
		<div class="b-comment-block-form-container">
			<form action="#" method="POST" class="clearfix">
				<div class="b-comment-block-form-textarea">
					<textarea name="comment_textarea" placeholder="Ответьте на комментарий" rows="1"></textarea>
				</div>
				<a href="#" class="b-btn b-comment-btn">Ответить</a>
			</form>
		</div>
	</div>
	<?*/?>
</div>
<? endif; ?>

<? includeArea('subscribe'); ?>