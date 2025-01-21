<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'sliders';
    protected $fillable = ['image', 'created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at'];
    protected $casts = [
        'image' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function getImageAttribute($value)
    {
        return $value ? getFilePublicURL($value, 'sliders') : null;
    }
}
