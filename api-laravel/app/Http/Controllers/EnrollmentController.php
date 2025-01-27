<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Enrollment::with(['student', 'discipline'])->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'student_id' => 'required|exists:students,id',
            'discipline_id' => 'required|exists:disciplines,id',
        ]);

        // Verificar se o aluno já está matriculado na disciplina
        $existingEnrollment = Enrollment::where('student_id', $request->student_id)
            ->where('discipline_id', $request->discipline_id)
            ->first();

        if ($existingEnrollment) {
            return response()->json(['message' => 'Aluno já está matriculado nesta disciplina.'], 400);
        }

        $enrollment = Enrollment::create($fields);
        return $enrollment->load('student', 'discipline');
    }

    /**
     * Display the specified resource.
     */
    public function show(Enrollment $enrollment)
    {
        return $enrollment->load('student', 'discipline');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Enrollment $enrollment)
    {
        $fields = $request->validate([
            'student_id' => 'required|exists:students,id',
            'discipline_id' => 'required|exists:disciplines,id',
        ]);

        // Verificar se o aluno já está matriculado na disciplina
        $existingEnrollment = Enrollment::where('student_id', $request->student_id)
            ->where('discipline_id', $request->discipline_id)
            ->first();

        if ($existingEnrollment && $existingEnrollment->id !== $enrollment->id) {
            return response()->json(['message' => 'Aluno já está matriculado nesta disciplina.'], 400);
        }

        $enrollment->update($fields);
        return $enrollment->load('student', 'discipline');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();
        return ['message' => 'A matrícula foi excluída'];
    }
}
