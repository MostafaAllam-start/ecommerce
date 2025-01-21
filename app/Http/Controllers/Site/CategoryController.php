<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function productsBySlug($slug)
    {
        $category = Category::where('slug', $slug)
            ->with([
                'products',
                'products.images' => fn($q) => $q->select('image', 'product_id'),
                'products.tags'
            ])
            ->firstOrFail();
        return view('front.products', compact('category'));
    }
}
