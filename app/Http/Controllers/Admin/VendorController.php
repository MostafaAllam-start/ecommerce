<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendorRequest;
use App\Models\Vendor;
use App\Notifications\NewVendorMailNotification;
use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendors = vendor::selection()->with('category')->paginate(env('PAGENATION_COUNT' , 10));
        return view('admin.vendors.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::selection()->parent()->get();
        return view('admin.vendors.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VendorRequest $request)
    {
        $validated_data =  $request->validated();
        try{
            // Saving the logo image
            if($request->hasFile('logo')){
                $logo_name = saveFile($validated_data['logo'], 'vendors');
                $validated_data['logo'] = $logo_name;
            }
            // Saving the vendor data
            $vendor = Vendor::create($validated_data);
            Notification::send($vendor, new NewVendorMailNotification($vendor));
            return redirect()->route('admin.vendors')->with(['success' => 'تم اضافة المتجر بنجاح.']);
        }
        catch(\Exception $ex){
            return redirect()->back()->withInput()->with(['error' => 'حدث خطأ اثناء اضافة البيانات حاول مرة اخري']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $vendor = Vendor::with('category')->findOrFail($id);
        $categories = Category::selection()->parent()->get();
        return view('admin.vendors.edit', compact('vendor'), compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VendorRequest $request, $id)
    {
        try {
            //get the updated vendor
            $vendor = Vendor::findOrFail($id);
            // validating data using request and getting the validated data as an array
            $validated_data =  $request->validated();
            // upload new logo if exists
            if(Arr::exists($validated_data, 'logo')){
                //delete the old logo
                $logo = Str::after($vendor->logo, 'vendors');
                if($vendor->logo && fileExists($logo, 'vendors')){

                    deleteFile($logo, 'vendors');
                }
                // upload the new logo
                $new_logo = saveFile($validated_data['logo'], 'vendors');
                $validated_data['logo'] = $new_logo;
            }
            // update password if exists
            if(Arr::exists($validated_data, 'name')){
                if($validated_data['password'] == null)
                {
                    unset($validated_data['password']);
                }
                else{
                    $validated_data['password'] = bcrypt($validated_data['password']);
                }
            }
            $vendor->update($validated_data);
            return redirect()->route('admin.vendors')->with(['success' => 'تم تعديل المتجر بنجاح.']);
        }
        catch (\Exception $ex){
            return redirect()->back()->withInput($request->validated())->with(['error'=>'حدث خطأ أثناء تسجيل البيانات حاول مرة اخري.']);
        }
      }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        //get the element
        $vendor = Vendor::findOrFail($id);
        //remove the logo from the storage
        $logo = Str::after($vendor->logo, 'vendors');
        if($vendor->logo && fileExists($logo, 'vendors'))
            deleteFile($logo, 'vendors');
        $vendor->delete();
        return redirect()->route('admin.vendors')->with(['success' => 'تم حذف المتجر بنجاح']);

    }
    public function changeStatus($id){
        try{
            $vendor = Vendor::find($id);
            $success_message = changeStatus($vendor);
            return redirect()->route('admin.vendors')->with(['success' => $success_message]);
        }
        catch(\Exception $ex){
            return redirect()->back()->with(['error'=> 'حدث خطأ حاول مرة أخري.']);
        }
    }
}
