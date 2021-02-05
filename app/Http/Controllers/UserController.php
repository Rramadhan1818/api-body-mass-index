<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Transformers\UserTransformer;

class UserController extends Controller
{
    public function index(User $user)
    {
        // $Users = DB::table('users')->get();
        $Users = $user->all();
        return fractal()
        ->collection($Users)
        ->transformWith(new UserTransformer)
        ->toArray();
        // return response([
        //     'success' => true,
        //     'message' => 'List Semua Users',
        //     'data' => $Users
        // ], 200);
    }

    public function store(Request $request)
    {
        //validate data
        $validator = Validator::make($request->all(), [
            'nama'     => 'required',
            'ttl'   => 'required',
            'umur'   => 'required',
            'tinggi_badan'   => 'required',
            'berat_badan'   => 'required',
        ],
            [
                'nama.required' => 'Nama harus diisi !',
                'ttl.required' => 'Tanggal lahir harus diisi !',
                'umur.required' => 'Umur harus diisi !',
                'tinggi_badan.required' => 'Tinggi badan harus diisi !',
                'berat_badan.required' => 'Berat badan harus diisi !',
            ]
        );

        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],400);

        } else {

            $User = User::create([
                'nama'     => $request->input('nama'),
                'ttl'   => $request->input('ttl'),
                'umur'   => $request->input('umur'),
                'tinggi_badan'   => $request->input('tinggi_badan'),
                'berat_badan'   => $request->input('berat_badan')
            ]);


            if ($User) {
                return response()->json([
                    'success' => true,
                    'message' => 'User Berhasil Disimpan!',
                    'data' => [
                        'nama' => $request->nama,
                        'ttl' =>$request->ttl,
                        'umur' =>$request->umur,
                        'tinggi_badan' =>$request->tinggi_badan,
                        'berat_badan' =>$request->berat_badan,
                    ],
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'User Gagal Disimpan!',
                ], 400);
            }
        }
    }


    public function show($id)
    {
        $User = User::whereId($id)->first();

        if ($User) {
            return response()->json([
                'success' => true,
                'message' => 'Detail User!',
                'data'    => $User
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User Tidak Ditemukan!',
                'data'    => ''
            ], 404);
        }
    }

    public function update(Request $request)
    {
        //validate data
        $validator = Validator::make($request->all(), [
            'nama'     => 'required',
            'ttl'   => 'required',
            'umur'   => 'required',
            'tinggi_badan'   => 'required',
            'berat_badan'   => 'required',
        ],
            [
                'nama.required' => 'Nama harus diisi !',
                'ttl.required' => 'Tanggal lahir harus diisi !',
                'umur.required' => 'Umur harus diisi !',
                'tinggi_badan.required' => 'Tinggi badan harus diisi !',
                'berat_badan.required' => 'Berat badan harus diisi !',
            ]
        );

        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],400);

        } else {

            $User = User::whereId($request->input('id'))->update([
                'nama'     => $request->input('nama'),
                'ttl'   => $request->input('ttl'),
                'umur'   => $request->input('umur'),
                'tinggi_badan'   => $request->input('tinggi_badan'),
                'berat_badan'   => $request->input('berat_badan')
            ]);


            if ($User) {
                return response()->json([
                    'success' => true,
                    'message' => 'User Berhasil Diupdate!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'User Gagal Diupdate!',
                ], 500);
            }

        }

    }

    public function destroy($id)
    {
        $User = User::findOrFail($id);
        $User->delete();

        if ($User) {
            return response()->json([
                'success' => true,
                'message' => 'User Berhasil Dihapus!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User Gagal Dihapus!',
            ], 500);
        }

    }
}
