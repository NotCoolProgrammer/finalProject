'use strict';

$(document).ready(function () {
    $('.delivery').accordion({
        animate: 1300,
        heightStyle: 'content'
    });

    generateStates();

    $('.shipping__address__form__states').change(function (e) {
        let selectVal = $(e.currentTarget).val();
        $.post('/getAllCitiesInTheCountry', {selectVal}, function (data) {
            let allCities = JSON.parse(data);
            let arrayCities = [];
            for (let i = 0; i < allCities.length; i++) {
                arrayCities.push(allCities[i].name);
            }
            $('#city').autocomplete({
                source: arrayCities,
                classes: {
                    'ui-autocomplete': 'autocomplete__components'
                }
            })
        })
    })

    $.post('/getUsersProducts', {}, function (data) {
        getAllInfoAboutCheckout(data);
    });

    $('.send__to__processing').on('click', function () {
        // отправить все данные из таблицы users_products в новую, вывести скрытый блок и написать, что заказ сформирован;
        // на стороне админа получить карточку с инфой по каждому пользователю, с его всей информацией по доставке, количеству
        // товара (подобно корзине карточки)
        // сделать на стороне админа возможность переводить заказ в статус "в обработке" и "доставлен" чекбоксами
        $.post('/getUsersProducts', {}, function (data) {
            let allProducts = JSON.parse(data);
            let countOfProducts = 0;
            let totalPrice = 0;
            let deliveryAddress = $('.delivery__address')[0].textContent;
            let recipientName = $('.recipient__name')[0].textContent;
            let recipientSurname = $('.recipient__surname')[0].textContent;
            let postalCode = Number($('.postal__code')[0].textContent);
            let deliveryMethod = $('.delivery__method')[0].textContent;
            let paymentMethod = $('.payment__method')[0].textContent;
            let status = 'Not done';
            for (let i = 0; i < allProducts.length; i++) {
                countOfProducts += Number(allProducts[i].count);
                totalPrice += Number(allProducts[i].price) * Number(allProducts[i].count);
            }

            let objectOfTheOrder = {
                countOfProducts: countOfProducts,
                totalPrice: totalPrice,
                deliveryAddress: deliveryAddress,
                postalCode: postalCode,
                deliveryMethod: deliveryMethod,
                recipientName: recipientName,
                recipientSurname: recipientSurname,
                paymentMethod: paymentMethod,
                status: status
            };

            console.log(objectOfTheOrder);
        });
        $.post('/transferAnOrderToAnotherStatus' , objectOfTheOrder, function () {

        })
    })

})

function generateStates () {
    let select = $('.shipping__address__form__states');
    $.post('/getAllStates', {}, function (data) {
        let allStates = JSON.parse(data);
        for (let i = 0; i < allStates.length; i++) {
            $(`<option>${allStates[i].name}</option>`).appendTo(select);
        }
    });
}


function getAllInfoAboutCheckout (data) {
    let allUsersProducts = JSON.parse(data);
    let countOfProductsBlock = $('.count__of__products');
    let totalPriceBlock = $('.total__purchase__price');
    let deliveryAddressBlock = $('.delivery__address');
    let deliveryMethodBlock = $('.delivery__method');
    let recipientBlockName = $('.recipient__name');
    let recipientBlockSurname = $('.recipient__surname');
    let paymentMethodBlock = $('.payment__method');
    let postalCodeBlock = $('.postal__code');


    let userName = $('.shipping__address__form__name').val();
    let userSurname = $('.shipping__address__form__surname').val();
    let countOfProducts = 0;
    let totalPrice = 0;

    for (let i = 0; i < allUsersProducts.length; i++) {
        countOfProducts += Number(allUsersProducts[i].count);
        totalPrice += Number(allUsersProducts[i].price) * Number(allUsersProducts[i].count);
    }

    recipientBlockName[0].textContent = userName;
    recipientBlockSurname[0].textContent = userSurname;
    countOfProductsBlock[0].textContent = countOfProducts;
    totalPriceBlock[0].textContent = totalPrice;

    $('.city').css('display', 'none');

    $('.shipping__address__form__city').change(function () {
        if ($('.shipping__address__form__city').val() === '') {
            $('.city').css('display', 'none');
        } else {
            deliveryAddressBlock[0].textContent = $('.shipping__address__form__city').val();
            $('.city').css('display', 'block');
        }
    })

    $('.shipping__address__form_radio1').change(function () {
        deliveryMethodBlock[0].textContent = $('#form2 input:checked').val();
    })

    $('.shipping__address__form_radio2').change(function () {
        paymentMethodBlock[0].textContent = $('#form3 input:checked').val();
    })

    $('.shipping__address__form__postcode').change(function () {
        postalCodeBlock[0].textContent = $('.shipping__address__form__postcode').val();
    })
}