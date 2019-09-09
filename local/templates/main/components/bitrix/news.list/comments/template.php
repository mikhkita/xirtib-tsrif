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
$thisUserID = $USER->GetID();?>

<? if(count($arResult["ITEMS"])): ?>
	<div class="b-comments-list">
		<?foreach($arResult["ITEMS"] as $arItem):

			$userID = $arItem['PROPERTIES']["USER_ID"]["VALUE"];
			$rsUser = CUser::GetByID($userID);
			$arUser = $rsUser->Fetch();
			$renderImage = CFile::ResizeImageGet($arUser["PERSONAL_PHOTO"], Array("width" => 85, "height" => 85), BX_RESIZE_IMAGE_EXACT, false, $arFilters );
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<div class="b-comment-item clearfix parrent-comment">
				<div class="b-comment-author-photo" style="background-image: url('<?=$renderImage['src']?>');"></div>
				<div class="b-comment-body clearfix">
					<div class="b-comment-author-name"><?=$arUser['NAME'].' '.$arUser['LAST_NAME']?></div>
					<div class="b-comment-text"><?=$arItem['NAME']?></div>
					<div class="b-comment-item-bottom">
						<?if (isAuth()):?>
							<?if (is_array($arItem["PROPERTIES"]["LIKES"]["VALUE"])):?>
								<?$active = '';?>
								<? foreach ($arItem["PROPERTIES"]["LIKES"]["VALUE"] as $key => $value): ?>
								 	<?if ($value == $thisUserID):?>
								 		<?$active = 'active';?>
								 	<?endif;?>
								<? endforeach; ?>
								<a href="/ajax/?action=ADDLIKETOCOMMENT&id=<?=$arItem['ID']?>&mark=LIKES" class="icon-like-up b-comment-mark b-comment-like <?=$active?>"><?=count($arItem["PROPERTIES"]["LIKES"]["VALUE"])?></a>
							<?else:?>
								<a href="/ajax/?action=ADDLIKETOCOMMENT&id=<?=$arItem['ID']?>&mark=LIKES" class="icon-like-up b-comment-mark b-comment-like">0</a>
							<?endif;?>
							<?if (is_array($arItem["PROPERTIES"]["DISLIKES"]["VALUE"])):?>
								<?$active = '';?>
								<? foreach ($arItem["PROPERTIES"]["DISLIKES"]["VALUE"] as $key => $value): ?>
								 	<?if ($value == $thisUserID):?>
								 		<?$active = 'active';?>
								 	<?endif;?>
								<? endforeach; ?>
								<a href="/ajax/?action=ADDLIKETOCOMMENT&id=<?=$arItem['ID']?>&mark=DISLIKES" class="icon-dislike b-comment-mark b-comment-dislike <?=$active?>"><?=count($arItem["PROPERTIES"]["DISLIKES"]["VALUE"])?></a>
							<?else:?>
								<a href="/ajax/?action=ADDLIKETOCOMMENT&id=<?=$arItem['ID']?>&mark=DISLIKES" class="icon-dislike b-comment-mark b-comment-dislike">0</a>
							<?endif;?>
						<?else:?>
							<div class="icon-like-up b-comment-like active">
								<?=count($arItem["PROPERTIES"]["LIKES"]["VALUE"])?>
							</div>
							<div class="icon-dislike b-comment-dislike active">
								<?=count($arItem["PROPERTIES"]["LIKES"]["VALUE"])?>
							</div>
						<?endif;?>
						<?/*?>
						<a href="#" class="b-comment-reply" data-id="<?=$arItem['ID']?>">Ответить на комментарий</a>
						<?*/?>
					</div>
				</div>
				<?foreach ($arItem['CHILDS'] as $key => $child):?>
					<? $userID = $child["USER_ID"]["VALUE"]; ?>
					<? $rsUser = CUser::GetByID($userID); ?>
					<? $arUser = $rsUser->Fetch(); ?>
					<? $renderImage = CFile::ResizeImageGet($arUser["PERSONAL_PHOTO"], Array("width" => 130, "height" => 130), BX_RESIZE_IMAGE_EXACT, false, $arFilters ); ?>
					<div class="b-comment-item clearfix">
						<div class="b-comment-author-photo" style="background-image: url('<?=$renderImage['src']?>');"></div>
						<div class="b-comment-body clearfix">
							<div class="b-comment-author-name"><?=$arUser['NAME'].' '.$arUser['LAST_NAME']?></div>
							<div class="b-comment-text"><?=$child['NAME']?></div>
						</div>
					</div>
				<?endforeach;?>
				<div class="comment-form hide">
					<div class="b-comment-block-form-container">
						<form action="/ajax/?action=ADDCOMMENT" method="POST" class="clearfix">
							<div class="b-comment-block-form-textarea">
								<textarea name="comment_textarea" placeholder="Ответьте на комментарий" rows="1" required></textarea>
								<input type="hidden" name="id" value="<?=$arItem["PROPERTIES"]["WORK_ID"]["VALUE"]?>">
								<input type="hidden" name="parent_comment" value="<?=$arItem["ID"]?>">
							</div>
							<a href="#b-popup-success-comment" class="b-thanks-link fancy" style="display:none;"></a>
							<a href="#" class="b-btn b-comment-btn ajax">Ответить</a>
						</form>
					</div>
				</div>
			</div>
		<?endforeach;?>
	</div>
	<? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
		<div class="b-load-more-container">
			<?=$arResult["NAV_STRING"];?>
		</div>
	<?endif;?>
<? endif; ?>