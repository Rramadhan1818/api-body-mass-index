<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model 
{
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
