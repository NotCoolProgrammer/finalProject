<?php 
namespace theBrand;
include 'vendor/autoload.php';
session_start();
$request = new SystemFunctions();
$valueOfRequestUri = $request -> serverUri();
$valueOfRequestMethod = $request -> serverMethor();

function equals ($thisValue) {
    return function ($thatValue) use ($thisValue) {
        return $thatValue == $thisValue;
    };
};

function authorizeUser ($user) {    
    $_SESSION["currentUser"] = $user;
};

function userAuthorized () {
    return !is_null($_SESSION['currentUser']);
};

function loginPath() {
    return '/account';
};

function returnSession() {
    return $_SESSION['currentUser'];
}

function withAuth ($handler) {
    return function () use($handler) {
        if (!userAuthorized()) {
            header('Location: '.loginPath());
            return null;
        } else {
            return $handler();
        }
    };
};

function addUuidToProducts () {
    $DB = new GetSmthWhenInteractingWithDB();
    $DB -> addUuidPathToProduct();
}

function isAdmin() {
    $session = returnSession();

    $checkDataFromDB = new GetSmthWhenInteractingWithDB ();
    $adminsBool = $checkDataFromDB -> checkForAdmins ($session['login'], $session['password']);

    if ($adminsBool === true) {
        return true;
    } else {
        return false;
    }
};

addUuidToProducts();

$mainPage = function () {
    $addressOfCssFile = '../CSS/main.css';

    $isAdmin = isAdmin();
    if ($isAdmin === true) {
        header('Location: /adminPage');
        die();
    }
    
    $DB = new WorkWithDB();
    $allReviews = json_decode($DB -> getAllReviews(), true);
    require 'HTML/main/main.php';
    die();
};

$allProducts = function () {
    $isAdmin = isAdmin();
    if ($isAdmin === true) {
        header('Location: /adminPage');
        die();
    }

    $addressOfCssFile = '../CSS/allproducts.css';
    require 'HTML/allProducts/allProducts.php';
    die();
};

$shoppingCart = function () {
    $isAdmin = isAdmin();
    if ($isAdmin === true) {
        header('Location: /adminPage');
        die();
    }

    $request = new SystemFunctions();
    $DB = new WorkWithDB();
    $valueOfRequestMethod = $request -> serverMethor();
    $idUser = $_SESSION['currentUser']['id'];
    if ($valueOfRequestMethod == 'POST' && isset($_SESSION['currentUser'])) {
        $idProduct = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
        $productName = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $productPrice = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_INT) ;
        $productColor = filter_var($_POST['color'], FILTER_SANITIZE_STRING);
        $productSize = filter_var($_POST['size'], FILTER_SANITIZE_STRING) ;
        $productCount = filter_var($_POST['count'], FILTER_SANITIZE_NUMBER_INT);
        $productSingleView = filter_var($_POST['singleview'], FILTER_SANITIZE_STRING);
        $productImg = filter_var($_POST['img'], FILTER_SANITIZE_STRING);

            
        $DB -> addProductToCart($idProduct, $idUser, $productName, $productPrice, $productColor, $productSize, $productCount, $productSingleView, $productImg);

        $existingPricesForUserProducts = $DB -> existingUserProducts($idUser);
        if (count($existingPricesForUserProducts) === 1) {
            $totalPrice = $productPrice * $productCount;
        } else if (count($existingPricesForUserProducts) > 1) {
            for ($i = 0; $i < count($existingPricesForUserProducts); $i++) {
                $totalPrice += $existingPricesForUserProducts[$i]['current_price'];
            }
        }

        $DB -> setTotalPrice($totalPrice, $idUser);

    }
    $userProducts = json_encode($DB -> getUsersProducts($idUser));
    $addressOfCssFile = '../CSS/shoppingCart.css';
    require 'HTML/shoppingCart/shoppingCart.php';
    die();
};

