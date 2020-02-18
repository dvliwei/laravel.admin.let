<?php
/**
 * Created by PhpStorm.
 * 文件描述
 * User: liwei
 * Date: 2019/10/31
 * Time: 21:32
 */

namespace App\Modules;
use Request;

abstract class BaseRepository{




    public function _input($str){
        $input = Request::All();
        $val = isset($input[$str]) ? $input[$str] : null;
        return $val;
    }

    abstract function saveAdBranch($ad_account_id=0,$ad_campaign_id=0,$ad_set_id=0,$ad_id=0,$date_at="",$hour="",$data=[]);


    public function getIp($adv=false){
        $type       =  0;
        static $ip  =   NULL;
        if ($ip !== NULL) return $ip[$type];
        if($adv){
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $arr    =   explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                $pos    =   array_search('unknown',$arr);
                if(false !== $pos) unset($arr[$pos]);
                $ip     =   trim($arr[0]);
            }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
                $ip     =   $_SERVER['HTTP_CLIENT_IP'];
            }elseif (isset($_SERVER['REMOTE_ADDR'])) {
                $ip     =   $_SERVER['REMOTE_ADDR'];
            }
        }elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip     =   $_SERVER['REMOTE_ADDR'];
        }
        // IP地址合法验证
        $long = sprintf("%u",ip2long($ip));
        $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
        return $ip[$type];
    }



    public  function getHour($hourly_stats){
        switch ($hourly_stats){
            case "01:00:00 - 01:59:59":
                return "01";
                break;
            case "02:00:00 - 02:59:59":
                return "02";
                break;
            case "03:00:00 - 03:59:59":
                return "03";
                break;
            case "04:00:00 - 04:59:59":
                return "04";
                break;
            case "05:00:00 - 05:59:59":
                return "05";
                break;
            case "06:00:00 - 06:59:59":
                return "06";
                break;
            case "07:00:00 - 07:59:59":
                return "07";
                break;
            case "08:00:00 - 08:59:59":
                return "08";
                break;
            case "09:00:00 - 09:59:59":
                return "09";
                break;
            case "10:00:00 - 10:59:59":
                return "10";
                break;
            case "11:00:00 - 11:59:59":
                return "11";
                break;
            case "12:00:00 - 12:59:59":
                return "12";
                break;
            case "13:00:00 - 13:59:59":
                return "13";
                break;
            case "14:00:00 - 14:59:59":
                return "14";
                break;
            case "15:00:00 - 15:59:59":
                return "15";
                break;
            case "16:00:00 - 16:59:59":
                return "16";
                break;
            case "17:00:00 - 17:59:59":
                return "17";
                break;
            case "18:00:00 - 18:59:59":
                return "18";
                break;
            case "19:00:00 - 19:59:59":
                return "19";
                break;
            case "20:00:00 - 20:59:59":
                return "20";
                break;
            case "21:00:00 - 21:59:59":
                return "21";
                break;
            case "22:00:00 - 22:59:59":
                return "22";
                break;
            case "23:00:00 - 23:59:59":
                return "23";
                break;
            default:
                return "00";
                break;
        }
    }
}