<?php

namespace App\Http\Utils;

use DateInterval;
use DateTime;
use DateTimeZone;

class Utils
{

    public static function skillsToArray($skills)
    {
        $arr = [];
        if (!is_null($skills) && count($skills) > 0) {
            foreach ($skills as $i) {
                $arr[] = $i->id;
            }
        }
        return $arr;
    }

    public static function itemsToArray($items)
    {
        $arr = [];
        if (!is_null($items) && count($items) > 0) {
            foreach ($items as $i) {
                $arr[$i->get_id_with_prefix()] = [$i->count, $i->ei];
            }
        }
        return $arr;
    }



    public static function timeNow()
    {
        return new DateTime('now', new DateTimeZone("Asia/Yekaterinburg"));
    }
    public static function dateNow()
    {
        $date = new DateTime('now', new DateTimeZone("Asia/Yekaterinburg"));

        return $date->format('Y-m-d');
    }

    public static function dateSubMonth(int $monthCount)
    {
        $now = Utils::timeNow();
        $month = new DateInterval("P" . $monthCount . "M");
        $now_min_month = $now->sub($month);
        return $now_min_month;
    }

    public static function formatDate(DateTime $date, $format)
    {
        return $date->format($format);
    }

    public static function dateDifference($date1, $date2)
    {
        $date1 = new DateTime($date1);
        $date2 = new DateTime($date2);


        return $date2->diff($date1);
    }

    public static function formatDateFromStr($date, $format)
    {
        $date = new DateTime($date);
        return $date->format($format);
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
