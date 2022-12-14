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
    public function getData(Request $request) {

        if($request->jenis_presensi == 'all') {
            $jenis_presensi = ['0','1'];
        } else {
            $jenis_presensi = [$request->jenis_presensi];
        }  

        if (auth()->guard('api')->check()) {

            
            $user_id = auth()->guard('api')->user()->id;
            $data = Presensi::query()->select('presensis.*', 'users.name as nama')->join('users', 'presensis.user_id', '=', 'users.id')->where('user_id', $user_id)->whereIn('jenis_presensi', $jenis_presensi)->orderBy('created_at', 'desc')->get();
            // dd($data);
            if (count($data) > 0) {

                // $data_presensi = array();

                foreach ($data as $key => $value) {
                    
                    $data_presensi[] = array (
                        'id'            => $value->id,
                        'nama'          => $value->nama,
                        'status_sebagai' => ($value->status_sebagai == 1 ? 'Guru': 'Murid'),
                        'status_masuk'  => ($value->status_presensi == 1 ? 'Tepat Waktu' : 'Telat'),
                        'tanggal_masuk' => ( $value->tanggal_masuk != null ? date("d-m-Y", strtotime($value->tanggal_masuk)) : null),
                        'waktu_masuk'   => ( $value->tanggal_masuk != null ? date('H:i', strtotime($value->tanggal_masuk)) : null),
                        'jenis_presensi'=> ( $value->jenis_presensi == 1 ? 'Izin' : 'Presensi'),
                        'tanggal_izin'  => ( $value->tanggal_izin != null ? date("d-m-Y", strtotime($value->tanggal_izin)) : null),
                        'alasan_izin'   => $value->alasan_izin,
                        'created_at'    => date("Y-m-d H:i:s", strtotime($row->created_at)),
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
                        'nama'          => $value->nama,
                        'status_sebagai' => ($value->status_sebagai == 1 ? 'Guru': 'Murid'),
                        'tanggal_masuk' => ( $value->tanggal_masuk != null ? date("d-m-Y", strtotime($value->tanggal_masuk)) : null),
                        'waktu_masuk'   => ( $value->tanggal_masuk != null ? date('H:i', strtotime($value->tanggal_masuk)) : null),
                        'jenis_presensi'=> ( $value->jenis_presensi == 1 ? 'Izin' : 'Presensi'),
                        'tanggal_izin'  => ( $value->tanggal_izin != null ? date("d-m-Y", strtotime($value->tanggal_izin)) : null),
                        'alasan_izin'   => $value->alasan_izin,
                        'created_at'    => date("Y-m-d H:i:s", strtotime($row->created_at)),
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
        dd($request->all());
        
        if (auth()->guard('api')->check()) {

            $user_id = auth()->guard('api')->user()->id;
            
            if ($request->izin != null) {
            
                $user = auth()->guard('api')->user();

                DB::beginTransaction();
                try {
                    $presensi = new Presensi;
                    $presensi->user_id          = $user_id;
                    $presensi->jenis_presensi   = 1;
                    $presensi->status_user      = $user->status;
                    $presensi->tanggal_izin     = $request->tanggal_izin;
                    $presensi->alasan_izin      = $request->alasan_izin;
                    
                    $presensi->save();
                    DB::commit();

                    $response = [
                        'status'    => 'success',
                        'message'   => 'Izin berhasil disimpan',
                        'data'      => $presensi,
                    ];

                } catch (\Exception $e) {
                    DB::rollback();
                
                    $response = [
                        'status'  => 'failed',
                        'message' => $e->getMessage(),
                    ];
                }

            } else {
                $getKodeJadwal = JadwalPresensi::whereDate('tanggal_awal', date('Y-m-d', strtotime($request->tanggal_masuk)))->where('status', 0)->first();
            $checkUserPresensi = Presensi::where('user_id', $user_id)->whereDate('tanggal_masuk', date('Y-m-d', strtotime($getKodeJadwal->tanggal_awal)))->first();
            if ( date('d-m-Y', strtotime($request->tanggal_masuk)) == date('d-m-Y', strtotime($getKodeJadwal->tanggal_akhir))) {

                if (!$checkUserPresensi) {

                    if ($getKodeJadwal != "" || $getKodeJadwal != null) {

                        $kode_presensi = base64_decode($getKodeJadwal->kode_presensi);
                        
                        if ($kode_presensi == $request->kode_jadwal_presensi) {
        
                            DB::beginTransaction();
                            try {
        
                                $user = auth()->guard('api')->user();
        
                                $waktu_presensi = date('H', strtotime($request->tanggal_masuk));
                                $waktu_akhir_jadwal = date('H', strtotime($getKodeJadwal->tanggal_akhir));
                
                                if ($waktu_akhir_jadwal >= $waktu_presensi) {
        
                                    $presensi = new Presensi;
                                    $presensi->user_id          = $user_id;
                                    $presensi->status_user      = $user->status;
                                    $presensi->jenis_presensi   = 0;
                                    $presensi->status_presensi  = 1;
                                    $presensi->tanggal_masuk    = $request->tanggal_masuk;
                                    $presensi->tanggal_izin     = $request->tanggal_izin;
                                    $presensi->alasan_izin      = $request->alasan_izin;
                                    $presensi->kode_jadwal_presensi = base64_encode($request->kode_jadwal_presensi);
                    
                                    $presensi->save();
                                    DB::commit();
                    
                                    $response = [
                                        'status'    => 'success',
                                        'message'   => 'Presensi Berhasil disimpan',
                                        'data'      => $presensi,
                                    ];
        
                                } else {
                    
                                    $response = [
                                        'status'    => 'failed',
                                        'message'   => 'Anda sudah telat, dan tidak dapat melakukan presensi',
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
                        'message' => 'Jadwal presensi tidak ada!',
                    ];
        
                   }

                } else {
                    $response = [
                        'status'  => 'failed',
                        'message' => 'Anda sudah melakukan presensi!',
                    ];
                }

            } else {

                $response = [
                    'status'  => 'failed',
                    'message' => 'Untuk presensi tanggal tersebut tidak ada!',
                ];
    
               }
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
