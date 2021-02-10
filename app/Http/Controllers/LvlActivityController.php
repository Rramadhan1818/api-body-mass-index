<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LvlActivityController extends Controller
{
    public function index()
    {
        $lvl_aktivitas = $cetegory = DB::table('lvl_aktivitas')
        ->get();
        return response([
            'success' => true,
            'message' => 'List Semua Hasil lvl aktivitas',
            'data' => $lvl_aktivitas
        ], 200);
    }

}
