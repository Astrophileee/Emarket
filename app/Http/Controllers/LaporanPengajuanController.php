<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade AS PDF;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

class LaporanPengajuanController extends Controller
{
    public function dataPengajuan(){

        $data = Pengajuan::all();
        return $data;
    }
    public function exportPengajuanPDF()
    {
        $data = $this->DataPengajuan();
        $pdf  = PDF::loadView('admin.pengajuan.pdf', compact('data'));
        $pdf->setPaper('a4', 'potrait');

        return $pdf->stream('Laporan-pendapatan-'. date('Y-m-d-his') .'.pdf');
    }
}
