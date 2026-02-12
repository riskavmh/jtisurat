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
    
    $auth   = collect(AuthHelper::getMe($dto->token)['data'])->toArray();
    $user->update([
      'identity_no' => !is_null($auth['student_detail']) ? $auth['student_detail']['nim'] : $auth['employee_detail']['nip'],
      'id_study_program' => !is_null($auth['student_detail']) ? $auth['student_detail']['m_study_program_id'] : $auth['employee_detail']['m_study_program_id'],
      'study_program_name' => !is_null($auth['student_detail']) ? $auth['student_detail']['study_program_name'] : $auth['employee_detail']['study_program_name'],
      'phone_number' => $auth['phone_number'] ?? null,
    ]);

    Auth::login($user);

    $roles = collect($data['data']['user']['roles']);
    $targetRoles = ['student', 'lecturer', 'technician'];

    if($roles->intersect($targetRoles)->isNotEmpty()){
        return redirect('/');
    }
    
    if ($roles->contains('admin')) {
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
