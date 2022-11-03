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

            $data = Hafalan::where('murid_id', $user_id)->orderBy('created_at', 'asc')->limit(30)->get();

            if (count($data) > 0) {

                $response = [
                    'status' => 'success',
                    'data'   => $data
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

            $data = Hafalan::where('murid_id', $request->murid_id)->orderBy('created_at', 'asc')->limit(30)->get();
    
            if (count($data) > 0) {

                $response = [
                    'status' => 'success',
                    'data'   => $data
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
}
