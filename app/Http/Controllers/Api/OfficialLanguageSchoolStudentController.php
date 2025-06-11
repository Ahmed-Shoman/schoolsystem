<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OfficialLanguageSchoolStudent;
use Illuminate\Http\Request;

class OfficialLanguageSchoolStudentController extends Controller
{
    public function index()
    {
        return response()->json(OfficialLanguageSchoolStudent::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'school_name' => 'required|string|max:255',
            'stage_data' => 'nullable|array',
            'stage_data.*.stage_name' => 'required|string',
            'stage_data.*.stage_year' => 'required|string',
            'stage_data.*.students_count' => 'nullable|integer',
            'stage_data.*.classrooms_count' => 'nullable|integer',
        ]);

        $record = OfficialLanguageSchoolStudent::create($validated);

        return response()->json($record, 201);
    }

    public function show($id)
    {
        $record = OfficialLanguageSchoolStudent::findOrFail($id);
        return response()->json($record);
    }

    public function update(Request $request, $id)
    {
        $record = OfficialLanguageSchoolStudent::findOrFail($id);

        $validated = $request->validate([
            'school_name' => 'sometimes|required|string|max:255',
            'stage_data' => 'nullable|array',
            'stage_data.*.stage_name' => 'required_with:stage_data|string',
            'stage_data.*.stage_year' => 'required_with:stage_data|string',
            'stage_data.*.students_count' => 'nullable|integer',
            'stage_data.*.classrooms_count' => 'nullable|integer',
        ]);

        $record->update($validated);

        return response()->json($record);
    }

    public function destroy($id)
    {
        $record = OfficialLanguageSchoolStudent::findOrFail($id);
        $record->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}