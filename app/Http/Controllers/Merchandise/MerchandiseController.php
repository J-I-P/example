<?php

namespace App\Http\Controllers\Merchandise;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\Merchandises;

class MerchandiseController extends Controller
{
    //
    public function merchandiseListPage(){
        echo("Hello~~~~merchandiselistpage!");
    }

    public function merchandiseManageListPage(){
        echo("merchandisemanagelistpage");
    }

    public function merchandiseCreateProcess(){
        $merchandise_data = [
            'status' => 'C',
            'name' => '',
            'name_en' => '',
            'introduction' => '',
            'introduction_en' => '',
            'photo' => null,
            'price' => 0,
            'remain_count' => 0
        ];
        $Merchandise = Merchandises::create($merchandise_data);
        return redirect('/merchandise/' . $Merchandise->id . '/edit');
    }

    public function merchandiseItemPage(){
        echo("merchandiseitempage");
    }

    public function merchandiseItemEditPage($merchandise_id){
        $Merchandise = Merchandises::findOrFail($merchandise_id);

        if (!is_null($Merchandise->photo)){
            $Merchandise->photo = url($Merchandise->photo);
        }

        $binding = [
            'title' => '編輯商品',
            'Merchandise' => $Merchandise
        ];

        return view('editMerchandise', $binding);
    }

    public function merchandiseItemUpdateProcess(){
        echo("merchandiseupdateprocess");
    }

    public function merchandiseItemBuyProcess(){
        echo("merchandiseitembuyprocess");
    }
}
