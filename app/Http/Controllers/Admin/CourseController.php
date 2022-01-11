<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Resources\CourseCollection;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $limit      = $request->get('limit', 10);
        $status     = $request->get('status', 'all');
        $sortBy     = $request->get('sortBy', 'id');
        $orderBy    = $request->get('orderBy', 'desc');
        $search     = $request->get('search');

        $courses = Course::
        orderBy($sortBy, $orderBy)
        ->paginate($limit);

        if ($request->ajax()) {
            return json_encode(
                [
                    'courses' => new CourseCollection($courses),
                ]
            );
        }

        return view('admin.course.index', [
            'courses' => new CourseCollection($courses)
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $limit      = $request->get('limit', 10);
        $status     = $request->get('status', 'all');
        $sortBy     = $request->get('sortBy', 'id');
        $orderBy    = $request->get('orderBy', 'desc');
        $search     = $request->get('search');

        $course = Course::find($id);


        if ($request->ajax()) {
            return json_encode(
                [
                    'course' => new CourseResource($course),
                ]
            );
        }

        return view('admin.course.edit', [
            'course' => new CourseResource($course)
        ]);
    }
}
