<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;
use Bitrix\Catalog\ProductTable;
use Bitrix\Sale\Basket;
use Bitrix\Iblock\ElementTable;
use Bitrix\Catalog\PriceTable;
use Bitrix\Iblock\PropertyTable;

Loader::includeModule("catalog");
Loader::includeModule("sale");
Loader::includeModule("iblock");

$productId = $arParams["ELEMENT_ID"];
if (!$productId) {
    ShowError("Товар не найден");
    return;
}

$product = CIBlockElement::GetByID($productId)->GetNext();
if (!$product) {
    ShowError("Товар не найден");
    return;
}

$skuIblockId = CCatalogSku::GetInfoByProductIBlock($product["IBLOCK_ID"])["IBLOCK_ID"];
$offers = [];
$colors = [];
$sizes = [];

if ($skuIblockId) {
    $offersRes = CIBlockElement::GetList(
        [],
        ["IBLOCK_ID" => $skuIblockId, "PROPERTY_CML2_LINK" => $productId, "ACTIVE" => "Y"],
        false,
        false,
        ["ID", "NAME", "CATALOG_QUANTITY", "PROPERTY_COLOR", "PROPERTY_SIZE"]
    );
    while ($offer = $offersRes->GetNext()) {
        $offers[] = $offer;
        if (!in_array($offer["PROPERTY_COLOR_VALUE"], $colors)) {
            $colors[] = $offer["PROPERTY_COLOR_VALUE"];
        }
        if (!in_array($offer["PROPERTY_SIZE_VALUE"], $sizes)) {
            $sizes[] = $offer["PROPERTY_SIZE_VALUE"];
        }
    }
}

$priceRes = PriceTable::getList([
    'filter' => ['=PRODUCT_ID' => $productId],
    'select' => ['PRICE', 'CURRENCY']
])->fetch();
$product['PRICE'] = $priceRes ? $priceRes['PRICE'] : 'Цена не указана';

// Получаем старую и новую цену
$oldPrice = $product['PRICE']; // старая цена
$newPrice = $product['PRICE']; // новая цена (если есть)

$discountPriceRes = PriceTable::getList([
    'filter' => ['=PRODUCT_ID' => $productId, '=CATALOG_GROUP_ID' => 1], // если скидка применима
    'select' => ['PRICE']
])->fetch();

if ($discountPriceRes) {
    $newPrice = $discountPriceRes['PRICE'];
    $oldPrice = $product['PRICE'];
}

$productPhotos = [];
if ($product['DETAIL_PICTURE']) {
    $productPhotos[] = CFile::GetPath($product['DETAIL_PICTURE']);
}
$resPhotos = CIBlockElement::GetProperty(
    $product["IBLOCK_ID"],
    $productId,
    [],
    ["CODE" => "MORE_PHOTO"]
);
while ($photo = $resPhotos->Fetch()) {
    if ($photo["VALUE"]) {
        $productPhotos[] = CFile::GetPath($photo["VALUE"]);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ADD_TO_CART'])) {
    $productToAdd = intval($_POST["OFFER_ID"]);
    $basket = Basket::loadItemsForFUser(
        Bitrix\Sale\Fuser::getId(),
        Bitrix\Main\Context::getCurrent()->getSite()
    );
    $item = $basket->createItem("catalog", $productToAdd);
    $item->setFields([
        "QUANTITY" => 1,
        "CURRENCY" => "RUB",
        "LID" => Bitrix\Main\Context::getCurrent()->getSite(),
        "PRICE" => $product['PRICE']
    ]);
    $basket->save();
    LocalRedirect($APPLICATION->GetCurPageParam("", ["ADD_TO_CART"]));
}
?>

<div class="container">
    <div class="eight columns">
        <div class="slider-padding">
            <div id="product-slider" class="royalSlider rsDefault">
                <?php foreach ($productPhotos as $photo): ?>
                    <img class="rsImg" src="<?=$photo?>" alt="<?=htmlspecialchars($product['NAME'])?>" />
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="eight columns">
        <div class="product-page">
            <section class="title">
                <h2><?=$product['NAME']?></h2>
                <span class="product-price-discount">
                    <?php if ($newPrice < $oldPrice): ?>
                        <span class="old-price" style="text-decoration: line-through;"><?=$oldPrice?> руб.</span>
                    <?php endif; ?>
                    <span class="new-price"><?=$newPrice?> руб.</span>
                </span>
            </section>

            <section class="variables">
                <div class="four alpha columns">
                    <label for="size">Size</label>
                    <select id="size" name="size">
                        <?php foreach ($sizes as $size): ?>
                            <option value="<?=$size?>"><?=$size?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="four omega columns">
                    <label for="color">Color</label>
                    <select id="color" name="color">
                        <?php foreach ($colors as $color): ?>
                            <option value="<?=$color?>"><?=$color?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </section>

            <section class="linking">
                <form method="POST">
                    <input type="hidden" name="ADD_TO_CART" value="Y" />
                    <input type="hidden" id="offer-id" name="OFFER_ID" value="" />
                    <button type="submit" class="button adc">Add to Cart</button>
                </form>
            </section>
        </div>
    </div>
</div>
