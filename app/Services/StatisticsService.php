<?php

namespace App\Services;

use App\Models\SchoolGrade;
use App\Models\OfficialLanguageSchoolStudent;
use App\Models\SchoolStatistic;

class StatisticsService
{
    public static function generate(): void
    {
        SchoolStatistic::truncate();

        $stats = [];

        // من جدول school_grades
        $grades = SchoolGrade::all();
        foreach ($grades as $record) {
            foreach ($record->grades ?? [] as $item) {
                $key = $record->education_level . '|' . $item['grade'];

                if (!isset($stats[$key])) {
                    $stats[$key] = [
                        'stage_name' => $record->education_level,
                        'stage_year' => $item['grade'],
                        'schools_count' => 0,
                        'total_students' => 0,
                        'total_boys' => 0,
                        'total_girls' => 0,
                        'total_classrooms' => 0,
                    ];
                }

                $stats[$key]['schools_count'] += 1;
                $stats[$key]['total_boys'] += $item['boys_count'] ?? 0;
                $stats[$key]['total_girls'] += $item['girls_count'] ?? 0;
                $stats[$key]['total_students'] += ($item['boys_count'] ?? 0) + ($item['girls_count'] ?? 0);
                $stats[$key]['total_classrooms'] += $item['classrooms_count'] ?? 0;
            }
        }

        // من جدول official_language_school_students
        $students = OfficialLanguageSchoolStudent::all();
        foreach ($students as $record) {
            foreach ($record->stage_data ?? [] as $item) {
                $key = $item['stage_name'] . '|' . $item['stage_year'];

                if (!isset($stats[$key])) {
                    $stats[$key] = [
                        'stage_name' => $item['stage_name'],
                        'stage_year' => $item['stage_year'],
                        'schools_count' => 0,
                        'total_students' => 0,
                        'total_boys' => 0,
                        'total_girls' => 0,
                        'total_classrooms' => 0,
                    ];
                }

                $stats[$key]['schools_count'] += 1;
                $stats[$key]['total_students'] += $item['students_count'] ?? 0;
                $stats[$key]['total_classrooms'] += $item['classrooms_count'] ?? 0;
            }
        }

        // تخزين الإحصائيات
        foreach ($stats as $data) {
            SchoolStatistic::create($data);
        }
    }
}