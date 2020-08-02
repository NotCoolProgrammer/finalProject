<?php  require 'includes/header.php';  ?>

<section class="register container">
    <h1 class="register__greeting">register</h1>
    <form action="/registerUser" class="register__user" id="register__user" method="POST" enctype="multipart/form-data" name="register__user">
        <div class="input__fields flex">
            <div class="input__fields__left flex">
                <input type="text" class="firstName" id="firstName" name="firstName" placeholder=" First Name">
                <p class="warningFirstName">Имя на русском, не более 12 букв</p>
                <input type="text" class="lastName" id="lastName" name="lastName" placeholder="Last Name">
                <p class="warningLastName">Фамилия на русском, не более 15 букв</p>
                <input type="text" class="login" id="login" name="login" placeholder="Email">
                <p class="warningEmail">Используйте одну из популярных почт (yandex.ru, mail.ru, gmail.com)</p>
                <p class="dublicateEmail">Введенная вами почта уже существует</p>
                <input type="text" class="mobile" id="mobile" name="mobile" placeholder="Mobile">
                <p class="warningNumber">Телефон в формате +70000000000</p>
            </div>
            <div class="input__fields__right flex">
                <input type="password" class="password1" id="password1" name="password1" placeholder="Password">
                <p class="warningPassword1">Пароль меньше 5 символов</p>
                <input type="password" class="password2" id="password2" placeholder="Retype password">
                <div class="descWarning flex">
                    <p class="warningPassword2">Пароль меньше 5 символов</p>
                    <p class="warningPassword">Пароли не совпадают</p>
                </div>
                <div class="image">
                    <p class="image__text">Загрузить фотографию:</p>
                    <input type="file" name="image" id="image" accept="image/*" class="img__input">
                    <p class="empty__field">Картинка не выбрана</p>
                </div>
            </div>
        </div>
        <input type="submit" value="Register" name="submit" id="submit" class="submit">
    </form>
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
    <nav class="footer__company">
        <h3 class="footer1__head">Company</h3>
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="#">Shop</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">How It Work</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </nav>
    <nav class="footer__information">
        <h3 class="footer1__head">Information</h3>
        <ul>
            <li><a href="#">Tearms & Condition</a></li>
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">How to Buy</a></li>
            <li><a href="#">How to Sell</a></li>
            <li><a href="#">Promotion</a></li>
        </ul>
    </nav>
    <nav class="footer__shop_category">
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

<div class="temp__block"></div>

<script src="/JS/interactionWithElements.js"></script>
<script src="/JS/validationRegisterForm.js"></script>