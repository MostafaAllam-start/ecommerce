<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OptionRequest;
use App\Models\Attribute;
use App\Models\Option;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OptionController extends Controller
{
    public function index()
    {
        $options = Option::paginate(env('PAGINATION_SIZE'));
        return view('admin.options.index', compact('options'));
    }
    public function create()
    {
        $products = Product::all();
        $attributes = Attribute::all();
        return view('admin.options.create', compact('products', 'attributes'));
    }
    public function store(OptionRequest $request)
    {
        $validated_data = $request->validated();
        try{
            DB::beginTransaction();
            $option = Option::create($validated_data);
            $option->name = $validated_data['name'];
            $option->save();
            DB::commit();
            return redirect()->route('admin.options')->with(['success' => 'تم الأضافة بنجاح']);
        }
        catch(\Exception $exception){
            DB::rollback();
            return redirect()->back()->with('error', 'حدث خطأ حاول مرة أخري');
        }
    }
    public function edit($id){
        $option = Option::findOrFail($id);
        $products = Product::all();
        $attributes = Attribute::all();
        return view('admin.options.edit', compact('option', 'products', 'attributes'));
    }
    public function update(OptionRequest $request, $id)
    {
        $validated_data = $request->validated();
        try{
            DB::beginTransaction();
            $option = Option::findOrFail($id);
            $option->update($validated_data);
            $option->name = $validated_data['name'];
            $option->save();
            DB::commit();
            return redirect()->route('admin.options')->with(['success' => 'تم التعديل بنجاح']);
        }
        catch(\Exception $exception){
            DB::rollback();
            return redirect()->back()->with(['error' => 'تم التعديل بنجاح']);
        }
    }
    public function delete($id){
        Option::findOrFail($id)->delete();
        return redirect()->route('admin.options')->with(['success' => 'تم الحذف بنجاح']);
    }
}
