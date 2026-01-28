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
        $ttl = 300;

        $cached = Redis::get($cacheKey);
        if ($cached) {
            return json_decode($cached, true);
        }

        $response = Http::withoutVerifying()
            ->withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Accept'        => 'application/json',
            ])
            ->get(config('app.super_app_url_internal') . '/employees/options', [
                'position' => $position,
                'major_id' => $majorId,
            ]);

        if ($response->failed()) {
            if ($response->status() === 401) {
                Redis::del($cacheKey);
                Auth::logout();
                Session::invalidate();
            }
            return null;
        }

        $data = $response->json()['data'] ?? null;

        if ($data) {
            Redis::setex($cacheKey, $ttl, json_encode($data));
        }
        
        // dd($data);
        return $data;
    }
}