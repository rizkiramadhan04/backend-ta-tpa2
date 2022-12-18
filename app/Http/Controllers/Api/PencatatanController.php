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
            $data = Pencatatan::select('pencatatans.*', 'users.name as nama_guru', 'alqurans.nama_surah as nama_surah')->join('users', 'pencatatans.guru_id', '=', 'users.id')->join('alqurans', 'pencatatans.no_surah', '=', 'alqurans.no_surah')->where('murid_id', $user_id)->whereMonth('tanggal', date('m'))->orderBy('created_at', 'desc')->limit(30)->get();
            $nama_murid = DB::table('users')->select('users.name')->where('id', $user_id)->first();
            
            if (count($data) > 0) {
                
                foreach ($data as $key => $value) {

                    if ($value->hasil == 0) {
                        $hasil = 'Mengulang';
                    } else if ($value->hasil == 1) {
                        $hasil = 'Cukup';
                    } else {
                        $hasil = 'Lanjut';
                    }
                    
                    $data_pct[] = array(
                        'id'            => $value->id,
                        'nama_murid'    => $nama_murid->name,
                        'nama_guru'     => $value->nama_guru,
                        'nama_surah'    => $value->nama_surah,
                        'no_ayat'       => $value->no_ayat,
                        'no_iqro'       => $value->no_iqro,
                        'jilid'         => $value->jilid,
                        'halaman'       => $value->halaman,
                        'hasil'         => $hasil,
                        'tanggal'       => $value->tanggal,
                        'jenis_kitab'   => $value->jenis_kitab,
                        'juz'           => $value->juz,
                        'created_at'    => $value->created_at,
                    );

                }

                $response = [
                    'status' => 'success',
                    'data'   => $data_pct,
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


    public function getMurid() {
        $data = DB::table('users')->where('status', '0')->get();

        if ($data) {
            
            foreach ($data as $row) {
                $data_ar[] = array(
                    
                    'id' => $row->id,
                    'nama_murid' => $row->name,
                    'tingkatan' => $row->tingkatan,
                    
                );
            }
            $response = [
                'status' => 'success',
                'data' => $data_ar,
            ];
        } else {
            $response = [
                'status' => 'error',
                'data' => [],
            ];
        }

        return response()->json($response, 200);
    }

    public function getDataAlquran() {

        $data = DB::table('alqurans')->get();

        if ($data) {
            
            $response = [
                'status' => 'success',
                'data' => $data,
            ];

        } else {
            $response = [
                'status' => 'error',
                'data' => [],
            ];
        }

        return response()->json($response, 200);

    }

    public function getDataGuru(Request $request) {

        if (auth()->guard('api')->check()) {

            $user_id = auth()->guard('api')->user()->id;
            $data = Pencatatan::select('pencatatans.*', 'users.name as nama_murid', 'alqurans.nama_surah as nama_surah')->join('users', 'pencatatans.murid_id', '=', 'users.id')->join('alqurans', 'pencatatans.no_surah', '=', 'alqurans.no_surah')->where('murid_id', $request->murid_id)->whereMonth('tanggal', date('m'))->orderBy('created_at', 'desc')->limit(30)->get();
            
            if (count($data) > 0) {
                
                foreach ($data as $key => $value) {
                    $guru = DB::table('users')->select('users.name')->where('id', $value->guru_id)->first();

                    if ($value->hasil == 0) {
                        $hasil = 'Mengulang';
                    } else if ($value->hasil == 1) {
                        $hasil = 'Cukup';
                    } else {
                        $hasil = 'Lanjut';
                    }
                    
                    $data_pct[] = array(
                        'id'            => $value->id,
                        'nama_murid'    => $value->nama_murid,
                        'nama_guru'     => $guru->name,
                        'nama_surah'    => $value->nama_surah,
                        'no_ayat'       => $value->no_ayat,
                        'no_iqro'       => $value->no_iqro,
                        'jilid'         => $value->jilid,
                        'halaman'       => $value->halaman,
                        'hasil'         => $hasil,
                        'tanggal'       => $value->tanggal,
                        'jenis_kitab'   => $value->jenis_kitab,
                        'juz'           => $value->juz,
                        'created_at'    => $value->created_at,
                    );

                }

                $response = [
                    'status' => 'success',
                    'data'   => $data_pct,
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
                $guru = DB::table('users')->where('id', $guru_id)->first();
                
                if ($guru->status == 1) {
                    $pencatatan = new Pencatatan;
                    $pencatatan->murid_id    = $request->murid_id;
                    $pencatatan->no_surah    = $request->no_surah;
                    $pencatatan->no_ayat     = $request->no_ayat;
                    $pencatatan->no_iqro     = $request->no_iqro;
                    $pencatatan->jilid       = $request->jilid;
                    $pencatatan->halaman     = $request->halaman;
                    $pencatatan->guru_id     = $guru_id;
                    $pencatatan->hasil       = $request->hasil;
                    $pencatatan->tanggal     = $request->tanggal;
                    $pencatatan->jenis_kitab = $request->jenis_kitab;
                    $pencatatan->juz         = $request->juz;

                    $pencatatan->save();
                    DB::commit();

                    $response = [
                        'status'   => 'success',
                        'message'  => 'Data berhasil disimpan!',
                        'data'     => $pencatatan,
                    ];
                } else {
                    $response = [
                        'status'   => 'failed',
                        'message'  => 'Anda buka guru pengajar!',
                    ];
                }

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

    public function getDataById($id) {
        $data = Pencatatan::where('id', $id)->first();

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
                $guru = DB::table('users')->where('id', $guru_id)->first();
                
                if ($guru->status == 1) {

                    $pencatatan = Pencatatan::where('id', $request->pencatatan_id)
                    ->update([
                        'murid_id'    => $request->murid_id,
                        'no_surah'    => $request->no_surah,
                        'no_ayat'     => $request->no_ayat,
                        'no_iqro'     => $request->no_iqro,
                        'jilid'       => $request->jilid,
                        'halaman'     => $request->halaman,
                        'guru_id'     => $guru_id,
                        'hasil'       => $request->hasil,
                        'tanggal'     => $request->tanggal,
                        'jenis_kitab' => $request->jenis_kitab,
                        'juz'         => $request->juz,
                    ]);

                    DB::commit();

                    $response = [
                        'status'   => 'success',
                        'message'  => 'Data berhasil ubah!',
                    ];
                } else {
                    $response = [
                        'status'   => 'failed',
                        'message'  => 'Anda buka guru pengajar!',
                    ];
                }

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

    public function delete($id) {
        $data = Pencatatan::find($id)->first();
        $data->delete();

        $response = [
            'status' => 'success',
            'message' => 'Berhasil hapus data!'
        ];

        return response()->json($response, 200);
    }
}
