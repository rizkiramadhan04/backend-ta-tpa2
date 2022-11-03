<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Exports\PembayaranExport;
use Maatwebsite\Excel\Facades\Excel;

class PembayaranController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() {

        $item = Pembayaran::select('pembayarans.*', 'users.name as nama_murid')->join('users', 'pembayarans.user_id', '=', 'users.id')->paginate(10);
        return view('admin.pembayaran.index', compact('item'));
    }

    public function detail($id) {

        $data = Pembayaran::select('pembayarans.*', 'users.name as nama_murid')->join('users', 'pembayarans.user_id', '=', 'users.id')->where('pembayarans.id', $id)->first();
        // dd($data->nama_murid);
        return view('admin.pembayaran.detail', compact('data'));
    }

    public function createPage() {

        $murid = User::where('status', 0)->get();
        return view('admin.pembayaran.create', compact('murid'));
    }

    public function create(Request $request) {

        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'no_hp'             => 'required',
            'jumlah'            => 'required',
            'no_rek'            => 'required',
            'jenis_pembayaran'  => 'required',
            'gambar'            => 'required|mimes:jpg,JPG,jpeg,JPEG,png,PNG',
        ], [
            'user_id.required'          => 'Nama murid belum diisi!',
            'no_hp.required'            => 'Nomor handphone belum diisi!',
            'jumlah.required'           => 'Jumlah agenda belum diisi!',
            'no_rek.required'           => 'Nomor rekening agenda belum diisi!',
            'jenis_pembayaran.required' => 'Jenis pembayaran belum diisi!',
            'gambar.required'           => 'Gambar belum diisi!',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.pembayaran-create-page')->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {

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
      
                  return redirect()->route('admin.pembayaran-create-page')->with($response);
                }
            
            $pembayaran                    = new Pembayaran;
            $pembayaran->user_id           = $request->murid_id;
            $pembayaran->no_hp             = $request->no_hp;
            $pembayaran->jumlah            = $request->jumlah;
            $pembayaran->no_rek            = $request->no_rek;
            $pembayaran->jenis_pembayaran  = $request->jenis_pembayaran;
            $pembayaran->status            = 1;
            $pembayaran->gambar            = base64_encode($filename);
            
            $pembayaran->save();

            DB::commit();
            return redirect()->route('admin.pembayaran')->with(['success' => 'Data Pembayaran berhasil disimpan']);;
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.pembayaran')->withErrors($e->getMessage());
        }
    }

    public function delete($id) {
       
        $pembayaran = Pembayaran::findOrFail($id);

        $filename = public_path('/storage/pembayaran/' . base64_decode($pembayaran->gambar));
        
        if (File::exists($filename)) {
            File::delete($filename);
        }

        $pembayaran->delete();

        return redirect()->route('admin.pembayaran')->with(['success' => 'Data pembayaran berhasil di hapus']);
    }

    public function updateStatus($id) {

        $data = Pembayaran::findOrFail($id);

       if ($data) {
         $data->update([
            'status' => 1,
            ]);
       }

        return redirect()->route('admin.pembayaran')->with(['success' => 'Data status pembayaran berhasil diubah']);
    }

    public function export(Request $request) {

        $param = array('tanggal_awal' => $request->tanggal_awal, 'tanggal_akhir' => $request->tanggal_akhir);
        return Excel::download(new PembayaranExport($param), 'Pembayaran.xlsx');
    }
}
