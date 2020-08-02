<?php  require 'includes/header.php'; ?>

<?php if ($session !== null ): ?>
    <section class="main__info container">
        <div class="main__info__about__user">
            <div class="name__surname">
                <p class="designation" data-id="<?php echo $user['id'] ?>">Name and surname: </p>
                <p class="name"><?php echo $user['firstname']; ?></p>
                <p class="surname"><?php echo $user['lastname']; ?></p>
            </div>
            <div class="login">
                <p class="login__designation"> Login: </p>
                <p class="login__data"><?php echo $user['login']; ?></p>
            </div>
            <div class="photo">
                <p class="photo__designation">Image: </p>
                <img src="<?php echo $user['image']  ?>" alt="Аватарка">
            </div>
            <div class="control__buttons">
                <a href="/logout" class="logout">LogOut</a>
                <a href="/editUserPage" class="editUser">Edit User</a>   
                <span class="deleteUser">Delete User</span>
            </div>
        </div>
    </section>
<?php else: ?>
    <section class="auth__or__register container flex">
        <div class="auth flex">
            <h1 class="auth__greeting">Existing User</h1>
            <form action="/auth" id="auth__user" class="auth__user flex" method="POST">
                <input type="text" placeholder="Email" id="login" name="login" class="login">
                <p class="warningEmail">Используйте одну из популярных почт (yandex.ru, mail.ru, gmail.com)</p>
                <input type="password" placeholder="Password" name="password" class="password" id="password">
                <p class="warningPassword">Пароль от 5 символов</p>
                <div class="forgotPass flex">
                    <a href="#" class="forgotPassword">Forgot your password?</a>
                    <input type="submit" class="submit" name="submit" id="submit" value="Login">
                </div>
            </form>
        </div>
        <div class="register flex">
            <h1 class="register__greeting">New User? Create an Account</h1>
            <p class="description">
                By creating an account with our store, you will be able to move through 
                the checkout process faster, store multiple shipping addresses, view and track 
                your orders in your account and more.
            </p>
            <div class="register__or__logout flex">
                <a href="/register" class="register__button">Create an Account</a>
            </div>
        </div>
    </section>
<?php endif;  ?>

<footer class="footer1 flex container">
    <div class="footer1__description">
        <a href="/" class="logo"><img class="logo__img" src="../img/logo.png" alt="Логотип сайта">BRAN<span>D</span></a>
        <p class="footer1__description__text">Objectively transition extensive data rather than cross functional solutions. Monotonectally
            syndicate multidisciplinary materials before go forward benefits. Intrinsicly syndicate an expanded
            array of processes and cross-unit partnerships.
        </p>

        <p class="footer1__description__text">Efficiently plagiarize 24/365 action items and focused infomediaries.
            Distinctively seize superior initiatives for wireless technologies. Dynamically optimize.
        </p>
    </div>
    <nav class="footer_company">
        <h3 class="footer1__head">Company</h3>
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="#">Shop</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">How It Work</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </nav>
    <nav class="footer_information">
        <h3 class="footer1__head">Information</h3>
        <ul>
            <li><a href="#">Tearms & Condition</a></li>
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">How to Buy</a></li>
            <li><a href="#">How to Sell</a></li>
            <li><a href="#">Promotion</a></li>
        </ul>
    </nav>
    <nav class="footer_shop_category">
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

<script src="/JS/interactionWithElements.js"></script>
<script src="/JS/validationAuthForm.js"></script>
<script src="/JS/deleteUser.js"></script>