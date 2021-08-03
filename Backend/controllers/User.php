<?php

namespace App\controllers;

use App\http\Auth;

use App\models\UserModel;

class User

{
    //=========register individual user======================
    public static function register($request,  $response)
    {
        $data = $request->getFormData();
        $imagename = $request->uplaodImages($data->image['image']);
        if (!is_array($imagename)) {
            $fields = $data->request;
            $id = UserModel::register($fields, $imagename);
            if ($id) {
                $user = (object)["id" => $id, "email" => $fields->email, "password" => $fields->password, "image" => $imagename];
                $token = Auth::authorization($user);
                $response->json(array(
                    "token" => $token
                ));
            } else {
                $response->json(array(
                    "error" => "can't create this account"
                ));
            }
        } else {
            $response->json($imagename);
        }
    }
    //=========login individual user ======================
    public static function login($request, $response)
    {
        $fields = $request->getJson();
        $row = UserModel::login($fields);
        if ($row) {
            $token = Auth::authorization($row);
            $response->json(array(
                "token" => $token,
                "user" => $row
            ));
        } else {
            $response->json(array(
                "user" => $row
            ));
        }
    }
    //=========update user profile ======================
    public static function update($request, $response)
    {
        if (Auth::gettoken()) {
            try {
                Auth::verification(Auth::gettoken());
            } catch (\Throwable $th) {
                $response->json("unauthorizedtoken");
            }
        } else {
            $response->json("unauthorized");
        }
        // $data = $request->getFormData();
        // $imagename = $request->uplaodImages($data->image['image']);
        // if (!is_array($imagename)) {
        //     $fields = $data->request;
        //     $updated = UserModel::update($fields, $imagename);
        //     if ($id) {
        //         $user = (object)["id" => $id, "email" => $fields->email, "password" => $fields->password, "image" => $imagename];
        //         $token = Auth::authorization($user);
        //         $response->json(array(
        //             "token" => $token
        //         ));
        //     } else {
        //         $response->json(array(
        //             "error" => "can't create this account"
        //         ));
        //     }
        // } else {
        //     $response->json($imagename);
        // }
    }
}
