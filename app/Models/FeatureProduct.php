<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeatureProduct extends Model
{
    use HasFactory;

    protected $table = 'ps_feature_product';


    public function feature_lang()
    {
        return $this->hasOne(FeatureLang::class, 'id_feature', 'id_feature');
    }

    public function feature_value_lang()
    {
        return $this->hasOne(FeatureValueLang::class, 'id_feature_value', 'id_feature_value');
    }

}
