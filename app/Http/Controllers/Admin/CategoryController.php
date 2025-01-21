<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::paginate(env('PAGINATION_COUNT'));
        return view('admin.categories.index', compact('categories'));
    }

    public function create(){
        $categories = Category::selection()->get();
        return view('admin.categories.create', compact('categories'));
    }

    public function store(CategoryRequest $request){
        try{
            DB::beginTransaction();
            $validated_data = $request->validated();
            $category = Category::create($validated_data);
            if(Arr::has($validated_data, 'parent_id'))
                $category->parent_id = $validated_data['parent_id'];
            $category->name = $validated_data['name'];
            $category->save();
            DB::commit();
            return redirect()->route('admin.categories')->with(['success'=>'تم اضافة القسم بنجاح.']);
        }
        catch (\Exception $ex){
            DB::rollBack();
            return redirect()->back()->with(['error'=>'حدث خطأ حاول مرة أخري']);
        }

    }
    public function edit($id){
        $category = Category::findOrFail($id);
        $categories = Category::where('id', '!=', $id)->get();
        return view('admin.categories.edit', compact('categories', 'category'));
    }

    public function update(CategoryRequest $request, $id){
        try{
            DB::beginTransaction();
            $category = Category::findOrFail($id);
            $validated_data = $request->validated();
            if($validated_data['type'] == 1)
                $validated_data['parent_id'] = null;
            $category->update($validated_data);
            $category->name = $validated_data['name'];
            $category->save();
            DB::commit();
            return redirect()->route('admin.categories')->with(['success'=>'تم تعديل التصنيف بنجاح']);
        }
        catch(\Exception $ex){
            DB::rollback();
            return redirect()->back()->with(['error'=> 'حدث خطأ حاول مرة أخري']);
        }
    }

    public function delete($id){
        try{
            DB::beginTransaction();
            $category = Category::findOrFail($id);
            $category->delete();
            DB::commit();
            return redirect()->route('admin.categories')->with(['success'=>'تم حذف التصنيف بنجاح.']);
        }
        catch (\Exception $ex){
            DB::rollback();
            return redirect()->back()->with(['error' => 'حدث خطأ أثناء الحذف حاول مرة أخري']);
        }

    }
    public function changeStatus($id){
        try{
            $category = Category::find($id);
            $success_message = changeStatus($category);
            return redirect()->route('admin.categories')->with(['success' => $success_message]);
        }
        catch(\Exception $ex){
            return redirect()->back()->with(['error'=> 'حدث خطأ حاول مرة أخري.']);
        }
    }

}
