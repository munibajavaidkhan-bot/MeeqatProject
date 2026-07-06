<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Category extends Model {
    protected $fillable = ['name_en', 'name_ar', 'slug', 'icon', 'is_active'];
    
    public function duas() {
        return $this->hasMany(Dua::class);
    }
}