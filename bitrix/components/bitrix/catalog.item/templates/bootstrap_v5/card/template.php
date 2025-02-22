<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Context;
use \Bitrix\Sale\Basket;
use \Bitrix\Catalog\Product;

$item = $arResult["ITEM"];
$itemId = $item["ID"];
$itemTitle = $item["NAME"];
$itemLink = $item["DETAIL_PAGE_URL"];
$itemImage = $item["PREVIEW_PICTURE"]["SRC"];
$itemImageHover = $item["DETAIL_PICTURE"]["SRC"];
$itemCategory = $item["SECTION_NAME"];
$iblockId = $item["IBLOCK_ID"];

if(isset($item["OFFERS"]) && is_array($item["OFFERS"]) && !empty($item["OFFERS"])){
    $offer = $item["OFFERS"][0];
    if (isset($offer['ITEM_PRICES']) && is_array($offer['ITEM_PRICES']) && !empty($offer['ITEM_PRICES'])) {
        $price = $offer['ITEM_PRICES'][0];
        $currentPrice = $price['PRINT_PRICE'];
        $oldPrice = "";
        $discountPercent = 0;
        $showDiscount = false;
    } else {
        $currentPrice = "Цена не указана";
        $oldPrice = "";
        $discountPercent = 0;
        $showDiscount = false;
    }
} else {
    if(isset($item["MIN_PRICE"])){
        $price = $item["MIN_PRICE"];
        $oldPrice = $price["PRINT_VALUE"];
        $currentPrice = $price["DISCOUNT_VALUE"] ?? $price["PRINT_VALUE"];
        $discountPercent = $price["DISCOUNT_DIFF_PERCENT"] ?? 0;
        $showDiscount = isset($price["DISCOUNT_VALUE"]) && $price["DISCOUNT_VALUE"] < $price["PRINT_VALUE"];
    } else {
        if (isset($item['ITEM_PRICES']) && is_array($item['ITEM_PRICES']) && !empty($item['ITEM_PRICES'])) {
            $price = $item['ITEM_PRICES'][0];
            $currentPrice = $price['PRINT_VALUE'];
            $oldPrice = "";
            $discountPercent = 0;
            $showDiscount = false;
        } else {
            $currentPrice = "Цена не указана";
            $oldPrice = "";
            $discountPercent = 0;
            $showDiscount = false;
        }
    }
}

?>

<div class="four shop columns">
    <figure class="product" id="product-<?= $itemId ?>">
        <div class="mediaholder">
            <a href="<?= $itemLink ?>">
                <img alt="<?= $itemTitle ?>" src="<?= $itemImage ?>"/>
                <?php if ($itemImageHover): ?>
                    <div class="cover">
                        <img alt="<?= $itemTitle ?>" src="<?= $itemImageHover ?>"/>
                    </div>
                <?php endif; ?>
            </a>
        </div>

        <a href="<?= $itemLink ?>">
            <section>
                <span class="product-category"><?= $itemCategory ?></span>
                <h5><?= $itemTitle ?></h5>
                <?php if ($showDiscount): ?>
                    <span class="product-price-discount">
                        <?= $currentPrice ?> <i><?= $oldPrice ?></i>
                    </span>
                    <?php if ($discountPercent > 0): ?>
                        <div class="product-discount">-<?= $discountPercent ?>%</div>
                    <?php endif; ?>
                <?php else: ?>
                    <span class="product-price"><?= $currentPrice ?></span>
                <?php endif; ?>
            </section>
        </a>
    </figure>
</div>
