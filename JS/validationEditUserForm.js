'use strict';

$(document).ready(function () {
    $('.send__user__data').on('click', validateForm)
});

function validateForm () {
    event.preventDefault();
    let email = $('#login').val();
    let number = $('#mobile').val();
    let password1 = $('#password1').val();
    let password2 = $('#password2').val();
    let image = $('#image').val();

    let pr1 = /^\w+[.]?\w+@+(mail.ru|yandex.ru|gmail.com)$/i.test(email);
    let pr2 = /^(\+7)(\d{3})(\d{3})(\d{4})$/.test(number);
    let pr3 = password1.length;
    let pr4 = password2.length;

    $.post('/checkEmails', {email}, function (data) {
        let dublicateEmail = JSON.parse(data);
        if (dublicateEmail === true) {
            $('.warningEmail').css('display', 'none');
            $('#login').css('margin-bottom', 0);
            $('.dublicateEmail').css('display', 'block');
        } else if (dublicateEmail === null) {
            $('.dublicateEmail').css('display', 'none');
            $('#login').css('margin-bottom', '20px');
        }
        $.post('/checkPassword', {password1}, function (data) {
            let correctPass = Number(data);
            if (correctPass === 1) {
                $('.warningPassword2').css('display', 'none');
                $('#password1').css('margin-bottom', '20px');
            } else if (correctPass === 0 && pr3 >= 5) {
                $('.warningPassword2').css('display', 'block');
                $('#password1').css('margin-bottom', 0);
            }

            if (pr1 === false) {
                $('#login').css('margin-bottom', 0);
                $('.warningEmail').css('display', 'inline-block');
            } else {
                $('.warningEmail').css('display', 'none');
                // $('#login').css('margin-bottom', '20px');
            }
            if (pr2 === false) {
                $('#mobile').css('margin-bottom', 0);
                $('.warningNumber').css('display', 'inline-block');
            } else {
                $('#mobile').css('margin-bottom', '20px');
                $('.warningNumber').css('display', 'none');
            }
        
            if (pr3 < 5) {
                $('#password1').css('margin-bottom', 0);
                $('.warningPassword1').css('display', 'inline-block');
            } else {
                // $('#password1').css('margin-bottom', '20px');
                $('.warningPassword1').css('display', 'none');
            }
        
            if (pr4 < 5) {
                $('#password2').css('margin-bottom', 0);
                $('.warningPassword3').css('display', 'inline-block');
            } else {
                $('#password2').css('margin-bottom', '20px');
                $('.warningPassword3').css('display', 'none');
            }
        
            if (image.length === 0) {
                $('#image').css('margin-bottom', 0);
                $('.empty__field').css('display', 'inline-block');
            } else {
                $('.empty__field').css('display', 'none');
                $('#image').css('margin-bottom', '20px');
            }
        
            if (pr1 === true && pr2 === true && pr3 > 5 && pr4 > 5 && image.length !== 0 && dublicateEmail !== true && correctPass === 1) {
                $('#editUser').submit();
            }
        })
    });
}