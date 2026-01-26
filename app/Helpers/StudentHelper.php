<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class StudentHelper
{
    public static function getStudents(string $token, string $majorId): ?array
    {
        $cacheKey = 'students_' . md5($token . '_' . $majorId);
        $ttl = 300; // 5 menit

        $cached = Redis::get($cacheKey);
        if ($cached) {
            return json_decode($cached, true);
        }

        $allData = [];
        $page = 1;
        $perPage = 10;

        do {
            $response = Http::withoutVerifying()
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $token,
                    'Accept'        => 'application/json',
                ])
                ->get(config('app.super_app_url_internal') . '/students', [
                    'major_id' => $majorId,
                    'page'     => $page,
                    'per_page' => $perPage,
                ]);

            if ($response->failed()) {
                if ($response->status() === 401) {
                    Redis::del($cacheKey);
                    Auth::logout();
                    Session::invalidate();
                    Session::regenerateToken();
                }
                return null;
            }

            $data = $response->json('data') ?? [];
            $allData = array_merge($allData, $data);
            $page++;

        } while (count($data) === $perPage);

        $result = [
            'data' => $allData,
        ];

        if (!empty($allData)) {
            Redis::setex($cacheKey, $ttl, json_encode($result));
        }

        return $result;
        // dd($result);
    }
}