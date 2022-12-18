<?php

namespace App\Http\Controllers\Api;

use App\Models\Hafalan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class HafalanController extends Controller
{
    public function getData(Request $request) {

        if (auth()->guard('api')->check()) {

            $user_id = auth()->guard('api')->user()->id;

            $data = Hafalan::select('hafalans.*', 'users.name as nama_guru')->join('users', 'hafalans.guru_id', '=', 'users.id')->where('murid_id', $user_id)->orderBy('created_at', 'asc')->limit(30)->get();
            $murid = DB::table('users')->select('users.name')->where('id', $user_id)->first();

            if (count($data) > 0) {

                foreach ($data as $key => $value) {
 
                    $data_hfl[] = array(
                        'nama_murid'        => $murid->name,
                        'nama_guru'         => $value->nama_guru,
                        'materi_hafalan'    => $value->materi_hafalan,
                        'nilai'             => $value->nilai,
                        'type'              => $value->jenis,
                        'tanggal_hafalan'   => $value->tanggal_hafalan,
                        'created_at'        => $value->created_at,
                    );

                }

                $response = [
                    'status' => 'success',
                    'data'   => $data_hfl
                ];
            } else {
                $response = [
                    'status' => 'failed',
                    'message'   =>  'Data tidak ada!'
                ];
            }
        } else {
            $response = [
                'status' => 'failed',
                'message' => 'Mohon untuk login terlebih dahulu!',
            ];
        }
        
        return response()->json($response, 200);
        
    }

    public function getDataByguru(Request $request) {
        
        if (auth()->guard('api')->check()) {

            $data = Hafalan::select('hafalans.*', 'users.name as nama_guru')->join('users', 'hafalans.guru_id', '=', 'users.id')->where('murid_id', $request->murid_id)->orderBy('created_at', 'asc')->limit(30)->get();
    
            if (count($data) > 0) {

                foreach ($data as $key => $value) {
                    $murid = DB::table('users')->select('users.name')->where('id', $value->murid_id)->first();
 
                    $data_hfl[] = array(
                        'nama_murid'        => $murid->name,
                        'nama_guru'         => $value->nama_guru,
                        'materi_hafalan'    => $value->materi_hafalan,
                        'nilai'             => $value->nilai,
                        'type'              => $value->jenis,
                        'tanggal_hafalan'   => $value->tanggal_hafalan,
                        'created_at'        => $value->created_at,
                    );

                }

                $response = [
                    'status' => 'success',
                    'data'   => $data_hfl
                ];
            } else {
                $response = [
                    'status' => 'failed',
                    'message'   =>  'Data tidak ada!'
                ];
            }

        } else {
            $response = [
                'status' => 'failed',
                'message' => 'Mohon untuk login terlebih dahulu!',
            ];
        }


        return response()->json($response, 200);
    }

    public function inputHafalan(Request $request) {

        // dd($request->all());

        if (auth()->guard('api')->check()) {

            $validator = Validator::make($request->all(), [
                'murid_id'        => 'required',
                'materi_hafalan'  => 'required',
                'tanggal_hafalan' => 'required',
                'nilai'           => 'required',
            ], [
                'murid_id.required'        => 'Nama murid belum diisi!',
                'materi_hafalan.required'  => 'Materi belum diisi!',
                'tanggal_hafalan.required' => 'Tanggal belum diisi!',
                'nilai.required'           => 'Nilai belum diisi!',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors(),
                ]);
            }
            
            DB::beginTransaction();
            try {
                $guru_id = auth()->guard('api')->user()->id;
    
                $hafalan = new Hafalan;
                $hafalan->murid_id         = $request->murid_id;
                $hafalan->materi_hafalan   = $request->materi_hafalan;
                $hafalan->tanggal_hafalan  = $request->tanggal_hafalan;
                $hafalan->nilai            = $request->nilai;
                $hafalan->guru_id          = $guru_id;
                $hafalan->jenis            = $request->jenis;
        
                $hafalan->save();

                DB::commit();
                $response = [
                    'status'   => 'success',
                    'message' => 'Berhasil ditambahkan!',
                    'data'    => $hafalan,
                ];

            } catch (Exception $e) {
                DB::rollback();
                $response = [
                    'satus'   => 'failed',
                    'message' => $e->getMessage(),
                ];
            }
        } else {
            $response = [
                'status' => 'failed',
                'message' => 'Mohon untuk login terlebih dahulu!',
            ];
        }

        return response()->json($response, 200);
        
    }

    public function getDataById($id) {
        $data = Hafalan::where('id', $id)->first();


        if ($data) {
            $response = [
                'status' => 'success',
                'data' => $data,
            ];
        } else {
            $response = [
                'status' => 'failed',
                'data' => [],
            ];
        }

        return response()->json($response, 200);
    }

    public function updateData(Request $request) {

        if (auth()->guard('api')->check()) {

            $validator = Validator::make($request->all(), [
                'murid_id'        => 'required',
                'materi_hafalan'  => 'required',
                'tanggal_hafalan' => 'required',
                'nilai'           => 'required',
            ], [
                'murid_id.required'        => 'Nama murid belum diisi!',
                'materi_hafalan.required'  => 'Materi belum diisi!',
                'tanggal_hafalan.required' => 'Tanggal belum diisi!',
                'nilai.required'           => 'Nilai belum diisi!',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validator->errors(),
                ]);
            }
            
            DB::beginTransaction();
            try {
                $guru_id = auth()->guard('api')->user()->id;
    
                $hafalan = Hafalan::where('id', $request->hafalan_id)
                ->update([

                    'murid_id'         => $request->murid_id,
                    'materi_hafalan'   => $request->materi_hafalan,
                    'tanggal_hafalan'  => $request->tanggal_hafalan,
                    'nilai'            => $request->nilai,
                    'guru_id'          => $guru_id,
                    'jenis'            => $request->jenis,
                ]);

                DB::commit();
                $response = [
                    'status'   => 'success',
                    'message' => 'Berhasil diubah!',
                ];

            } catch (Exception $e) {
                DB::rollback();
                $response = [
                    'satus'   => 'failed',
                    'message' => $e->getMessage(),
                ];
            }
        } else {
            $response = [
                'status' => 'failed',
                'message' => 'Mohon untuk login terlebih dahulu!',
            ];
        }

        return response()->json($response, 200);
    }

    public function delete($id) {
        $data = Hafalan::find($id)->first();
        $data->delete();
        
        $response = [
            'status' => 'Success',
            'message' => 'Berhasil hapus data!',
        ];

        return response()->json($response, 200);
    }
}
