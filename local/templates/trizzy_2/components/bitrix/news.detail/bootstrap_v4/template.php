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
$themeClass = isset($arParams['TEMPLATE_THEME']) ? ' bx-'.$arParams['TEMPLATE_THEME'] : '';
CUtil::InitJSCore(['fx', 'ui.fonts.opensans']);
?>
<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="container">
    <div class="clearfix"></div>

    <!-- Slider -->
    <div class="eleven columns">
        <div class="slider-padding">
            <div id="basic-slider" class="royalSlider rsDefault">
                <? if (!empty($arResult["SLIDER"])): ?>
                    <? foreach ($arResult["SLIDER"] as $slide): ?>
                        <a href="<?= $slide["SRC"] ?>" class="mfp-gallery" title="<?= $slide["DESCRIPTION"] ?>">
                            <img class="rsImg" src="<?= $slide["SRC"] ?>" alt="<?= $slide["DESCRIPTION"] ?>" />
                        </a>
                    <? endforeach; ?>
                <? else: ?>
                    <img class="rsImg" src="<?= $arResult["DETAIL_PICTURE"]["SRC"] ?>" alt="<?= $arResult["NAME"] ?>" />
                <? endif; ?>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <!-- Content -->
    <div class="five columns">
        <div class="product-page">

            <h3 class="headline"><?= $arResult["NAME"] ?></h3>
            <span class="line margin-bottom-25"></span>
            <div class="clearfix"></div>

            <!-- Project Description -->
            <section class="project-section">
                <p class="margin-bottom-5"><?= $arResult["DETAIL_TEXT"] ?: $arResult["PREVIEW_TEXT"] ?></p>
            </section>

        </div>
    </div>
</div>

