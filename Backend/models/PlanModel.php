<?php

namespace App\models;

use App\core\Database;
use Exception;

class PlanModel
{
    public static function create($fields)
    {
        try {
            $row = Database::query("INSERT INTO `plans` (`title`,`description`,`duration`,`price`,`balance`,`buiss_id`) VALUES ('$fields->title','$fields->description',$fields->duration,$fields->price,$fields->balance,$fields->buiss_id) ")->execute();
        } catch (\Throwable $th) {
            return false;
        }
        return $row;
    }
    public static function reserve($fields)
    {
        try {
            $row = Database::query("INSERT INTO `subscriptions` (`user_id`,`plan_id`,`balance`) VALUES ($fields->user_id,$fields->plan_id,$fields->balance) ")->execute();
        } catch (\Throwable $th) {
            return false;
        }
        return $row;
    }
    public static function stats($id)
    {

        try {
            $row = Database::query("SELECT SUM(CASE WHEN plan_status=1 THEN 1 ELSE 0 END) progress, SUM(CASE WHEN plan_status=0 THEN 1 ELSE 0 END) expired FROM subscriptions WHERE user_id=$id")->getSingleResult();
        } catch (\Throwable $th) {
            return false;
        }
        return $row;
    }
    public static function myplans($id)
    {
        try {
            $row = Database::query("SELECT p.plan_id,p.duration,p.title,s.created_at,p.description,p.price,cast((s.balance*100/p.balance) as int) progress,CASE WHEN TIMESTAMPDIFF(DAY,CURRENT_TIMESTAMP,(DATE_ADD(p.created_at, INTERVAL p.duration DAY)))<0 THEN 0 ELSE TIMESTAMPDIFF(DAY,CURRENT_TIMESTAMP,(DATE_ADD(p.created_at, INTERVAL p.duration DAY))) END AS daysleft ,s.plan_status FROM `subscriptions` s ,`plans` p WHERE s.plan_id=p.plan_id AND s.user_id=$id")->getResult();
        } catch (\Throwable $th) {
            return false;
        }
        return $row;
    }
}
