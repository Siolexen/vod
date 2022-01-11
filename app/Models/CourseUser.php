<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseUser extends Model
{
    use HasFactory;


    protected $fillable = ['customer_id', 'course_id', 'order_id', 'status', 'start', 'end'];
    public function course()
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }
}
