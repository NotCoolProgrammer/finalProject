'use strict';

$(document).ready(function () {
    $('.submit__button').on('click', validateReviewForm);
})

function validateReviewForm () {
    $.post('/getSessionOfUser', {}, function (data) {
        let userSession = JSON.parse(data);
        let userId;
        let userImage;
        if (userSession !== null) {
            userId = userSession.id;
            userImage = userSession.image
        } else {
            userId = null;
            userImage = null;
        }

        let firstName = $('.feedback__form__name').val();
        let lastName = $('.feedback__form__surname').val();
        let comment = $('.feedback__form__review__content').val();
    
        let pr1 = /^\W+$/.test(firstName);
        let pr2 = /^\W+$/.test(lastName);
    
        if (pr1 === false || firstName.length >= 12) {
            event.preventDefault();
            $('.feedback__form__name').css('margin-bottom', 0);
            $('.warningFirstName').css('display', 'inline-block');
        } else if (pr1 === true && firstName.length <= 12) {
            $('.feedback__form__name').css('margin-bottom', '15px');
            $('.warningFirstName').css('display', 'none');
        }
    
        if (pr2 === false || lastName.length >= 15) {
            event.preventDefault();
            $('.feedback__form__surname').css('margin-bottom', 0);
            $('.warningLastName').css('display', 'inline-block');
        } else if (pr2 === true && lastName.length <= 15) {
            $('.feedback__form__surname').css('margin-bottom', '15px');
            $('.warningLastName').css('display', 'none');
        }
    
        if (comment.length <= 15) {
            $('.warningText').css('display', 'inline-block');
            $('.feedback__form__review__content').css('margin-bottom', '0px');
        }
    
        if (pr1 === true && firstName.length <= 12 && pr2 === true && lastName.length <= 15 && comment.length >= 15) {
            uploadReview(firstName, lastName, comment, userId, userImage);
        }
        
    })
}

function uploadReview (firstName, lastName, comment, userId, userImage) {
    let activeStars = $('.orange').length;
    let objectOfReview = {
        name: firstName,
        surname: lastName,
        countOfActiveStars: activeStars,
        comment: comment,
        idUser: userId,
        userImage: userImage
    };
    $.post('/uploadReview', objectOfReview, successfullyUploadedReview).fail(unloadedReview);
}

$('.fa-star').on('click', function (e) {
    let countStars = e.currentTarget.dataset.id;
    let allStars = e.currentTarget.parentNode.children;
    let countOfAllStars = e.currentTarget.parentNode.children.length;

    for (let i = 0; i < countOfAllStars; i++) {
        allStars[i].classList.remove('orange');
    }

    for (let i = 0; i < countStars; i++) {
        allStars[i].classList.add('orange');
    }
})

function successfullyUploadedReview () {
    $('#feedback__form')[0].reset();
    let text = 'Спасибо за ваш отзыв <br> Приходите еще';
    generalAnswer(text);
}

function unloadedReview () {
    let text = 'Не удалось загрузить ваш отзыв <br>Проверьте, авторизованы ли вы или попробуйте позже';
    generalAnswer(text);
}

function generalAnswer (text) {
    $('.shadow').css('display', 'block');
    let headerClass = $('.header'); 
    let answerBlock = $('<div></div>', {
        class: 'answer__block'
    });

    let answerText = $(`<p class="answer__text">${text}</p>`);
    answerText.appendTo(answerBlock);
    answerBlock.appendTo(headerClass);
    if (text.length < 50) {
         $('.answer__block').css('left', '39%');
    } else {
        $('.answer__block').css('left', '39%');
    }
    closeAnswerAfterSomeTime();
    closeAnswerAfterClickOnWindow();
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

function closeAnswerAfterSomeTime () {
    setTimeout(() => {
        $('.shadow').css('display', 'none');
        $('.answer__block').remove();
    }, 2500);
}