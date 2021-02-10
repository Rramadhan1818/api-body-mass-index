<?php

namespace App\Http\Controllers;

use App\CheckBmr;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CheckBmrController extends Controller
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

    public function bmrStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama'     => 'required',
            'berat_badan'   => 'required',
            'tinggi_badan'   => 'required',
            'umur'   => 'required',
            'gender'   => 'required',
            'type_bmr'   => 'required',
            'id_lvl_aktivitas'   => 'required',
        ],
            [
                'nama.required' => 'Nama harus diisi !',
                'tinggi_badan.required' => 'Tinggi badan harus diisi !',
                'berat_badan.required' => 'Berat badan harus diisi !',
                'umur.required' => 'Umur harus diisi !',
                'gender.required' => 'Gender harus diisi !',
                'type_bmr.required' => 'Type bmr harus diisi !',
                'id_lvl_aktivitas.required' => 'Level Aktivitas bmr harus diisi !',
            ]
        );

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],400);

        } else {

            //  Sangat jarang olahraga, kalikan BMR dengan 1,2
            //  Jarang olahraga (1-3 hari/ minggu), kalikan BMR dengan 1,375
            //  Normal olahraga (3-5 hari/ minggu), kalikan BMR dengan 1,55
            //  Sering olahraga (6-7 hari/ minggu), kalikan BMR dengan 1,725
            //  Sangat sering olahraga (setiap hari bisa dua kali dalam sehari), kalikan BMR dengan 1,9

            $bb = $request->input('berat_badan');
            $tb = $request->input('tinggi_badan');
            $gender = $request->input('gender');
            $umur = $request->input('umur');
            $type = $request->input('type_bmr');
            $lvl_aktivitas = $request->input('id_lvl_aktivitas');

            if($type == 'Harris Benedict'){
                if($gender == 'L'){
                    $bmr =  66 + (13.7 * $bb) + (5 * $tb) - (6.8 * $umur);
                    // dd($bmr);
                    if($lvl_aktivitas == 1){
                        $kal_dibutuhkan = ($bmr * 1.2);
                    }else if($lvl_aktivitas == 2){
                        $kal_dibutuhkan = ($bmr * 1.375);
                    }else if($lvl_aktivitas == 3){
                        $kal_dibutuhkan = ($bmr * 1.55); 
                    }else if($bmr == 4){
                        $kal_dibutuhkan = ($bmr * 1.725); 
                    }else if($bmr <= 5){
                        $kal_dibutuhkan = ($bmr * 1.9); 
                    }
                }else if($gender == 'P'){
                    $bmr = 655 + (9.6 * $bb) + (1.8 * $tb) - (4.7 * $umur);
                    
                    if($lvl_aktivitas == 1){
                        $kal_dibutuhkan = ($bmr * 1.2);
                    }else if($lvl_aktivitas == 2){
                        $kal_dibutuhkan = ($bmr * 1.375);
                    }else if($lvl_aktivitas == 3){
                        $kal_dibutuhkan = ($bmr * 1.55); 
                    }else if($bmr == 4){
                        $kal_dibutuhkan = ($bmr * 1.725); 
                    }else if($bmr <= 5){
                        $kal_dibutuhkan = ($bmr * 1.9); 
                    }
                }
            }else if($type == 'WHO'){
                if($umur <= 3){
                    if($gender == 'L'){
                        $bmr = 60.9 * $bb - 54;
                        $data_bmr = array(
                            'bmr' => $bmr,
                            'deskripsi' => '',
                        );
                    }else if($gender == 'P'){
                        $bmr = 61 * $bb - 51;
                        $data_bmr = array(
                            'bmr' => $bmr,
                            'deskripsi' => '',
                        );
                    }
                }else if($umur <= 10){
                    if($gender == 'L'){
                        $bmr = 22.7 * $bb - 495;
                        $data_bmr = array(
                            'bmr' => $bmr,
                            'deskripsi' => '',
                        );
                    }else if($gender == 'P'){
                        $bmr = 22.5 * $bb - 499;
                        $data_bmr = array(
                            'bmr' => $bmr,
                            'deskripsi' => '',
                        );
                    }
                }else if($umur <= 18){
                    if($gender == 'L'){
                        $bmr = 17.5 * $bb - 651;
                        $data_bmr = array(
                            'bmr' => $bmr,
                            'deskripsi' => '',
                        );
                    }else if($gender == 'P'){
                        $bmr = 12.2 * $bb - 746;
                        $data_bmr = array(
                            'bmr' => $bmr,
                            'deskripsi' => '',
                        );
                    }
                }else if($umur <= 30){
                    if($gender == 'L'){

                    }else if($gender == 'P'){
                        
                    }
                }else if($umur <= 60){
                    if($gender == 'L'){

                    }else if($gender == 'P'){
                        
                    }
                }else if($umur > 60){
                    if($gender == 'L'){

                    }else if($gender == 'P'){
                        
                    }
                }
            }
            
            $CheckBmr = CheckBmr::create([
                'nama'     => $request->input('nama'),
                'tinggi_badan'   => $request->input('tinggi_badan'),
                'berat_badan'   => $request->input('berat_badan'),
                'umur'   => $request->input('umur'),
                'gender'   => $request->input('gender'),
                'id_lvl_aktivitas' => $request->input('id_lvl_aktivitas'),
                'type_bmr'   => $request->input('type_bmr'),
                'jumlah_bmr'   => $bmr,
                'kal_dibutuhkan'   => $kal_dibutuhkan,
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
                        'id_lvl_aktivitas'   => $request->id_lvl_aktivitas,
                        'jumlah_bmr' => $bmr,    
                        'kal_dibutuhkan' => $kal_dibutuhkan    
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
