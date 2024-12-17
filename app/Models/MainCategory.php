<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    protected $table = 'main_categories';
    protected $fillable = ['translation_lang', 'translation_of', 'name', 'slug', 'photo', 'active', 'created_at', 'updated_at'];
    public function scopeSelection($query){
        return $query->select('id', 'translation_lang', 'translation_of', 'name', 'slug', 'photo', 'active');
    }

    public function scopeDefaultCategory($query){
        return $query->where('translation_lang', get_default_language());
    }
    public function scopeActive($query){
        return $query->where('active', 1);
    }

    public function getActive():string {
        return $this->active? 'مفعل' : 'غير مفعل';
    }

    public function getSlug():string {
        $name = explode(' ', $this->name);
        return implode('-', $name);
    }



}
