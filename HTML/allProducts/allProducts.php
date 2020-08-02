<?php require 'includes/header.php' ?>


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

    <section class="all__products container flex">
        <ul class="all__products__navigation" id="filters">
            <div class="product__materials">
                <h2 class="product__materials__header">all product materials</h2>
                <div class="product__materials__components flex">

                </div>
            </div>
            <div class="size">
                <h2 class="product__materials__header">size</h2>
                <div class="size__label" id ="size__label">

                </div>
            </div>
            <div class="price">
                <h2 class="product__materials__header">price</h2>
                <div class="price__slider">
                    <input type="text" class="price__slider__input" name="price__slider__input">
                </div>   
            </div>
            <li class="product__list">
                <p class="product__link flex">designer</p>
                <ul class="drop__ul designer hidden">

                </ul>
            </li>
            <li class="product__list">
                <p class="product__link flex">collection</p>
                <ul class="drop__ul collection hidden">

                </ul>
            </li>
            <button class="apply__filter">Apply Filter</button>
        </ul>
        <div class="all__products__content flex">
            <div class="all__products__content__choice">
                <!-- Сюда генерятся все товары -->
            </div>
        </div>
    </section>

    <section class="discount__info">
        <div class="discount__info__content container flex">
            <div class="delivery">
                <img src="../img/delivery.svg" alt="delivery">
                <h1 class="delivery__h1">Free Delivery</h1>
                <p class="delivery__p">Worldwide delivery on all. Authorit tively morph next-generation innov tion with extensive models.</p>
            </div>
            <div class="sales">
                <img src="../img/sales.svg" alt="sales">
                <h1 class="delivery__h1">Sales & discounts</h1>
                <p class="delivery__p">Worldwide delivery on all. Authorit tively morph next-generation innov tion with extensive models.</p class="delivery__p">
            </div>
            <div class="quality">
                <img src="../img/quality.svg" alt="quality">
                <h1 class="delivery__h1">Quality assurance</h1>
                <p class="delivery__p">Worldwide delivery on all. Authorit tively morph next-generation innov tion with extensive models.</p class="delivery__p">
            </div>
        </div>
    </section>

    <?php require 'includes/footer.php' ?>
    <script src="/JS/generateAllProducts.js"></script>
    <script src="/JS/workWithAllProductsPage.js"></script>

</body>
</html>