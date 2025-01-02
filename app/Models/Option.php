<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Option extends Model
{
     use HasFactory;
     use Translatable;
     protected $table = 'options';
     protected $fillable = ['price', 'product_id', 'attribute_id'];
     public $translatedAttributes = ['name'];
     protected $with = ['translations'];

     public function product() : BelongsTo
     {
         return $this->belongsTo(Product::class);
     }
     public function attribute(): BelongsTo
     {
         return $this->belongsTo(Attribute::class);
     }
}
