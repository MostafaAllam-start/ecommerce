<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $sliders = Slider::get(['image']);
        $categories = Category::select('id', 'slug')->parent()->with(['_children' => function ($q){
            $q->select('id', 'parent_id', 'slug');
            $q->with(['_children' => function ($q){
                $q->select('id', 'parent_id', 'slug');
            }]);
        }])->get();
        return view('front.home', compact('categories', 'sliders'));
    }


}
