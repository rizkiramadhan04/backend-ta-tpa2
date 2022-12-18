<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Exception;

class PembayaranController extends Controller
{
    public function getData() {

        if (auth()->guard('api')->check()) {
    
            $user_id = auth()->guard('api')->user()->id;
            $data    = Pembayaran::where('user_id', $user_id)->orderBy('created_at', 'asc')->limit(30)->get();
    
            if (count($data) > 0) {

                foreach ($data as $key => $value) {
                    $data_p[] = array(
                        'no_hp'      => $value->no_hp,
                        'jumlah'     => $value->jumlah,
                        'no_rek'     => $value->no_rek,
                        'jenis_pembayaran' => $value->jenis_pembayaran,
                        'status'     => ($value->status == 0 ? 'Belum dilihat' : 'Diterima'),
                        'gambar'     => base64_decode($value->gambar),
                        'created_at' => $value->created_at,
                    );

                }

                $response = [
                    'status' => 'success',
                    'data'   => $data_p,
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

    public function inputPembayaran(Request $request) {

        if (auth()->guard('api')->check()) {

            $validator = Validator::make($request->all(), [
                'no_hp'               => 'required',
                'jumlah'              => 'required',
                'no_rek'              => 'required',
                'jenis_pembayaran'    => 'required',
                'gambar'              => 'required|mimes:jpg,JPG,jpeg,JPEG,png,PNG',
            ], [
                'no_hp.required'             => 'Nomor HP belum diisi!',
                'jumlah.required'            => 'Jumlah belum diisi!',
                'no_rek.required'            => 'Nomor rekening belum diisi!',
                'jenis_pembayaran.required'  => 'Jenis pembayaran belum diisi!',
                'gambar.required'            => 'Gambar masih kosong!',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'status'  => 'error',
                    'message' => $validator->errors(),
                ]);
            }
            
            DB::beginTransaction();
            try {
                
                $user_id = auth()->guard('api')->user()->id;

               $filename = "";
                if ($request->has('gambar')) {
                    $filename = 'pembayaran_' . mt_rand(100000, 999999) . '.' . $request->gambar->extension();
                    $request->gambar->move(public_path('/storage/pembayaran/'), $filename);
                }
                else {
                    DB::rollback();
        
                    $response = [
                        'error' => 'File yang anda upload salah'
                    ];
        
                    return response()->json($response, 200);
                    }

                $pembayaran                   = new Pembayaran;
                $pembayaran->user_id          = $user_id;
                $pembayaran->no_hp            = $request->no_hp;
                $pembayaran->jumlah           = $request->jumlah;
                $pembayaran->no_rek           = $request->no_rek;
                $pembayaran->jenis_pembayaran = $request->jenis_pembayaran;
                $pembayaran->status           = 0;
                $pembayaran->gambar           = base64_encode($filename);
        
                $pembayaran->save();

                DB::commit();
                $response = [
                    'status'   => 'success',
                    'message'  => 'Berhasil ditambahkan!',
                    'data'     => $pembayaran,
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
                'status'  => 'failed',
                'message' => 'Mohon untuk login terlebih dahulu!',
            ];
        }

        return response()->json($response, 200);
        
    }

    public function getDataById($id) {
        $data = Pembayaran::where('id', $id)->first();

        if ($data) {

                    $data_arr = array(
                        'id'        => $data->id,
                        'user_id'   => $data->user_id,
                        'no_hp'     => $data->no_hp,
                        'jumlah'    => $data->jumlah,
                        'no_rek'    => $data->no_rek,
                        'jenis_pembayaran' => $data->jenis_pembayaran,
                        'status'    => $data->status,
                        'gambar'    => base64_decode($data->gambar),
                    );
            

            $response = [
                'status' => 'success',
                'data'   => $data_arr,
            ];
        } else {
            $response = [
                'status' => 'failed',
                'data'   => [],
            ];
        }

        return response()->json($response, 200);
    }

    public function updateData(Request $request) {

        if (auth()->guard('api')->check()) {

            $validator = Validator::make($request->all(), [
                'no_hp'               => 'required',
                'jumlah'              => 'required',
                'no_rek'              => 'required',
                'jenis_pembayaran'    => 'required',
                'gambar'              => 'required|mimes:jpg,JPG,jpeg,JPEG,png,PNG',
            ], [
                'no_hp.required'             => 'Nomor HP belum diisi!',
                'jumlah.required'            => 'Jumlah belum diisi!',
                'no_rek.required'            => 'Nomor rekening belum diisi!',
                'jenis_pembayaran.required'  => 'Jenis pembayaran belum diisi!',
                'gambar.required'            => 'Gambar masih kosong!',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'status'  => 'error',
                    'message' => $validator->errors(),
                ]);
            }
            
            DB::beginTransaction();
            try {
                
                $user_id = auth()->guard('api')->user()->id;

               $filename = "";
                if ($request->has('gambar')) {
                    $filename = 'pembayaran_' . mt_rand(100000, 999999) . '.' . $request->gambar->extension();
                    $request->gambar->move(public_path('/storage/pembayaran/'), $filename);
                }
                else {
                    DB::rollback();
        
                    $response = [
                        'error' => 'File yang anda upload salah'
                    ];
        
                    return response()->json($response, 200);
                    }

                $pembayaran = Pembayaran::where('id', $request->pembayaran_id)
                ->update([

                    'user_id'          => $user_id,
                    'no_hp'            => $request->no_hp,
                    'jumlah'           => $request->jumlah,
                    'no_rek'           => $request->no_rek,
                    'jenis_pembayaran' => $request->jenis_pembayaran,
                    'status'           => 0,
                    'gambar'           => base64_encode($filename),

                ]);

                DB::commit();
                $response = [
                    'status'   => 'success',
                    'message'  => 'Berhasil diubah!',
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

    public function delete(Request $request) {
        $data = Pembayaran::find($request->id)->first();
        $data->delete();

        $response = [
            'status' => 'success',
            'message' => 'Berhasil hapus data!'
        ];

        return response()->json($response, 200);
    }
}
