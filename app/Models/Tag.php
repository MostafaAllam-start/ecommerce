<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use Translatable;
    protected $with = ['translations'];
    protected $table = 'tags';
    protected $fillable = ['slug'];
    protected $hidden = ['translations'];
    public $translatedAttributes = ['name'];

    public function products(){
        return $this->morphedByMany(Product::class, 'taggable');
    }

}
