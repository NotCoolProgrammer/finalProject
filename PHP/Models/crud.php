<?php

namespace theBrand;

use LengthException;

class CRUD {
    function createUser ($firstName, $lastName, $login, $mobile, $password, $file_url) {
        if (\mb_strlen($password) < 5) {
            throw new LengthException('invalid password');
        }

        $connectToDB = new WorkWithDB();
        $addUser = $connectToDB -> addUserToDB($firstName, $lastName, $login, $mobile, $password, $file_url);
        if ($addUser === true) {
            return true;
        }
    }

    function editUser ($userId, $login, $mobile, $password2, $file_url) {
        if (\mb_strlen($password2) < 5) {
            throw new LengthException('invalid password');
        }

        $connectToDB = new WorkWithDB();
        $updateUser = $connectToDB -> updateUser($userId, $login, $mobile, $password2, $file_url);
        if ($updateUser === true) {
            return true;
        }
    }
}