<?php

namespace App\models;

use App\core\Database;
use Exception;

class UserModel
{
    //=========register individual user======================
    public static function register($fields, $image)
    {
        try {
            $row = Database::query("SELECT * FROM `users` WHERE `user_email`= '$fields->email' ")->getSingleResult();
            if ($row) {
                return false;
            } else {
                $fields->password = PASSWORD_HASH($fields->password, PASSWORD_DEFAULT);
                Database::query("INSERT INTO `users` (`user_firstname`,`user_lastname`,`user_cin`,`user_birth`,`user_phone`,`user_email`,`user_password`,`user_image`) VALUES ('$fields->firstname','$fields->lastname','$fields->cin','$fields->birth','$fields->phone','$fields->email','$fields->password','$image')")->execute();
            }
        } catch (\Throwable $th) {
            return false;
        }
        return Database::lastID();
    }
    //=========login individual user ======================
    public static function login($fields)
    {

        $row = Database::query("SELECT * FROM `users` WHERE `user_email` = '$fields->email' ")->getSingleResult();
        if ($row) {
            if (password_verify($fields->password, $row->user_password)) {
                return  $row;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    //=========update user profile ======================
    public static function update($fields, $id, $image)
    {
        if ($image) {
            $query = Database::query("UPDATE  `users` SET `user_firstname`='$fields->firstname',`user_lastname`='$fields->lastname',`user_cin`='$fields->cin',`user_birth`='$fields->birth',`user_phone`='$fields->phone',`user_email`='$fields->email',`user_image`='$image' WHERE `user_ID`= '$id' ")->execute();
            return  $query;
        } else {

            $query = Database::query("UPDATE  `users` SET `user_firstname`='$fields->firstname',`user_lastname`='$fields->lastname',`user_cin`='$fields->cin',`user_birth`='$fields->birth',`user_phone`='$fields->phone',`user_email`='$fields->email' WHERE `user_ID`= '$id' ")->execute();
            return  $query;
        }
    }
    //=========user profile info ======================
    public static function info($id)
    {
        $row = Database::query("SELECT * FROM `users` WHERE `user_id` = $id ")->getSingleResult();
        if ($row) {
            return  $row;
        } else {
            return false;
        }
    }
}
