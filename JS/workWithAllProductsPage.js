'use strict';

$(document).ready(function () {
    // $.post('/getAllSizes', {}, function (data) {
    //     generateSizes(data);
    // })

    $.post('/allGoods', {}, function (products) {
        let allProducts = JSON.parse(products);
        generateMaterialsOfProducts(allProducts);
        generateCollection(allProducts);
        generateDesigners(allProducts);
        generateAllSizes(allProducts);
        deleteLastSeparator();
    })

    $('.product__link').on('click', showHiddenBlocks);

    $('.price__slider__input').ionRangeSlider({
        type: 'double',
        min: 10,
        max: 300,
        from: 40,
        to: 150,
        step: 5
    });

})

// function generateSizes (data) {
//     let allSizes = JSON.parse(data);
//     let blockForSizes = $('.size__label');
//     for (let i = 0; i < allSizes.length; i++) {
//         $(`
//             <input type="checkbox" id="${allSizes[i].size}" name="${allSizes[i].size}" class="checkbox">
//             <label for="${allSizes[i].size}">${allSizes[i].size}</label>
//         `).appendTo(blockForSizes);
//     }
// }

function generateMaterialsOfProducts(allProducts) {
    let materialComponents = $('.product__materials__components');
    let allUnfilteredMaterials = [];

    for (let i = 0; i < allProducts.length; i++) {
        allUnfilteredMaterials.push(allProducts[i].material);
    }
    let allMaterials = Array.from(new Set(allUnfilteredMaterials));

    for (let i = 0; i < allMaterials.length; i++) {
        $(`<p class="product__materials__components__p">${allMaterials[i]}</p>
            <span>|</span>`).appendTo(materialComponents);
    }

    $('.product__materials__components__p').on('click', addFilterToProductMaterials);
}

function generateCollection (allProducts) {
    let collectionComponents = $('.collection');
    let allUnfilteredCollection = [];


    for (let i = 0; i < allProducts.length; i++) {
        allUnfilteredCollection.push(allProducts[i].collection);
    } 
    let allCollection = Array.from(new Set(allUnfilteredCollection));

    for (let i = 0; i < allCollection.length; i++) {
        $(`<li class ="drop__li"><span class="drop__link">${allCollection[i]}</span></li>`).appendTo(collectionComponents);
    }
}

function generateDesigners (allProducts) {
    let collectionDesigners = $('.designer');
    let allUnfilteredDesigners = [];

    for (let i = 0; i < allProducts.length; i++) {
        allUnfilteredDesigners.push(allProducts[i].designer);
    } 

    let allDesigners = Array.from(new Set(allUnfilteredDesigners));

    for (let i = 0; i < allDesigners.length; i++) {
        $(`<li class ="drop__li"><span class="drop__link">${allDesigners[i]}</span></li>`).appendTo(collectionDesigners);
    }
}

function generateAllSizes (products) {
    let arrayOfSizes = [];
    for (let i = 0; i < products.length; i++) {
        let tempArray = JSON.parse(products[i].json_agg);
        arrayOfSizes.push(tempArray);
    }
    let index = indexOfLongest(arrayOfSizes);

    let blockForSizes = $('.size__label');
    for (let i = 0; i < arrayOfSizes[index].length; i++) {
        $(`
            <input type="checkbox" id="${arrayOfSizes[index][i]}" name="${arrayOfSizes[index][i]}" class="checkbox">
            <label for="${arrayOfSizes[index][i]}">${arrayOfSizes[index][i]}</label>
        `).appendTo(blockForSizes);
    }
}

function indexOfLongest(arrays) {
    var longest = -1;
    for (var i = 0; i < arrays.length; i++) {
      if (longest == -1 || arrays[i].length > arrays[longest].length) {
        longest = i;
      }
    }
    return longest;
  }  


function showHiddenBlocks (e) {
    let dropDownBlock = e.currentTarget.nextElementSibling;
    if ($(dropDownBlock).hasClass('hidden')) {
        $(dropDownBlock).css({
            'max-height': '500px',
            'opacity': '1'
        });
        $(dropDownBlock).removeClass('hidden');
    } else {
        $(dropDownBlock).css({
            'max-height': '0px',
            'opacity': '0',
            'overflow': 'hidden'
        });
        $(dropDownBlock).addClass('hidden');
    }
    $('.drop__li').on('click', addFilterToDropDownBlocks);
}

function addFilterToDropDownBlocks (e) {
    let element = e.currentTarget.children[0];
    filterCondition(element)
}

function addFilterToProductMaterials (e) {
    let element = e.currentTarget;
    filterCondition(element);
}

function filterCondition (element) {
    if ($(element).hasClass('filter')) {
        $(element).removeClass('filter');
    } else {
        $(element).addClass('filter');
    }
}

function deleteLastSeparator () {
    let elements = $('.product__materials__components');
    let lastSpan = elements[0].children[elements[0].children.length - 1];
    if (lastSpan.localName === 'span') {
        lastSpan.innerHTML = '';
    }
}