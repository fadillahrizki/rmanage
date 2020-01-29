<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use Auth;

class HomeController extends Controller
{
    public function index()
    {  
        $user = Auth::user();
        $menus = $user->menus;
        $data['menus'] = $menus;
        return view('home',$data);
    }

    public function get(){
        $user = Auth::user();
        $menus = $user->menus;
        return response()->json($menus,200);
    }
}
