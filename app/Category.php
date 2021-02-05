<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $primarykey = 'id_kategori';
    public $timestamps = false;

}
