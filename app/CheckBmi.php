<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckBmi extends Model
{
    protected $table = 'check_bmi';
    protected $primarykey = 'id_check_bmi';
    protected $fillable = [
        'nama', 'berat_badan', 'tinggi_badan', 'umur', 'gender', 'id_kategori', 'id_user', 'jumlah_bmi'
    ];
    public $timestamps = false;
}
