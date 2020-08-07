<?php

namespace theBrand;

class SystemFunctions {
    function serverUri () {
        return $_SERVER['REQUEST_URI'];
    }

    function serverMethor () {
        return $_SERVER['REQUEST_METHOD'];
    }

    function startsWith($haystack, $needle) {
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
    }
    
    function generateSingleProduct ($product, $sizes, $colors, $images, $user) {

        $product = json_decode($product, true);
        $sizes = json_decode($sizes, true);
        $colors = json_decode($colors, true);
        $images = json_decode($images, true);

        $handleRequest = function () use ($product, $sizes, $colors, $images) {
            include "PHP/Views/singleProduct.php";
        };
        $addressOfCssFile = "../CSS/singlePage.css";
        include "HTML/singleProduct/singlePageProduct.php";
    }

    function returnSession () {
        return $_SESSION['currentUser'];
    }

    function uploadFolder () {
        $documentRoot = $_SERVER['DOCUMENT_ROOT'];
        $uploadFolder = $documentRoot.'/uploads';
        return $uploadFolder;
    }

    function serverName () {
        $serverName = $_SERVER['HTTP_HOST'];
        return $serverName;
    }
}