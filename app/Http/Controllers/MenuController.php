<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use Auth;

class MenuController extends Controller
{
    public function create(Request $request){
        $user = Auth::user();
        $create = $user->menus()->create([
            'name'  =>  $request->name
        ]);
        
        return response()->json(['message'=>"create success"],200);
    }

    public function single($id){
        $menu = Menu::find($id);
        if($menu->user == Auth::user()){

            $menuItems = $menu->menuItems()->get();
            foreach($menuItems as $menuItem){
                $menuItem->items;
            }
            $data['menu'] = $menu;
            return view('menu.index',$data);
        }else{
            return redirect("/");
        }
    }

    public function get($id){
        $menu = Menu::find($id);
        $menuItems = $menu->menuItems()->get();
        foreach($menuItems as $menuItem){
            $menuItem->items;
        }
        return response()->json($menuItems,200);
    }

    public function update(Request $request,$id){
        $menu = Menu::find($id);
        $menu->update([
            'name'  =>  $request->name
        ]);
        return response()->json(['message'=>'menu updated'],200);
    }

    public function delete($id){
        $menu = Menu::find($id);
        $menu->delete();
        return response()->json(['message'=>'menu deleted'],200);
    }
}
