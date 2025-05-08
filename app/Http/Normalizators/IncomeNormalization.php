<?php
    namespace App\Http\Normalizators;

    class IncomeNormalization extends Normalization{
        
        public static function normalize($request){
        }

        public static function beautify_datetime($income){
            $income->date = parent::beautify_dateTime($income->date);
            return $income;
        }
    
    }
?>