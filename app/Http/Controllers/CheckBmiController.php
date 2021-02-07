<?php

namespace App\Http\Controllers;

use App\CheckBmi;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CheckBmController extends Controller
{
    public function index()
    {
        $check_bmi = $cetegory = DB::table('check_bmi')
        ->get();
        return response([
            'success' => true,
            'message' => 'List Semua Hasil Check',
            'data' => $check_bmi
        ], 200);
    }

    public function bmiStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'     => 'required',
            'berat_badan'   => 'required',
            'tinggi_badan'   => 'required',
            'umur'   => 'required',
            'gender'   => 'required',
        ],
            [
                'nama.required' => 'Nama harus diisi !',
                'tinggi_badan.required' => 'Tinggi badan harus diisi !',
                'berat_badan.required' => 'Berat badan harus diisi !',
                'umur.required' => 'Umur harus diisi !',
                'gender.required' => 'Gender harus diisi !',
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

            $bmi = $bb / ($tb*$tb);
            if($bmi < 15.5) {
                $message = "Anda mengalami anoreksia";
                $kategori = 1;
            }elseif ($bmi < 18.5 ) {
                $message = "Anda mengalami kekurangan gizi";
                $kategori = 1;
            }elseif ($bmi < 25 ) {
                $message = "Anda memiliki berat badan normal";
                $kategori = 2;
            }elseif ($bmi < 30 ) {
                $message = "Anda memiliki overweight";
                $kategori = 3;
            }elseif ($bmi < 35 ) {
                $message = "Anda mengalami Obesitas Level 1";
                $kategori = 4;
            }elseif ($bmi < 40 ) {
                $message = "Anda mengalami Obesitas Level 2";
                $kategori = 4;
            }else {
                $message = "Anda mengalami Obesitas Akut";
                $kategori = 4;
            }
            // dd($bmi);

            $CheckBmi = CheckBmi::create([
                'nama'     => $request->input('nama'),
                'tinggi_badan'   => $request->input('tinggi_badan'),
                'berat_badan'   => $request->input('berat_badan'),
                'umur'   => $request->input('umur'),
                'gender'   => $request->input('gender'),
                'id_kategori'   => $kategori 
            ]);


            if ($CheckBmi) {
                return response()->json([
                    'success' => true,
                    'message' => 'CheckBmi Berhasil Disimpan!',
                    'data' => [
                        'nama'     => $request->nama,
                        'tinggi_badan'   => $request->tinggi_badan,
                        'berat_badan'   => $request->berat_badan,
                        'umur'   => $request->umur,
                        'gender'   => $request->gender,
                        'id_kategori'   => $kategori,
                        'message' => $message 
                    ],
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'CheckBmi Gagal Disimpan!',
                ], 400);
            }
        }
    }


}
