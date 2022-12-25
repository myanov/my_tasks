<?php

namespace App\Modules\Admin\User\Models;

use App\Modules\Admin\Role\Models\Traits\UserRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as AuthUser;
use Laravel\Passport\HasApiTokens;

class User extends AuthUser
{
    use HasFactory, HasApiTokens, UserRoles;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'description',
        'company_id'
    ];

    protected $hidden = [
        'password'
    ];


}
