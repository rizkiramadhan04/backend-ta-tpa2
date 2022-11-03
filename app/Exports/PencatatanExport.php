<?php

namespace App\Exports;

use App\Models\Pencatatan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PencatatanExport implements FromView
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
        $pencatatan = Pencatatan::select('pencatatans.*', 'users.name as nama')
        ->join('users', 'users.id', '=', 'pencatatans.murid_id')->where('pencatatans.murid_id', $this->id);
        if($this->tanggal_awal != "" && $this->tanggal_akhir != ""){
            $pencatatan = $pencatatan->whereBetween('pencatatans.created_at', [$this->tanggal_awal, $this->tanggal_akhir]);
        }

        return view('admin.export.pencatatan', [
            'model' => $pencatatan->get(),
        ]);
    }
}
