<?php

namespace App\Http\Controllers\Admin;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;


class AgendaController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {

        $item = DB::table('agendas')->paginate(10);
        return view('admin.agenda.index', compact('item'));

    }

    public function detail($id) {

        $data = Agenda::findOrFail($id);
        return view('admin.agenda.detail', compact('data'));
    }

    public function createPage() {

        return view('admin.agenda.create');
    }

    public function create(Request $request) {

        $validator = Validator::make($request->all(), [
            'nama_agenda'       => 'required',
            'deskripsi_agenda'  => 'required',
            'tanggal_agenda'    => 'required',
            'gambar'            => 'required|mimes:jpg,JPG,jpeg,JPEG,png,PNG',
        ], [
            'nama_agenda.required'      => 'Nama agenda belum diisi!',
            'deskripsi_agenda.required' => 'Deskripsi agenda belum diisi!',
            'tanggal_agenda.required'   => 'Tanggal agenda belum diisi!',
            'gambar.required'           => 'Gambar belum diisi!',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.agenda-create-page')->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {

            $filename = "";
            if ($request->has('gambar')) {
                $filename = 'agenda_' . mt_rand(100000, 999999) . '.' . $request->gambar->extension();
                $request->gambar->move(public_path('/storage/agenda/'), $filename);
              }
              else {
                  DB::rollback();
      
                  $response = [
                      'error' => 'File yang anda upload salah'
                  ];
      
                  return redirect()->route('admin.agenda-create-page')->with($response);
                }
            
            $agenda                      = new Agenda;
            $agenda->nama_agenda         = $request->nama_agenda;
            $agenda->deskripsi_agenda    = $request->deskripsi_agenda;
            $agenda->tanggal_agenda      = $request->tanggal_agenda;
            $agenda->gambar              = base64_encode($filename);

            $agenda->save();

            DB::commit();
            return redirect()->route('admin.agenda')->with(['success' => 'Data Agenda '.$agenda->nama_agenda. ' Berhasil disimpan']);;
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.agenda')->withErrors($e->getMessage());
        }
    }

    public function updatePage($id) {

        $data = Agenda::findOrFail($id);
        return view('admin.agenda.update', compact('data'));

    }

    public function update(Request $request, $id) {

        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'nama_agenda'       => 'required',
            'deskripsi_agenda'  => 'required',
            'tanggal_agenda'    => 'required',
            'gambar'            => 'mimes:jpg,JPG,jpeg,JPEG,png,PNG',
        ], [
            'nama_agenda.required'      => 'Nama agenda belum diisi!',
            'deskripsi_agenda.required' => 'Deskripsi agenda belum diisi!',
            'tanggal_agenda.required'   => 'Tanggal agenda belum diisi!',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.agenda-update-page', $id)->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $agenda = Agenda::where('id', $id)->first();

            $filename = "";
            if (!empty($request->file('gambar'))) {

                $file       = $request->file('gambar');
                $extension  = $file->getClientOriginalExtension();
                $filename   = 'agenda_' . mt_rand(100000, 999999) . '.' . $request->file('gambar')->extension();
                // $locfile = public_path() . '/storage/agenda/'.$filename;
                $file->move(public_path('/storage/agenda/'), $filename);
            
                if($agenda->gambar != ""){
                    if(file_exists(public_path() . '/storage/agenda/' . $agenda->gambar)){
                        unlink(public_path() . '/storage/agenda/' . $agenda->gambar);
                    }
                }
              } else {
                $filename = base64_decode($agenda->gambar);
              }
            

            $agenda->update([
                'nama_agenda'         => $request->nama_agenda,
                'deskripsi_agenda'    => $request->deskripsi_agenda,
                'tanggal_agenda'      => $request->tanggal_agenda,
                'gambar'              => base64_encode($filename),
            ]);

            // dd($agenda);

            DB::commit();
            return redirect()->route('admin.agenda')->with(['success' => 'Data Agenda '.$agenda->nama_agenda. ' Berhasil diubah']);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.agenda')->withErrors($e->getMessage());
        }
    }

    public function delete($id) {
        $agenda = Agenda::findOrFail($id);

        $filename = public_path('/storage/agenda/' . base64_decode($agenda->gambar));
        
        if (File::exists($filename)) {
            File::delete($filename);
        }

        $agenda->delete();

        return redirect()->route('admin.agenda')->with(['success' => 'Data Agenda '.$agenda->nama_agenda. ' Berhasil di hapus']);
    }

}
