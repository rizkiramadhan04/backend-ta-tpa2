<?php

namespace App\Exports;

use App\Models\Presensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PresensiExport implements FromView
{
    protected $id;
    protected $tanggal_awal;
    protected $tanggal_akhir;

    public function __construct($param) {
        $this->id            = $param['id'];
        $this->tanggal_awal  = $param['tanggal_awal'];
        $this->tanggal_akhir = $param['tanggal_akhir'];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $presensi = Presensi::select('presensis.*', 'users.name as nama')->join('users', 'users.id', '=', 'presensis.user_id')->where('user_id', $this->id);
        
        if($this->tanggal_awal != "" && $this->tanggal_akhir != ""){
            $presensi = $presensi->whereBetween('presensis.created_at', [$this->tanggal_awal, $this->tanggal_akhir]);
        }

        return view('admin.export.presensi', [
            'model' => $presensi->get(),
        ]);
    }
}
