<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckBmr extends Model
{
    protected $table = 'check_bmr';
    protected $primarykey = 'id_check_bmr';
    protected $fillable = [
        'nama', 'berat_badan', 'tinggi_badan', 'umur', 'gender', 'id_lvl_aktivitas', 'type_bmr', 'jumlah_bmr', 'kal_dibutuhkan'
    ];
    public $timestamps = false;
}
