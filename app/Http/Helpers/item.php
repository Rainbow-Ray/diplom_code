<?php

namespace App\Http\Helpers;

use App\Models\Ei;

class Item
{
    const prefix = array(
        "other" => 'I',
        "material" => 'M',
        "equip" => 'F',
    );
    public $type;
    public $mat_id;
    public $equip_id;
    public $name;
    public $count;
    public $ei;
    public $eiName;
    public $itemQuantity;
    public $frontPrefId;
    public $frontValue;
    public $frontId;

    public function set_item_id($id_name)
    {
        if ($this->type == "other" || $this->type == "I") {
            $this->name = $id_name;
        } elseif ($this->type == "material" ||  $this->type == "M") {
            $this->mat_id = $id_name;
        } elseif ($this->type == "equip" ||  $this->type == "F") {
            $this->equip_id = $id_name;
        }
    }

    public static function create($req)
    {
        $item = new Item();
        $item->type = $req['type'];
        $item->frontId =  $req['id'];
        $item->name = $req['name'];

        if ($item->type == "other") {
            $item->name =  $req['name'];
            $item->frontPrefId = $item::prefix['other'] . $item->frontId;
            $item->frontValue = $item::prefix['other'] . $item->name;
        } elseif ($item->type == "material") {
            $item->mat_id = $req['id'];
            $item->frontPrefId = $item::prefix['material'] . $item->frontId;
            $item->frontValue = $item::prefix['material'] . $item->frontId;
        } elseif ($item->type == "equip") {
            $item->equip_id = $req['id'];
            $item->frontPrefId = $item::prefix['equip'] . $item->frontId;
            $item->frontValue = $item::prefix['equip'] . $item->frontId;
        }


        $item->count =  $req['count'];

        $item->ei =  $req['ei'];
        if ($item->ei != null || $item->ei != 'null' || $item->ei != '') {
            $item->eiName = Ei::findOrFail($item->ei)->name;
        }
        $item->itemQuantity = $item->count . "|" . $item->ei;


        return $item;
    }

    public function to_json()
    {
        return json_encode($this, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    }

    public static function getItems($request)
    {
        $items = [];
        for ($i = 0; $i < count($request['itemCheck']) - 1; $i += 2) {
            $itemType = $request['itemCheck'][$i][0];
            $id_name = substr($request['itemCheck'][$i], 1);
            $itemsCountPrice = explode('|', $request['itemCheck'][$i + 1]);

            $count = $itemsCountPrice[0];
            $ei = '';
            $price = '';

            if (count($itemsCountPrice) > 1) {
                $ei = $itemsCountPrice[1];
            }
            if (count($itemsCountPrice) > 2) {
                $price = $itemsCountPrice[2];
            }
            if ($ei == '' || $ei == 'null') {
                $ei = null;
            }
            if ($price == '' || $price == 'null') {
                $price = null;
            }

            $item = new item();
            $item->type = $itemType;
            $item->set_item_id($id_name);
            $item->count = $count;
            $item->ei = $ei;
            $items[] = $item;
        }
        return $items;
    }



    public function __construct() {}
}