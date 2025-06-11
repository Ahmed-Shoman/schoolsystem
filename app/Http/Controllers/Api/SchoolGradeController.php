<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SchoolGrade;
use Illuminate\Http\Request;

class SchoolGradeController extends Controller
{
    public function index()
    {
        return response()->json(SchoolGrade::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'school_name' => 'required|string|max:255',
            'education_level' => 'required|string',
            'dependency' => 'required|string',
            'grades' => 'nullable|array',
            'grades.*.grade' => 'required|string',
            'grades.*.classrooms_count' => 'nullable|integer',
            'grades.*.boys_count' => 'nullable|integer',
            'grades.*.girls_count' => 'nullable|integer',
            'grades.*.total_in_directorate' => 'nullable|integer',
        ]);

        $grade = SchoolGrade::create($validated);

        return response()->json($grade, 201);
    }

    public function show($id)
    {
        $grade = SchoolGrade::findOrFail($id);
        return response()->json($grade);
    }

    public function update(Request $request, $id)
    {
        $grade = SchoolGrade::findOrFail($id);

        $validated = $request->validate([
            'school_name' => 'sometimes|required|string|max:255',
            'education_level' => 'sometimes|required|string',
            'dependency' => 'sometimes|required|string',
            'grades' => 'nullable|array',
            'grades.*.grade' => 'required_with:grades|string',
            'grades.*.classrooms_count' => 'nullable|integer',
            'grades.*.boys_count' => 'nullable|integer',
            'grades.*.girls_count' => 'nullable|integer',
            'grades.*.total_in_directorate' => 'nullable|integer',
        ]);

        $grade->update($validated);

        return response()->json($grade);
    }

    public function destroy($id)
    {
        $grade = SchoolGrade::findOrFail($id);
        $grade->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}