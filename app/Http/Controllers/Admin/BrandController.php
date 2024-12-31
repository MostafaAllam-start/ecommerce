<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::selection()->Paginate(env('PAGINATION_SIZE'));
        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request)
    {
        try{
            DB::beginTransaction();
            $validated_data = $request->validated();
            //save the photo
            if(Arr::exists($validated_data, 'photo'))
            {
                $photo_name = saveFile($validated_data['photo'], 'brands');
                $validated_data['photo'] = $photo_name;
            }
            $brand = Brand::create($validated_data);

            //save the name
            $brand->name = $validated_data['name'];
            $brand->save();
            DB::commit();
            return redirect()->route('admin.brands')->with('success', 'تم إضافة الماركة بنجاح');
        }catch(\Exception $exception){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'حدث خطأ اثناء تخزين البيانات حاول مرة اخري']);
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try{
            DB::beginTransaction();
            $brand = Brand::find($id);
            if(!$brand)
                return redirect()->back()->with(['error' => 'هذه الماركة غير موجودة']);

            DB::commit();
            return view('admin.brands.edit', compact('brand'));

        }
        catch(\Exception $exception){
            DB::rollBack();
            return redirect()->route('admin.brands')->with('حدث خطأ أثناء التعديل حاول مرة أخري');
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, $id)
    {
        try{
            DB::beginTransaction();
            $brand = Brand::find($id);
            $validated_data = $request->validated();
            if(Arr::has($validated_data, 'photo')){
                $photo_name = saveFile($validated_data['photo'], 'brands');
                $validated_data['photo'] = $photo_name;
                //delete the old photo
                $photo = Str($brand->photo, 'brands');
                if(fileExists($photo, 'brands'))
                    deleteFile($photo, 'brands');
            }
            $brand->update($validated_data);

            //save name
            if(Arr::has($validated_data, 'name')){
                $brand->name = $validated_data['name'];
                $brand->save();
            }

            DB::commit();
            return redirect()->route('admin.brands')->with(['success' => 'تم تعديل الماركة بنجاح']);
        }
        catch(\Exception $exception){
            DB::rollBack();
            return redirect()->route('admin.brands')->with('error', 'حدث خطأ برجاء المحاولة مرة أخري');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        try{
            DB::beginTransaction();
            //get brand
            $brand = Brand::find($id);
            //delete photo
            $photo = Str::after($brand->photo, 'brand');
            if(fileExists($photo, 'brands'))
                deleteFile($photo, 'brand');
            $brand->delete();
            DB::commit();
            return redirect()->route('admin.brands')->with(['success'=>'تم حذف الماركة بنجاح']);
        }
        catch(\Exception $exception){
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'حدث خطأ أثناء الحذف برجاء المحاولة مرة أخري']);
        }
    }

    public function changeStatus($id)
    {
        try{
            $brand = Brand::find($id);
            if(!$brand)
                return redirect()->back()->with(['error' => 'هذه الماركة غير موجودة حاول مرة أخري']);
            $message = changeStatus($brand);
            return redirect()->route('admin.brands')->with('success', $message);
        }
        catch(\Exception $exception){
            return redirect()->route('admin.brands')->with('error', 'حدث خطأ حاول مرة أخري');
        }

    }
}
