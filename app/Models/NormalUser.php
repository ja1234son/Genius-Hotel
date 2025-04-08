<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;


class NormalUser extends Model
{
    use HasFactory,HasRoles;

    protected $table = 'normal_user_tables';

    protected $fillable = ([
        'name',
        'first_name',
        'middle_name',
        'last_name',
        'phone_no',
        'gender',
        'email',
        'role',
        'password',
    ]);
}
