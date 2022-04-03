<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pelanggan;
use App\Models\Pengajuan;
use Illuminate\Http\Request;
use App\Exports\PengajuanExport;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pengajuan.index',[
            'pengajuan' => Pengajuan::all(),
            'pelanggan' => Pelanggan::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pengajuans = Pengajuan::create([
            'pelanggan_id' => $request->pelanggan_id,
            'nama_barang' => $request->nama_barang,
            'tgl_pengajuan' => $request->tgl_pengajuan,
            'jumlah' => $request->jumlah,
        ]);
        return redirect('admin/pengajuan')->with('success','success');

        
    }
    
    public function updateTerpenuhi(Request $request){
        $data = Pengajuan::where('id',$request->id)->first();
        $data->terpenuhi= $request->terpenuhi;
        $update = $data->save();

        if($update){
            $msg = $data->terpenuhi==1?"Pengajuan Berhasil Terpenuhi":"Pengajuan Dikembalikan";
            return response()->json(['msg'=>$msg],200);
        }

            
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pengajuans = Pengajuan::findOrFail($id);
        $pengajuans ->update([
            'pelanggan_id' => $request->pelanggan_id,
            'nama_barang' => $request->nama_barang,
            'tgl_pengajuan' => $request->tgl_pengajuan,
            'jumlah' => $request->jumlah,
        ]);
        return redirect('admin/pengajuan')->with('edited','edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->delete();
        return redirect('admin/pengajuan');
    }

    public function export_excel()
	{
		return Excel::download(new PengajuanExport, 'pengajuan.xlsx');
	}
}
