<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageRequest;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function index(){
        $languages = Language::selection()->paginate(env('PAGINATION_SIZE'));
        return view('admin.languages.index', compact('languages'));
    }

    public function create(){
        return view('admin.languages.create');
    }

    public function store(LanguageRequest $request){
        Language::create($request->validated());
        return redirect()->route('admin.languages')->with(['success' => 'تم اضافة اللغة بنجاح.']);
    }

    public function edit($id){
        $language = Language::findOrFail($id);
        return view('admin.languages.edit', compact('language'));
    }

    public function update(LanguageRequest $request, $id){
        $language = Language::findOrFail($id);
        $language->update($request->validated());
        return redirect()->route('admin.languages')->with(['success' => 'تم تعديل اللغة بنجاح.']);
    }

    public function delete($id){
        $language = Language::findOrFail($id);
        $language->delete();
        return redirect()->route('admin.languages')->with(['success' => 'تم حذف اللغة بنجاح.']);
    }
    public function changeStatus($id){
        try{
            $language = Language::find($id);
            $success_message = changeStatus($language);
            return redirect()->route('admin.languages')->with(['success' => $success_message]);
        }
        catch(\Exception $ex){
            return redirect()->back()->with(['error'=> 'حدث خطأ حاول مرة أخري.']);
        }
    }
}
