<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $casts = [
        'data' => 'array'
    ];

    public function product()
    {
        return $this->HasOne(Product::class, 'id_product', 'product_id',);
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'id_product', 'product_id');
    }

    public function userCourse()
    {
        return $this->hasOne(CourseUser::class, 'course_id', 'id');
    }

    public function videos()
    {
        return $this->belongsToMany(Video::class, 'course_videos', 'course_id', 'video_id')
            ->withPivot('lesson', 'chapter')
            ->orderBy('course_videos.chapter')
            ->orderBy('course_videos.lesson')
            ;
    }
}
