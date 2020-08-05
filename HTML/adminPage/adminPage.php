<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="<?php echo $addressOfCssFile;   ?>">
    <link rel="icon" href="../img/logo.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/74db1e8a9f.js" crossorigin="anonymous"></script>
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <link rel="stylesheet" href="../bower_components/jquery-ui/themes/base/autocomplete.css">
    <script src="../bower_components/jquery-ui/jquery-ui.min.js"></script>

    <title>The BRAND</title>
</head>

<body>
    <header class="header">
        <div class="container header-flex flex">
            <div class="header__left flex">
                <a href="/" class="logo flex"><img class="logo__img" src="../img/logo.png" alt="">BRAN<span>D</span></a>
            </div>
        </div>
    </header>

    <section class="categories container">
        <p class="order__details">order details</p>
        <div class="order__data flex">
            <p>ФИО Покупателя</p>
            <p>Количество товаров</p>
            <p>Общая стоимость покупки</p>
            <p>Адрес доставки</p>
            <p>Почтовый индекс</p>
            <p>Номер телефона</p>
            <p>Статус заказа</p>
        </div>
    </section>

    <section class="order container">
        <?php for ($i = 0; $i < count($usersOrders); $i++): ?>
            <div class="order__card flex">
                <div class="name__surname flex">
                    <p class="name"><?php echo $usersOrders[$i]['recipientname']?></p>
                    <p class="surname"><?php echo $usersOrders[$i]['recipientsurname']?> </p>
                </div>

                <p class="count__of__products"><?php echo $usersOrders[$i]['countofproducts'] ?></p>
                <p class="total__price"><?php echo $usersOrders[$i]['totalprice'] ?></p>
                <p class="delivery__address"><?php echo $usersOrders[$i]['deliveryaddress'] ?></p>
                <p class="post__code"><?php echo $usersOrders[$i]['postcode'] ?></p>
                <p class="user__mobile"><?php echo $usersOrders[$i]['usermobile'] ?></p>
                <div class="order__status" data-id ="<?php echo $usersOrders[$i]['id'] ?>">
                    <div class="status_1">
                        <input type="radio" name="<?php echo ($i + 1) ?>status" id = '<?php echo ($i + 1) ?>accepted' data-text="Принят"/>
                        <label for="<?php echo ($i + 1) ?>accepted"> Принят </label>
                    </div>
                    <div class="status_2">
                        <input type="radio" name="<?php echo ($i + 1) ?>status" id ="<?php echo ($i + 1) ?>in__treatment" data-text="В обработке"/>
                        <label for="<?php echo ($i + 1) ?>in__treatment">В обработке</label>
                    </div>
                    <div class="status_3">
                        <input type="radio" name="<?php echo ($i + 1) ?>status" id = "<?php echo ($i + 1) ?>delivery" data-text="В пути"/>
                        <label for="<?php echo ($i + 1) ?>delivery">В пути</label>
                    </div>
                    <div class="status_4">
                        <input type="radio" name="<?php echo ($i + 1) ?>status" id ="<?php echo ($i + 1) ?>delivered" data-text="Доставлен"/>
                        <label for="<?php echo ($i + 1) ?>delivered">Доставлен</label>
                    </div>
                </div>
            </div>

        <?php endfor; ?>
    </section>

    <a href="/logout">LogOut</a>

    <script src="/JS/workWithAdminPage.js"></script>
</body>
</html>