<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\MenuItem;

class MenuItemController extends Controller
{
    public function create(Request $request,$menu_id){
        $menu = Menu::find($menu_id);
        $menu->menuItems()->create([
            'name'  =>  $request->name
        ]);

        return response()->json(['message'=>'menu item created'],200);
    }

    public function update(Request $request,$menu_id,$id){
        $menuItem = MenuItem::find($id);
        $menuItem->update([
            'name'  =>  $request->name
        ]);
        return response()->json(['message'=>'menu item updated'],200);
    }

    public function delete($menu_id,$id){
        $menuItem = MenuItem::find($id);
        $menuItem->delete();
        return response()->json(['message'=>'menu item deleted'],200);
    }
}
