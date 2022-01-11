<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeatureLang extends Model
{
    use HasFactory;

    protected $table = 'ps_feature_lang';


//    public function categories()
//    {
//        return $this->belongsToMany(Category::class, 'ps_category_product', 'id_product', 'id_category', 'id_product', 'id_category');
//    }
}
