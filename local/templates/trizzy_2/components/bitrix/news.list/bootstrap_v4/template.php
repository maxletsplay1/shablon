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

\Bitrix\Main\UI\Extension::load('ui.fonts.opensans');

$themeClass = isset($arParams['TEMPLATE_THEME']) ? ' bx-'.$arParams['TEMPLATE_THEME'] : '';
?>
<div class="container">

    <div class="clearfix"></div>

    <div id="">

        <?foreach($arResult["ITEMS"] as $arItem):?>
            <?$this->AddEditAction(
                $arItem['ID'],
                $arItem['EDIT_LINK'],
                CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT")
            );
            $this->AddDeleteAction(
                $arItem['ID'],
                $arItem['DELETE_LINK'],
                CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"),
                array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM'))
            );?>

            <div class="one-third column portfolio-item <?=$arItem["PROPERTIES"]["CATEGORY"]["VALUE"]?> other" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <figure>
                    <div class="portfolio-holder">
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                            <img alt="<?=$arItem["NAME"]?>" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"/>
                        </a>
                    </div>

                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
                        <section class="item-description">
                            <span><?=$arItem["PROPERTIES"]["CATEGORY"]["VALUE"] ?? "Без категории"?></span>
                            <h5><?=$arItem["NAME"]?></h5>
                        </section>
                    </a>
                </figure>
            </div>

        <?endforeach;?>

    </div>

</div>
