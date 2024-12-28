<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoryRequest;
use App\Http\Requests\MainCategoryUpdateRequest;
use App\Models\MainCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MainCategoryController extends Controller
{
    use \App\Traits\FileUpload;


    public function index(){
        $main_categories = MainCategory::where('translation_of', null)->paginate(env('PAGINATION_COUNT'));
        return view('admin.maincategories.index', compact('main_categories'));
    }

    public function create(){
        return view('admin.maincategories.create');
    }

    public function store(MainCategoryRequest $request){
        if($request->hasFile('photo')){
            $photo_name = $this->uploadFile($request->photo, 'assets/images/maincategories/');
        }
        //as we store categories with different languages we have to pick the default language
        $default_lang =  get_default_language();
        $categories = collect($request->category);
        $default_category = $this->getDefaultCategory($categories, $default_lang, $photo_name);
        $default_category = MainCategory::create($default_category);
        //inserting other categories than the default
        $categoriesOtherThanDefault = $this->getCategoriesOtherThanDefault($categories, $default_category, $photo_name);
        MainCategory::insert($categoriesOtherThanDefault);
        return redirect()->route('admin.main_category')->with(['success'=>'تم اضافة التصنيف بنجاح.']);
    }
    public function edit($id){
        $main_category = MainCategory::with('translations')->findOrFail($id);
        return view('admin.maincategories.edit', compact('main_category'));
    }

    public function update(MainCategoryRequest $request, $id){
        $main_category = MainCategory::findOrFail($id);
        $photo_name = null;
        if($request->hasfile('photo'))
        {
            $photo_name = $this->uploadFile($request->photo, 'assets/images/maincategories/');
        }
        $category = $this->manipulateCategory($request->category[0], $main_category->translation_of, $photo_name);
        $main_category->update($category);
        return redirect()->route('admin.main_category')->with(['success'=>'تم تعديل التصنيف بنجاح']);
    }

    public function delete($id){
        $main_category = MainCategory::findOrFail($id);
        $count_categories_with_the_same_photo = MainCategory::where('photo', $main_category->photo)->count();
        if($main_category->photo && file_exists(public_path('assets/images/maincategories/'.$main_category->photo)) && ($count_categories_with_the_same_photo === 1 || $main_category->translation_of === null))
            unlink(public_path('assets/images/maincategories/'.$main_category->photo));
        $main_category->delete();
        return redirect()->route('admin.main_category')->with(['success'=>'تم حذف التصنيف بنجاح.']);
    }
    public function changeStatus($id){
        try{
            $main_category = MainCategory::find($id);
            $success_message = changeStatus($main_category);
            return redirect()->route('admin.main_category')->with(['success' => $success_message]);
        }
        catch(\Exception $ex){
            return redirect()->back()->with(['error'=> 'حدث خطأ حاول مرة أخري.']);
        }
    }



    private function getDefaultCategory($categories , $default_lang, $photo_name) : array{
        $default_category = $categories->filter(function ($category) use($default_lang) {
            return $category['abbr'] == $default_lang;
        })->values()[0];
        $default_category = $this->manipulateCategory($default_category, null, $photo_name);
        return $default_category;
    }

    private function getCategoriesOtherThanDefault($categories, $default_category, $photo_name){
        $otherCategories = $categories->filter(function ($category) use ($default_category) {
            return $category['abbr'] != $default_category['translation_lang'];
        })->values()->all();

        foreach($otherCategories as &$otherCategory){
            $otherCategory = $this->manipulateCategory($otherCategory, $default_category->id, $photo_name);
        }
        return $otherCategories;
    }

    private function manipulateCategory($category, $translation_of, $photo_name = null){
        if($photo_name !== null)
            $category['photo'] = $photo_name;
        $category['slug'] = slugify($category["name"]);
        $category['translation_of'] = $translation_of;
        $category['translation_lang'] = $category['abbr'];
        unset($category['abbr']);
        return $category;
    }

}
