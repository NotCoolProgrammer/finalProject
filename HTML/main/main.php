<?php require 'includes/header.php' ?>

    <section class="promo">
        <div class="promo__content container flex">
            <div class="promo__text">
                <h2 class="promo__h2">THE BRAND</h2>
                <h3 class="promo__h3">OF LUXERIOUS <span>FASHION</span></h3>
            </div>
        </div>
    </section >

    <section class="middle container flex">
        <div class="middle__left">
            <a href="/allProducts" class="middle__left__promo1 promo1 flex">
                <div class="text bxbb text1">hot deal <span>for men</span></div>
            </a>
            <a href="/allProducts" class="middle__left__promo1 promo2 flex">
                <div class="text bxbb text2">luxirous & trendy <span>accesories</span></div>
                <div class="promo_img"></div>
            </a>
        </div>
        <div class="middle__right">
            <a href="/allProducts" class="middle__right__promo2 promo3 flex">
                <div class="text bxbb text3">30% offer <span>women</span></div>
            </a>
            <a href="/allProducts" class="middle__right__promo2 promo4 flex">
                <div class="text bxbb text4">new arrivals <span>for kids</span></div>
            </a>
        </div>
    </section>

    <section class="product container">
        <h3 class="flex">Fetured Items</h3>
        <p class="product__store__desc flex">Shop for items based on what we featured in this week</p>
        <div class="product-box container">
            <!-- Сюда генерятся все товары -->
        </div>
        <a href="/allProducts" class="product__all bxbb flex">Browse All Product &rarr;</a>
    </section>

    <section class="discount container flex bxbb">
        <div class="discount__offer">
            <span class="discount__link flex bxbb">
                <img class="discount__img flex" src="../img/woman.png" alt="discount">
                <div class="discount__text">
                    <h3>30% <span>offer</span></h3>
                    <p>for women</p>
                </div>
            </span>
        </div>
        <div class="discount__list">
            <div class="discount__delivery flex bxbb">
                <div class="discount__logo">
                    <img src="../img/car.svg" alt="Car">
                </div>
                <article class="discount__text__desc">
                    <h3>Free Delivery</h3>
                    <p>Worldwide delivery on all. Authorit tively morph next-generation innov tion with extensive
                        models.</p>
                </article>
            </div>
            <div class="discount__sales flex">
                <div class="discount__logo">
                    <img src="../img/sales.svg" alt="Sales">
                </div>
                <article class="discount__text__desc">
                    <h3>Sales & discounts</h3>
                    <p>Worldwide delivery on all. Authorit tively morph next-generation innov tion with extensive
                        models.</p>
                </article>
            </div>
            <div class="discount__quality flex">
                <div class="discount__logo">
                    <img src="../img/quality.svg" alt="Quality">
                </div>
                <article class="discount__text__desc">
                    <h3>Quality assurance</h3>
                    <p>Worldwide delivery on all. Authorit tively morph next-generation innov tion with extensive
                        models.</p>
                </article>
            </div>
        </div>
    </section>

    <?php require 'includes/footer.php' ?>
    <script src="/JS/generateAllProducts.js"></script>


</body>

</html>