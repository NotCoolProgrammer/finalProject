'use strict';

$(document).ready(function () {
    $('.browse').on('click', function () {
        if ($('.browse .drop').hasClass('dropped__list')) {
            $('.browse .drop').removeClass('dropped__list');
            $(".browse").removeClass('browse__opened').addClass('browse__closed');
        } else {
            $('.browse .drop').addClass('dropped__list');
            $('.browse').addClass('browse__opened').removeClass('browse__closed');
        }
    });

    $.post('/allGoods', {}, function (data) {
        let allProducts = JSON.parse(data);
        let ul = $(`<ul class = "found__products"></ul>`);
        let header = $('.header__form');
        ul.appendTo(header);

        allProducts.forEach(function (product) {
            generateLi(ul, product);
        });
    });

    $('.button1').on('click', findProductByName)

    $('.temp__block').on('click', function () {
        $('.found__products_li').removeClass('shown');
        $('.temp__block').css('display', 'none');   
    })

    $.post('/getAllInfoAboutReviews', {}, function (data) {
        generateReviews (data);
    });

    $('.feedback__bg2__button').on('click', sendEmail);
})



function sendEmail () {
    let email = $('.email').val();
    let pr1 = /^\w+[.]?\w+@+(mail.ru|yandex.ru|gmail.com)$/i.test(email);

    if (pr1 == false) {
        $('.warning__email').css('display', 'block');
    } else {
        $('.warning__email').css('display', 'none');
        $.post('/sendEmail', email, function (data) {
            positiveResultOfSendingEmail()
            $('#email').val('');
        }).fail(function () {
            negativeResultOfSendingEmail();
            $('#email').val('');
        })
    }
}

function positiveResultOfSendingEmail() {
    let answer = 'Спасибо за подписку<br>В скором времени вам на почту придет что нибудь <br> интересное от нас';
    answerBlock(answer);
}

function negativeResultOfSendingEmail () {
    let answer = 'Не удалось отправить письмо на указанныый email <br> Попробуйте позже';
    answerBlock(answer);
}

function answerBlock(answer) {
    $('.shadow').css('display', 'block');
    let headerClass = $('.header'); 
    let answerBlock = $('<div></div>', {
        class: 'answer__block'
    });
    let answerText = $(`<p class="answer__text">${answer}</p>`);
    answerText.appendTo(answerBlock);
    answerBlock.appendTo(headerClass);
    $('.answer__block').css({
        left: '39%',
    });
    $('.answer__text').css('padding-top', '38px');
    closeAnswerAfterSomeTime();
}

function closeAnswerAfterSomeTime () {
    setTimeout(() => {
        $('.shadow').css('display', 'none');
        $('.answer__block').remove();
    }, 2500);
}

function generateReviews (data) {
    let allReviewsData = JSON.parse(data);
    if (allReviewsData.length !== 0) {
        let reviews = $(`<div class ="feedback__bg1 bxbb flex reviews"></div>`);
        $(reviews).prependTo($('.feedback__bg'));
        allReviewsData.forEach(review => {
            let reviewBlock = $(`<div class="flex review"><div/>`);
            $(`
                <img class="feedback__circle" src="${review.image}" alt="">
                <div class="feedback__bg1__text bxbb">
                    <p class="feedback__comment">${review.userreview}</p>
                    <div class="stars">
                    </div>
                    <div class="name__surname">
                        <p class="name">${review.name}</p>
                        <p class="surname">${review.surname}</p>
                    </div>
                </div>
            `).appendTo(reviewBlock);
            reviewBlock.appendTo(reviews);
        })
    
        let allStarsFromUser = $('.stars');
        for (let i = 0; i < allStarsFromUser.length; i++) {
            for (let j = 0; j < allReviewsData[i].siterating; j++) {      
                let star = $('<i class="fas fa-star orange"></i>');
                star.appendTo(allStarsFromUser[i]);
            }
        }
    
        $(reviews).slick({
            autoplay: true,
            infinite: true,
            slidesToShow: 1,
            speed: 2000,
            autoplaySpeed: 5000,
            nextArrow: '<i class="fas fa-angle-double-right right__button"></i>',
            prevArrow: '<i class="fas fa-angle-double-left left__button"></i>'
        });
    }
}

function generateLi(ul, product) {
    $(`<li class ="found__products_li"><a href="/singleProduct/${product.singleview}">${product.fulldesc}</a></li>`).appendTo(ul);
}

function findProductByName() {
    let value = $('.search__product').val();
    let productVal = value.trim();
    let allProducts = document.querySelectorAll('.found__products_li');

    if (productVal != '') {
        allProducts.forEach(function (product) {
            if (product.innerText.search(productVal) == -1) {
                product.classList.remove('shown');
            } else {
                product.classList.add('shown');
            }
        });
    } else {
        allProducts.forEach(function (product) {
            product.classList.remove('shown');
        });
    }
    $('.temp__block').css('display', 'block');
    $('.found__products').css('display', 'block');
    $('.search__product').val("");
}
