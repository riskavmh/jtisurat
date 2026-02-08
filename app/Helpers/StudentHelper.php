<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class StudentHelper
{
    public static function getStudents(string $token, string $nim): ?array
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])
        ->withQueryParameters([
            'search' => $nim,
        ])
        ->get(config('app.super_app_url_internal') . '/students');

        if ($response->successful()) {
            $dataResponse = $response->json()['data'];

            if (!empty($dataResponse)) {
                $student = $dataResponse[0];
                return [
                    'id'           => $student['user_id'],
                    'name'         => $student['name'] ?? '-',
                    'studyprogram' => $student['study_program']['name'] ?? '-',
                    'phonenumber'  => $student['phone_number'] ?? '-'
                ];
            }
        }
        return null;
    }

    public static function getDetail(string $token, string $id): ?array
    {
        // dd($id);
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->withQueryParameters([
            'search' => $id,
        ])
        ->get(config('app.super_app_url_internal') . '/students');

        if ($response->successful()) {
            // dd( $response->json());
            $student = $response->json()['data'] ?? $response->json();

            if (!empty($student)) {
                return [
                    'nim'  => $student['student_detail']['nim'] ?? '-',
                    'name' => $student['name'] ?? '-',
                ];
                // dd($student);
            }
        }

        return null;
    }
}