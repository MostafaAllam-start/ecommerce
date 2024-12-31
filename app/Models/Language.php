<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'languages';
    protected $fillable = ['abbr', 'name','direction', 'is_active'];
    public $timestamps = true;

    public function scopeSelection($query){
        return $query->select('id', 'abbr', 'name', 'native', 'direction', 'is_active');
    }
    public function scopeActive($query){
        return $query->where('is_active', 1);
    }

    public function getActive(): string{
        return $this->is_active? 'مفعل' : 'غير مفعل';
    }
}
