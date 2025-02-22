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

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));

?>

<div class="container product-categories">

    <? foreach ($arResult['SECTIONS'] as &$arSection): ?>
        <?
            $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
            $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

            if (false === $arSection['PICTURE'])
            {
                $altValue = (string)($arSection['IPROPERTY_VALUES']['SECTION_PICTURE_FILE_ALT'] ?? '');
                if ($altValue === '')
                {
                    $altValue = $arSection['NAME'];
                }
                $titleValue = (string)($arSection['IPROPERTY_VALUES']['SECTION_PICTURE_FILE_TITLE'] ?? '');
                if ($titleValue === '')
                {
                    $titleValue = $arSection['NAME'];
                }
                $arSection['PICTURE'] = array(
                    'SRC' => $this->GetFolder().'/images/tile-empty.png', // Используем заглушку
                    'ALT' => $altValue,
                    'TITLE' => $titleValue,
                );
                unset($titleValue, $altValue);
            }
        ?>
        <div class="four columns" id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
            <a href="<? echo $arSection['SECTION_PAGE_URL']; ?>" class="img-caption" >
                <figure>
                    <img src="<? echo $arSection['PICTURE']['SRC']; ?>" alt="<? echo $arSection['PICTURE']['ALT']; ?>" title="<? echo $arSection['PICTURE']['TITLE']; ?>"/>
                    <figcaption>
                        <h3><? echo $arSection['NAME']; ?></h3>
                        <span>Смотреть предложения</span>
                    </figcaption>
                </figure>
            </a>
        </div>
    <? endforeach; ?>

</div>