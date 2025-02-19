<?php

use Bitrix\Main\Web\Json;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
    die();

$this->setFrameMode(true);

if (empty($arResult["ALL_ITEMS"]))
    return;

CUtil::InitJSCore();
\Bitrix\Main\UI\Extension::load('ui.fonts.opensans');

$menuBlockId = "catalog_menu_".$this->randString();
?>
<div class="container" id="navcontainer">
    <div class="sixteen columns" id="nav">

        <a href="#menu" class="menu-trigger"><i class="fa fa-bars"></i> Menu</a>

        <nav id="navigation">
            <ul class="menu" id="responsive">
                <li><a href="/" class="homepage">Home</a></li>
                <?php
                foreach($arResult["MENU_STRUCTURE"] as $itemID => $arColumns) {
                    $class = "";
                    if ($arResult["ALL_ITEMS"][$itemID]["SELECTED"]) {
                        $class .= " bx-active";
                    }
                    $hasSubmenu = is_array($arColumns) && !empty($arColumns);
                    ?>
                    <li class="<?= $hasSubmenu ? 'dropdown' : '' ?><?= $class ?>">
                        <a href="<?= $arResult["ALL_ITEMS"][$itemID]["LINK"] ?>">
                            <?= htmlspecialcharsbx($arResult["ALL_ITEMS"][$itemID]["TEXT"]) ?>
                        </a>
                        <?php if ($hasSubmenu) { ?>
                            <ul style="padding-left: 0">
                                <?php foreach ($arColumns as $key => $arRow) { ?>
                                    <?php foreach ($arRow as $itemIdLevel_2 => $arLevel_3) { ?>
                                        <li>
                                            <a href="<?= $arResult["ALL_ITEMS"][$itemIdLevel_2]["LINK"] ?>">
                                                <?= $arResult["ALL_ITEMS"][$itemIdLevel_2]["TEXT"] ?>
                                            </a>
                                            <?php if (is_array($arLevel_3) && !empty($arLevel_3)) { ?>
                                                <ul style="padding-left: 0">
                                                    <?php foreach ($arLevel_3 as $itemIdLevel_3) { ?>
                                                        <li>
                                                            <a href="<?= $arResult["ALL_ITEMS"][$itemIdLevel_3]["LINK"] ?>">
                                                                <?= $arResult["ALL_ITEMS"][$itemIdLevel_3]["TEXT"] ?>
                                                            </a>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            <?php } ?>
                                        </li>
                                    <?php } ?>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </div>
</div>

<script>
    BX.ready(function () {
        window.obj_<?=$menuBlockId?> = new BX.Main.MenuComponent.CatalogHorizontal('<?=CUtil::JSEscape($menuBlockId)?>', <?= Json::encode($arResult["ITEMS_IMG_DESC"]) ?>);
    });
</script>
