<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use Translatable,
        HasFactory;
    protected $table = 'attributes';
    public $translatedAttributes = ['name'];
    protected $with = ['translations'];


}
