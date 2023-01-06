<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Pencatatan;
use Illuminate\Http\Request;
use App\Exports\MengajarExport;
use App\Exports\PresensiExport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;


class GuruController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() {

        $item = User::where('status', 1)->paginate(10);

        return view('admin.guru.index', compact('item'));
    }

    public function detail($id) {
        $januari = DB::table('presensis')->where('user_id', $id)->whereMonth('tanggal_masuk', '01')->get()->count(); 
        $februari = DB::table('presensis')->where('user_id', $id)->whereMonth('tanggal_masuk', '02')->get()->count(); 
        $maret = DB::table('presensis')->where('user_id', $id)->whereMonth('tanggal_masuk', '03')->get()->count(); 
        $april = DB::table('presensis')->where('user_id', $id)->whereMonth('tanggal_masuk', '04')->get()->count(); 
        $mei = DB::table('presensis')->where('user_id', $id)->whereMonth('tanggal_masuk', '05')->get()->count(); 
        $juni = DB::table('presensis')->where('user_id', $id)->whereMonth('tanggal_masuk', '06')->get()->count(); 
        $juli = DB::table('presensis')->where('user_id', $id)->whereMonth('tanggal_masuk', '07')->get()->count(); 
        $agustus = DB::table('presensis')->where('user_id', $id)->whereMonth('tanggal_masuk', '08')->get()->count(); 
        $september = DB::table('presensis')->where('user_id', $id)->whereMonth('tanggal_masuk', '09')->get()->count(); 
        $oktober = DB::table('presensis')->where('user_id', $id)->whereMonth('tanggal_masuk', '10')->get()->count(); 
        $november = DB::table('presensis')->where('user_id', $id)->whereMonth('tanggal_masuk', '11')->get()->count(); 
        $desember = DB::table('presensis')->where('user_id', $id)->whereMonth('tanggal_masuk', '12')->get()->count(); 

        $dataPresensi = array(
            'januari'   => $januari,
            'februari'  => $februari,
            'maret'     => $maret,
            'april'     => $april,
            'mei'       => $mei,
            'juni'      => $juni,
            'juli'      => $juli,
            'agustus'   => $agustus,
            'september' => $september,
            'oktober'   => $oktober,
            'november'  => $november,
            'desember'  => $desember,
        );

        $data_mengajar = array(      
            'data_mengajar_ulang'  => Pencatatan::select('pencatatans.*', 'users.name as nama_user')->join('users', 'pencatatans.murid_id', '=', 'users.id')->where('pencatatans.guru_id', $id)->where('users.tingkatan', 'Awal')->whereMonth('tanggal', date('m'))->get()->count(),
            'data_mengajar_cukup'  => Pencatatan::select('pencatatans.*', 'users.name as nama_user')->join('users', 'pencatatans.murid_id', '=', 'users.id')->where('pencatatans.guru_id', $id)->where('users.tingkatan', 'Lanjut')->whereMonth('tanggal', date('m'))->get()->count(),
            'data_mengajar_lanjut' => Pencatatan::select('pencatatans.*', 'users.name as nama_user')->join('users', 'pencatatans.murid_id', '=', 'users.id')->where('pencatatans.guru_id', $id)->where('users.tingkatan', 'Lancar')->whereMonth('tanggal', date('m'))->get()->count(),
        );

        $data_hafalan = array(
            'data_hafalan_1'  => DB::table('hafalans')->where('guru_id', $id)->where('jenis', 1)->whereMonth('tanggal_hafalan', date('m'))->get()->count(),
            'data_hafalan_2'  => DB::table('hafalans')->where('guru_id', $id)->where('jenis', 2)->whereMonth('tanggal_hafalan', date('m'))->get()->count(),
        );

        $data = User::where('id', $id)->first();
        return view('admin.guru.detail', compact('data', 'dataPresensi', 'data_mengajar', 'data_hafalan'));
    }

    public function createPage() {
        return view('admin.guru.create');
    }

    public function delete($id) {
        
        $guru = User::findOrFail($id);

        if ($guru) {
            $guru->delete();
        }

        return redirect()->route('admin.guru')->with(['success', 'Data guru' .  $guru->name . 'berhasil dihapus']);
    }

    public function exportMengajar(Request $request, $id) {
        $nama_user = User::findOrFail($id);
        $param = array('id' => $id, 'tanggal_awal' => $request->tanggal_awal, 'tanggal_akhir' => $request->tanggal_akhir);
        return Excel::download(new MengajarExport($param), 'Mengajar_'.$nama_user->name.'.xlsx');
    }
}
