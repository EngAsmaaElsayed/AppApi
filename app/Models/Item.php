<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_ar',
        'name_en',
        'logo',
        'web',
        'meta_description',
        'meta_keywords',
        'sub_category_id',
        'description_en',
        'description_ar',
    ];
    public function subCategory(){
        return $this->belongsTo(SubCategory::class);
    }
}
