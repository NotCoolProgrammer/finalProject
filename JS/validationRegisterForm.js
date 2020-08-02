'use strict';

$(document).ready(function () {
    $('.submit').on('click', validateForm)
})

function validateForm() {
    let firstName = $("#firstName").val();
    let lastName = $("#lastName").val();
    let email = $('#login').val();
    let number = $('#mobile').val();
    let password1 = $("#password1").val();
    let password2 = $("#password2").val();
    let image = $('#image').val();

    $.post('/checkEmails', {email}, function (data) {
        let result = JSON.parse(data);
        if (result === true) {
            event.preventDefault();
            $('.warningEmail').css('display', 'none');
            $('#login').css('margin-bottom', 0);
            $('.dublicateEmail').css('display', 'block');
        } else if (result === null) {
            $('.dublicateEmail').css('display', 'none');
        }
    })
    
    let pr1 = /^\W+$/.test(firstName);
    let pr2 = /^\W+$/.test(lastName);
    let pr3 = /^\w+[.]?\w+@+(mail.ru|yandex.ru|gmail.com)$/i.test(email);
    let pr4 = /^(\+7)(\d{3})(\d{3})(\d{4})$/.test(number);
    let pr5 = password1.length;
    let pr6 = password2.length;


    if (pr1 === false || firstName.length >= 12) {
        event.preventDefault();
        $('#firstName').css('margin-bottom', 0);
        $('.warningFirstName').css('display', 'inline-block');
    } else if (pr1 === true && firstName.length <= 12) {
        $('#firstName').css('margin-bottom', '20px');
        $('.warningFirstName').css('display', 'none');
    }
    if (pr2 === false || lastName.length >= 15) {
        event.preventDefault();
        $('#lastName').css('margin-bottom', 0);
        $('.warningLastName').css('display', 'inline-block');
    } else if (pr2 === true && lastName.length <= 15) {
        $('#lastName').css('margin-bottom', '20px');
        $('.warningLastName').css('display', 'none');
    }
    if (pr3 === false) {
        event.preventDefault();
        $('#login').css('margin-bottom', 0);
        $('.warningEmail').css('display', 'inline-block');
    } else {
        $('#login').css('margin-bottom', '20px');
        $('.warningEmail').css('display', 'none');
    }
    if (pr4 === false) {
        event.preventDefault();
        $('#mobile').css('margin-bottom', 0);
        $('.warningNumber').css('display', 'inline-block');
    } else {
        $('#mobile').css('margin-bottom', '20px');
        $('.warningNumber').css('display', 'none');
    }

    if (pr5 < 5) {
        event.preventDefault();
        $('#password1').css('margin-bottom', 0);
        $('.warningPassword1').css('display', 'inline-block');
    } else {
        $('#password1').css('margin-bottom', '20px');
        $('.warningPassword1').css('display', 'none');
    }

    if (pr6 < 5) {
        event.preventDefault();
        $('#password2').css('margin-bottom', 0);
        $('.warningPassword2').css('display', 'inline-block');
    } else {
        $('#password2').css('margin-bottom', '20px');
        $('.warningPassword2').css('display', 'none');
    }

    if (pr5 !== pr6) {
        event.preventDefault();
        $('#password2').css('margin-bottom', 0);
        $('.warningPassword').css('display', 'inline-block');
    } else {
        $('.warningPassword').css('display', 'none');
    }

    if (password1 !== password2) {
        event.preventDefault();
        $('.warningPassword').css('display', 'inline-block');
    } else {
        $('.warningPassword').css('display', 'none');
    }

    if (image.length === 0) {
        event.preventDefault();
        $('.empty__field').css('display', 'inline-block');
    } else {
        $('.empty__field').css('display', 'none');
    }
}