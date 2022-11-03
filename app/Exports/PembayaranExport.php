<?php

namespace App\Exports;

use App\Models\Pembayaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PembayaranExport implements FromView
{
    protected $tanggal_awal;
    protected $tanggal_akhir;

    public function __construct($param) {
        $this->tanggal_awal  = $param['tanggal_awal'];
        $this->tanggal_akhir = $param['tanggal_akhir'];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $pembayaran = Pembayaran::select('pembayarans.*', 'users.name as nama')->join('users', 'users.id', '=', 'pembayarans.user_id');
        if($this->tanggal_awal != "" && $this->tanggal_akhir != ""){
            $pembayaran = $pembayaran->whereBetween('pembayarans.created_at', [$this->tanggal_awal, $this->tanggal_akhir]);
        }
        
        return view('admin.export.pembayaran', [
            'model' => $pembayaran->get(),
        ]);
    }
}
