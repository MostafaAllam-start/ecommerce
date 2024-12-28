<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Vendor extends Model
{
    use Notifiable;
    protected $table = 'vendors';
    protected $fillable = ['name', 'email','password', 'phone', 'address', 'logo', 'category_id', 'active'];
    protected $hidden = ['created_at', 'updated_at', 'category_id', 'password'];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
    public function category(){
        return $this->belongsTo(MainCategory::class, 'category_id', 'id');
    }

    public function scopeActive($query){
        return $query->where('active', 1);
    }
    public function scopeSelection($query){
        return $query->select('id', 'name', 'email', 'phone', 'address', 'logo', 'category_id', 'active');
    }
    public function getLogo(){
        return asset('assets/images/vendors/logos/'.$this->logo);
    }

    public function getActive(){
        return $this->active ? 'مفعل' : 'غير مفعل';
    }


}
