<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttributeController extends Controller
{
    public function index()
    {
        $attributes = Attribute::paginate(env('PAGINATION_SIZE'));
        return view('admin.attributes.index', compact('attributes'));
    }
    public function create()
    {
        return view('admin.attributes.create');
    }
    public function store(AttributeRequest $request)
    {
        $validated_data = $request->validated();
        try{
            DB::beginTransaction();
            $attribute = new Attribute();
            $attribute->name = $validated_data['name'];
            $attribute->save();
            DB::commit();
            return redirect()->route('admin.attributes')->with(['success' => 'تم الأضافة بنجاح']);
        }
        catch(\Exception $exception){
            DB::rollback();
            return redirect()->back()->with('error', 'حدث خطأ حاول مرة أخري');
        }
    }
    public function edit($id){
        $attribute = Attribute::findOrFail($id);
        return view('admin.attributes.edit', compact('attribute'));
    }
    public function update(AttributeRequest $request, $id)
    {
        $validated_data = $request->validated();
        try{
            DB::beginTransaction();
            $attribute = Attribute::findOrFail($id);
            $attribute->name = $validated_data['name'];
            $attribute->save();
            DB::commit();
            return redirect()->route('admin.attributes')->with(['success' => 'تم التعديل بنجاح']);
        }
        catch(\Exception $exception){
            DB::rollback();
            return redirect()->back()->with(['error' => 'تم التعديل بنجاح']);
        }
    }
    public function delete($id){
        Attribute::findOrFail($id)->delete();
        return redirect()->route('admin.attributes')->with(['success' => 'تم الحذف بنجاح']);
    }
}
