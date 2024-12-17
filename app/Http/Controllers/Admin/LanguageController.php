<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LanguageRequest;
use App\Models\Language;
use Illuminate\Http\Request;

define('PAGINATION_COUNT', 10);
class LanguageController extends Controller
{
    public function index(){
        $languages = Language::selection()->paginate(PAGINATION_COUNT);
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
}
