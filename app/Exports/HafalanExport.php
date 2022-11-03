<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Hafalan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class HafalanExport implements FromView
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
        $hafalan = Hafalan::select('hafalans.*', 'users.name as nama')
        ->join('users', 'users.id', '=', 'hafalans.murid_id')
        ->where('hafalans.murid_id', $this->id);

        if($this->tanggal_awal != "" && $this->tanggal_akhir != ""){
            $hafalan = $hafalan->whereBetween('hafalans.created_at', [$this->tanggal_awal, $this->tanggal_akhir]);
        }

        return view('admin.export.hafalan', [
            'model' => $hafalan->get(),
        ]);
    }
}
