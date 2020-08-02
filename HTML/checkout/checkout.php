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

    <section class="delivery container">
        <p class="delivery__headers">shipping address</p>
        <div class="shipping__address">
            <form name="form1" id="form1" class="shipping__address__form flex">
                <input type="text" disabled class="shipping__address__form__name" name="name" placeholder="Name" value="<?php echo $user['firstname'] ?>">
                <input type="text" disabled class="shipping__address__form__surname" name="surname" placeholder="Surname" value="<?php echo $user['lastname'] ?>" >
                <select name="select_1" id="select_1" class="shipping__address__form__states">
                    <option>--Выберите город--</option>
                </select>
                <input type="text" placeholder="City" class="shipping__address__form__city" name="city" id="city">
                <input type="text" placeholder="Postcode / Zip" class="shipping__address__form__postcode" name="postcode">
            </form>
        </div>

        </div>
        <p class="delivery__headers">shipping method</p>
        <div class="shipping__address">
            <form name="form2" id="form2" class="shipping__address__form flex">
                <div class="option__1">
                    <input type="radio" name="delivery" id="option1" value="Курьерская доставка" class="shipping__address__form_radio1">
                    <label for="option1">Курьерская доставка</label>
                </div>
                <div class="option__2">
                    <input type="radio" name="delivery" id="option2" value="Срочная курьерская доставка" class="shipping__address__form_radio1">
                    <label for="option2">Срочная курьерская доставка</label>
                </div>
                <div class="option__3">
                    <input type="radio" name="delivery" id="option3" value="Штатный курьер" class="shipping__address__form_radio1">
                    <label for="option3">Штатный курьер</label>
                </div>
                <div class="option__4">
                    <input type="radio" name="delivery" id="option4" value="Самовывоз" class="shipping__address__form_radio1">
                    <label for="option4">Самовывоз</label>
                </div>
                <div class="option__5">
                    <input type="radio" name="delivery" id="option5" value="Почта" class="shipping__address__form_radio1">
                    <label for="option5">Почта</label>
                </div>
                <div class="option__6">
                    <input type="radio" name="delivery" id="option6" value="Транспортные компании" class="shipping__address__form_radio1">
                    <label for="option6">Транспортные компании</label>
                </div>
            </form>
        </div>
        <p class="delivery__headers">payment method</p>
        <div class="shipping__address">
            <form name="form3" id="form3" class="shipping__address__form flex">
                <div class="option__7">
                    <input type="radio" name="payment" id="option7" value="Карта" class="shipping__address__form_radio2">
                    <label for="option7">Карта</label>
                </div>
                <div class="option__8">
                    <input type="radio" name="payment" id="option8" value="Наличные" class="shipping__address__form_radio2">
                    <label for="option8">Наличные</label>
                </div>
            </form>
        </div>
        <p class="delivery__headers">order review</p>
        <div class="shipping__address">
            <div class="shipping__address__final">
                <p class="shipping__address__final_info">Количество товара - <span class="count__of__products"></span></p>
                <p class="shipping__address__final_info">Общая стоимость покупки - <span class="total__purchase__price"></span></p>
                <p class="shipping__address__final_info">Адрес доставки - <span class="city">г. </span> <span class="delivery__address"></span></p>
                <p class="shipping__address__final_info">Почтовый индекс - <span class="postal__code"></span></p>  
                <p class="shipping__address__final_info">Метод доставки - <span class="delivery__method"></span></p> 
                <p class="shipping__address__final_info">Получатель - 
                    <span class="recipient">
                        <span class="recipient__name"></span>
                        <span class="recipient__surname"></span>
                    </span>
                </p>
                <p class="shipping__address__final_info">Способ оплаты -<span class="payment__method"></span></p> 
                <button class="send__to__processing">Confirm Order</button>
            </div>
        </div>

    </section>

    <?php require 'includes/footer.php' ?>
    <script src="/JS/workWithCheckoutPage.js"></script>
    
</body>
</html>