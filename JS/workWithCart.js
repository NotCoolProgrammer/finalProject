'use strict';

$(document).ready(function () {
    $('.control__button__left').on('click', function () {
        $.post('/deleteAllProducts', function () {
            $('.cart__product').empty();
            deleteCoupon();
            grandTotal();
        });
    })

    $('.delete__product i').on('click', function (e) {
        let idOfSpecificProduct = e.currentTarget.parentNode.dataset.id;
        let blockWithoutDiscount = document.querySelector('.amount__without__discount');
        let blockWithDiscount = document.querySelector('.amount__with__discount');
        let thisProduct = e.currentTarget.parentNode.parentNode.parentNode;

        if (blockWithoutDiscount.style.textDecoration === 'line-through') {
            grandTotal();
        } else if (blockWithDiscount.style.textDecoration === '') {
            grandTotal();
        }

        $.post('/deleteOneProduct', {idOfSpecificProduct}, function () {
            thisProduct.remove();
            grandTotal();
        });
        if ($('.cart__product')[0].children.length === 0) {
            $('.amount__with__discount').css('display', 'none');
            $('.amount__without__discount').css('text-decoration', 'none');
        }
    });

    $('.button__left').on('click', changePriceWhenDeletingAnItem);
    $('.apply__coupon').on('click', checkCoupon);
    $('.delete__coupon').on('click', deleteCoupon);
    grandTotal();
});

function grandTotal() {
    $.post('/getInfoAboutCoupons', {}, function (data) {
        let coupon = JSON.parse(data);
        let totalPriceWithoutDiscount = document.querySelector('.total__product__value__withoutDiscount');
        let totalPriceWithDiscount = document.querySelector('.total__product__value__withDiscount');
        let priceOfProducts = document.querySelectorAll('.subtotal__product__value');   

        if (coupon.length === 0) {
            let totalProductValueWithoutDiscount = 0;
            priceOfProducts.forEach(price => {
                let numberOfPrices = Number(price.textContent);
                totalProductValueWithoutDiscount += numberOfPrices;
                totalPriceWithoutDiscount.textContent = totalProductValueWithoutDiscount;  
            });
        } else {
            let totalProductValueWithoutDiscount = 0;
            let totalProductValueWithDiscount = 0;
            priceOfProducts.forEach(price => {
                let numberOfPrices = Number(price.textContent);
                totalProductValueWithoutDiscount += numberOfPrices;
                totalPriceWithoutDiscount.textContent = totalProductValueWithoutDiscount;
            });

            $('.amount__without__discount').css('text-decoration', 'line-through');
            $('.amount__with__discount').css('display', 'block');
            let totalPriceValue = Number(totalPriceWithDiscount.textContent);
            priceOfProducts.forEach(price => {
                let numberOfPrices = Number(price.textContent);
                totalProductValueWithDiscount += numberOfPrices;
                totalPriceValue = totalProductValueWithDiscount;  
            });
            let tempPrice = (totalPriceValue * coupon[0].discount) / 100;
            let finalPrice = totalPriceValue - tempPrice;
            totalPriceWithDiscount.textContent = finalPrice;
        }

        if ($('.cart__product')[0].children.length === 0) {
            $('.amount__with__discount').css('display', 'none');
            $('.amount__without__discount').css('text-decoration', 'none');
            $('.total__product__value__withoutDiscount')[0].textContent = 0;
        }
    })

}

function changePriceWhenDeletingAnItem () {
    let totalPrice = document.querySelector('.total__product__value');
    totalPrice.textContent = 0;
}

function checkCoupon () {
    let couponVal = $('.coupon').val();
    if (couponVal.length === 0) {
        $('.empty__field').css('display', 'inline-block');
        setTimeout(() => {
            $('.empty__field').css('display', 'none');
        }, 2500);
    } else {
        $.post('/checkCoupon', {couponVal}, function (data) {
            let couponObject = JSON.parse(data);
            checkCouponForCompliance(couponObject);
        });
    }
}

function checkCouponForCompliance (couponObject) {
    $('.coupon').val('');
    let coupon = couponObject[0];
    if (couponObject.length === 0) {
        $('.warning__coupon').css('display', 'inline-block');
        setTimeout(() => {
            $('.warning__coupon').css('display', 'none');
        }, 2500);
    } else {
        $.post('/checkEnteredCouponNameWithUsersCouponName', {coupon}, function (result) {
            checkCouponForThePresenceOfUser(Boolean(result), coupon);
        });
    }
}

function checkCouponForThePresenceOfUser (result, coupon) {
    if (result === true) {
        $('.dublicate__coupon').css('display', 'block');
        setTimeout(() => {
            $('.dublicate__coupon').css('display', 'none');
        }, 2500);
    } else if ($('.cart__product')[0].children.length === 0) { 
        $('.amount__without__discount').css('text-decoration', 'none');
        $('.no__products__in__the__cart').css('display', 'block');
        $('.coupon').val('');
        setTimeout(() => {
            $('.no__products__in__the__cart').css('display', 'none');
        }, 2500);
    } else {
        $('.dublicate__coupon').css('display', 'none');
        $.post('/addCouponInShoppingCart', {coupon}, function () {
            applyCoupon(coupon);
        });
    }
}

function applyCoupon (coupon) {
    let priceWithoutDisc = $('.total__product__value__withoutDiscount');
    let priceWithDisc = $('.total__product__value__withDiscount');
    let discountAmount = (Number(priceWithoutDisc[0].textContent) * coupon.discount) / 100;
    priceWithDisc[0].textContent = priceWithoutDisc[0].textContent - discountAmount;
    $('.amount__without__discount').css('text-decoration', 'line-through');
    $('.amount__with__discount').css('display', 'block');
    $('.coupon').val('');
    $('.apply__coupon__text').css('display', 'block');
    setTimeout(() => {
        $('.apply__coupon__text').css('display', 'none');
    }, 2500);
}

function deleteCoupon () {
    $.post('/deleteCoupon', {}, function () {
        grandTotal();
        $('.amount__without__discount').css('text-decoration', 'none');
        $('.amount__with__discount').css('display', 'none');

        $('.delete__coupon__text').css('display', 'block');
        setTimeout(() => {
            $('.delete__coupon__text').css('display', 'none');
        }, 2500);
    })
}


