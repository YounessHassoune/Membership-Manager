<?php

namespace App\models;

use App\core\Database;
use Exception;

class CompanyModel
{
    //=========register company user======================
    public static  function register($fields, $image)
    {

        try {
            $row = Database::query("SELECT * FROM `business` WHERE `email`= '$fields->email' ")->getSingleResult();
            if ($row) {
                return false;
            } else {
                $fields->password = PASSWORD_HASH($fields->password, PASSWORD_DEFAULT);
                Database::query("INSERT INTO `business` (`company_name`,`about`,`adresse`,`city`,`phone`,`email`,`password`,`image`) VALUES ('$fields->name','$fields->about','$fields->address','$fields->city','$fields->phone','$fields->email','$fields->password','$image')")->execute();
            }
        } catch (\Throwable $th) {
            return false;
        }
        return Database::lastID();
    }
    //========login company user==========================
    public static function login($fields)
    {
        $row = Database::query("SELECT * FROM `business` WHERE `email` = '$fields->email' ")->getSingleResult();
        if ($row) {
            if (password_verify($fields->password, $row->password)) {
                return  $row;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    //=========company profile info ======================
    public static function info($id)
    {
        $row = Database::query("SELECT * FROM `business` WHERE `company_id` = $id ")->getSingleResult();
        if ($row) {
            return  $row;
        } else {
            return false;
        }
    }
}
