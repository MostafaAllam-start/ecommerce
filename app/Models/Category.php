<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Translatable;
    protected $table = 'categories';
    protected $fillable = ['slug', 'is_active', 'created_at', 'updated_at'];

    /**
     *
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['translations'];


    public $translatedAttributes = ['name'];
    public function scopeSelection($query){
        return $query->select('id', 'slug', 'is_active');
    }
    protected function casts(){
        return [
            'is_active' => 'boolean',
        ];
    }


    public function scopeActive($query){
        return $query->where('is_active', 1);
    }
    public function scopeParent($query){
        return $query -> whereNull('parent_id');
    }
    public function scopeChild($query){
        return $query -> whereNotNull('parent_id');
    }
    public function getActive():string {
        return $this->is_active? 'مفعل' : 'غير مفعل';
    }
    public function _parent(){
        return $this->belongsTo(self::class, 'parent_id');
    }
}
