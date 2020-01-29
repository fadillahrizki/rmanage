<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MenuItem;
use App\Item;

class ItemController extends Controller
{

    public function create(Request $request,$menu_id,$menu_item_id){
        $menuItem = MenuItem::find($menu_item_id);
        $menuItem->items()->create([
            'name'  =>  $request->name
        ]);

        return response()->json(['message'=>'item created'],200);
    }

    public function update(Request $request,$menu_id,$menu_item_id,$id){
        $item = Item::find($id);
        $item->update([
            'name' => $request->name
        ]);

        return response()->json(['message'=>'item updated'],200);   
    }

    public function delete($menu_id,$menu_item_id,$id){
        $item = Item::find($id);
        $item->delete();

        return response()->json(['message'=>'item deleted'],200); 
    }
}
