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
$this->setFrameMode(true);?>

<? if(count($arResult["ITEMS"])): ?>
	<div class="b-faq-list">
		<?foreach($arResult["ITEMS"] as $arItem):?>
		
		<? $answerClass = ''; ?>
		<? if (!empty($arItem['DETAIL_TEXT'])): ?>
			<? $answer = $arItem['DETAIL_TEXT']; ?>
		<? else: ?>
			<? $answer = 'Администратор еще не ответил на ваш вопрос'; ?>
			<? $answerClass = 'no-answer'; ?>
		<? endif; ?>

			<div class="b-faq-item no-img">
				<div class="b-faq-header"><?=$arItem['PREVIEW_TEXT']?>
					<div class="b-faq-header-icon">
						<div class="b-faq-header-icon-line"></div>
						<div class="b-faq-header-icon-line"></div>
					</div>
				</div>
				<div class="b-faq-content">
					<div class="b-faq-item-text <?=$answerClass?>"><?=$answer?></div>
				</div>
			</div>
		<?endforeach;?>
	</div>
	<? if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?>
		<div class="b-load-more-container">
			<?=$arResult["NAV_STRING"];?>
		</div>
	<?endif;?>
<? else: ?>
	<p>Вы ещё не задали ни одного вопросы</p>
<? endif; ?>