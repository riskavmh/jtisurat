<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class AuthHelper
{
    public static function getMe(string $token): ?array
    {
        $cacheKey = 'me_' . md5($token);
        $ttl = 300;

        $cached = Redis::get($cacheKey);
        if($cached) {
            return json_decode($cached, true);
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])
        ->get(config('app.super_app_url_internal'). '/auth/me');

        if ($response->failed()) {
            if($response->status() === 401) {
                Redis::del($cacheKey);
                Auth::logout();
                Session::invalidate();
            }
            return null;
        }

        $data = $response->json()['data'] ?? null;
        if($data) {
            Redis::setex($cacheKey, $ttl, json_encode($data));
        }

        return $data;
    }
}