$checkout = function () {
    $isAdmin = isAdmin();
    if ($isAdmin === true) {
        header('Location: /adminPage');
        die();
    }

    $session = returnSession();
    $user = $session;

    $DB = new WorkWithDB();
    $allUserProducts = $DB -> getUsersProducts($user['id']);

    if (count($allUserProducts) === 0) {
        header('Location: /allProducts');
    } else {
        $addressOfCssFile = '../CSS/checkout.css';
        require 'HTML/checkout/checkout.php';
    }
    die();
};

$getProducts = function () {
    $DB = new WorkWithDB();
    $result = $DB -> getAllProductsFromDB();
    echo $result;
    die();
};

$account = function () {
    $isAdmin = isAdmin();
    if ($isAdmin === true) {
        header('Location: /adminPage');
        die();
    }

    $session = returnSession();
    $DB = new WorkWithDB();
    $user = $DB -> findUser($session['login']);
    $addressOfCssFile = '../CSS/account.css';
    require 'HTML/account/account.php';
    die();
};

$register = function () {
    $addressOfCssFile = '../CSS/register.css';
    require 'HTML/register/register.php';
    die();
};

$handleAuth = function () {
    $login =  filter_var($_POST['login'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

    $callTheDbClass = new WorkWithDB();

    $checkDataFromDB = new GetSmthWhenInteractingWithDB ();
    $adminsBool = $checkDataFromDB -> checkAdminDataAndAuthData ($login, $password);
    $admin = json_decode($callTheDbClass -> findAdminInfo(), true);
    if ($adminsBool === true) {
        authorizeUser($admin);
        header('Location: /adminPage');
        die();
    }
    
    $user = $callTheDbClass -> findUser($login);

    if (!is_null($user) && $user['active'] && password_verify($password, $user['password'])) {
        authorizeUser($user);
        header("Refresh:0");
        die();
    } else {
        header("Location: /account");
        die();
    };
};

$registerUser = function () {
    $firstName = filter_var($_POST['firstName'], FILTER_SANITIZE_STRING);
    $lastName = filter_var($_POST['lastName'], FILTER_SANITIZE_STRING);
    $login = filter_var($_POST['login'], FILTER_SANITIZE_STRING);
    $mobile = filter_var($_POST['mobile'], FILTER_SANITIZE_NUMBER_INT);
    $password = filter_var($_POST['password1'], FILTER_SANITIZE_STRING);

    if (!empty($_FILES['image'])) {
        $request = new SystemFunctions();
        $uploadFolder = $request -> uploadFolder();
        $serverName = $request -> serverName();
        $folder = $uploadFolder;
        $additionalFunction = new additionalFunctions();
        $file_path = $additionalFunction -> upload_image($_FILES['image'], $folder);
        $file_path_exploded = explode('/', $file_path);
        $filename = $file_path_exploded[count($file_path_exploded) - 1];
        $file_url = "//$serverName/uploads/".$filename;
    }

    $register = new CRUD();
    $createUser = $register -> createUser($firstName, $lastName, $login, $mobile, $password, $file_url);
    if ($createUser === true) {
        header('Location: /account');
        die();
    }
};

$authorizedUser = function () {
    echo json_encode($_SESSION);
    die();
};

$logout = function () {
    $DB = new WorkWithDB();
    $user = returnSession();
    $DB -> deleteCoupon($user['id']);
    $DB -> deleteAllProducts($user['id']);
    session_destroy();
    header('Location: /');
    die();
};

$deleteAllProducts = function () {
    $idUser = $_SESSION['currentUser']['id'];
    $DB = new WorkWithDB();
    $DB -> deleteAllProducts($idUser);
    die();
};

$deleteOneProduct = function () {
    $idOfSpecificProduct = filter_var($_POST['idOfSpecificProduct'], FILTER_SANITIZE_NUMBER_INT);
    $idUser = $_SESSION['currentUser']['id'];
    $DB = new WorkWithDB();
    $DB -> deleteOneProduct($idUser, $idOfSpecificProduct);
    die();
};

$editUserPage = function () {
    $isAdmin = isAdmin();
    if ($isAdmin === true) {
        header('Location: /adminPage');
        die();
    }
    $session = returnSession();
    $DB = new WorkWithDB();
    $user = $DB -> findUser($session['login']);
    $addressOfCssFile = '../CSS/editUserPage.css';
    require "HTML/editUser/editUserPage.php";
    die();
};

$editUser = function () {
    $session = returnSession();
    $userId = $session['id'];
    $login = filter_var($_POST['login'], FILTER_SANITIZE_STRING);
    $mobile = filter_var($_POST['mobile'], FILTER_SANITIZE_NUMBER_INT);
    $password1 = filter_var($_POST['password1'], FILTER_SANITIZE_STRING);
    $password2 = filter_var($_POST['password2'], FILTER_SANITIZE_STRING);


    if (!empty($_FILES['image'])) {
        $request = new SystemFunctions();
        $uploadFolder = $request -> uploadFolder();
        $serverName = $request -> serverName();
        $folder = $uploadFolder;
        $additionalFunction = new additionalFunctions();
        $file_path = $additionalFunction -> upload_image($_FILES['image'], $folder);
        $file_path_exploded = explode('/', $file_path);
        $filename = $file_path_exploded[count($file_path_exploded) - 1];
        $file_url = "//$serverName/uploads/".$filename;
    }

    $processOfEditingUser = new CRUD();
    $editingUser = $processOfEditingUser -> editUser($userId, $login, $mobile, $password2, $file_url);
    if ($editingUser=== true) {
        session_destroy();
        header('Location: /account');
        die();
    }

};

$deleteUser = function () {
    $idUser = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $DB = new WorkWithDB();
    $DB-> deleteUser($idUser);
    session_destroy();
    header('Location: /');
};

$uploadReview = function () {
    $session = returnSession();
    $DB = new WorkWithDB();
    $user = $DB -> findUser($session['login']);
    $countOfActiveStars = filter_var($_POST['countOfActiveStars'], FILTER_SANITIZE_NUMBER_INT);
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $surname = filter_var($_POST['surname'], FILTER_SANITIZE_STRING);
    $comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
    $userId = filter_var($_POST['idUser'], FILTER_SANITIZE_NUMBER_INT);
    $userImage = filter_var($_POST['userImage'], FILTER_SANITIZE_STRING);
    $imageOfAnUnathorizedUser = '/img/avatars/anonim.jpg';

    if ($userId === '') {
        $DB -> uploadReview($name, $surname, $countOfActiveStars, $comment, $imageOfAnUnathorizedUser);
    } else if ($userId !== '') {
        $DB -> uploadReview2($userId, $user['firstname'], $user['lastname'], $countOfActiveStars, $comment, $userImage);
    }
};

$getAllInfoAboutReviews = function () {
    $DB = new WorkWithDB();
    $allReviews = $DB -> getAllReviews();
    echo $allReviews;
};

$checkCoupon = function () {
    $coupon = filter_var($_POST['couponVal'], FILTER_SANITIZE_STRING);
    $DB = new WorkWithDB();
    $resultOfCheck = $DB -> checkCoupon($coupon);
    echo $resultOfCheck;
};

$getAllStates = function () {
    $DB = new WorkWithDB();
    $allStates = $DB -> getAllStates();
    echo $allStates;
};

$getAllCitiesInTheCountry = function () {
    $state = filter_var($_POST['selectedState'], FILTER_SANITIZE_STRING);
    $DB = new WorkWithDB();
    $allCitiesInTheCountry = $DB -> getAllCities($state);
    echo $allCitiesInTheCountry;
};

$getUsersProducts = function () {
    $session = returnSession();
    $userId = $session['id'];
    $DB = new WorkWithDB();
    $allUsersProducts = json_encode($DB -> getUsersProducts($userId));
    echo $allUsersProducts;
};

$checkEmails = function () {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $checkDataFromDB = new GetSmthWhenInteractingWithDB ();
    $result = $checkDataFromDB -> checkEmails ($email);
    echo json_encode($result);
};

$checkPassword = function () {
    $pass = filter_var($_POST['password1'], FILTER_SANITIZE_STRING);
    $user = returnSession();
    $checkDataFromDB = new GetSmthWhenInteractingWithDB ();
    $result = $checkDataFromDB -> checkPass ($pass, $user);
    echo $result;
};

$checkEnteredCouponNameWithUsersCouponName = function () {
    $user = returnSession();
    $couponName = filter_var($_POST['coupon']['coupon'], FILTER_SANITIZE_STRING);
    $checkCoupon = new GetSmthWhenInteractingWithDB ();
    $result = $checkCoupon -> checkCoupon($couponName, $user['id']);
    echo $result;
};

$addCouponInShoppingCart = function () {
    $DB = new WorkWithDB();
    $user = returnSession();
    $idCoupon = filter_var($_POST['coupon']['id'], FILTER_SANITIZE_NUMBER_INT);
    $discountVal = filter_var($_POST['coupon']['discount']);

    $currentTotalPrice = $DB -> currentTotalPrice($user['id']);
    $differenceBetweenPrices = ($currentTotalPrice['total_price'] * $discountVal) / 100;
    $newTotalPrice = $currentTotalPrice['total_price'] - $differenceBetweenPrices;
    $DB -> addCouponToUser ($user['id'], $idCoupon);
    $DB -> changeTotalPrice($newTotalPrice, $user['id']);
};

$getInfoAboutCoupons = function () {
    $DB = new WorkWithDB();
    $user = returnSession();
    $coupon = json_encode($DB -> getUserCoupon ($user['id']));
    echo $coupon;
};

$deleteCoupon = function () {
    $DB = new WorkWithDB();
    $user = returnSession();
    $DB -> deleteCoupon($user['id']);
    $totalPrice = $DB -> getTotalPrice($user['id']);
    $DB -> returnTotalPriceOfProducts($user['id'], $totalPrice['total_price']);
};

$sendEmail = function () {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    if (!isset($email)) {
        $additionalFunction = new additionalFunctions();
        $additionalFunction -> sendEmail($email);
    }
};

$increaseProductCounterBy1 = function () {
    $singleProductPath = filter_var($_POST['singlePath'], FILTER_SANITIZE_STRING);
    $countFromFront = filter_var($_POST['count'], FILTER_SANITIZE_NUMBER_INT);
    $productColor = filter_var($_POST['color'], FILTER_SANITIZE_STRING);
    $productSize = filter_var($_POST['size'], FILTER_SANITIZE_STRING);
    $DB = new WorkWithDB();
    $countFromBack = $DB -> findCountOfProduct($singleProductPath, $productColor, $productSize);
    $DB -> increaseProductCounterBy1($countFromFront, $countFromBack['count'], $singleProductPath, $productColor, $productSize);
};

$findIdenticalProduct = function () {
    $DB = new WorkWithDB();
    $idProduct = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
    $productColor = filter_var($_POST['color'], FILTER_SANITIZE_STRING);
    $productSize = filter_var($_POST['size'], FILTER_SANITIZE_STRING);
    $productSingleView = filter_var($_POST['singleview'], FILTER_SANITIZE_STRING);
    $allProducts = $DB -> findIdenticalProduct($idProduct, $productColor, $productSize, $productSingleView);
    echo $allProducts;
};

$getSessionOfUser = function () {
    $user = returnSession();
    echo json_encode($user);
};

$adminPage = function () {
    $DB = new WorkWithDB();
    $usersOrders = $DB -> getAllInfoAboutTheOrderFromAdminTable();
    $addressOfCssFile = '../CSS/adminPage.css';
    require 'HTML/adminPage/adminPage.php';
    die();
};

$transferAnOrderToAnotherStatus = function () {
    $countOfProducts = filter_var($_POST['countOfProducts'], FILTER_SANITIZE_NUMBER_INT);
    $totalPrice = $_POST['totalPrice'];
    $deliveryAddress = filter_var($_POST['deliveryAddress'], FILTER_SANITIZE_STRING);
    $postCode = filter_var($_POST['postCode'], FILTER_SANITIZE_NUMBER_INT);
    $deliveryMethod = filter_var($_POST['deliveryMethod'], FILTER_SANITIZE_STRING);
    $recipientName = filter_var($_POST['recipientName'], FILTER_SANITIZE_STRING);
    $recipientSurname = filter_var($_POST['recipientSurname'], FILTER_SANITIZE_STRING);
    $paymentMethod = filter_var($_POST['paymentMethod'], FILTER_SANITIZE_STRING);
    $session = returnSession();
    $userMobile = $session['mobile'];
    $userId = $session['id'];
    $DB = new WorkWithDB();
    $DB -> provideInfoAboutOrderToAdmins($countOfProducts, $totalPrice, $deliveryAddress, $postCode, $deliveryMethod, $recipientName, $recipientSurname, $paymentMethod, $userMobile);
    $DB -> deleteAllProducts($userId);
    $DB -> deleteCoupon($userId);
};

$changeStatusOfTheOrder = function () {
    $DB = new WorkWithDB();
    $newStatusOfTheOrder = filter_var($_POST['statusText'], FILTER_SANITIZE_STRING);
    $orderId = filter_var($_POST['orderId'], FILTER_SANITIZE_NUMBER_INT);
    $DB -> changeStatus($newStatusOfTheOrder, $orderId);
};

$deleteOrder = function () {
    $DB = new WorkWithDB();
    $orderId = $_POST['orderId'];
    echo json_encode($orderId);
    $DB -> deleteOrder ($orderId);
};

$routes = [
    '/' => $mainPage,
    '/allProducts' => $allProducts,
    '/shoppingCart' => withAuth($shoppingCart),
    '/checkout' => withAuth($checkout),
    '/allGoods' => $getProducts,
    '/account' => $account,
    '/register' => $register,
    '/auth' => $handleAuth,
    '/registerUser' => $registerUser,
    '/authorizedUser' => $authorizedUser,
    '/logout' => withAuth($logout),
    '/deleteAllProducts' => $deleteAllProducts,
    '/deleteOneProduct' => $deleteOneProduct,
    '/editUserPage' => withAuth($editUserPage),
    '/editUser' => withAuth($editUser),
    '/deleteUser' => withAuth($deleteUser),
    '/uploadReview' => $uploadReview,
    '/getAllInfoAboutReviews' => $getAllInfoAboutReviews,
    '/checkCoupon' => $checkCoupon,
    '/getAllStates' => $getAllStates,
    '/getAllCitiesInTheCountry' => $getAllCitiesInTheCountry,
    '/getUsersProducts' => $getUsersProducts,
    '/checkEmails' => $checkEmails,
    '/checkPassword' => $checkPassword,
    '/checkEnteredCouponNameWithUsersCouponName' => $checkEnteredCouponNameWithUsersCouponName,
    '/addCouponInShoppingCart' => $addCouponInShoppingCart,
    '/getInfoAboutCoupons' => $getInfoAboutCoupons,
    '/deleteCoupon' => $deleteCoupon,
    '/sendEmail' => $sendEmail,
    '/increaseProductCounterBy1' => $increaseProductCounterBy1,
    '/findIdenticalProduct' => $findIdenticalProduct,
    '/getSessionOfUser' => $getSessionOfUser,
    '/adminPage' => $adminPage,
    '/transferAnOrderToAnotherStatus' => $transferAnOrderToAnotherStatus,
    '/changeStatusOfTheOrder' => $changeStatusOfTheOrder,
    '/deleteOrder' => $deleteOrder,
];

function go ($routes, $valueOfRequestUri) {
    $router = new Router();
    foreach ($routes as $path => $handler) {
        $router -> addRoute(equals($path), $handler);
    };

    try {
        $router -> handleRequest($valueOfRequestUri);
    } catch (NotFoundException $exception) {
        http_response_code(404);
    }
}

go($routes, $valueOfRequestUri);
die();