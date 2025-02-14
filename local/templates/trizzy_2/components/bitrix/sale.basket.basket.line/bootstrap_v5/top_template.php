<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/**
 * @global array $arParams
 * @global CUser $USER
 * @global CMain $APPLICATION
 * @global string $cartId
 */
$compositeStub = (isset($arResult['COMPOSITE_STUB']) && $arResult['COMPOSITE_STUB'] == 'Y');
$currentUrl = urlencode($APPLICATION->GetCurPageParam("", ["login", "logout", "register", "forgot_password", "clear_cache", "backurl"]));
$pathToAuthorize = $arParams['PATH_TO_AUTHORIZE'] . (mb_stripos($arParams['PATH_TO_AUTHORIZE'], '?') === false ? '?' : '&') . 'login=yes&backurl='.$currentUrl;
$pathToRegister = $arParams['PATH_TO_REGISTER'] . (mb_stripos($arParams['PATH_TO_REGISTER'], '?') === false ? '?' : '&') . 'register=yes&backurl='.$currentUrl;
?>

<div class="container header-container">
    <div class="logo">
        <a href="<?=$arParams['PATH_TO_HOME'] ?? '/'?>">
            <img src="<?=SITE_TEMPLATE_PATH?>/images/logo.png" alt="Trizzy" />
        </a>
    </div>

    <div class="menu-and-cart">
        <div id="additional-menu">
            <ul>
                <li><a href="<?=$arParams['PATH_TO_BASKET']?>">Корзина</a></li>
                <li><a href="<?=$arParams['PATH_TO_ORDER']?>">Заказать</a></li>
                <li><a href="<?=$arParams['PATH_TO_PERSONAL']?>">Мой профиль</a></li>
                <?if ($USER->IsAuthorized()):?>
                    <li><a href="?logout=yes&<?=bitrix_sessid_get()?>">Выйти</a></li>
                <?else:?>
                    <li><a href="<?=$pathToAuthorize?>">Войти</a></li>
                    <li><a href="<?=$pathToRegister?>">Регистрация</a></li>
                <?endif;?>
            </ul>
        </div>

        <div class="cart-and-search">
            <div id="cart">
                <div class="cart-btn">
                    <?php
                    $totalPrice = $compositeStub || $arParams['SHOW_TOTAL_PRICE'] != 'Y'
                        ? 0
                        : floatval($arResult['TOTAL_PRICE']);
                    $currency = $arResult['CURRENCY'] ?? 'RUB';
                    ?>
                    <a href="/personal/cart/" class="button adc">
                        <?= CurrencyFormat($totalPrice, $currency) ?>
                    </a>
                </div>
            </div>

            <nav class="top-search">
                <form action="#" method="get">
                    <button><i class="fa fa-search"></i></button>
                    <input class="search-field" type="text" placeholder="Search" value=""/>
                </form>
            </nav>
        </div>
    </div>
</div>

