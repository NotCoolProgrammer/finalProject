<?php

namespace theBrand;
session_start();
$request = new SystemFunctions();
$valueOfRequestUri = $request -> serverUri();
$valueOfRequestMethod = $request -> serverMethor();
$singleView = $request -> startsWith($valueOfRequestUri, '/singleProduct/');


if ($singleView) {
    $getSingleProduct = new GetSmthWhenInteractingWithDB();
    $path = explode('/', $valueOfRequestUri);
    $productSingleView = $path[2];
    $product = json_encode($getSingleProduct -> getProductSingleView($productSingleView));
    $sizes = json_encode($getSingleProduct -> getSizeOfProduct($productSingleView));
    $colors = json_encode($getSingleProduct -> getColorsOfProduct($productSingleView));
    $images = json_encode($getSingleProduct -> getImagesOfProduct($productSingleView));

    $session = $request -> returnSession();
    $DB = new WorkWithDB();
    $user = $DB -> findUser($session['login']);


    if (is_null($product)) {
        http_response_code(404);
        die();
    } else {
        $request -> generateSingleProduct($product, $sizes, $colors, $images, $user);
    }
}

