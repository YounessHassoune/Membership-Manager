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
                $user = Auth::verification(Auth::gettoken());
                $data = $request->getFormData();
                $imagename = $request->uplaodImages($data->image['image']);
                $fields = $data->request;

                if ($request->validate($fields, ["firstname", "lastname", "cin", "birth", "phone", "email", "password"])) {
                    $sanitized = $request->ValueValidate($fields);
                    if ($sanitized) {
                        if (!is_array($imagename)) {
                            $updated = UserModel::update($fields, $user->user->user_id, $imagename);
                            if ($updated) {
                                $response->json(array(
                                    "updated" => true
                                ));
                            } else {
                                $response->json(array(
                                    "error" => "can't update user information"
                                ));
                            }
                        } else {
                            $response->json($imagename);
                        }
                    } else {
                        $response->json(array(
                            "error" => "empty values"
                        ));
                    }
                } else {
                    $response->json(array(
                        "error" => "can't update user information"
                    ));
                }
            } catch (\Throwable $th) {
                $response->json("unauthorizedtoken");
            }
        } else {
            $response->json("unauthorized");
        }
    }

    public static function test($request, $response)

    {
        $fields = $request->getJson();
        if ($request->validate($fields, ["firstname", "lastname", "cin", "birth", "phone", "email", "password"])) {
            $sanitized = $request->ValueValidate($fields);
            if ($sanitized) {
                $response->json($sanitized);
            } else {
                $response->json("empty values");
            }
        } else {
            $response->json("non validate");
        }
    }
}
