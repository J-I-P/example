<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ToDoController extends Controller
{
    function plus(){
        return view('plus');
    }
}
