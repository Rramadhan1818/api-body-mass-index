<?php

namespace App;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $primarykey = 'id';
    protected $fillable = [
        'id',
        'name',
        'email',
        'email_verified_at',
        'password',
        'api_token',
        'remember_token',
        'created_at',
        'updated_at',
    ];
    // public $timestamps = false;

}
