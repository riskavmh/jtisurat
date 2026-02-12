<?php

namespace App\Dto\Auth;

class UserLoginResponseDto
{
  public function __construct(
    public string $token,
    public UserLoginInfoDto $user,
  ) {}
}

class UserLoginInfoDto
{
  public function __construct(
    public string $id,
    public string $name,
    public string $email,
    public ?string $identity_no = null,
    public ?string $id_program_study = null,
    public ?string $study_program_name = null,
    public ?string $phone_number = null,
    public ?array $roles = null,
    public ?array $permissions = null,
  ) {}
}
