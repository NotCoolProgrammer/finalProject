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

    <link rel="stylesheet" type="text/css" href="../bower_components/slick-carousel/slick/slick.css"/>
    <script type="text/javascript" src="../bower_components/slick-carousel/slick/slick.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script> 

    <link rel="stylesheet" href="../bower_components/jquery-ui/themes/base/autocomplete.css">
    <script src="../bower_components/jquery-ui/jquery-ui.min.js"></script>

    <title>The BRAND</title>
</head>

<body>
    <header class="header">
        <div class="container header-flex flex">
            <div class="header__left flex">
                <a href="/" class="logo flex"><img class="logo__img" src="../img/logo.png" alt="">BRAN<span>D</span></a>
                <div class="header__form flex">
                    <div class="browse browse__closed flex">Browse
                        <div class="drop drop__first">
                            <div class="drop__flex">
                                <h3 class="drop__h3">Women</h3>
                                <ul class="drop__ul">
                                    <li><a href="/allProducts" class="drop__link">Dresses</a></li>
                                    <li><a href="/allProducts" class="drop__link">Tops</a></li>
                                    <li><a href="/allProducts" class="drop__link">Sweaters/Knits</a></li>
                                    <li><a href="/allProducts" class="drop__link">Jackets/Coats</a></li>
                                    <li><a href="/allProducts" class="drop__link">Blazers</a></li>
                                    <li><a href="/allProducts" class="drop__link">Denim</a></li>
                                    <li><a href="/allProducts" class="drop__link">Leggins/Pants</a></li>
                                    <li><a href="/allProducts" class="drop__link">Skirts/Shorts</a></li>
                                    <li><a href="/allProducts" class="drop__link">Accessories</a></li>
                                </ul>
                            </div>
                            <div class="drop__flex">
                                <h3 class="drop__h3">Men</h3>
                                <ul class="drop__ul">
                                    <li><a href="/allProducts" class="drop__link">Tees/Tank tops</a></li>
                                    <li><a href="/allProducts" class="drop__link">Shirts/Polos</a></li>
                                    <li><a href="/allProducts" class="drop__link">Sweaters</a></li>
                                    <li><a href="/allProducts" class="drop__link">Sweatshirts/Hoodies</a></li>
                                    <li><a href="/allProducts" class="drop__link">Blazers</a></li>
                                    <li><a href="/allProducts" class="drop__link">Jackets/vests</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <input class="input search__product flex" type="text" name="Search" placeholder="Search for item...">
                    <button class="button1 flex"><i class="fas fa-search"></i></button>
                </div>
            </div>
            <div class="header__right flex">
                <a href="/shoppingCart" class="header__cart"><img src="../img/cart.svg" alt=""></a>
                <a href="/account" class="button flex">My Account</a>
            </div>
        </div>
    </header>

    <nav class="nav">
        <div class="container">
            <ul class="menu flex">
                <li class="menu__list flex"><a href="/" class="menu__link">Home</a></li>
                <li class="menu__list flex"><a href="/allProducts" class="menu__link">Man</a>
                    <div class="drop drop__first">
                        <div class="drop__flex">
                            <h3 class="drop__h3">Women</h3>
                            <ul class="drop__ul">
                                <li><a href="/allProducts" class="drop__link">Dresses</a></li>
                                <li><a href="/allProducts" class="drop__link">Tops</a></li>
                                <li><a href="/allProducts" class="drop__link">Sweaters/Knits</a></li>
                                <li><a href="/allProducts" class="drop__link">Jackets/Coats</a></li>
                                <li><a href="/allProducts" class="drop__link">Blazers</a></li>
                                <li><a href="/allProducts" class="drop__link">Denim</a></li>
                                <li><a href="/allProducts" class="drop__link">Leggins/Pants</a></li>
                                <li><a href="/allProducts" class="drop__link">Skirts/Shorts</a></li>
                                <li><a href="/allProducts" class="drop__link">Accessories</a></li>
                            </ul>
                        </div>
                        <div class="drop__flex">
                            <h3 class="drop__h3">Women</h3>
                            <ul class="drop__ul">
                                <li><a href="/allProducts" class="drop__link">Dresses</a></li>
                                <li><a href="/allProducts" class="drop__link">Tops</a></li>
                                <li><a href="/allProducts" class="drop__link">Sweaters/Knits</a></li>
                            </ul>

                            <h3 class="drop__h3">Women</h3>
                            <ul class="drop__ul">
                                <li><a href="/allProducts" class="drop__link">Dresses</a></li>
                                <li><a href="/allProducts" class="drop__link">Tops</a></li>
                                <li><a href="/allProducts" class="drop__link">Sweaters/Knits</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="menu__list flex"><a href="/allProducts" class="menu__link">Women</a>
                    <div class="drop drop__first">
                        <div class="drop__flex">
                            <h3 class="drop__h3">Women</h3>
                            <ul class="drop__ul">
                                <li><a href="/allProducts" class="drop__link">Dresses</a></li>
                                <li><a href="/allProducts" class="drop__link">Tops</a></li>
                                <li><a href="/allProducts" class="drop__link">Sweaters/Knits</a></li>
                                <li><a href="/allProducts" class="drop__link">Jackets/Coats</a></li>
                                <li><a href="/allProducts" class="drop__link">Blazers</a></li>
                                <li><a href="/allProducts" class="drop__link">Denim</a></li>
                                <li><a href="/allProducts" class="drop__link">Leggins/Pants</a></li>
                                <li><a href="/allProducts" class="drop__link">Skirts/Shorts</a></li>
                                <li><a href="/allProducts" class="drop__link">Accessories</a></li>
                            </ul>
                        </div>
                        <div class="drop__flex">
                            <h3 class="drop__h3">Women</h3>
                            <ul class="drop__ul">
                                <li><a href="/allProducts" class="drop__link">Dresses</a></li>
                                <li><a href="/allProducts" class="drop__link">Tops</a></li>
                                <li><a href="/allProducts" class="drop__link">Sweaters/Knits</a></li>
                                <li><a href="/allProducts" class="drop__link">Jackets/Coats</a></li>
                                <li><a href="/allProducts" class="drop__link">Blazers</a></li>
                                <li><a href="/allProducts" class="drop__link">Denim</a></li>
                                <li><a href="/allProducts" class="drop__link">Leggins/Pants</a></li>
                                <li><a href="/allProducts" class="drop__link">Skirts/Shorts</a></li>
                                <li><a href="/allProducts" class="drop__link">Accessories</a></li>
                            </ul>
                        </div>
                        <div class="drop__flex">
                            <h3 class="drop__h3">Women</h3>
                            <ul class="drop__ul">
                                <li><a href="/allProducts" class="drop__link">Dresses</a></li>
                                <li><a href="/allProducts" class="drop__link">Tops</a></li>
                                <li><a href="/allProducts" class="drop__link">Sweaters/Knits</a></li>
                            </ul>

                            <h3 class="drop__h3">Women</h3>
                            <ul class="drop__ul">
                                <li><a href="/allProducts" class="drop__link">Dresses</a></li>
                                <li><a href="/allProducts" class="drop__link">Tops</a></li>
                                <li><a href="/allProducts" class="drop__link">Sweaters/Knits</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="menu__list flex"><a href="/allProducts" class="menu__link">Kids</a></li>
                <li class="menu__list flex"><a href="/allProducts" class="menu__link">Accoseriese</a></li>
                <li class="menu__list flex"><a href="/allProducts" class="menu__link">Featured</a>
                    <div class="drop drop__last">
                        <div class="drop__flex">
                            <h3 class="drop__h3">Women</h3>
                            <ul class="drop__ul">
                                <li><a href="/allProducts" class="drop__link">Dresses</a></li>
                                <li><a href="/allProducts" class="drop__link">Tops</a></li>
                                <li><a href="/allProducts" class="drop__link">Sweaters/Knits</a></li>
                                <li><a href="/allProducts" class="drop__link">Jackets/Coats</a></li>
                                <li><a href="/allProducts" class="drop__link">Blazers</a></li>
                                <li><a href="/allProducts" class="drop__link">Denim</a></li>
                                <li><a href="/allProducts" class="drop__link">Leggins/Pants</a></li>
                                <li><a href="/allProducts" class="drop__link">Skirts/Shorts</a></li>
                                <li><a href="/allProducts" class="drop__link">Accessories</a></li>
                            </ul>
                        </div>
                        <div class="drop__flex">
                            <h3 class="drop__h3">Women</h3>
                            <ul class="drop__ul">
                                <li><a href="/allProducts" class="drop__link">Dresses</a></li>
                                <li><a href="/allProducts" class="drop__link">Tops</a></li>
                                <li><a href="/allProducts" class="drop__link">Sweaters/Knits</a></li>
                            </ul>

                            <h3 class="drop__h3">Women</h3>
                            <ul class="drop__ul">
                                <li><a href="/allProducts" class="drop__link">Dresses</a></li>
                                <li><a href="/allProducts" class="drop__link">Tops</a></li>
                                <li><a href="/allProducts" class="drop__link">Sweaters/Knits</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="menu__list flex"><a href="/allProducts" class="menu__link">Hot Deals </a>
                    <div class="drop drop__last">
                        <div class="drop__flex">
                            <h3 class="drop__h3">Women</h3>
                            <ul class="drop__ul">
                                <li><a href="/allProducts" class="drop__link">Dresses</a></li>
                                <li><a href="/allProducts" class="drop__link">Tops</a></li>
                                <li><a href="/allProducts" class="drop__link">Sweaters/Knits</a></li>
                                <li><a href="/allProducts" class="drop__link">Jackets/Coats</a></li>
                                <li><a href="/allProducts" class="drop__link">Blazers</a></li>
                                <li><a href="/allProducts" class="drop__link">Denim</a></li>
                                <li><a href="/allProducts" class="drop__link">Leggins/Pants</a></li>
                                <li><a href="/allProducts" class="drop__link">Skirts/Shorts</a></li>
                                <li><a href="/allProducts" class="drop__link">Accessories</a></li>
                            </ul>
                        </div>
                        <div class="drop__flex">
                            <h3 class="drop__h3">Women</h3>
                            <ul class="drop__ul">
                                <li><a href="/allProducts" class="drop__link">Dresses</a></li>
                                <li><a href="/allProducts" class="drop__link">Tops</a></li>
                                <li><a href="/allProducts" class="drop__link">Sweaters/Knits</a></li>
                            </ul>

                            <h3 class="drop__h3">Women</h3>
                            <ul class="drop__ul">
                                <li><a href="/allProducts" class="drop__link">Dresses</a></li>
                                <li><a href="/allProducts" class="drop__link">Tops</a></li>
                                <li><a href="/allProducts" class="drop__link">Sweaters/Knits</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>