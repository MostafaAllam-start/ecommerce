<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';
    protected $fillable = ['product_id', 'image'];
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function getImageAttribute($value){
        return $value ? getFilePublicURL($value, 'products') : null;
    }
}
