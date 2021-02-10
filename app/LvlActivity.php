<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LvlActivity extends Model
{
    protected $table = 'lvl_aktivitas';
    protected $primarykey = 'id_lvl_aktivitas';
    // protected $fillable = [

    // ];
    public $timestamps = false;
}
