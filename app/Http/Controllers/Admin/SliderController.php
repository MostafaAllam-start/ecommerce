<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    public function uploadImages(){
        return view('admin.sliders.create');
    }

    public function saveImages(Request $request){
        $file = $request->file('dzfile');
        $filename = saveFile($file, 'sliders');
        return response()->json([
            'name' => $filename,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }
    public function storeImages(Request $request)
    {
        try {
            // delete old sliders
            $sliders = Slider::all();
            foreach($sliders as $slider){
                $image = STR::after($slider->image, 'sliders');
                deleteFile($image, 'sliders');
                $slider->delete();
            }
            // save dropzone images
            if ($request->has('document') && count($request->document) > 0) {
                foreach ($request->document as $image) {
                    Slider::create([
                        'image' => $image,
                    ]);
                }
            }
            return redirect()->route('admin.sliders')->with(['success' => 'تم التحديث بنجاح']);

        }catch(\Exception $ex){
            //delete the uploaded images
            if ($request->has('document') && count($request->document) > 0) {
                foreach ($request->document as $image) {
                    if($request->has('name') &&fileExists($request->name, 'sliders'))
                        deleteFile($image, 'sliders');
                }
            }
            return redirect()->back()->with('error', 'An error occurred while uploading images');
        }
    }
    public function deleteImage(Request $request){
        if($request->has('name') &&fileExists($request->name, 'sliders'))
            deleteFile($request->name, 'sliders');
        return response()->json([
            'success' => true,
            'message' => 'the image was successfully deleted',
        ]);
    }
}
