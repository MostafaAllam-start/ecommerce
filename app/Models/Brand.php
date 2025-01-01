<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use translatable;

    protected $table = 'brands';
    protected $fillable = ['is_active', 'photo'];
    public $translatedAttributes = ['name'];


    protected function casts(){
        return [
            'is_active' => 'boolean',
        ];
    }

    public function getPhotoAttribute($value){
        return ($value !== null) ? getFilePublicURL($value, 'brands'): "";
    }
    public function scopeSelection($query){
        return $query->select('id', 'is_active', 'photo');
    }
    public function getActive(){
        return $this->is_active ? 'مفعل' : 'غير مفعل';
    }
    public function products(){
        return $this->hasMany(Product::class, 'brand_id', 'id');
    }

}
