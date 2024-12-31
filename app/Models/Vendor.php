<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Vendor extends Model
{
    use Notifiable;
    protected $table = 'vendors';
    protected $fillable = ['name', 'email','password', 'phone', 'address', 'logo', 'category_id', 'is_active'];
    protected $hidden = ['created_at', 'updated_at', 'category_id', 'password'];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function scopeActive($query){
        return $query->where('is_active', 1);
    }
    public function scopeSelection($query){
        return $query->select('id', 'name', 'email', 'phone', 'address', 'logo', 'category_id', 'is_active');
    }
    public function getLogoAttribute($val){
        return ($val !== null) ? getFilePublicURL($val, 'vendors'): "";
    }

    public function getActive(){
        return $this->is_active ? 'مفعل' : 'غير مفعل';
    }


}
