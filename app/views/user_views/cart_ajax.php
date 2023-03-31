<?php session_start();
?>
<table class="table cart mb-5">
    <thead>
        <tr>
            <th class="cart-product-remove">&nbsp;</th>
            <th class="cart-product-thumbnail">&nbsp;</th>
            <th class="cart-product-name">Product</th>
            <th class="cart-product-price">Unit Price</th>
            <th class="cart-product-quantity">Quantity</th>
        </tr>
    </thead>
    <tbody>

        <?php if (!empty($_SESSION['cart'])) {
            $total_price = 0; // Khởi tạo biến tổng tiền toàn giỏ hàng
            foreach ($_SESSION['cart'] as $index => $cart) {
                $product_id = 'product' . $index;
                ?>
                <tr class="cart_item">
                    <td class="cart-product-remove">
                        <i data-id="<?php echo $index ?>" class="icon-trash2"></i>
                    </td>

                    <td class="cart-product-thumbnail">
                        <img th="64" height="64" src="../../../public/image/<?php echo $cart['image'] ?>"
                            alt="<?php echo $cart['name'] ?>"></a>
                    </td>

                    <td class="cart-product-name">
                        <a href="#">
                            <?php echo $cart['name'] ?>
                        </a>
                    </td>

                    <td class="cart-product-price">
                        <span class="amount">
                            <input type="hidden" name="price<?php echo $index ?>" id="price<?php echo $index ?>"
                                value="<?php echo $cart['price']; ?>">
                                $<?php echo number_format($cart['price'], 0, '.', ',');?>
                        </span>
                    </td>

                    <td class="cart-product-quantity">
                        <div class="quantity">
                            <input onclick="decrement(<?php echo $index ?>)" type="button" value="-" class="minus">
                            <input data-id="<?php echo $index ?>" type="number" id="quantity<?php echo $index ?>"
                                value="<?php echo $cart['quantity']; ?>" name="itemQuantity<?php echo $index ?>" min="1"
                                max="20">
                            <input onclick="increment(<?php echo $index ?>)" type="button" value="+" class="plus">
                        </div>
                    </td>
                </tr>
            <?php }
        }else{$total_price = 0;}
        ?>


    </tbody>

</table>

<div class="row col-mb-30">
    <div class="col-lg-6">
        <h4>Cart Totals</h4>

        <div class="table-responsive">
            <table class="table cart cart-totals">
                <tbody>
                    <tr class="cart_item">
                        <td class="cart-product-name">
                            <strong>Cart Subtotal</strong>
                        </td>

                        <td class="cart-product-name">

                            <?php if (!empty($_SESSION['cart'])) {
                                $total_price = 0;
                                foreach ($_SESSION['cart'] as $index => $cart_item) {
                                    $total_price += $cart_item['quantity'] * $cart_item['price'];
                                }
                            }else{
                                $total_price = 0;
                            } ?>
                            <span class="amount">
                            $<?php echo number_format($total_price, 0, '.', ',');?>
                            </span>
                        </td>
                    </tr>
                    <tr class="cart_item">
                        <td class="cart-product-name">
                            <strong>Shipping</strong>
                        </td>

                        <td class="cart-product-name">
                            <span class="amount">Free Delivery</span>
                        </td>
                    </tr>
                    <tr class="cart_item">
                        <td class="cart-product-name">
                            <strong>Total</strong>
                        </td>

                        <td class="cart-product-name">
                            <?php if (!empty($_SESSION['cart'])) {
                                $total_price = 0;
                                foreach ($_SESSION['cart'] as $index => $cart_item) {
                                    $total_price += $cart_item['quantity'] * $cart_item['price'];
                                }
                            } else{
                                $total_price = 0;
                            } ?>
                            <span class="amount color lead"><strong>
                            $<?php echo number_format($total_price, 0, '.', ',');?>
                                </strong></span>
                        </td>
                    </tr>
                </tbody>

            </table>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="row justify-content-between py-2 col-mb-30">
            <div class="col-lg-auto ps-lg-0">
                <div class="row">
                    <div class="col-md-8">
                        <input type="text" value="" class="sm-form-control text-center text-md-start"
                            placeholder="Enter Coupon Code..">
                    </div>
                    <div class="col-md-4 mt-3 mt-md-0">
                        <a href="#" class="button button-3d button-black m-0">Apply Coupon</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-auto pe-lg-0">
                <a href="shop.html" class="button button-3d mt-2 mt-sm-0 me-0">Proceed to
                    Checkout</a>
            </div>
        </div>
    </div>
</div>