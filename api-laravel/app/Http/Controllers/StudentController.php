<?php

namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Student::query();
        if ($request->has('name')){ 
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        } 
        if ($request->has('email')) { 
            $query->where('email', 'like', '%' . $request->input('email') . '%'); 
        } 
        return $query->get();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:students,email',
            'date_birth' => 'nullable|date',
            'password'=>''
        ]);

        $student = Student::create($fields);
        return $student;
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return $student;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $fields = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'date_birth' => 'nullable|date'
        ]);
        $student->update($fields);
        return $student;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return['message'=>'O aluno foi excluído!'];  
    }
}
