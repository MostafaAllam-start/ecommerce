<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'languages';
    protected $fillable = ['abbr', 'name','direction', 'active'];
    public $timestamps = true;

    public function scopeSelection($query){
        return $query->select('id', 'abbr', 'name', 'native', 'direction', 'active');
    }
    public function scopeActive($query){
        return $query->where('active', 1);
    }

    public function getActive(): string{
        return $this->active? 'مفعل' : 'غير مفعل';
    }
}
