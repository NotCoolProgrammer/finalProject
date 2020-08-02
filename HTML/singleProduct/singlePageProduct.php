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


    <?php  
        $handleRequest();
    ?>

    <section class="similar__product container">
        <h3 class="similar__product__h3 flex">you may like also</h3>
        <div class="similar__product__box container flex">
            <!-- здесь генерятся первые 4 товара -->
        </div>
    </section>

    <!-- доделать блок -->
    <section class="feedback flex">
        <div class="feedback__img">
            <h1 class="text__for__feedback__form">Please, write a review about our site</h1>
            <form class="feedback__form flex container bxbb" name="feedback__form" id="feedback__form">
                
                <?php if (!is_null($_SESSION['currentUser'])): ?>
                    <input type="text" class="feedback__form__name" name="name" placeholder="Name" value="<?php echo $user['firstname'] ?>" disabled>
                    <p class="warningFirstName">Имя на русском, не более 12 букв</p>
                    <input type="text" class="feedback__form__surname" name="surname" placeholder="Surname" value="<?php echo $user['lastname'] ?>" disabled >
                    <p class="warningLastName">Фамилия на русском, не более 15 букв</p>
                <?php else: ?>
                    <input type="text" class="feedback__form__name" name="name" placeholder="Name">
                    <p class="warningFirstName">Имя на русском, не более 12 букв</p>
                    <input type="text" class="feedback__form__surname" name="surname" placeholder="Surname" >
                    <p class="warningLastName">Фамилия на русском, не более 15 букв</p>
                <?php endif; ?>

                <div class="feedback__form__review flex">
                    <div class="review__and__stars flex">
                        <p class="review__and__stars__text">Write a review and mark your rating here</p>
                        <div class="icons">
                            <i class="fas fa-star orange" data-id="1"></i>
                            <i class="fas fa-star orange" data-id="2"></i>
                            <i class="fas fa-star orange" data-id="3"></i>
                            <i class="fas fa-star orange" data-id="4"></i>
                            <i class="fas fa-star orange" data-id="5"></i>
                        </div>
                    </div>
                    <textarea name="feedback__form__review__content" class="feedback__form__review__content"></textarea>
                    <p class="warningText">Слишком маленький отзыв (допускается от 15 букв)</p>
                </div>
                <span class="submit__button flex">Submit review</span>
            </form>
        </div>
    </section>

    <footer class="footer1 flex container">
        <div class="footer1__description">
            <a href="/" class="logo"><img class="logo__img" src="../img/logo.png" alt="">BRAN<span>D</span></a>
            <p class="footer1__description__text">Objectively transition extensive data rather than cross functional solutions. Monotonectally
                syndicate multidisciplinary materials before go forward benefits. Intrinsicly syndicate an expanded
                array of processes and cross-unit partnerships.
            </p>

            <p class="footer1__description__text">Efficiently plagiarize 24/365 action items and focused infomediaries.
                Distinctively seize superior initiatives for wireless technologies. Dynamically optimize.
            </p>
        </div>
        <nav class="footer1__company">
            <h3 class="footer1__head">Company</h3>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="#">Shop</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">How It Work</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
        <nav class="footer1__information">
            <h3 class="footer1__head">Information</h3>
            <ul>
                <li><a href="#">Tearms & Condition</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">How to Buy</a></li>
                <li><a href="#">How to Sell</a></li>
                <li><a href="#">Promotion</a></li>
            </ul>
        </nav>
        <nav class="footer1__shop__category">
            <h3 class="footer1__head">Shop Category</h3>
            <ul>
                <li><a href="/allProducts">Men</a></li>
                <li><a href="/allProducts">Woman</a></li>
                <li><a href="/allProducts">Child</a></li>
                <li><a href="/allProducts">Apparel</a></li>
                <li><a href="/allProducts">Brows All</a></li>
            </ul>
        </nav>
    </footer>

    <footer class="footer2">
        <div class="footer2__content container flex">
            <div class="footer2__text flex">
                <p>© 2020 Brand All Rights Reserved.</p>
            </div>
            <div class="footer2__soc__net flex">
                <a class="flex" target="_blank" href="https://vk.com/alexandr.tvelenev"><i class="fab fa-vk"></i></a>
                <a class="flex" target="_blank" href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                <a class="flex" target="_blank" href="https://twitter.com/home"><i class="fab fa-twitter"></i></a>
                <a class="flex" target="_blank" href="#"><i class="fab fa-linkedin-in"></i></a>
                <a class="flex" target="_blank" href="#"><i class="fab fa-pinterest-p"></i></a>
                <a class="flex" target="_blank" href="#"><i class="fab fa-google-plus-g"></i></a>
            </div>
        </div>
    </footer>

    <div class="shadow"></div>
    <div class="temp__block"></div>
    <script>
        let images = <?php echo json_encode($images); ?>
    </script>
    <script src="../JS/interactionWithElements.js"></script>
    <script src="../JS/generateSlider.js"></script>
    <script src="../JS/generateAllProducts.js"></script>
    <script src="../JS/addProductToCart.js"></script>
    <script src="../JS/reviewForm.js"></script>

</body>
</html>