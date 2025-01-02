<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PriceRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\StockRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(){
            $products = Product::paginate(env('PAGINATION_SIZE'));
            return view('admin.products.general.index', compact('products'));
    }
    public function create(){
        $categories = Category::selection()->get();
        $tags = Tag::all();
        $brands = Brand::selection()->get();
        return view('admin.products.general.create', compact('categories', 'tags', 'brands'));
    }
    public function store(ProductRequest $request){
        $validated_data = $request->validated();
        try{
            DB::beginTransaction();
            $product = Product::create([
                'slug' => $validated_data['slug'],
                'is_active' => $validated_data['is_active'],
            ]);
            $product->categories()->toggle($validated_data['categories']);
            $product->tags()->toggle($validated_data['tags']);
            $product->name = $validated_data['name'];
            $product->description = $validated_data['description'];
            $product->short_description = $validated_data['short_description'];
            $product->is_active = $validated_data['is_active'];
            $product->save();
            DB::commit();
            return redirect()->route('admin.products')->with(['success' => 'تم إضافة المنتج بنجاح']);
        }
        catch(\Exception $exception){
            DB::rollback();
            return redirect()->back()->with('error', 'حدث خطأ حاول مرة أخري');
        }
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
    public function showPrice($id){
        $price = Product::getPrice();
        $id = Product::find($id)->id;
        return view('admin.products.prices.create', compact('price', 'id'));
    }
    public function storePrice(PriceRequest $request){
        $validated_data = $request->validated();
        try{
            DB::beginTransaction();
            $product = Product::find($validated_data['product_id']);
            $product->update(Arr::except($validated_data, ['product_id']));
            DB::Commit();
            return redirect()->route('admin.products')->with(['success' => 'تم إضافة السعر بنجاح']);
        }
        catch(\Exception $exception){
            DB::rollback();
            return redirect()->back()->with('error', 'حدث خطأ حاول مرة أخري');
        }
    }


    public function uploadImages($id){
        return view('admin.products.images.create', compact('id'));
    }

    public function saveImages(Request $request){
        $file = $request->file('dzfile');
        $filename = saveFile($file, 'products');
        return response()->json([
            'name' => $filename,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }
    public function storeImages(Request $request)
    {
        try {
            // save dropzone images
            if ($request->has('document') && count($request->document) > 0) {
                foreach ($request->document as $image) {
                    Image::create([
                        'product_id' => $request->product_id,
                        'image' => $image,
                    ]);
                }
            }

            return redirect()->route('admin.products')->with(['success' => 'تم التحديث بنجاح']);

        }catch(\Exception $ex){
            //delete the uploaded images
            if ($request->has('document') && count($request->document) > 0) {
                foreach ($request->document as $image) {
                    if($request->has('name') &&fileExists($request->name, 'products'))
                        deleteFile($image, 'products');
                }
            }
            return redirect()->back()->with('error', 'An error occurred while uploading images');
        }
    }
    public function deleteImage(Request $request){
        if($request->has('name') &&fileExists($request->name, 'products'))
            deleteFile($request->name, 'products');
        return response()->json([
            'success' => true,
            'message' => 'the image was successfully deleted',
        ]);
    }
    public function showStock($id){
        $product = Product::findOrFail($id);
        return view('admin.products.stock.create', compact('product'))->with('id', $id);
    }
    public function storeStock(StockRequest $request){
        $validated_data = $request->validated();
        try{
            $product = Product::findOrFail($validated_data['product_id']);
            $product->update(Arr::except($validated_data, ['product_id']));
            return redirect()->route('admin.products')->with('success', 'تم التعديل بنجاح');
        }
        catch(\Exception $exception){
            return redirect()->back()->with('error', 'حدث خطأ حاول مرة أخري');
        }
    }
}
