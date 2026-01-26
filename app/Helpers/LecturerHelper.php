<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LecturerHelper
{
    public static function getLecturer(string $token, ?string $position = null, ?string $majorId = null): ?array
    {
        $cacheKey = 'lecturer_' . md5($token . '_' . $position . $majorId);
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
                ->get(config('app.super_app_url_internal') . '/employees/options', [
                    'position' => $position,
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

        // $result = [
        //     'data' => collect($allData)
        //         ->pluck('label')
        //         ->sort()
        //         ->values()
        //         ->toArray(),
        // ];

        $result = [
                'data' => $allData,
        ];

        if (!empty($allData)) {
            Redis::setex($cacheKey, $ttl, json_encode($result));
        }

        // dd($result);
        return $result;
    }
}