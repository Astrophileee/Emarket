<?php

namespace App\Http\Controllers;

use App\Models\Pemasok;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PemasokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.supplier.index',[
            'pemasok' => Pemasok::all()
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
        $kode_pemasok = Pemasok::get_code($request->nama_pemasok);
        $request->validate([
            'nama_pemasok' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'no_telp' => 'required|min:10|max:13|unique:pemasok,no_telp'
        ]);

        $pemasok = Pemasok::create([
            'kode_pemasok' => $kode_pemasok,
            'nama_pemasok' => $request->nama_pemasok,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'no_telp' => $request->no_telp
        ]);
        return redirect('admin/pemasok')->with('success','success');
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
        $pemasok = Pemasok::findOrFail($id);
        $pemasok ->update([
            'nama_pemasok' => $request->nama_pemasok,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'no_telp' => $request->no_telp
        ]);
        return redirect('admin/pemasok')->with('edited','edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Pemasok = Pemasok::findOrFail($id);
        $Pemasok->delete();
        return redirect('admin/pemasok');
    }
}
