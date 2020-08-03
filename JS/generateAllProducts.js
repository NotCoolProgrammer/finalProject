$(document).ready(function() {
    $.post('/allGoods', {}, function (someProducts) {
        let products = JSON.parse(someProducts);
        if ($('.all__products__content__choice').length) {
            generateAllProducts(products);
        } else if ($('.product-box').length) {
            generateEightProducts(products);
        } else if ($('.similar__product__box').length) {
            generateFourProducts(products)
        } else {
            console.log("Не получилось, не фортануло");
        }

        $('.apply__filter').on('click', function () {
            filterProducts(products);
        });

    });
})

function generateAllProducts (products) {
    $('.all__products__content__choice').empty();
    let mainBlock = $('.all__products__content__choice');
    for(let i = 0; i < products.length; i++) {
        generateLayout(products, mainBlock, i);
    }
}

function generateEightProducts (products) {
    let mainBlock = $('.product-box');
    for (let i = 0; i < 8; i++) {
        generateLayout(products, mainBlock, i);
    }
}

function generateFourProducts (products) {
    let href = document.location.pathname;
    let url = href.split('/');
    let singleView = url[2];
    let mainBlock = $('.similar__product__box');
    for(let i = 0; i < products.length; i++) {
        if (singleView === products[i].singleview) {
            products.splice(i, 1);
            break;
        }
    }

    for (let i = 0; i < 4; i++) {
        generateLayout(products, mainBlock, i);
    }
}

function generateLayout (products, mainBlock, i) {
    let mainProductBlock = $(`<div class ="product__unique" data-id ="${products[i].id}"></div>`);
    $(`
        <a href="/singleProduct/${products[i].singleview}"><img class="product__img" src="${products[i].mainimg}" alt="фото продукта"></a>
        <div class="product__text">
            <a href="/singleProduct/${products[i].singleview}" class="product__name">${products[i].name}</a>
            <p class="product__price"><span class="currency">$</span>${products[i].price}</p>
        </div>
    `).prependTo(mainProductBlock);
    mainProductBlock.appendTo(mainBlock);
}


function filterProducts (products) {
    const 
        filteredCollectionElements = $('.collection .filter'),
        filteredDesignerElements = $('.designer .filter'),
        filteredProductMaterials = $('.product__materials .filter'),
        filteredSizesElements = $('.size__label input:checked'),
        priceMin = $('.irs-from')[0].textContent,
        priceMax = $('.irs-to')[0].textContent;

    const 
        filteredCollections = [],
        filteredDesigners = [],
        filteredMaterials = [],
        filteredSizes = [];


    for (let i = 0; i < filteredCollectionElements.length; i++) {
        filteredCollections.push(filteredCollectionElements[i].textContent);
    }

    for (let i = 0; i < filteredDesignerElements.length; i++) {
        filteredDesigners.push(filteredDesignerElements[i].textContent);
    }

    for (let i = 0; i < filteredProductMaterials.length; i++) {
        filteredMaterials.push(filteredProductMaterials[i].textContent);
    }

    for (let i = 0; i < filteredSizesElements.length; i++) {
        filteredSizes.push(filteredSizesElements[i].name);
    }

    generateAllProducts(products.filter(n => (
        (!filteredMaterials.length || filteredMaterials.includes(n.material)) &&
        (!priceMin || priceMin <= n.price) &&
        (!priceMax || priceMax >= n.price) &&
        (!filteredDesigners.length || filteredDesigners.includes(n.designer)) &&
        (!filteredCollections.length || filteredCollections.includes(n.collection))
    )))
}