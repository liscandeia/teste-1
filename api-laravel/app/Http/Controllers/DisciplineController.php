<?php

namespace App\Http\Controllers;
use App\Models\Discipline;
use Illuminate\Http\Request;

class DisciplineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $disciplines = Discipline::with(['course', 'teacher'])->get();
        return response()->json($disciplines);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'title' => 'required|max:255',
            'body' => 'nullable',
            'course_id' => 'required|exists:courses,id',
            'teacher_id' => 'required|exists:teachers,id'
        ]);
        $discipline = Discipline::create($fields);
        return $discipline;
    }

    /**
     * Display the specified resource.
     */
    public function show(Discipline $discipline)
    {
        return $discipline->load('course', 'teacher');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Discipline $discipline)
    {
        $fields = $request->validate([
            'title' => 'required|max:255',
            'body' => 'nullable',
            'course_id' => 'required|exists:courses,id',
            'teacher_id' => 'required|exists:teachers,id'
        ]);
        $discipline->update($fields);
        return $discipline;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Discipline $discipline)
    {
        $discipline->delete();
        return ["message:"=>"A disciplina foi excluida"];
    }
}
