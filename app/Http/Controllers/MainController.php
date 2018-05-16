<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BindingService;


class MainController extends Controller
{
    function index(){
        $binding = BindingService::binding();
        return view('index',$binding);
    }
}
