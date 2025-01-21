<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    public function index(){
        $products = Auth::user()->wishList()->with(['images', 'tags', 'categories', 'attributes'])->get();
        return view('front.wishlists', compact('products'));
    }
    public function toggle(Request $request)
    {
        if(!Auth::user()->wishListHas($request->product_id)){
            Auth::user()->wishList()->attach($request->product_id);
            return response()->json(['message' => 'WishList added successfully.','product_id'=>$request->product_id, 'status' => 201]);
        }
        Auth::user()->wishlist()->detach($request->product_id);
        return response()->json(['message' => 'Product removed from the wishlist.', 'product_id'=>$request->product_id ,'status' => 204 ]);
    }
    public function destroy(Request $request){
        Auth::user()->wishList()->detach($request->product_id);
        return response()->json(['message' => 'product removed from the wishlist.', 'product_id'=>$request->product_id, 'status'=>204]);
    }
}
