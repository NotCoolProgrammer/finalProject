'use strict';
// let allImages = JSON.parse(images);
let allImages = images;
let slideNow = 1;
let slideCount = allImages.length;
let translateWidth = 0;
let slideInterval = 3000;

$(document).ready(function () {
    let switchInterval = setInterval(nextSlide, slideInterval)
    generationImages(allImages);
    stopSliderWhenHovering(switchInterval);
    $('.navigation__prev').on('click', function () {
        prevSlide();
    })

    $('.navigation__next').on('click', function () {
        nextSlide();
    })
});

function generationImages (allImages) {
    let blockForImg = $('.slidewrapper');
    for (let i = 0; i < allImages.length; i++) {
        let li = $('<li class="slide"></li>');
        let img = $(`<img class = "slide__img" src ="${allImages[i].img}" data-src = "${allImages[i].img}">`);
        img.appendTo(li);
        li.appendTo(blockForImg);
    };
}

function nextSlide () {
    if (slideNow == slideCount || slideNow <= 0 || slideNow > slideCount) {
       $('.slidewrapper').css('transform', 'translate(0, 0)');
       slideNow = 1;
    } else {
        translateWidth = -$('.single__product__wear').width() * (slideNow);
        $('.slidewrapper').css({
            'transform': 'translate(' + translateWidth + 'px, 0)',
            '-webkit-transform': 'translate (' + translateWidth + 'px, 0)',
            '-ms-transform': 'translate(' + translateWidth + 'px, 0)',
        });
        slideNow++;
    }
}

function prevSlide() {
    if (slideNow == 1 || slideNow <= 0 || slideNow > slideCount) {
        translateWidth = -$('.single__product__wear').width() * (slideNow - 1);
        $('.slidewrapper').css({
            'transform': 'translate(' + translateWidth + 'px, 0)',
            '-webkit-transform': 'translate(' + translateWidth + 'px, 0)',
            '-ms-transform': 'translate(' + translateWidth + 'px, 0)',
        });
        slideNow = slideCount;
    } else {
        translateWidth = -$('.single__product__wear').width() * (slideNow - 2);
        $('.slidewrapper').css({
            'transform': 'translate(' + translateWidth + 'px, 0)',
            '-webkit-transform': 'translate(' + translateWidth + 'px, 0)',
            '-ms-transform': 'translate(' + translateWidth + 'px, 0)',
        });
        slideNow--;
    }
}

function stopSliderWhenHovering (switchInterval) {
    $('.single__product__wear').hover(function () {
        clearInterval(switchInterval);
    }, function () {
        switchInterval = setInterval(nextSlide, slideInterval)
    })
}