<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>

<?php
use Bitrix\Main;
use Bitrix\Main\Localization\Loc;

\Bitrix\Main\UI\Extension::load(["ui.fonts.ruble", "ui.fonts.opensans"]);
?>

<div class="container cart">
    <div class="sixteen columns">
        <table class="cart-table responsive-table">
            <tr>
                <th>Item</th>
                <th>Description</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th></th>
            </tr>

            <?php
            $cartItems = CSaleBasket::GetList(
                array('NAME' => 'ASC'),
                array('FUSER_ID' => CSaleBasket::GetBasketUserID(), 'LID' => SITE_ID, 'ORDER_ID' => 'NULL')
            );

            $totalPrice = 0;

            while ($item = $cartItems->Fetch()) {
                $productId = $item['PRODUCT_ID'];
                $productName = $item['NAME'];
                $productPrice = $item['PRICE'];
                $productQuantity = $item['QUANTITY'];
                $productTotal = $productPrice * $productQuantity;
                $totalPrice += $productTotal;

                $res = CIBlockElement::GetList(
                    array(),
                    array('ID' => $productId),
                    false,
                    false,
                    array('ID', 'NAME', 'DETAIL_PICTURE')
                );
                $arProduct = $res->Fetch();
                $productImage = CFile::GetPath($arProduct['DETAIL_PICTURE']);
                ?>

                <tr>
                    <td><img src="<?= $productImage ?>" alt="<?= $productName ?>" /></td>
                    <td class="cart-title"><a href="#"><?= $productName ?></a></td>
                    <td><?= number_format($productPrice, 2) ?>₽</td>
                    <td>
                        <form action="<?= $APPLICATION->GetCurPage() ?>" method="POST">
                            <input type="hidden" name="update_quantity" value="<?= $item['ID'] ?>" />
                            <div class="qtyminus"></div>
                            <input type="text" name="quantity" value="<?= $productQuantity ?>" class="qty" />
                            <div class="qtyplus"></div>
                            <button type="submit" style="display:none;"></button>
                        </form>
                    </td>
                    <td class="cart-total"><?= number_format($productTotal, 2) ?>₽</td>
                    <td>
                        <form action="<?= $APPLICATION->GetCurPage() ?>" method="POST">
                            <input type="hidden" name="delete_item" value="<?= $item['ID'] ?>" />
                            <button type="submit" class="cart-remove">Удалить</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>

        <table class="cart-table bottom">
            <tr>
                <th>
                    <form action="#" method="get" class="apply-coupon">
                        <input class="search-field" type="text" placeholder="Coupon Code" value="" />
                        <a href="#" class="button gray">Apply Coupon</a>
                    </form>

                    <div class="cart-btns">
                        <a href="http://site4.maxletspay.beget.tech/personal/order/make/" class="button color cart-btns proceed">Proceed to Checkout</a>
                        <a href="#" class="button gray cart-btns">Update Cart</a>
                    </div>
                </th>
            </tr>
        </table>
    </div>

    <div class="eight columns cart-totals">
        <h3 class="headline">Cart Totals</h3><span class="line"></span><div class="clearfix"></div>

        <table class="cart-table margin-top-5">
            <tr>
                <th>Cart Subtotal</th>
                <td><strong><?= number_format($totalPrice, 2) ?>₽</strong></td>
            </tr>

            <tr>
                <th>Shipping and Handling</th>
                <td>Free Shipping</td>
            </tr>

            <tr>
                <th>Order Total</th>
                <td><strong><?= number_format($totalPrice, 2) ?>₽</strong></td>
            </tr>
        </table>
        <br>
    </div>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_quantity'])) {
    $basketItemId = $_POST['update_quantity'];
    $newQuantity = intval($_POST['quantity']);

    if ($newQuantity > 0) {
        CSaleBasket::Update($basketItemId, array(
            'QUANTITY' => $newQuantity
        ));
    }

    LocalRedirect($APPLICATION->GetCurPage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_item'])) {
    $basketItemId = $_POST['delete_item'];
    CSaleBasket::Delete($basketItemId);
    LocalRedirect($APPLICATION->GetCurPage());
}
?>

<script>
    document.querySelectorAll('.qtyplus').forEach(function(button) {
        button.addEventListener('click', function() {
            var input = this.previousElementSibling;
            var quantity = parseInt(input.value);
            input.value = quantity + 1;
        });
    });

    document.querySelectorAll('.qtyminus').forEach(function(button) {
        button.addEventListener('click', function() {
            var input = this.nextElementSibling;
            var quantity = parseInt(input.value);
            if (quantity > 1) {
                input.value = quantity - 1;
            }
        });
    });
</script>
