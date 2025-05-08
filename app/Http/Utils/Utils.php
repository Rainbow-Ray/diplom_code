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

        // UpdateItems, arrInter, itemsEqual - методы для редактирования строк закупки и запроса на закупку
        static function UpdateItems($oldItems, $newItems)
        {
            $arrDiff = Utils::arrInter($oldItems, $newItems);
            $oldKeysFound = $arrDiff[0];
            $newKeysFound = $arrDiff[1];
    
            $delete = array_diff_key($oldItems, $oldKeysFound);
            $add = array_diff_key($newItems, $newKeysFound);
    
            foreach ($delete as $i) {
                $i->delete();
            }
    
            foreach ($add as $i) {
                $i->save();
            }
        }
    

        static function arrInter($arr1, $arr2)
        {
            $inter = [];
            $newKeysFound = [];
            $oldKeysFound = [];
    
            foreach ($arr1 as $oldKey => $a) {
                // echo '  new old item <br>';
                foreach ($arr2 as $newKey => $b) {
                    if (!array_key_exists($newKey, $newKeysFound)) {
                        // echo '  new new item <br>';
                        if (Utils::itemsEqual($a, $b)) {
                            $inter[] = $a;
                            $newKeysFound[$newKey] = 1;
                            $oldKeysFound[$oldKey] = 1;
                            // echo '  found <br>';
                            break;
                        }
                    }
                }
            }
            return [$oldKeysFound, $newKeysFound];
        }


        static function itemsEqual($a, $b)
        {
            if (
                $a->name == $b->name
                &&
                $a->mat_id == $b->mat_id
                &&
                $a->equip_id == $b->equip_id
                &&
                $a->count == $b->count
                &&
                $a->ei_id == $b->ei_id
                &&
                $a->req_id == $b->req_id
            ) {
                return true;
            }
            return false;
        }
    
    
        
    }
?>