<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Iblock\ElementTable;

Loader::includeModule("iblock");

$sliderIBlockId = $arParams["IBLOCK_ID"];
$slides = [];

$filter = ["IBLOCK_ID" => $sliderIBlockId, "ACTIVE" => "Y"];
$select = ["ID", "NAME", "PREVIEW_PICTURE", "PROPERTY_DEAL_LINK", "PROPERTY_DESCRIPTION"];
$res = CIBlockElement::GetList(["SORT" => "ASC"], $filter, false, false, $select);
while ($slide = $res->Fetch()) {
    $slides[] = [
        "TITLE" => $slide["NAME"],
        "SUBTITLE" => $slide["PROPERTY_DESCRIPTION_VALUE"],
        "LINK" => $slide["PROPERTY_DEAL_LINK_VALUE"],
        "IMAGE" => CFile::GetPath($slide["PREVIEW_PICTURE"]),
    ];
}
?>

<div class="container fullwidth-element home-slider">
    <div class="tp-banner-container">
        <div class="tp-banner">
            <ul>
                <?php foreach ($slides as $slide): ?>
                    <li data-transition="fade" data-slotamount="7" data-masterspeed="1000">
                        <img src="<?= htmlspecialchars($slide['IMAGE']) ?>" alt="slider-image" data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
                        <div class="caption dark sfb fadeout" data-x="750" data-y="170" data-speed="400" data-start="800" data-easing="Power4.easeOut">
                            <h2><?= htmlspecialchars($slide['TITLE']) ?></h2>
                            <h3><?= htmlspecialchars($slide['SUBTITLE']) ?></h3>
                            <a href="<?= htmlspecialchars($slide['LINK']) ?>" class="caption-btn">Shop The Collection</a>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>