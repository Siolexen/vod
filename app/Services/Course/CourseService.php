<?php

namespace App\Services\Course;

use App\Models\Course;
use App\Models\CourseUser;
use Illuminate\Support\Carbon;
use Log;

class CourseService
{
    public function checkCourse(array $courses){
        foreach ($courses as $course) {
            if($course['valid'] == 1){ // verification paid

                try {
                    if(!isset($course['associations']['order_rows']['order_row']['id'])){
                        if(isset($course['associations']) && isset($course['associations']['order_rows']) &&
                            isset($course['associations']['order_rows']['order_row'])){
                            foreach ($course['associations']['order_rows']['order_row'] as $product) {
                                $vodCourse = Course::where('product_id', $product['product_id'])->first();
                                $this->addCourse(
                                    auth()->user()->id_customer,
                                    $vodCourse->id,
                                    $course['id']);
                            }
                        }

                    }else{
                        $vodCourse = Course::where('product_id', $course['associations']['order_rows']['order_row']['product_id'])->first();
                        $this->addCourse(auth()->user()->id_customer, $vodCourse->id, $course['id']);
                    }

                }catch (\Exception $e){
                    Log::error($e);
                    //    dd($e,$course);
                }
            }
        }
    }

    public function addCourse($user_id, $course_id, $order_id) {
        CourseUser::firstOrCreate(
            [
                'customer_id' => $user_id,
                'course_id' => $course_id,
                'order_id' => $order_id,
            ],
            [
                'status' => 'active',
                'start' => Carbon::now(), // setting time
                'end' => Carbon::now()->addDays(30), // setting time,
            ],
        );
    }
}
