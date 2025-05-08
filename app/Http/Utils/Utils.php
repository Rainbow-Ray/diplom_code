<?php
    namespace App\Http\Utils;

use DateInterval;
use DateTime;
use DateTimeZone;

    class Utils {
        
        public static function skillsToArray($skills){
            $arr = [];
            foreach($skills as $i){
                $arr[] = $i->id;
            }
            return $arr;
        }

        public static function itemsToArray($items){
            $arr = [];
            foreach($items as $i){
                $arr[$i->get_id_with_prefix()] = [$i->count, $i->ei];
            }
            return $arr;
        }



        public static function timeNow(){
            return new DateTime('now', new DateTimeZone("Asia/Yekaterinburg"));    
        }
        
    }
?>