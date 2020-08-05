<?php

namespace theBrand;

class GetSmthWhenInteractingWithDB {

    //нужен нормальный запрос на получение товара (не использовать функцию getAllProductsFromDB)
    function getProducts () {
        $product = new WorkWithDB();
        $products = $product -> getAllInfoAboutAllProducts();
        return json_decode($products, true);
    }

    function getProductSingleView ($productSingleView) {
        $getProducts = new GetSmthWhenInteractingWithDB();
        $products = $getProducts -> getProducts();
        foreach ($products as $product) {
            if ($product['singleview'] == $productSingleView) {
                return $product;
            }
        }
        return null;
    }

    function getSizeOfProduct($productSingleView) {
        $getSizes = new WorkWithDB();
        $sizes = $getSizes -> getAllSizesOfProduct($productSingleView);
        return $sizes;
    }

    function getColorsOfProduct ($productSingleView) {
        $getColors = new WorkWithDB();
        $colors = $getColors -> getAllColorsOfProduct($productSingleView);
        return $colors;
    }

    function getImagesOfProduct ($productSingleView) {
        $getImages = new WorkWithDB();
        $images = $getImages -> getAllImagesOfProduct ($productSingleView);
        return $images;
    }

    function checkEmails ($email) {
        $DB = new WorkWithDB();
        $allEmails = $DB -> getAllEmails ();

        for ($i = 0; $i < count($allEmails); $i++) {
            if ($allEmails[$i]['login'] == $email) {
                return true;
            }
        }
    }

    function checkPass ($pass, $user) {
        if (password_verify($pass, $user['password'])) {
            return true;
        }
    }

    function checkCoupon ($couponName, $userId) {
        $DB = new WorkWithDB();
        $coupon = $DB -> getUserCoupon ($userId);

        if (count($coupon) !== 0) {
            return true;
        } else {
            return false;
        }
    }

    function addUuidPathToProduct () {
        $DB = new WorkWithDB();
        $additional = new additionalFunctions();
        $allProducts = json_decode($DB -> getAllProductsFromDB(), true);

        for ($i = 0; $i < count($allProducts); $i++) {
            if ($allProducts[$i]['singleview'] === '') {
                $uuid = $additional -> randomUuid();
                $productId = $allProducts[$i]['id'];
                $DB -> addUuidPathToProduct($uuid, $productId);
            }
        };
    }

    function checkAdminDataAndAuthData ($login, $pass) {
        $DB = new WorkWithDB();
        $adminData = json_decode($DB -> findAdminInfo(), true);


        if ($adminData['login'] === $login && password_verify($pass, $adminData['password'])) {
            return true;
        } else {
            return false;
        }
    }

    function checkForAdmins ($login, $pass) {
        $DB = new WorkWithDB();
        $adminData = json_decode($DB -> findAdminInfo(), true);


        if ($adminData['login'] === $login && $adminData['password'] === $pass) {
            return true;
        } else {
            return false;
        }
    }
}