<?php

namespace App\Http\Controllers\Auth;

use App\Dto\Auth\UserLoginInfoDto;
use App\Dto\Auth\UserLoginResponseDto;
use App\Http\Controllers\Controller;
use App\Helpers\AuthHelper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class OAuthController extends Controller
{
  public function redirect()
  {
    return redirect(config('app.super_app_url') . '/oauth/authorize?client_id=' . env('OAUTH_CLIENT_ID') . '&redirect_uri=' . route('auth.callback') . '&response_type=code');
  }

  public function callback(Request $request)
  {
    $response = Http::asForm()->post(config('app.super_app_url_internal') . '/oauth/token', [
      'grant_type' => 'authorization_code',
      'client_id' => env('OAUTH_CLIENT_ID'),
      'client_secret' => env('OAUTH_CLIENT_SECRET'),
      'redirect_uri' => route('auth.callback'),
      'code' => $request->code,
    ]);

    if ($response->failed()) {
      return redirect()->route('login')->withErrors(['msg' => $response->json('message') ?? 'Login failed. Please try again.']);
    }

    $data = $response->json();

    $dto = new UserLoginResponseDto(
      token: $data['data']['token'],
      user: new UserLoginInfoDto(
        id: $data['data']['user']['id'],
        name: $data['data']['user']['name'],
        email: $data['data']['user']['email'],
        roles: $data['data']['user']['roles'] ?? null,
        permissions: $data['data']['user']['permissions'] ?? null,
      ),
    );
    // dd($dto);
    $user = User::updateOrCreate(
      ['external_id' => $dto->user->id],
      [
        'name' => $dto->user->name,
        'email' => $dto->user->email,
        'token' => $dto->token,
        'roles' => $dto->user->roles ? $dto->user->roles : null,
        'permissions' => $dto->user->permissions ? $dto->user->permissions : null,
      ]
    );
    
    $detail   = collect(AuthHelper::getMe($dto->token)['data'])->toArray();
    session(['user_api_data' => $detail]);
    $user->update([
      'identity_no' => ($detail['student_detail']['nim'] ?? null) ?: ($detail['employee_detail']['nip'] ?? null),
      'id_study_program' => ($detail['student_detail']['m_study_program_id'] ?? null) ?: ($detail['employee_detail']['m_study_program_id'] ?? null),
      'study_program_name' => ($detail['student_detail']['study_program_name'] ?? null) ?: ($detail['employee_detail']['study_program_name'] ?? null),
      'phone_number' => $detail['phone_number'] ?? null,
    ]);

    Auth::login($user);

    $roles = collect($data['data']['user']['roles']);
    $targetUser = ['student', 'lecturer', 'technician'];
    $targetAdmin = ['admin_jtisurat', 'superadmin_jtisurat'];

    if($roles->intersect($targetUser)->isNotEmpty()){
        return redirect('/');
    }
    
    if ($roles->intersect($targetAdmin)->isNotEmpty()) {
        return redirect('admin');
    }

    return redirect('/');
  }

  public function logout(Request $request)
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->away(config('app.super_app_url') . '/oauth/logout?redirect=' . route('/'));
  }
}
