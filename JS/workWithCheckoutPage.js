'use strict';

$(document).ready(function () {
    $('.delivery').accordion({
        animate: 1300,
        heightStyle: 'content'
    });

    generateStates();

    $('.shipping__address__form__states').change(function (e) {
        let selectedState = $(e.currentTarget).val();
        $.post('/getAllCitiesInTheCountry', {selectedState}, function (data) {
            let allCities = JSON.parse(data);
            fillInTheCityField (allCities);
        })
    })

    $.post('/getUsersProducts', {}, function (data) {
        let allUsersProducts = JSON.parse(data);
        fillInTheDataAboutTheOrder (allUsersProducts);
    });

})


function fillInTheCityField (allCities) {
    let arrayCities = [];
    for (let i = 0; i < allCities.length; i++) {
        arrayCities.push(allCities[i].city);
    }

    $('#city').autocomplete({
        source: arrayCities,
        classes: {
            'ui-autocomplete': 'autocomplete__components'
        }
    })

    $('.shipping__address__form__city').change(function (e) {
        let selectedCity = $(e.currentTarget).val();
        compareEnteredCityWithTheExistingOne (arrayCities, selectedCity);
    });
}

function generateStates () {
    let select = $('.shipping__address__form__states');
    $.post('/getAllStates', {}, function (data) {
        let allStates = JSON.parse(data);
        for (let i = 0; i < allStates.length; i++) {
            $(`<option>${allStates[i].state}</option>`).appendTo(select);
        }
    });
}

function fillInTheDataAboutTheOrder (allUsersProducts) {
    console.log(allUsersProducts);
    let countOfProductsBlock = $('.count__of__products');
    let totalPriceBlock = $('.total__purchase__price');
    let recipientBlockName = $('.recipient__name');
    let recipientBlockSurname = $('.recipient__surname');
    let postCodeBlock = $('.post__code');
    let userName = $('.shipping__address__form__name').val();
    let userSurname = $('.shipping__address__form__surname').val();
    let countOfProducts = 0;
    let totalPrice;
    if (allUsersProducts[0].total_price_with_discount === null) {
        totalPrice = allUsersProducts[0].total_price;
    } else if (allUsersProducts[0].total_price_with_discount !== null) {
        totalPrice = Number(allUsersProducts[0].total_price_with_discount);
    }

    for (let i = 0; i < allUsersProducts.length; i++) {
        countOfProducts += Number(allUsersProducts[i].count);
    }

    $('.total__purchase__price').css('padding-right', 0);
    $('.monetary__currency').css('padding', 0);

    recipientBlockName[0].textContent = userName;
    recipientBlockSurname[0].textContent = userSurname;
    countOfProductsBlock[0].textContent = countOfProducts;
    totalPriceBlock[0].textContent = totalPrice;

    $('.city').css('display', 'none');

    $('.shipping__address__form_radio1').change(function () {
        let deliveryMethodBlock = $('.delivery__method');
        deliveryMethodBlock[0].textContent = $('#form2 input:checked').val();
    })

    $('.shipping__address__form_radio2').change(function () {
        let paymentMethodBlock = $('.payment__method');
        paymentMethodBlock[0].textContent = $('#form3 input:checked').val();
    })

    $('.shipping__address__form__postcode').change(function () {
        let postCode = $('.shipping__address__form__postcode').val();
        let pr1 = /^[0-9]+$/.test(postCode);
        if (postCode.length < 5 || pr1 === false) {
            $('.wrong__post__code').css('display', 'block');
            $('.shipping__address__form__postcode').css('margin-bottom', '0px');
        } else {
            $('.wrong__post__code').css('display', 'none');
            $('.shipping__address__form__postcode').css('margin-bottom', '20px');
            postCodeBlock[0].textContent = $('.shipping__address__form__postcode').val();
        }
    })

    $('.send__to__processing').on('click', function () {
        validateDataBeforeSendItToAdmins (countOfProducts, totalPrice);
    })
}

function compareEnteredCityWithTheExistingOne (arrayCities, selectedCity) {
    if (arrayCities.indexOf(selectedCity) == -1) {
        $('.wrong__city').css('display', 'block');
        $('.shipping__address__form__city').css('margin-bottom', '0px');
    } else {
        $('.wrong__city').css('display', 'none');
        $('.shipping__address__form__city').css('margin-bottom', '20px');
        $('.delivery__address')[0].textContent = $('.shipping__address__form__city').val();
        $('.city').css('display', 'block');
    }
}

function validateDataBeforeSendItToAdmins (countOfProducts, totalPrice) {

    let deliveryAddress = $('.shipping__address__form__city').val();
    let recipientName = $('.shipping__address__form__name').val();
    let recipientSurname = $('.shipping__address__form__surname').val();
    let deliveryMethod = $('#form2 input:checked').val();
    let paymentMethod = $('#form3 input:checked').val();
    let postCode = $('.shipping__address__form__postcode').val();

    if (deliveryAddress.length !== 0 && $('.wrong__city').css('display') === "none" && postCode.length > 5 && deliveryMethod && paymentMethod) {
        sendDataToAdmins(countOfProducts, totalPrice, deliveryAddress, postCode, deliveryMethod, recipientName, recipientSurname, paymentMethod);
    } else {
        incorrectData();
    }
}

function sendDataToAdmins (countOfProducts, totalPrice, deliveryAddress, postCode, deliveryMethod, recipientName, recipientSurname, paymentMethod) {
    let objectOfTheOrder = {
        countOfProducts: countOfProducts,
        totalPrice: totalPrice,
        deliveryAddress: deliveryAddress,
        postCode: postCode,
        deliveryMethod: deliveryMethod,
        recipientName: recipientName,
        recipientSurname: recipientSurname,
        paymentMethod: paymentMethod
    };

    $.post('/transferAnOrderToAnotherStatus' , objectOfTheOrder, function () {
        positiveAnswer();
    }).fail(function () {
        negativeAnswer();
    })
}

function incorrectData () {
    let text = 'Не заполнены все данные, пожалуйста проверьте еще раз всю информацию';
    let distanceToLeft = '39%';
    showAnswer(text, distanceToLeft);
}

function positiveAnswer () {
    let text = 'Ваш заказ оформлен. В ближайшее время с вами свяжутся';
    let distanceToLeft = '39%';
    showAnswer(text, distanceToLeft);
}

function negativeAnswer () {
    let text = 'Не удалось оформить заказ, попробуйте немного позже';
    let distanceToLeft = '39%';
    showAnswer(text, distanceToLeft);
}

function showAnswer(text, distanceToLeft) {
    $('.shadow').css('display', 'block');
    let headerClass = $('.header'); 
    let answerBlock = $('<div></div>', {
        class: 'answer__block'
    });

    let answerText = $(`<p class="answer__text">${text}</p>`);
    answerText.appendTo(answerBlock);
    answerBlock.appendTo(headerClass);
    answerBlock.css('left', `${distanceToLeft}`);
    closeAnswerAfterSomeTime();
    closeAnswerAfterClickOnWindow();
}

function closeAnswerAfterSomeTime () {
    setTimeout(() => {
        $('.shadow').css('display', 'none');
        $('.answer__block').remove();
        location.href = '/';
    }, 2500);
}

function closeAnswerAfterClickOnWindow () {
    $('.shadow').on('click', function (e) {
        if (e.target == $('.shadow')[0]) {
            deleteAnswer();
            location.href = '/';
        }
    })
}

function deleteAnswer () {
    $('.shadow').css('display', 'none');
    $('.answer__block').remove();
}

// function deleteUserCoupon() {
//     $.post('/')
// }