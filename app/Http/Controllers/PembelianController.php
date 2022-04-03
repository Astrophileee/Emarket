<?php

namespace App\Http\Controllers;
use App\Models\Barang;
use App\Models\Pemasok;
use App\Models\Pembelian;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\User;
use Yajra\DataTables\Facades\DataTables;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function data()
    {
        $pembelian = Pembelian::with('detail')->latest()->get();

        return DataTables::of($pembelian)
            ->addIndexColumn()
            ->addColumn('total_bayar', function ($pembelian) {
                return 'Rp ' . number_format($pembelian->total);
            })
            ->addColumn('nama_user', function ($pembelian) {
                return $pembelian->user->name;
            })
            ->addColumn('total_barang', function ($pembelian) {
                return $pembelian->detail->count();
            })
            ->addColumn('nama_pemasok', function ($pembelian) {
                return $pembelian->pemasok->nama_pemasok;
            })
            ->addColumn('action', function ($pembelian) {
                $buttons = '<button type="button" class="button-lihat-detail btn btn-sm btn-info mr-1" title="Lihat Detail" data-toggle="modal" data-target="#modalDetailPembelian" data-pembelian-id="' . $pembelian->id . '" data-kode-pembelian="' . $pembelian->kode_masuk . '">Lihat Detail</button>';
                return $buttons;
            })->rawColumns(['action'])->make(true);
    }

    public function detail_data($id)
    {
        $pembelian = Pembelian::with('detailPembelian')->find($id);
        $detail = $pembelian->detailPembelian;


        return DataTables::of($detail)
            ->addIndexColumn()
            ->addColumn('kode_barang', function ($detail) {
                return $detail->barang->kode_barang;
            })
            ->addColumn('nama_barang', function ($detail) {
                return $detail->barang->nama_barang;
            })
            ->addColumn('jenis_produk', function ($detail) {
                return $detail->barang->produk->nama_produk;
            })
            ->editColumn('harga_beli', function ($detail) {
                return 'Rp ' . number_format($detail->harga_beli);
            })
            ->editColumn('sub_total', function ($detail) {
                return 'Rp ' . number_format($detail->sub_total);
            })->make(true);
    }


     
    public function index()
    {
        return view('admin.pembelian.index',[
            'pembelian' => Pembelian::all(),
            'pemasok' => Pemasok::all(),
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
        return view('admin.pembelian.create',[
            'pembelian' => Pembelian::all(),
            'pemasok' => Pemasok::all(),
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
        $request->validate([
            'pemasok_id' => 'required',
            'barang_id' =>'required',
            'tanggal_masuk' =>'required'
        ]);

        $kode_beli = Pembelian::get_code();
        $tanggal_masuk = $request->tanggal_masuk;
        $pemasok_id = $request->pemasok_id;
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

            $pembelian = Pembelian::create([
                'kode_masuk' => $kode_beli,
                'tanggal_masuk' => $tanggal_masuk,
                'pemasok_id' => $pemasok_id,
                'user_id' => $user_id,
                'total' => $total_harga,

            ]);

            foreach ($arr_barang_id as $index => $barang_id) {
                $harga_jual = (int) $request->harga_jual[$index] ?? 0;
                $jumlah = (int) $request->qty[$index] ?? 0;
                if ($jumlah !== 0){
                    $detail = $pembelian->detailPembelian()->create([
                        'barang_id' => $barang_id,
                        'harga_beli' => $harga_jual,
                        'jumlah' => $jumlah,
                        'sub_total' => $harga_jual * $jumlah
                    ]);
                    $detail->barang()->increment('stok', $jumlah);
                }
            };
            return redirect('admin/pembelian')->with('success','success');
        
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
