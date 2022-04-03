<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\produk;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.barang.index',[
            'barang' => Barang::all(),
            'produk' => produk::all()
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
        $kode_barang = Barang::get_code();
        $barangs = Barang::create([
            'kode_barang' => $kode_barang,
            'produk_id' => $request->produk_id,
            'nama_barang' => $request->nama_barang,
            'satuan' => $request->satuan,
            'harga_jual' => $request->harga_jual,
            'stok' => $request->stok
        ]);
        return redirect('admin/barang')->with('success','success');
    }

    public function updateDitarik(Request $request){
        $data = Barang::where('kode_barang',$request->kode_barang)->first();
        $data->ditarik = $request->ditarik;
        $update = $data->save();

        if($update){
            $msg = $data->ditarik==1?"Barang Berhasil Ditarik":"Barang Dikembalikan";
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
        $barangs = Barang::findOrFail($id);
        $barangs ->update([
            'produk_id' => $request->produk_id,
            'nama_barang' => $request->nama_barang,
            'satuan' => $request->satuan,
            'harga_jual' => $request->harga_jual,
            'stok' => $request->stok
        ]);
        return redirect('admin/barang')->with('edited','edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();
        return redirect('admin/barang');
    }
}
