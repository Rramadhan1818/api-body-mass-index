<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            $cetegory = DB::table('category')
            ->get();
            return response([
                'success' => true,
                'message' => 'List Semua Category',
                'data' => $cetegory
            ], 200);
        } catch (Throwable $e) {
            return response([
                'success' => 500,
                'message' => 'Error',
                'data' => $e
            ], 500);
    
            return false;
        }
       
    }
}
