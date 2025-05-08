<?php
    namespace App\Http\Normalizators;

    class Normalization{
        public static function normalize_phone($phone){
            $phone = Normalization::check_phone($phone);
            return str_replace(['-', '(', ')'], '', $phone);
        }

        public static function check_phone($phone){
            if(str_starts_with($phone, "8(___)")){
                return '';
            }
            else{
                return $phone;
            }
        }

        public static function normalize_checkbox($check){
            if($check == "on")
                return 1;
            else return 0;
        }

        public static function beautify_date_from_str($date){
            return date_format(date_create($date), 'd.m.Y');
        }
        public static function beautify_date_from_date($date){
            return date_format($date, 'd.m.Y');
        }
    
        public static function beautify_dateTime($date){
            return date_format(date_create($date), 'd.m.Y H:m');
        }
    
    }
?>