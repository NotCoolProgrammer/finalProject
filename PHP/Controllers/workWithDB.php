<?php

namespace theBrand;

use PDOException;

class InvalidLoginException extends \Exception {};

class WorkWithDB {

    function getAllProductsFromDB () {
        $pdo = connection();
        $query = $pdo -> prepare('
                select products.id, name, price, singleView, fulldesc, designer, material, collection, mainImg, json_agg(size) from products
                left join products_size ps on products.id = ps.id_product
                group by (products.id)
        ');
        $query ->execute();
        $product = $query -> fetchAll();
        return json_encode($product);
    }

    function getAllInfoAboutAllProducts () {
        $pdo = connection();
        $query = $pdo -> prepare('Select products.id, products.name, products.price, products.singleView, products.fullDesc, products.designer, products.material, products.collection,
            products.mainImg, products_color.color, products_size.size, iTRTP.img
            from products
            left join products_color on products.id = products_color.id_product
            left join products_size on products.id = products_size.id_product
            left join imagesToRepresentTheProduct iTRTP on products.id = iTRTP.id_product');
        $query ->execute();
        $product = $query -> fetchAll();
        return json_encode($product);
    }

    function getAllColorsOfProduct ($productSingleView) {
        $pdo = connection();
        $query = $pdo -> prepare('select products_color.color
                from products_color
                left join products p on products_color.id_product = p.id
                where p.singleView = ?');
        $query -> execute([$productSingleView]);
        $colors = $query -> fetchAll();
        return $colors;
    }

    function getAllSizesOfProduct ($productSingleView) {
        $pdo = connection();
        $query = $pdo -> prepare('select products_size.size
            from products_size
            left join products p on products_size.id_product = p.id
            where p.singleView = ?');
        $query -> execute([$productSingleView]);
        $sizes = $query -> fetchAll();
        return $sizes;
    }

    function getAllImagesOfProduct ($productSingleView) {
        $pdo = connection();
        $query = $pdo -> prepare('select imagesToRepresentTheProduct.img
            from imagesToRepresentTheProduct
            left join products p on imagesToRepresentTheProduct.id_product = p.id
            where p.singleView = ?');
        $query -> execute([$productSingleView]);
        $images = $query -> fetchAll();
        return $images;
    }

    function findUser ($login) {
        $pdo = connection();
        $query = $pdo -> prepare('select * from users where login = ?');
        $query -> execute([$login]);
        $user = $query -> fetch();
        if ($user === false) {
            return null;
        } else {
            return $user;
        }
    }
        
    /**
     * addUserToDB
     *
     * @param  mixed $firstName
     * @param  mixed $lastName
     * @param  mixed $login
     * @param  mixed $mobile
     * @param  mixed $password
     * @throws InvalidLoginException login is not unique
     */
    function addUserToDB($firstName, $lastName, $login, $mobile, $password, $file_url) {
        $password = password_hash($password, PASSWORD_BCRYPT);
        $pdo = connection();
        $query = $pdo -> prepare('insert into users (firstName, lastName, login, mobile, 
            password, image) values (?, ?, ?, ?, ?, ?)');
        try {
            $query -> execute([$firstName, $lastName, $login, $mobile, $password, $file_url]);
            return true;
        } catch (PDOException $exception) {
            throw new InvalidLoginException('invalid login');
        }
    }

    function existingUserProducts ($userId) {
        $pdo = connection();
        $query = $pdo -> prepare('select (price * count) as current_price from users_products where user_id = ?');
        $query -> execute([$userId]);
        $result = $query -> fetchAll();
        return $result;
    }

    
    function addProductToCart($idProduct, $idUser, $productName, $productPrice, $productColor, $productSize, $productCount, $productSingleView, $productImg) {
        $pdo = connection();
        $query = $pdo -> prepare('insert into users_products (user_id, product_id, name, price, color, 
            size, singleView, mainImg, count) 
            values (?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $query -> execute([$idUser, $idProduct, $productName, $productPrice, $productColor, $productSize, $productSingleView, $productImg, $productCount]);
    }

    function setTotalPrice ($totalPrice, $idUser) {
        $pdo = connection();
        $query = $pdo -> prepare('update users_products set total_price = ? where user_id = ?');
        $query -> execute([$totalPrice, $idUser]);
    }

    function getUsersProducts ($idUser) {
        $pdo = connection();
        $query = $pdo -> prepare('select * from users_products where user_id = ?');
        $query -> execute([$idUser]);
        $userProducts = $query -> fetchAll();
        return $userProducts;
    }

    function deleteAllProducts ($idUser) {
        $pdo = connection();
        $query = $pdo -> prepare('delete from users_products where user_id = ?');
        $query -> execute([$idUser]);
    }

    function deleteOneProduct ($idUser, $idOfSpecificProduct) {
        $pdo = connection();
        $query = $pdo -> prepare('delete from users_products where user_id = ? and id = ?');
        $query -> execute([$idUser, $idOfSpecificProduct]);
    }

    function updateUser ($userId, $login, $mobile, $password2, $file_url) {
        $password2 = password_hash($password2, PASSWORD_BCRYPT);
        $pdo = connection();
        $query = $pdo -> prepare('update users set (login, mobile, password, image) = (?, ?, ?, ?) where id = ?');
        try {
            $query -> execute([$login, $mobile, $password2, $file_url, $userId]);
            return true;
        } catch (PDOException $exception) {
            throw new InvalidLoginException('invalid login');
        }
    }

    function deleteUser ($idUser) {
        $pdo = connection();
        $query = $pdo -> prepare('update users set active = false where id = ?');
        $query -> execute([$idUser]);
    }

    function uploadReview ($firstName, $lastName, $countOfActiveStars, $comment, $imageOfAnUnathorizedUser) {
        $pdo = connection();
        $query = $pdo -> prepare('insert into userReviews (name, surname, siteRating, userReview, image) values (?, ?, ?, ?, ?)');
        $query -> execute([$firstName, $lastName, $countOfActiveStars, $comment, $imageOfAnUnathorizedUser]);
    }

    function uploadReview2 ($userId, $firstName, $lastName, $countOfActiveStars, $comment, $userImage) {
        $pdo = connection();
        $query = $pdo -> prepare('insert into userReviews (id_user, name, surname, siteRating, userReview, image) values (?, ?, ?, ?, ?, ?)');
        $query -> execute([$userId, $firstName, $lastName, $countOfActiveStars, $comment, $userImage]);
    }

    function getAllReviews () {
        $pdo = connection();
        $query = $pdo -> prepare('select * from userReviews');
        $query -> execute();
        $allReviews = $query -> fetchAll();
        return json_encode($allReviews);
    }

    function checkCoupon ($coupon) {
        $pdo = connection();
        $query = $pdo -> prepare('select * from coupons where coupon = ?');
        $query -> execute([$coupon]);
        $allReviews = $query -> fetchAll();
        return json_encode($allReviews);
    }

    function getAllStates () {
        $pdo = connection();
        $query = $pdo -> prepare('select * from states');
        $query -> execute();
        $allStates = $query -> fetchAll();
        return json_encode($allStates);
    }

    function getAllCities ($state) {
        $pdo = connection();
        $query = $pdo -> prepare('select cities.city
                from cities
                left join states s on cities.id_state = s.id
                where s.state = ?');
        $query -> execute([$state]);
        $allCities = $query -> fetchAll();
        return json_encode($allCities);
    }

    function getAllUsers () {       //под вопросом
        $pdo = connection();
        $query = $pdo -> prepare('select * from users');
        $query -> execute();
        $allUsers = $query -> fetchAll();
        return json_encode($allUsers);
    }

    function getAllEmails () {
        $pdo = connection();
        $query = $pdo -> prepare('select login from users');
        $query -> execute();
        $allEmails = $query -> fetchAll();
        return $allEmails;
    }

    function addCouponToUser ($idUser, $idCoupon) {
        $pdo = connection();
        $query = $pdo -> prepare('insert into userCoupons (user_id, coupon_id) VALUES (?, ?)');
        $query -> execute([$idUser, $idCoupon]);
    }

    function getUserCoupon ($idUser) {
        $pdo = connection();
        $query = $pdo -> prepare('select * from usercoupons
                    left join coupons c on userCoupons.coupon_id = c.id
                    where user_id = ?');
        $query -> execute([$idUser]);
        $result = $query -> fetchAll();
        return $result;
    }

    function addUuidPathToProduct ($uuid, $productId) {
        $pdo = connection();
        $query = $pdo -> prepare('update products set singleView = ? where id = ?');
        $query -> execute([$uuid, $productId]);
    }

    function deleteCoupon ($userId) {
        $pdo = connection();
        $query = $pdo -> prepare('delete from userCoupons where user_id = ?');
        $query -> execute([$userId]);
    }

    function findCountOfProduct ($singleProductPath, $productColor, $productSize) {
        $pdo = connection();
        $query = $pdo -> prepare('select count from users_products where singleView = ?
                        and color = ? and size = ?');
        $query -> execute([$singleProductPath, $productColor, $productSize]);
        $product = $query -> fetch();
        return $product;
    }

    function increaseProductCounterBy1($countFromFront, $countFromBack, $singleProductPath, $productColor, $productSize) {
        $pdo = connection();
        $query = $pdo -> prepare("update users_products set count = ${countFromFront} + ${countFromBack} 
                where singleView = ? and color = ? and size = ?");
        $query -> execute([$singleProductPath, $productColor, $productSize]);
    }

    function findIdenticalProduct ($idProduct, $productColor, $productSize, $productSingleView) {
        $pdo = connection();
        $query = $pdo -> prepare("select * from users_products where product_id = ? 
                            and singleView = ? and color = ? and size = ?");
        $query -> execute([$idProduct, $productSingleView, $productColor, $productSize]);
        $allProducts = $query -> fetchAll();
        return json_encode($allProducts);
    }

    function findAdminInfo () {
        $pdo = connection();
        $query = $pdo -> prepare("select * from admins");
        $query -> execute();
        $adminInfo = $query -> fetch();
        return json_encode($adminInfo);
    }

    function provideInfoAboutOrderToAdmins ($countOfProducts, $totalPrice, $deliveryAddress, $postCode, $deliveryMethod, $recipientName, $recipientSurname, $paymentMethod, $userMobile) {
        $pdo = connection();
        $query = $pdo -> prepare("insert into admin_work (countOfProducts, totalPrice, deliveryAddress, postCode, deliveryMethod, recipientName, recipientSurname, paymentMethod, userMobile) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $query -> execute([$countOfProducts, $totalPrice, $deliveryAddress, $postCode, $deliveryMethod, $recipientName, $recipientSurname, $paymentMethod, $userMobile]);
    }

    function getAllInfoAboutTheOrderFromAdminTable () {
        $pdo = connection();
        $query = $pdo -> prepare("select * from admin_work");
        $query -> execute();
        $usersOrders = $query -> fetchAll();
        return $usersOrders;
    }

    function changeStatus($newStatusOfTheOrder, $orderId) {
        $pdo = connection();
        $query = $pdo -> prepare("update admin_work set status = ? where id = ?");
        $query -> execute([$newStatusOfTheOrder, $orderId]);
    }

    function currentTotalPrice ($userId) {
        $pdo = connection();
        $query = $pdo -> prepare("select total_price from users_products where user_id = ?");
        $query -> execute([$userId]);
        $result = $query -> fetch();
        return $result;
    }

    function changeTotalPrice ($newTotalPrice, $userId) {
        $pdo = connection();
        $query = $pdo -> prepare("update users_products set total_price_with_discount = ? where user_id = ?");
        $query -> execute([$newTotalPrice, $userId]);
    }

    function returnTotalPriceOfProducts ($userId, $totalPrice) {
        $pdo = connection();
        $query = $pdo -> prepare("update users_products set total_price_with_discount = ? where user_id = ?");
        $query -> execute([$totalPrice, $userId]);
    }

    function getTotalPrice ($userId) {
        $pdo = connection();
        $query = $pdo -> prepare("select total_price from users_products where user_id = ?");
        $query -> execute([$userId]);
        $result = $query -> fetch();
        return $result;
    }

    function deleteOrder ($orderId) {
        $pdo = connection();
        $query = $pdo -> prepare("delete from admin_work where id = ?");
        $query -> execute([$orderId]);
    }

}
