$(document).ready(function () {
    $('.submit').on('click', validateForm)
})

function validateForm() {
    let email = $('#login').val();
    let pr1 = /^\w+[.]?\w+@+(mail.ru|yandex.ru|gmail.com)$/i.test(email);
    let passwordLength = $('#password').val().length;

    if (pr1 === false) {
        event.preventDefault();
        $('#login').css('margin-bottom', 0);
        $('.warningEmail').css('display', 'inline-block');
    } else {
        $('#login').css('margin-bottom', '20px');
        $('.warningEmail').css('display', 'none');
    }

    if (passwordLength < 5) {
        event.preventDefault();
        $('#password').css('margin-bottom', 0);
        $('.warningPassword').css('display', 'inline-block');
    } else {
        $('#password').css('margin-bottom', '20px');
        $('.warningPassword').css('display', 'none');
    }
}