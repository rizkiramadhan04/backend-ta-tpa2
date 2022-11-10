<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Presensi;
use Illuminate\Http\Request;
use App\Models\JadwalPresensi;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PresensiController extends Controller
{
    public function getData() {

        if (auth()->guard('api')->check()) {

            $user_id = auth()->guard('api')->user()->id;
            $data = Presensi::select('presensis.*', 'users.name as nama_murid')->join('users', 'presensis.user_id', '=', 'users.id')->where('user_id', $user_id)->orderBy('created_at', 'desc')->limit(30)->get();

            if (count($data) > 0) {

                foreach ($data as $key => $value) {
                    
                    $data_presensi[] = array(
                        'id'            => $value->id,
                        'nama_murid'    => $value->nama_murid,
                        'status_sebagai' => ($value->status_sebagai == 1 ? 'Guru': 'Murid'),
                        'tanggal_masuk' => $value->tanggal_masuk,
                        'waktu_masuk'   => date('H:i', strtotime($value->tanggal_masuk)),
                        'status_masuk'  => ($value->status_presensi == 1 ? 'Tepat Waktu' : 'Telat'),
                        'tanggal_izin'  => $value->tanggal_izin,
                        'alasan_izin'   => $value->alasan_izin,
                        'kode_jadwal'   => base64_decode($value->kode_jadwal_presensi),
                        'created_at'    => $value->created_at,
                    );

                }

                $response = [
                    'status' => 'success',
                    'data'   => $data_presensi,
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

            $data = Presensi::select('presensis.*', 'users.name as nama_murid')->join('users', 'presensis.user_id', '=', 'users.id')->where('user_id', $request->murid_id)->orderBy('created_at', 'desc')->limit(30)->get();

            if (count($data) > 0) {

                foreach ($data as $key => $value) {
                    
                    $data_presensi[] = array(
                        'id'            => $value->id,
                        'nama_murid'    => $value->nama_murid,
                        'status_sebagai' => ($value->status_sebagai == 1 ? 'Guru': 'Murid'),
                        'tanggal_masuk' => $value->tanggal_masuk,
                        'waktu_masuk'   => date('H:i', strtotime($value->tanggal_masuk)),
                        'status_masuk'  => ($value->status_presensi == 1 ? 'Tepat Waktu' : 'Telat'),
                        'tanggal_izin'  => $value->tanggal_izin,
                        'alasan_izin'   => $value->alasan_izin,
                        'kode_jadwal'   => base64_decode($value->kode_jadwal_presensi),
                        'created_at'    => $value->created_at,
                    );

                }

                $response = [
                    'status' => 'success',
                    'data'   => $data_presensi,
                ];
            } else {
                $response = [
                    'status'  => 'failed',
                    'message' => 'Data tidak ada!',
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

    public function inputPresensi(Request $request) {
        
        if (auth()->guard('api')->check()) {

            $getKodeJadwal = JadwalPresensi::whereDate('tanggal_presensi', date('Y-m-d', strtotime($request->tanggal_masuk)))->where('status', 0)->first();
            
            if ($getKodeJadwal != "" || $getKodeJadwal != null) {

                $kode_presensi = base64_decode($getKodeJadwal->kode_presensi);
                
                if ($kode_presensi == $request->kode_jadwal_presensi) {

                    DB::beginTransaction();
                    try {

                        $user_id = auth()->guard('api')->user()->id;
                        $user = auth()->guard('api')->user();

                        $waktu_presensi = date('H', strtotime($request->tanggal_masuk));
        
                        if ($waktu_presensi >= date('H')) {

                            $presensi = new Presensi;
                            $presensi->user_id          = $user_id;
                            $presensi->status_user      = $user->status;
                            $presensi->status_presensi  = 1;
                            $presensi->tanggal_masuk    = $request->tanggal_masuk;
                            $presensi->tanggal_izin     = $request->tanggal_izin;
                            $presensi->alasan_izin      = $request->alasan_izin;
                            $presensi->kode_jadwal_presensi = base64_encode($request->kode_jadwal_presensi);
            
                            $presensi->save();
                            DB::commit();
            
                            $response = [
                                'status'    => 'success',
                                'message'   => 'Data Berhasil disimpan',
                                'data'      => $presensi,
                            ];

                        } else {

                            $presensi = new Presensi;
                            $presensi->user_id          = $user_id;
                            $presensi->status_user      = $user->status;
                            $presensi->status_presensi  = 2;
                            $presensi->tanggal_masuk    = $request->tanggal_masuk;
                            $presensi->tanggal_izin     = $request->tanggal_izin;
                            $presensi->alasan_izin      = $request->alasan_izin;
                            $presensi->kode_jadwal_presensi = base64_encode($request->kode_jadwal_presensi);
            
                            $presensi->save();
                            DB::commit();
            
                            $response = [
                                'status'    => 'success',
                                'message'   => 'Data Berhasil disimpan, tapi anda sudah telat',
                                'data'      => $presensi,
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
                        'message' => 'Kode presensi sudah tidak dapat digunakan!',
                    ];
                }

           } else {

            $response = [
                'status'  => 'failed',
                'message' => 'Untuk QR Code presensi sudah expired',
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

    public function getJadwalPresensi() {

        if (auth()->guard('api')->check()) {

            $data = DB::table('jadwal_presensis')->get();

            if ($data) {

                foreach ($data as $key => $value) {
                    $data_jdwl[] = array(
                        'nama_kegiatan' => $value->nama_kegiatan,
                        'tanggal'       => $value->tanggal_presensi,
                        'kode_presensi' => base64_decode($value->kode_presensi),
                    );
                }
    
                $response = [
                    'status' => 'success',
                    'data'   => $data_jdwl,
                ];

            } else {
                $response = [
                    'status'  => 'failed',
                    'message' => 'Jadwal presensi tidak ada!',
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

    public function getDetailJadwalPresensi(Request $request) {

        if (auth()->guard('api')->check()) {

            $data = DB::table('jadwal_presensis')->where('id', $request->jadwal_id)->first();

            if ($data) {

                $response = [
                    'status'        => 'success',
                    'nama_kegiatan' => $data->nama_kegiatan,
                    'tanggal'       => $data->tanggal_presensi,
                    'kode_presensi' => base64_decode($data->kode_presensi),
                ];

            } else {
                $response = [
                    'status'  => 'failed',
                    'message' => 'Jadwal presensi tidak ada!',
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
