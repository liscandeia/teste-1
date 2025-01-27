<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Course::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'title' => 'required|max:255|',
            'body' => 'required',
            'date_start' => 'required|date',
            'date_end' => 'required|date|after_or_equal:dataInicio',

        ]);
        $course = Course::create($fields);
        return $course;
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return $course;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $fields = $request->validate([
            'title' => 'required|max:255|',
            'body' => 'required',
            'date_start' => 'required|date',
            'date_end' => 'required|date|after_or_equal:dataInicio',

        ]);
        $course -> update($fields);
        return $course;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return ['message'=> 'O curso foi excluido'];
    }
}
