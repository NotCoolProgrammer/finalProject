'use strict';

$(document).ready(function () {
    $('.order__status input[type=radio]').change(function (e) {
        let statusText = e.currentTarget.dataset.text;
        let orderId = e.currentTarget.parentNode.parentNode.dataset.id;
        $.post('/changeStatusOfTheOrder', {statusText, orderId});
    })
})