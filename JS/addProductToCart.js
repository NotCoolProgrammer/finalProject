'use strict';

$(document).ready(function () {
    $('.add__to__cart__span').on('click', function (e) {
        $.post('/authorizedUser', {}, function (sessionData) {
            let session = checkPropertiesOfObjectSession(JSON.parse(sessionData));
            let session2 = JSON.parse(sessionData);
            if (session) {
                let product = productDesigner(e);
                $.post('/getUsersProducts', {}, function (data) {
                    let allUsersProducts = JSON.parse(data);
                    if (allUsersProducts.length !== 0) {
                        findProduct(product);              
                    } else {
                        addNewProductToShoppingCart(product);
                    }
                })
            } else {    
                pleaseRegister();
            }
        })
    })
})

function productDesigner (e) {
    let object = e.currentTarget.offsetParent;
    let select1 = document.querySelector('.color');
    let colorOfProduct = select1.options[select1.selectedIndex].value;
    let select2 = document.querySelector('.size');
    let sizeOfProduct = select2.options[select2.selectedIndex].value;
    let countOfProducts = Number($('.countOfProducts').val());
    if (countOfProducts == 0) {
        countOfProducts = 1;
    }
    let product = {
        id: e.currentTarget.dataset.id,
        img: object.previousElementSibling.childNodes[1].childNodes[1].children[0].children[0].dataset.src,
        name: object.children[0].children[0].children[2].textContent,
        price: Number(object.children[0].children[0].children[5].children[1].textContent),
        color: colorOfProduct,
        size: sizeOfProduct,
        count: countOfProducts,
        singleview: e.currentTarget.dataset.singleview.trim()
    }
    return product;
}

function successfullyАddedЗroduct() {
    let text = 'Товар добавлен в корзину <br>Приятных покупок';
    let paddingTop = '50px';
    let distanceToLeft = '38%';
    showAnswer(text, paddingTop, distanceToLeft);
}

function pleaseRegister() {
    let text = 'Вы не авторизованы, пожалуйста перейдите по ссылке ниже<br><a href ="http://thebrand.com/account">Авторизоваться</a>';
    let paddingTop = '45px';
    let distanceToLeft = '25%';
    showAnswer(text, paddingTop, distanceToLeft);
}

function showAnswer(text, paddingTop, distanceToLeft) {
    $('.shadow').css('display', 'block');
    let headerClass = $('.header'); 
    let answerBlock = $('<div></div>', {
        class: 'answer__block'
    });

    let answerText = $(`<p class="answer__text">${text}</p>`);
    answerText.appendTo(answerBlock);
    answerBlock.appendTo(headerClass);
    answerText.css('padding-top', `${paddingTop}`);
    answerBlock.css('left', `${distanceToLeft}`);
    closeAnswerAfterSomeTime();
    closeAnswerAfterClickOnWindow();
}

function closeAnswerAfterSomeTime () {
    setTimeout(() => {
        $('.shadow').css('display', 'none');
        $('.answer__block').remove();
    }, 2500);
}

function checkPropertiesOfObjectSession (session) {
    for (let key in session) {
        return true;
    }
    return false;
}

function closeAnswerAfterClickOnWindow () {
    $('.shadow').on('click', function (e) {
        if (e.target == $('.shadow')[0]) {
            deleteAnswer();
        }
    })
}

function deleteAnswer () {
    $('.shadow').css('display', 'none');
    $('.answer__block').remove();
}

function findProduct (product) {
    $.post('/findIdenticalProduct', product, function (data) {
        let allIdenticProducts = JSON.parse(data);
        let singlePath = product.singleview;
        let count = product.count;
        let color = product.color;
        let size = product.size;
        console.log(allIdenticProducts);
        if (allIdenticProducts.length !== 0) {
            increaseProductCounter(singlePath, count, color, size);
        } else {
            addNewProductToShoppingCart(product);
        }
    })
}

function increaseProductCounter (singlePath, count, color, size) {
    $.post('/increaseProductCounterBy1', {singlePath, count, color, size}, function () {
        successfullyАddedЗroduct();
        $('.countOfProducts').val('');
    }).fail(function () {
        alert('Не удалось добавить товар в корзину. Попробуйте немного позже');
    })
}

function addNewProductToShoppingCart(product) {
    $.post('/shoppingCart', product, function () {
        successfullyАddedЗroduct();
        $('.countOfProducts').val('');
    }).fail(function () {
        alert('Не удалось добавить товар в корзину. Попробуйте немного позже');
    });
}