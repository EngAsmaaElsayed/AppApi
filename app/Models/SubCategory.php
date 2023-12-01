<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_ar',
        'name_en',
        'image',
        'icon',
        'meta_description',
        'meta_keywords',
        'category_id',
    ];
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function items(){
        return $this->hasMany(Item::class);
    }
}
