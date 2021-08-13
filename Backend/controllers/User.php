<?php

namespace App\controllers;

use App\http\Auth;
use App\http\Response;
use App\models\UserModel;

class User

{
    //=========register individual user======================
    public static function register($request,  $response)
    {
        $data = $request->getFormData();
        if ($data->image) {
            $imagename = $request->uplaodImages($data->image['image']);
            $fields = $data->request;
            if ($request->validate($fields, ["firstname", "lastname", "cin", "birth", "phone", "email", "password"])) {
                $sanitized = $request->ValueValidate($fields);
                if ($sanitized) {
                    if (!is_array($imagename)) {
                        $fields = $data->request;
                        $id = UserModel::register($fields, $imagename);
                        if ($id) {
                            $user = (object)["id" => $id, "user_firstname" => $fields->firstname, "user_lastname" => $fields->lastname, "user_cin" => $fields->cin, "user_birth" => $fields->birth, "user_phone" => $fields->phone, "user_email" => $fields->email, "user_image" => $imagename];
                            $token = Auth::authorization($user->id);
                            $response->json(array(
                                "token" => $token,
                                "user" => $user
                            ));
                        } else {
                            $response->json(array(
                                "error" => "can't create this account"
                            ));
                        }
                    } else {
                        $response->json($imagename);
                    }
                } else {
                    $response->json(array(
                        "error" => "can't create this account"
                    ));
                }
            } else {
                $response->json(array(
                    "error" => "can't create this account "
                ));
            }
        } else {
            $response->json(array(
                "error" => "can't create this account "
            ));
        }
    }
    //=========login individual user ======================
    public static function login($request, $response)
    {
        $fields = $request->getJson();
        $row = UserModel::login($fields);
        if ($row) {
            $token = Auth::authorization($row->user_id);
            $response->json(array(
                "token" => $token,
                "user" => $row,
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

                if ($data->image != []) {
                    $imagename = $request->uplaodImages($data->image['image']);
                } else {
                    $imagename = null;
                }

                $fields = $data->request;
                if ($request->validate($fields, ["firstname", "lastname", "cin", "birth", "phone", "email"])) {
                    $sanitized = $request->ValueValidate($fields);
                    if ($sanitized) {
                        if (!is_array($imagename)) {
                            $updated = UserModel::update($fields, $user->id, $imagename);
                            if ($updated) {
                                $response->json(array(
                                    "updated" => true
                                ));
                            } else {
                                $response->json(array(
                                    "error" => "can't update user information "
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
                        "error" => "can't update user information "
                    ));
                }
            } catch (\Throwable $th) {
                $response->json("unauthorizedtoken");
            }
        } else {
            $response->json("unauthorized");
        }
    }
    //=========user profile info ======================
    public static function info($request, $response)
    {
        if (Auth::gettoken()) {
            try {
                $id = Auth::verification(Auth::gettoken());
                $user = UserModel::info($id->id);
                if ($user) {
                    $response->json(
                        $user
                    );
                } else {
                    $response->json(array(
                        "error" => "can't get user information"
                    ));
                }
            } catch (\Throwable $th) {
                $response->json("unauthorizedtoken");
            }
        } else {
            $response->json("unauthorized");
        }
    }
}
