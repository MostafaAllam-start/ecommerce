<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends Controller
{
    public function index()
    {
        $sub_categories = Category::children()->get();
        return view('admin.subcategories.index', compact('sub_categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.subcategories.create', compact('categories'));
    }

    public function store(SubCategoryRequest $request)
    {
        $validated = $request->validated();
        try
        {
            DB::beginTransaction();
            $sub_category = Category::create(Arr::only($validated,['slug', 'is_active']));
            $sub_category-> parent_id = $validated['parent_id'];
            $sub_category->name = $validated['name'];
            $sub_category->save();
            DB::commit();
            return redirect()->route('admin.sub_categories')->with(['success' => 'تم إضافة القسم بنجاح']);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'حدث خطأ حاول مرة أخري']);
        }
    }

    public function edit($id)
    {
        $sub_category = Category::findOrFail($id);
        $categories = Category::all();
        return view('admin.subcategories.edit', compact('sub_category', 'categories'));
    }

    public function update(SubCategoryRequest $request, $id)
    {
        $sub_category = Category::findOrFail($id);
        $validated = $request->validated();
        try
        {
            DB::beginTransaction();
            $sub_category->name = $validated['name'];
            $sub_category->parent_id = $validated['parent_id'];
            $sub_category->slug = $validated['slug'];
            $sub_category->is_active = $validated['is_active'];
            $sub_category->save();
            DB::commit();
            return redirect()->route('admin.sub_categories')->with(['success'=>'تم التعديل بنجاح']);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'حدث خطأ حاول مرة أخري']);
        }
    }

    public function delete($id)
    {
        try{
            Category::findOrFail($id)->delete();
            return redirect()->route('admin.sub_categories')->with(['success'=>'تم الحذف بنجاح']);
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with(['error' => 'حدث خطأ حاول مرة أخري']);
        }
    }

    public function changeStatus($id)
    {
        try{
            $sub_category = Category::findOrFail($id);
            $sub_category->update(['is_active' => !$sub_category->is_active]);
            return redirect()->route('admin.sub_categories')->with(['success'=>'تم تغيير الحالة بنجاح']);
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with(['error' => 'حدث خطأ حاول مرة أخري']);
        }
    }
}
