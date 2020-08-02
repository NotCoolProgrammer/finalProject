<?php  require 'includes/header.php'; ?>

<?php 
    if ($user['active'] == 1) {
        $user['active'] = 'true';
    }
?>

<section class="main__info container">
    <h1 class="main__info__h1">Edit User</h1>
    <form class="editUser flex" action="/editUser" method="POST" name="editUser" id="editUser" enctype="multipart/form-data">
        <div class="main__editing__fields flex">
            <p class="login">Login</p>
            <input type="text" placeholder="Login" name="login" id="login" value="<?php echo $user['login']  ?>">
            <p class="warningEmail">Используйте одну из популярных почт (yandex.ru, mail.ru, gmail.com)</p>
            <p class="dublicateEmail">Такой email уже существует, пожалуйста введите другой</p>
            <p class="password">Mobile phone</p>
            <input type="text" placeholder="+70000000000" name="mobile" id="mobile" value="<?php echo $user['mobile'];  ?>">
            <p class="warningNumber">Телефон в формате +70000000000</p>
            <p class="image">Image</p>
            <input type="file" name="image" id="image" accept="image/*" class="img__input">
            <p class="empty__field">Картинка не выбрана</p>
            <input type="submit" value="Редактировать" class="send__user__data">
        </div>
        <div class="additional__editing__fields flex">
            <p class="password">Old password</p>
            <input type="password" placeholder="password1" name="password1" id="password1">
            <p class="warningPassword1">Пароль меньше 5 символов</p>
            <p class="warningPassword2">Неправильно введенный старый пароль</p>
            <p class="password">New password</p>
            <input type="password" placeholder="password2" name="password2" id="password2">
            <p class="warningPassword3">Пароль меньше 5 символов</p>
        </div>
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
<script src="/JS/validationEditUserForm.js"></script>