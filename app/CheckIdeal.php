<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckIdeal extends Model
{
    protected $table = 'check_ideal';
    protected $primarykey = 'id_check_ideal';
    protected $fillable = [
        'nama', 'berat_badan', 'tinggi_badan', 'umur', 'gender', 'id_kategori'
    ];
    public $timestamps = false;
}
