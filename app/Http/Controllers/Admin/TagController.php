<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    public function index(){
        $tags = Tag::paginate(10);
        return view('admin.tags.index', compact('tags'));
    }
    public function create(){
        return view('admin.tags.create');
    }
    public function store(TagRequest $request){
        $validated_data = $request->validated();
        try{
            DB::beginTransaction();
            $tag = Tag::create($validated_data);
            $tag->name = $validated_data['name'];
            $tag->save();
            DB::commit();
            return redirect()->route('admin.tags')->with(['success'=>'تم إضافة وسم بنجاح']);
        }
        catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()->withInput($validated_data)->with(['error' => 'حدث خطأ حاول مرة أخري']);
        }
    }
    public function edit($id){
        $tag = Tag::findOrFail($id);
        return view('admin.tags.edit', compact('tag'));
    }
    public function update(TagRequest $request, $id){
        $validated_data = $request->validated();
        try{
            DB::beginTransaction();
            $tag = Tag::find($id);
            $tag->update($validated_data);
            if(Arr::has($validated_data, 'name'))
                $tag->name = $validated_data['name'];
            $tag->save();
            DB::commit();
            return redirect()->route('admin.tags');
        }
        catch (\Exception $exception){
            return redirect()->back()->withInput($validated_data)->withErrors(['error' => 'حدث خطأ حاول مرة أخري']);
        }
    }
    public function delete($id){
        Tag::findOrFail($id)->delete();
        return redirect()->route('admin.tags');
    }
}
