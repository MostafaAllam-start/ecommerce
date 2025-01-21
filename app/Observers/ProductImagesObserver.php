<?php

namespace App\Observers;

use App\Models\ProductImage;
use Illuminate\Support\Str;

class ProductImagesObserver
{
    public function forceDeleted(ProductImage $productImage): void
    {
        deleteFile(Str::after($productImage, 'products/'), 'products');
    }
}
