<?php
    namespace App\Http\Normalizators;

    class ReceiptNormalization extends Normalization{
        
        public static function normalize($request){
            $request['isUrgent'] = parent::normalize_checkbox($request['isUrgent']);
            $request['isPaid'] = parent::normalize_checkbox($request['isPaid']);
            $request['isHanded'] = parent::normalize_checkbox($request['isHanded']);
            return $request;
        }

        public static function beautify_dates($reciept){
            $reciept->dateIn = parent::beautify_date_from_str($reciept->dateIn);
            $reciept->datePlan =  parent::beautify_date_from_str($reciept->datePlan);
            $reciept->dateOut =  parent::beautify_date_from_str($reciept->dateOut);
            return $reciept;
        }
    
    }
?>