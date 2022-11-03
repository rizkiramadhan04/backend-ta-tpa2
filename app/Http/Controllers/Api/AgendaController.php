<?php

namespace App\Http\Controllers\Api;

use App\Models\Agenda;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AgendaController extends Controller
{
    public function getData() {

        $data = Agenda::all();

        if($data) {

            foreach($data as $row) {

                $response[] = [
                    'status'           => 'success',
                    'nama_agenda'      => $row->nama_agenda,
                    'deskripsi_agenda' => $row->deskripsi_agenda,
                    'tanggal_agenda'   => $row->tanggal_agenda,
                    'gambar_agenda'    => base64_decode($row->gambar),
                ];
            }

        } else {
            $response = [
                'status'  => 'failed',
                'message' => 'Data tidak ada',
            ];
        }

        return response()->json($response, 200);
    }
}
