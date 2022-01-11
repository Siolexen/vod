<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'ps_product';


    public function categories()
    {
        return $this->belongsToMany(Category::class, 'ps_category_product', 'id_product', 'id_category', 'id_product', 'id_category');
    }

    public function features()
    {
        return $this->hasMany(FeatureProduct::class, 'id_product', 'id_product');
    }
}
