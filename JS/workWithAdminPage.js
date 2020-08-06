'use strict';

$(document).ready(function () {
    $('.order__status input[type=radio]').change(function (e) {
        let statusText = e.currentTarget.dataset.text;
        let orderId = e.currentTarget.parentNode.parentNode.dataset.id;
        $.post('/changeStatusOfTheOrder', {statusText, orderId});
    })

    $('.delete__order i').on('click', function (e) {
        let orderId = e.currentTarget.parentNode.dataset.id;
        let thisOrder = e.currentTarget.parentNode.parentNode;
        $.post('/deleteOrder', {orderId}, function () {
            thisOrder.remove();
        });
    })
})