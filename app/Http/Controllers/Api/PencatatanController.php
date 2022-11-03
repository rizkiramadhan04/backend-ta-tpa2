<?php

namespace App\Http\Controllers\Api;

use App\Models\Hafalan;
use App\Models\Pencatatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PencatatanController extends Controller
{
    public function getData() {

        if (auth()->guard('api')->check()) {

            $user_id = auth()->guard('api')->user()->id;
            $data = Pencatatan::where('murid_id', $user_id)->orderBy('created_at', 'asc')->limit(30)->get();

            if (count($data) > 0) {
                $response = [
                    'status' => 'success',
                    'data'   => $data,
                ];
            } else {
                $response = [
                    'status' => 'failed',
                    'message' => 'Data tidak ada!',
                ];
            }
        } else {
            $response = [
                'status' => 'failed',
                'message' => 'Mohon untuk login terlebih dahulu!'
            ];
        }

        return response()->json($response, 200);
    }

    public function getDataGuru(Request $request) {

        if (auth()->guard('api')->check()) {

            $data = Pencatatan::where('murid_id', $request->murid_id)->orderBy('created_at', 'asc')->limit(30)->get();

            if (count($data) > 0) {
                $response = [
                    'status' => 'success',
                    'data'   => $data,
                ];
            } else {
                $response = [
                    'status' => 'failed',
                    'message' => 'Data tidak ada!',
                ];
            }
        } else {
            $response = [
                'status' => 'failed',
                'message' => 'Mohon untuk login terlebih dahulu!'
            ];
        }

        return response()->json($response, 200);
    }

    public function inputPencatatan(Request $request) {

        if (auth()->guard('api')->check()) {
            
            $validator = Validator::make($request->all(), [
                'murid_id'    => 'required',
                'jilid'       => 'required',
                'halaman'     => 'required',
                'hasil'       => 'required',
                'tanggal'     => 'required',
                'jenis_kitab' => 'required',
            ], [
                'murid_id.required'     => 'Nama murid belum diisi!',
                'jilid.required'        => 'Jilid belum diisi!',
                'halaman.required'      => 'Halaman belum diisi!',
                'hasil.required'        => 'Hasil belum diisi!',
                'tanggal.required'      => 'Tanggal belum diisi!',
                'jenis_kitab.required'  => 'Jenis kitab belum diisi!',
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
    
                $pencatatan = new Pencatatan;
                $pencatatan->murid_id    = $request->murid_id;
                $pencatatan->no_surat    = $request->no_surat;
                $pencatatan->no_ayat     = $request->no_ayat;
                $pencatatan->no_iqro     = $request->no_iqro;
                $pencatatan->jilid       = $request->jilid;
                $pencatatan->halaman     = $request->halaman;
                $pencatatan->guru_id     = $guru_id;
                $pencatatan->hasil       = $request->hasil;
                $pencatatan->tanggal     = $request->tanggal;
                $pencatatan->jenis_kitab = $request->jenis_kitab;

                $pencatatan->save();
                DB::commit();

                $response = [
                    'status'   => 'success',
                    'message'  => 'Data berhasil disimpan!',
                    'data'     => $pencatatan,
                ];

            } catch (Exception $e) {

                DB::rollback();
                $response = [
                    'status'  => 'failed',
                    'message' => $e->getMessage(),
                ];

            }
            
        } else {
            $response = [
                'status'  => 'failed',
                'message' => 'Mohon untuk login terlebih dahulu!'
            ];
        }

        return response()->json($response, 200);
    }
}
