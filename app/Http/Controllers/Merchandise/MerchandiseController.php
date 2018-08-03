<?php

namespace App\Http\Controllers\Merchandise;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MerchandiseController extends Controller
{
    //
    public function merchandiseListPage(){
        echo("merchandiselistpage");
    }

    public function merchandiseManageListPage(){
        echo("merchandisemanagelistpage");
    }

    public function merchandiseCreateProcess(){
        echo("merchandisecreateprocess");
    }

    public function merchandiseItemPage(){
        echo("merchandiseitempage");
    }

    public function merchandiseItemEditPage(){
        echo("merchandiseitemeditpage");
    }

    public function merchandiseItemUpdateProcess(){
        echo("merchandiseupdateprocess");
    }

    public function merchandiseItemBuyProcess(){
        echo("merchandiseitembuyprocess");
    }
}
