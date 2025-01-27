<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RelatorioController extends Controller
{
    public function mediaIdadePorCurso()
    {
        $cursos = Enrollment::with(['student', 'discipline.course'])
            ->get()
            ->groupBy('discipline.course.id')
            ->map(function ($enrollments, $courseId) {
                $courseTitle = $enrollments->first()->discipline->course->title;
                $idades = $enrollments->map(function ($enrollment) {
                    return Carbon::parse($enrollment->student->date_birth)->age;
                });

                return [
                    'course_id' => $courseId,
                    'course_title' => $courseTitle,
                    'media_idade' => $idades->avg(),
                    'min_age' => $idades->min(),
                    'max_age' => $idades->max(),
                ];
            })
            ->values();

        return response()->json($cursos);
    }
}

