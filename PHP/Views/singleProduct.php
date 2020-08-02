<section class="single__product flex">
    <div class="single__product__wear">
        <ul class="slidewrapper">
            <!-- //сюда генерятся картинки -->
        </ul>

        <div class="navigation">
            <div class="navigation__prev flex"><i class="fas fa-chevron-left"></i></div>
            <div class="navigation__next flex"><i class="fas fa-chevron-right"></i></div>
        </div>
    </div>
</section>

<section class="clothing__features container">
    <div class="clothing__features__info flex">
        <div class="unique__info">
            <h4 class="unique__info__h4 flex"><?php  echo $product['collection'];  ?></h4>
            <div class="unique__info__lines flex">
                <div class="line__1"></div>
                <div class="line__2"></div>
                <div class="line__3"></div>
            </div>
            <h3 class="unique__info__h3 flex"><?php echo $product['name']  ?></h3>
            <p class="flex">  <?php echo $product['fulldesc'] ?></p>
            <div class="info__about__clothes flex">
                <h3 class="material material_1">material: <span>  <?php echo $product['material'] ?></span></h3>
                <h3 class="material">designer: <span> <?php echo $product['designer'] ?></span></h3>
            </div>
            <div class="price flex"> 
                <span class="product__currency">$</span>  
                <span class="product__value"><?php echo $product['price'] ?></span>
            </div>
        </div>
    </div>
    <div class="form__to__cart flex">
        <form class="features">
            <div class="features__filter flex">
                <div class="choose__color">
                    <h3>choose color</h3>
                    <label>
                        <select name="filter" class="color">
                            <?php
                                for ($i = 0; $i < count($colors); $i++) {
                                    ?>
                                        <option value="<?php echo $colors[$i]['color'] ?>"><?php echo $colors[$i]['color'] ?></option>
                                    <?php
                                }
                            ?>
                        </select>
                    </label>
                </div>
                <div class="choose__size">
                    <h3>choose size</h3>
                    <label>
                        <select name="filter" class="size">
                            <?php
                                for ($i = 0; $i < count($sizes); $i++) {
                                    ?>
                                        <option value="<?php echo $sizes[$i]['size'] ?>"><?php echo $sizes[$i]['size'] ?></option>
                                    <?php
                                }
                            ?>
                        </select>
                    </label>
                </div>
                <div class="quantity">
                    <h3>quantity</h3>
                    <label>
                        <input type="text" placeholder="2" class="countOfProducts">
                    </label>
                </div>
            </div>
            <div class="add__to__cart flex">
                <span class="add__to__cart__span flex" data-id = "<?php echo $product['id'] ?>" data-singleview = " <?php echo $product['singleview'] ?> ">
                    <img src="../img/cart.svg" alt="">
                    Add to card
                </span>
            </div>
        </form>
    </div>
</section>