<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use Translatable,
        HasFactory;
    protected $table = 'categories';
    protected $fillable = ['slug', 'is_active', 'parent_id', 'created_at', 'updated_at'];

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
    public function scopeChildren($query){
        return $query -> whereNotNull('parent_id');
    }
    public function getActive():string {
        return $this->is_active? 'مفعل' : 'غير مفعل';
    }
    public function _parent(){
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function _children(){
        return $this->hasMany(self::class, 'parent_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'products_categories');
    }
}
