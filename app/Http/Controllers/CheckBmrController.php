<?php

namespace App\Http\Controllers;

use App\CheckBmr;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CheckBmController extends Controller
{
    public function index()
    {
        $check_bmr = $cetegory = DB::table('check_bmr')
        ->get();
        return response([
            'success' => true,
            'message' => 'List Semua Hasil Check',
            'data' => $check_bmr
        ], 200);
    }

    public function BmrStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'     => 'required',
            'berat_badan'   => 'required',
            'tinggi_badan'   => 'required',
            'umur'   => 'required',
            'gender'   => 'required',
            'type'   => 'required',
        ],
            [
                'nama.required' => 'Nama harus diisi !',
                'tinggi_badan.required' => 'Tinggi badan harus diisi !',
                'berat_badan.required' => 'Berat badan harus diisi !',
                'umur.required' => 'Umur harus diisi !',
                'type.required' => 'Type harus diisi !',
            ]
        );

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],400);

        } else {

            $bb = $request->input('berat_badan');
            $tb = $request->input('tinggi_badan') / 100;

            // $Bmr = $bb / ($tb*$tb);
            // if($Bmr < 15.5) {
            //     $message = "Anda mengalami anoreksia";
            //     $kategori = 1;
            // }elseif ($Bmr < 18.5 ) {
            //     $message = "Anda mengalami kekurangan gizi";
            //     $kategori = 1;
            // }elseif ($Bmr < 25 ) {
            //     $message = "Anda memiliki berat badan normal";
            //     $kategori = 2;
            // }elseif ($Bmr < 30 ) {
            //     $message = "Anda memiliki overweight";
            //     $kategori = 3;
            // }elseif ($Bmr < 35 ) {
            //     $message = "Anda mengalami Obesitas Level 1";
            //     $kategori = 4;
            // }elseif ($Bmr < 40 ) {
            //     $message = "Anda mengalami Obesitas Level 2";
            //     $kategori = 4;
            // }else {
            //     $message = "Anda mengalami Obesitas Akut";
            //     $kategori = 4;
            // }
            // dd($Bmr);
            
            $CheckBmr = CheckBmr::create([
                'nama'     => $request->input('nama'),
                'tinggi_badan'   => $request->input('tinggi_badan'),
                'berat_badan'   => $request->input('berat_badan'),
                'umur'   => $request->input('umur'),
                'gender'   => $request->input('gender'),
                'type'   => $type 
            ]);


            if ($CheckBmr) {
                return response()->json([
                    'success' => true,
                    'message' => 'CheckBmr Berhasil Disimpan!',
                    'data' => [
                        'nama'     => $request->nama,
                        'tinggi_badan'   => $request->tinggi_badan,
                        'berat_badan'   => $request->berat_badan,
                        'umur'   => $request->umur,
                        'gender'   => $request->gender,
                        'message' => $message 
                    ],
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Check BMR Gagal Disimpan!',
                ], 400);
            }
        }
    }


}
