<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Exports\HafalanExport;
use App\Exports\PresensiExport;
use App\Exports\PencatatanExport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class MuridController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() {

        $item = User::where('status', 0)->paginate(10);

        return view('admin.murid.index', compact('item'));
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
            'januari'  => $januari,
            'februari' => $februari,
            'maret'    => $maret,
            'april'    => $april,
            'mei'      => $mei,
            'juni'     => $juni,
            'juli'     => $juli,
            'agustus'  => $agustus,
            'september' => $september,
            'oktober'   => $oktober,
            'november'  => $november,
            'desember'  => $desember,
        );

        $data_mengaji = array(
            
            'data_mengaji_ulang'  => DB::table('pencatatans')->where('murid_id', $id)->where('hasil', 0)->whereMonth('tanggal', date('m'))->get()->count(),
            'data_mengaji_cukup'  => DB::table('pencatatans')->where('murid_id', $id)->where('hasil', 1)->whereMonth('tanggal', date('m'))->get()->count(),
            'data_mengaji_lanjut' => DB::table('pencatatans')->where('murid_id', $id)->where('hasil', 2)->whereMonth('tanggal', date('m'))->get()->count(),
        );

        $data_hafalan = array(

            'data_hafalan_1'  => DB::table('hafalans')->where('murid_id', $id)->where('jenis', 0)->whereMonth('tanggal_hafalan', date('m'))->get()->count(),
            'data_hafalan_2'  => DB::table('hafalans')->where('murid_id', $id)->where('jenis', 1)->whereMonth('tanggal_hafalan', date('m'))->get()->count(),
        );
        
        // dd($data_mengaji);

        $data = User::findOrFail($id);

        return view('admin.murid.detail', compact('data', 'dataPresensi', 'data_mengaji', 'data_hafalan'));
    }

    public function createPage() {
        return view('admin.murid.create');
    }

    public function delete($id) {

        $murid = User::findOrFail($id);

        if ($murid) {
            $murid->delete();
        }

        return redirect()->route('admin.murid')->with(['success', 'Data murid' .  $murid->name . 'berhasil dihapus']);
    }

     public function exportPresensi(Request $request, $id) {

        $nama_user = User::findOrFail($id);
        $param = array('id' => $id, 'tanggal_awal' => $request->tanggal_awal, 'tanggal_akhir' => $request->tanggal_akhir);
        return Excel::download(new PresensiExport($param), 'Presensi_'.$nama_user->name.'.xlsx');
    }

    public function exportHafalan(Request $request, $id) {

        $nama_user = User::findOrFail($id);
        $param = array('id' => $id, 'tanggal_awal' => $request->tanggal_awal, 'tanggal_akhir' => $request->tanggal_akhir);
        return Excel::download(new HafalanExport($param), 'Hafalan_'.$nama_user->name.'.xlsx');
    }
}
