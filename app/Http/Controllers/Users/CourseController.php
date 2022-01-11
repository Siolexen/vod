<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoriesResource;
use App\Http\Resources\CourseResource;
use App\Http\Resources\UserCourseResource;
use App\Models\Course;
use App\Models\CourseUser;
use App\Repositories\PrestashopRepositories;
use App\Services\Course\CourseService;
use Illuminate\Http\Request;
use Protechstudio\PrestashopWebService\PrestashopWebService;

class CourseController extends Controller
{

     /**
     * @var PrestashopRepositories
     */

    protected PrestashopRepositories $prestashopRepositories;

    public function __construct()
    {
        $this->middleware('auth');
        $this->prestashopRepositories = new PrestashopRepositories();
    }

    public function index(Request $request) {

        $courseService = new CourseService();
        $courseService->checkCourse($this->prestashopRepositories->getUserOrderId($this->prestashopRepositories->getUserOrders()));

        $userCourse = CourseUser::with('course', 'course.videos', 'course.images', 'course.product', 'course.product.categories')
            ->where('end', '>',now())
            ->where('status', 'active')
            ->where('customer_id', auth()->user()->id_customer)
            ->get();

        if ($request->ajax()) {
            return json_encode(
                [
                    'userCourse' => UserCourseResource::collection($userCourse),
                ]
            );
        }

        return view('users.course.index', [
            'courseUser' => UserCourseResource::collection($userCourse)
        ]);
    }

    public function show($course_id) {
        $userCourse = CourseUser::with('course', 'course.videos', 'course.product', 'course.product.categories')
            ->where('course_id', $course_id)
            ->where('end', '>',now())
            ->where('status', 'active')
            ->where('customer_id', auth()->user()->id_customer)
            ->first();

        if(!isset($userCourse->course)){
            return redirect()->back()->with('error', 'Brak dostepu');
        }
        $course = $userCourse->course;
//        dd($course->product->features()->feature_lang()->get());

        if (request()->ajax()) {
            return json_encode(
                [
                    'course' => new CourseResource($course),
                ]
            );
        }

        return view('users.course.show', [
            'courseId' => $course_id
        ]);
    }
}
