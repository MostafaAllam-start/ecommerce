<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductReviewRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    public function details($slug)
    {
        $product = Product::where('slug', $slug)->with(['images', 'brand', 'categories', 'tags', 'attributes', 'reviews'])->firstOrFail();
        $related_products = Product::with('images', 'tags', 'brand', 'categories', 'attributes', 'reviews')
                                ->where('id', '!=', $product->id)
                                ->where(function ($query) use($product) {
                                    $query->where('brand_id', $product->brand_id)
                                        ->orWhereHas('categories', fn($query) => $query->whereIn('category_id', $product->categories->pluck('id')))
                                        ->orWhereHas('tags', fn($query) => $query->whereIn('tag_id', $product->tags->pluck('id')))
                                        ->orWhereHas('attributes', fn($query) => $query->whereIn('attribute_id', $product->attributes->pluck('id')));
                                })->get();
        return view('front.products-details', compact('product', 'related_products'));
    }

    public function storeReview(ProductReviewRequest $request)
    {
        $validated = $request->validated();
        $product = Product::findOrFail($validated['product_id']);
        if($product->reviews()->count() > 0)
            $product->reviews()->detach(Auth::user());
        $product->reviews()->attach(Auth::user(), [
                'rating' => $validated['rating'],
                'comment' => $validated['comment'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        return redirect()->back()->with(['success' => 'the review has been added successfully']);
    }
}
