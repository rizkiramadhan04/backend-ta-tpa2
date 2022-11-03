<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;

class AuthController extends Controller
{
    public function login(Request $request) {

        $validator = Validator::make($request->all(), [
            'email'     => 'required',
            'password'  => 'required'
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        $credentials = $request->only('email', 'password');

        if(!$token = auth()->guard('api')->attempt($credentials)) {
            return response()->json([
                'success' => 'failed',
                'message' => 'Email atau Password Anda salah'
            ], 401);
        }

        return response()->json([
            'success' => 'success',
            'user'    => auth()->guard('api')->user(),    
            'token'   => $token   
        ], 200);


    }

    public function getData(Request $request) {
        if (auth()->guard('api')->check()) {

            $user_id = auth()->guard('api')->user()->id;
            $user = User::where('id', $user_id)->first();

            $response = [
                'status'        => 'success',
                'nama'          => $user->name,
                'email'         => $user->email,
                'status_user'   => ($user->status == 0 ? 'Mutid' : 'Guru'),
                'tanggal_lahir' => date('d-m-Y', strtotime($user->tgl_lahir)),
                'alamat'        => $user->alamat,
                'tingkatan'     => $user->tingkatan,
                'no_hp'         => $user->no_hp,

            ];
        } else {
            $response = [
                'status'  => 'failed',
                'message' => 'Mohon untuk login untuk terlebih dahulu!'
            ];
        }

        return Response()->json($response, 200);
    }

    public function update(Request $request) {

        if (auth()->guard('api')->check()) {

            $validator = Validator::make($request->all(), [
                'name'      => 'required',
                'email'     => 'required|email|exists:users',
                'tgl_lahir' => 'required',
                'alamat'    => 'required',
                'no_hp'     => 'required',
            ],[
                'name.required'      => 'Nama belum terisi',
                'email.required'     => 'Email belum terisi',
                'tgl_lahir.required' => 'Tanggal lahir belum terisi',
                'alamat.required'    => 'Alamat belum terisi',
                'no_ho.required'     => 'Nomor HP belum terisi',
            ]);

            if ($validator->fails()) {
                response()->json([
                    'status' => 'failed',
                    'message' => $validator->errors()->first(),
                ]);
            }

            try {

                $user_id  = auth()->guard('api')->user()->id;
                $user = User::where('id', $user_id)->update([
                    'name'      => $request->name,
                    'email'     => $request->email,
                    'tgl_lahir' => $request->tgl_lahir,
                    'alamat'    => $request->alamat,
                    'no_hp'     => $request->no_hp,
                ]);

                $response = [
                    'status' => 'success',
                    'message' => 'Data berhasil diubah!',
                    'data' => auth()->guard('api')->user(),
                ];

            } catch (Exception $e) {
                $response = [
                    'status' => 'failed',
                    'message' => $e->getMessage(),
                ];
            }

        } else {
            $response = [
                'status' => 'failed',
                'message' => 'Mohon untuk login terlebih dahulu!',
            ];
        }

        return response()->json($response);
    
    }

    public function logout(Request $request) {
         //remove token
         $removeToken = JWTAuth::invalidate(JWTAuth::getToken());

         if($removeToken) {
             $response = [
                'status' => 'success',
                'message' => 'Berhasil logout!'
             ];
         } else {
            $response = [
                'status' => 'failed',
                'message' => 'Gagal logout!'
             ];
         }

         return response()->json($response, 200);
    }
}
