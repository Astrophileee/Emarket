<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use App\Models\Pelanggan;
use App\Models\Pembelian;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function data()
    {
        $penjualan = Penjualan::with('detail')->latest()->get();

        return DataTables::of($penjualan)
            ->addIndexColumn()
            ->addColumn('total_bayar', function ($penjualan) {
                return 'Rp ' . number_format($penjualan->total_bayar);
            })
            ->addColumn('nama_user', function ($penjualan) {
                return $penjualan->user->name;
            })
            ->addColumn('total_barang', function ($penjualan) {
                return $penjualan->detail->count();
            })
            ->addColumn('nama_pelanggan', function ($penjualan) {
                return $penjualan->pelanggan->nama;
            })
            ->addColumn('action', function ($penjualan) {
                $buttons = '<button type="button" class="button-lihat-detail btn btn-sm btn-info mr-1" title="Lihat Detail" data-toggle="modal" data-target="#modalDetailPembelian" data-penjualan-id="' . $penjualan->id . '" data-no-faktur="' . $penjualan->no_faktur . '">Lihat Detail</button>';
                return $buttons;
            })->rawColumns(['action'])->make(true);
    }

    public function detail_data($id)
    {
        $penjualan = Penjualan::with('detailPenjualan')->find($id);
        $detail = $penjualan->detailPenjualan;


        return DataTables::of($detail)
            ->addIndexColumn()
            ->addColumn('no_faktur', function ($detail) {
                return $detail->no_faktur;
            })
            ->addColumn('kode_barang', function ($detail) {
                return $detail->barang->kode_barang;
            })
            ->editColumn('harga_jual', function ($detail) {
                return 'Rp ' . number_format($detail->harga_jual);
            })
            ->addColumn('jumlah', function ($detail) {
                return $detail->jumlah;
            })
            ->editColumn('sub_total', function ($detail) {
                return 'Rp ' . number_format($detail->sub_total);
            })->make(true);
    }

    public function index()
    {
        return view('admin.penjualan.index',[
            'penjualan' => Penjualan::all(),
            'pelanggan' => Pelanggan::all(),
            'user' => User::all(),
            'barang' => Barang::with('produk')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.penjualan.create',[
            'penjualan' => Penjualan::all(),
            'pelanggan' => Pelanggan::all(),
            'user' => User::all(),
            'barang' => Barang::with('produk')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'pelanggan_id' => 'required',
        //     'barang_id' =>'required',
        //     'tanggal_masuk' =>'required'
        // ]);

        $kode_jual = Penjualan::get_code();
        $tanggal_masuk = $request->tanggal_masuk;
        $pelanggan_id = $request->pelanggan_id;
        $user_id = 1;
        $arr_jumlah = $request->qty;
        $arr_barang_id = $request->barang_id;
        $arr_harga_jual = $request->harga_jual;
        $total_harga = collect($arr_harga_jual)->reduce(
            function($total, $harga_jual, $index) use ($arr_jumlah){
                 $harga_jual = (int) $harga_jual ?? 0;
                 $jumlah = (int) $arr_jumlah[$index] ?? 0;
                 return $total + $harga_jual * $jumlah;
            });

            $penjualan = Penjualan::create([
                'no_faktur' => $kode_jual,
                'pelanggan_id' => $pelanggan_id,
                'tgl_faktur' => $tanggal_masuk,
                'user_id' => $user_id,
                'total_bayar' => $total_harga,

            ]);

            foreach ($arr_barang_id as $index => $barang_id) {
                $harga_jual = (int) $request->harga_jual[$index] ?? 0;
                $jumlah = (int) $request->qty[$index] ?? 0;
                if ($jumlah !== 0){
                    $detail = $penjualan->detailPenjualan()->create([
                        'barang_id' => $barang_id,
                        'harga_jual' => $harga_jual,
                        'jumlah' => $jumlah,
                        'sub_total' => $harga_jual * $jumlah
                    ]);
                    $detail->barang()->increment('stok', $jumlah);
                }
            };
            return redirect('admin/penjualan')->with('success','success');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
