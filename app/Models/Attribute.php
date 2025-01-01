<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use Translatable;
    protected $table = 'attributes';
    public $translatedAttributes = ['name'];
    protected $with = ['translations'];


}
