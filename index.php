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

addUuidToProducts();

$mainPage = function () {
    $addressOfCssFile = '../CSS/main.css';
    $DB = new WorkWithDB();
    $allReviews = json_decode($DB -> getAllReviews(), true);
    require 'HTML/main/main.php';
    die();
};

$allProducts = function () {
    $addressOfCssFile = '../CSS/allproducts.css';
    require 'HTML/allProducts/allProducts.php';
    die();
};

$shoppingCart = function () {
    $request = new SystemFunctions();
    $DB = new WorkWithDB();
    $valueOfRequestMethod = $request -> serverMethor();
    $idUser = $_SESSION['currentUser']['id'];
    if ($valueOfRequestMethod == 'POST' && isset($_SESSION['currentUser'])) {
        $idProduct = $_POST['id'];
        $productName = $_POST['name'];
        $productPrice = $_POST['price'];
        $productColor = $_POST['color'];
        $productSize = $_POST['size'];
        $productCount = $_POST['count'];
        $productSingleView = $_POST['singleview'];
        $productImg = $_POST['img'];
        $DB -> addProductToCart($idProduct, $idUser, $productName, $productPrice, $productColor, $productSize, $productCount, $productSingleView, $productImg);
    }
    $userProducts = json_encode($DB -> getUsersProducts($idUser));
    $addressOfCssFile = '../CSS/shoppingCart.css';
    require 'HTML/shoppingCart/shoppingCart.php';
    die();
};

$checkout = function () {
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
    $adminsBool = $checkDataFromDB -> checkForAdmins ($login, $password);
    $admin = json_decode($callTheDbClass -> findAdminInfo(), true);

    
    $user = $callTheDbClass -> findUser($login);
    
    if ($adminsBool === true) {
        authorizeUser($admin);
        header('Location: /adminPage');
        die();
    }

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
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $login = $_POST['login'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password1'];

    if (!empty($_FILES['image'])) {
        $folder = '/home/sasha/desktop/finalProject/uploads';
        $additionalFunction = new additionalFunctions();
        $file_path = $additionalFunction -> upload_image($_FILES['image'], $folder);
        $file_path_exploded = explode('/', $file_path);
        $filename = $file_path_exploded[count($file_path_exploded) - 1];
        $file_url = 'http://thebrand.com/uploads/'.$filename;
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
    $idOfSpecificProduct = $_POST['idOfSpecificProduct'];
    $idUser = $_SESSION['currentUser']['id'];
    $DB = new WorkWithDB();
    $DB -> deleteOneProduct($idUser, $idOfSpecificProduct);
    die();
};

$editUserPage = function () {
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
    $login = $_POST['login'];
    $mobile = $_POST['mobile'];
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];


    if (!empty($_FILES['image'])) {
        $folder = '/home/sasha/Desktop/domains/ProgSchool/finalProject/uploads';
        $additionalFunction = new additionalFunctions();
        $file_path = $additionalFunction -> upload_image($_FILES['image'], $folder);
        $file_path_exploded = explode('/', $file_path);
        $filename = $file_path_exploded[count($file_path_exploded) - 1];
        $file_url = 'http://theBrand.com/uploads/'.$filename;
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
    $idUser = $_POST['id'];
    $DB = new WorkWithDB();
    $DB-> deleteUser($idUser);
    session_destroy();
    header('Location: /');
};

$uploadReview = function () {
    $session = returnSession();
    $DB = new WorkWithDB();
    $user = $DB -> findUser($session['login']);
    $countOfActiveStars = $_POST['countOfActiveStars'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $comment = $_POST['comment'];
    $userId = $_POST['idUser'];
    $userImage = $_POST['userImage'];

    if ($userId === '') {
        $DB -> uploadReview($name, $surname, $countOfActiveStars, $comment);
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
    $coupon = $_POST['couponVal'];
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
    $state = $_POST['selectVal'];
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
    $email = $_POST['email'];
    $checkDataFromDB = new GetSmthWhenInteractingWithDB ();
    $result = $checkDataFromDB -> checkEmails ($email);
    echo json_encode($result);
};

$checkPassword = function () {
    $pass = $_POST['password1'];
    $user = returnSession();
    $checkDataFromDB = new GetSmthWhenInteractingWithDB ();
    $result = $checkDataFromDB -> checkPass ($pass, $user);
    echo $result;
};

$checkEnteredCouponNameWithUsersCouponName = function () {
    $user = returnSession();
    $couponName = $_POST['coupon']['coupon'];
    $checkCoupon = new GetSmthWhenInteractingWithDB ();
    $result = $checkCoupon -> checkCoupon($couponName, $user['id']);
    echo $result;
};

$addCouponInShoppingCart = function () {
    $DB = new WorkWithDB();
    $user = returnSession();
    $idCoupon = $_POST['coupon']['id'];
    $DB -> addCouponToUser ($user['id'], $idCoupon);
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
};

$sendEmail = function () {
    $email = $_POST['email'];
    if (!isset($email)) {
        $additionalFunction = new additionalFunctions();
        $additionalFunction -> sendEmail($email);
    }
};

$increaseProductCounterBy1 = function () {
    $singleProductPath = $_POST['singlePath'];
    $countFromFront = $_POST['count'];
    $productColor = $_POST['color'];
    $productSize = $_POST['size'];
    $DB = new WorkWithDB();
    $countFromBack = $DB -> findCountOfProduct($singleProductPath, $productColor, $productSize);
    $DB -> increaseProductCounterBy1($countFromFront, $countFromBack['count'], $singleProductPath, $productColor, $productSize);
};

$findIdenticalProduct = function () {
    $DB = new WorkWithDB();
    $idProduct = $_POST['id'];
    $productColor = $_POST['color'];
    $productSize = $_POST['size'];
    $productSingleView = $_POST['singleview'];
    $allProducts = $DB -> findIdenticalProduct($idProduct, $productColor, $productSize, $productSingleView);
    echo $allProducts;
};

$getSessionOfUser = function () {
    $user = returnSession();
    echo json_encode($user);
};

$adminPage = function () {
    // $addressOfCssFile = ''
    require 'HTML/adminPage/adminPage.php';
    die();
};

$transferAnOrderToAnotherStatus = function () {
    $countOfProducts = $_POST['countOfProducts'];
    $totalPrice = $_POST['totalPrice'];
    $deliveryAddress = $_POST['deliveryAddress'];
    $postalCode = $_POST['postalCode'];
    $deliveryMethod = $_POST['deliveryMethod'];
    $recipientName = $_POST['recipientName'];
    $recipientSurname = $_POST['recipientSurname'];
    $paymentMethod = $_POST['paymentMethod'];
    $status = $_POST['status'];
    $session = returnSession();
    $userMobile = $session['mobile'];
    $DB = new WorkWithDB();
    $DB -> provideInfoAboutOrderToAdmins($countOfProducts, $totalPrice, $deliveryAddress, $postalCode, $deliveryMethod, $recipientName, $recipientSurname, $paymentMethod, $status, $userMobile);
    $DB -> deleteAllProducts($session['id']);
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
    '/transferAnOrderToAnotherStatus' => $transferAnOrderToAnotherStatus
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