<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\Product;
class ProductController extends Controller
{
    public function index(){
            $products = Product::paginate(env('PAGINATION_SIZE'));
            return view('admin.products.general.index', compact('products'));
    }
    public function create(){
        $categories = Category::selection();
        $tags = Tag::all();
        $brands = Brand::selection();
        return view('admin.products.general.create', compact('categories', 'tags', 'brands'));
    }
    public function store(Request $request){
        //
    }
    public function edit($id){
        //
    }
    public function update(Request $request, $id){
        //
    }
    public function delete($id){
        //
    }
    public function changeStatus(Request $request, $id){
        //
    }
}
