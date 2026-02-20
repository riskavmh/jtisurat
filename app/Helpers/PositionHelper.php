<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class PositionHelper
{
    public static function getPositions(string $token, string $code): ?array
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])
        
        ->get(config('app.super_app_url_internal') . '/org-units');

        dd($response->json());

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

}