'use strict';

$(document).ready(function () {
    $('.deleteUser').on('click', deleteUser);
})

function deleteUser() {
    let idUser = $('.designation').data();
    $.post('/deleteUser', idUser, positiveResponse).fail(negativeResponce);
}   


function positiveResponse () {
    let text = 'Пользователь был успешно удален';
    generalAnswer(text);
    $('.answer__block').css('width', '370px');
}

function negativeResponce () {
    let text = 'Не удалось удалить пользователя <br>Попробуйте позже';
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
    window.location.reload();
}

function closeAnswerAfterSomeTime () {
    setTimeout(() => {
        $('.shadow').css('display', 'none');
        $('.answer__block').remove();
        window.location.reload();
    }, 2500);
}