<?php require 'includes/header.php' ?>


<?php 
    $userProducts = json_decode($userProducts, true);
?>
    <nav class="promo__shopping__cart flex">
        <div class="promo__shopping__cart__info container flex">
            <p class="promo__shopping__cart__info__header">New Arrivals</p>
            <div class="block_right">
                <a href="/" class="menu__prom__link">Home /</a>
                <a href="#" class="menu__prom__link"> Men /</a>
                <a href="#" class="menu__prom__link"> <span> New Arrivals </span> </a>
            </div>
        </div>
    </nav>

    <section class="categories container flex">
        <div class="categories__left flex">
            <p class="category">product details</p>
        </div>
        <div class="categories__right flex">
            <p>UNITE PRICE</p>
            <p>QUANTITY</p>
            <p>SHIPPING</p>
            <p>SUBTOTAL</p>
            <p>ACTION</p>
        </div>
    </section>

    <section class="cart__product container">
        <?php foreach ($userProducts as  $product): ?>
            <div class="cart__product__notes flex">
                <div class="unique__cart flex">
                    <a href="/singleProduct/<?php echo $product['singleview'] ?>">
                        <div class="cart__img flex">
                            <img src="<?php echo $product['mainimg'] ?>" alt="man">
                            <div class="cart_desc">
                                <p class="product__name"><?php echo $product['name'] ?></p>
                                <p class="color">
                                    Color: <span class="span_grey"> <?php echo $product['color']  ?></span> <br>
                                    Size: <span class="span_grey"> <?php echo $product['size']  ?> </span>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="product__details flex">
                    <div class="product__details__price">
                        <span class="product__currency">$</span>
                        <span class="product__value"> <?php echo $product['price']  ?></span>
                    </div>
                    <p class="product__count"> <?php echo $product['count'] ?></p>
                    <p class="product__delivery">free</p>
                    <div class="subtotal__product__details__price">
                        <span class="subtotal__product__currency">$</span>
                        <span class="subtotal__product__value">
                            <?php
                                $priceOfProduct = $product['price'];
                                $countOfProduct = $product['count'];
                                $totalPrice = $priceOfProduct * $countOfProduct;
                                echo $totalPrice;
                            ?>
                        </span>
                    </div>
                    <span class="delete__product" data-id="<?php echo $product['id'] ?>"><i class="fas fa-times-circle"></i></span>
                </div>
            </div>
        <?php  endforeach; ?>
    </section>

    <section class="control__button container">
        <button class="control__button__left">Clear shopping cart</button>
    </section>

    <section class="form">
        <div class="form__all container flex">
            <div class="form__1 flex" id="coupon__form">
                <p class="form__1__header">coupon discount</p>
                <p class="description">Enter your coupon code if you have one</p>
                <input type="text" placeholder="Coupon" class="coupon">
                <p class="empty__field">Пустое поле, введите купон</p>
                <p class="warning__coupon">Такого купона не существует</p>
                <p class="dublicate__coupon">Купон уже был введен <br> Удалите старый купон для введения нового</p>
                <p class="delete__coupon__text">Купон был удален</p>
                <p class="apply__coupon__text">Купон был принят</p>
                <p class="no__products__in__the__cart">Нет товаров в корзине <br> Приобретите что нибудь, чтобы была скидочка</p>
                <div class="buttons flex">
                    <button class="apply__coupon">Apply coupon</button>
                    <button class="delete__coupon">Delete coupon</button>
                </div>
            </div>
            <div class="form__2 flex">
                <div class="form__2__header1 flex">
                    <p class="grand">grand total
                        <div class="amount__without__discount flex">
                            <span class="total__product__currency__withoutDiscount">$</span>
                            <span class="total__product__value__withoutDiscount">0</span>
                        </div>
                        <div class="amount__with__discount flex">
                            <span class="total__product__currency__withDiscount">$</span>
                            <span class="total__product__value__withDiscount">0</span>
                        </div>
                    </p>
                </div>
                <div class="form__2__header2">
                    <a href="/checkout" class="checkout flex">proceed to checkout</a>
                </div>
            </div>
        </div>
    </section>

    <?php require 'includes/footer.php' ?>
    <script src="/JS/workWithCart.js"></script>


</body>

</html>