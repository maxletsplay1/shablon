<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Iblock\SectionPropertyTable;
$this->setFrameMode(true);
$templateData = [
    'TEMPLATE_CLASS' => 'bx-'.$arParams['TEMPLATE_THEME']
];
if (isset($templateData['TEMPLATE_THEME'])) {
    $this->addExternalCss($templateData['TEMPLATE_THEME']);
}
$filterUrl = $arResult["FORM_ACTION"] . "filter/price-base-from-" . $arResult["ITEMS"]["PRICE"]["VALUES"]["MIN"]["HTML_VALUE"] . "-to-" . $arResult["ITEMS"]["PRICE"]["VALUES"]["MAX"]["HTML_VALUE"] . "/apply/";
?>
<div class="filter-container <?=$templateData["TEMPLATE_CLASS"]?>">
    <div class="filter-section">
        <h3 class="filter-title"><?echo GetMessage("CT_BCSF_FILTER_TITLE")?></h3>
        <form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?=$filterUrl?>" method="get">
            <?foreach($arResult["HIDDEN"] as $arItem):?>
                <input type="hidden" name="<?echo $arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
            <?endforeach;?>
            <div class="widget">
                <h3 class="headline">Filter By Price</h3><span class="line"></span><div class="clearfix"></div>
                <div id="price-range">
                    <div class="padding-range"><div id="slider-range"></div></div>
                    <label for="amount">Price:</label>
                    <input type="text" id="amount" readonly />
                    <input type="hidden" name="min_price" id="min_price" value="<?echo $arResult["ITEMS"]["PRICE"]["VALUES"]["MIN"]["HTML_VALUE"]?>" />
                    <input type="hidden" name="max_price" id="max_price" value="<?echo $arResult["ITEMS"]["PRICE"]["VALUES"]["MAX"]["HTML_VALUE"]?>" />
                    <button type="submit" class="button color">Filter</button>
                </div>
                <div class="clearfix"></div>
            </div>
        </form>
    </div>
</div>
<script>
    BX.ready(function() {
        $("#slider-range").slider({
            range: true,
            min: <?echo $arResult["ITEMS"]["PRICE"]["VALUES"]["MIN"]["VALUE"]?>,
            max: <?echo $arResult["ITEMS"]["PRICE"]["VALUES"]["MAX"]["VALUE"]?>,
            values: [<?echo $arResult["ITEMS"]["PRICE"]["VALUES"]["MIN"]["HTML_VALUE"]?:$arResult["ITEMS"]["PRICE"]["VALUES"]["MIN"]["VALUE"]?>, <?echo $arResult["ITEMS"]["PRICE"]["VALUES"]["MAX"]["HTML_VALUE"]?:$arResult["ITEMS"]["PRICE"]["VALUES"]["MAX"]["VALUE"]?>],
            slide: function(event, ui) {
                $("#amount").val(ui.values[0] + " - " + ui.values[1]);
                $("#min_price").val(ui.values[0]);
                $("#max_price").val(ui.values[1]);
                var newUrl = "<?echo $arResult["FORM_ACTION"]?>" + "filter/price-base-from-" + ui.values[0] + "-to-" + ui.values[1] + "/apply/";
                $("form[name='<?echo $arResult["FILTER_NAME"]."_form"?>']").attr("action", newUrl);
            }
        });
        $("#amount").val($("#slider-range").slider("values", 0) + " - " + $("#slider-range").slider("values", 1));
    });
</script>
