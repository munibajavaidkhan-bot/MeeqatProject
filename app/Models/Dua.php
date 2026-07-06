<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Dua extends Model {
    protected $fillable = ['category_id', 'title_en', 'arabic_text', 'transliteration', 'translation_en', 'translation_ur', 'reference', 'is_featured', 'is_active'];
    
    public function category() {
        return $this->belongsTo(Category::class);
    }
}