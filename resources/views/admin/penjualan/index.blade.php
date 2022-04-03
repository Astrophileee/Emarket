@include('admin.partials.header')

<!-- sidebar menu -->
@include('admin.partials.sidebar')
<!-- /sidebar menu -->

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Penjualan</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-secondary" type="button">Go!</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <a href="/admin/penjualan/create" type="button" class="btn btn-success"><span class="fw-bold me-1">&plus;</span> Tambah</a>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="tablePenjualan" class="table table-striped table-bordered"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>No Faktur</th>
                                                <th>Tanggal Faktur</th>
                                                <th>Total Bayar</th>
                                                <th>Nama Pelanggan</th>
                                                <th>Operator</th>
                                                <th>Menu</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($penjualan as $p)
                                                <tr>
                                                    <td>
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td>
                                                        {{ $p->no_faktur }}
                                                    </td>
                                                    <td>
                                                        {{ $p->tgl_faktur }}
                                                    </td>
                                                    <td>
                                                        {{ $p->total_bayar }}
                                                    </td>
                                                    <td>
                                                        {{$p->pelanggan ? $p->pelanggan->nama : '-' }}
                                                    </td>
                                                    <td>
                                                        Rp.{{ $p->user->name }}
                                                    </td>
                                                    <td>
                                                        <button type="button" class="button-lihat-detail btn btn-sm btn-info mr-1" title="Lihat Detail" data-toggle="modal" data-target="#exampleModal" data-penjualan-id="{{ $p->id }}" data-no-faktur="{{ $p->no_faktur }}">Lihat Detail</button>
                                                    </td>
                                                    </tr>
                                            @endforeach
                                        </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


         <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Detail Penjualan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-4 mt-2 text-right">
                <b>Kode penjualan : </b><span class="ml-2 badge badge-success kode-penjualan"></span>
            </div>
            <table id="tableDetailPenjualan" class="table table-striped table-sm">
                <thead>
                    <th>#</th>
                    <th>Kode Barang</th>
                    <th>Harga Jual</th>
                    <th>Jumlah</th>
                    <th>Sub Total</th>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
      </div>
    </div>
  </div>


        @push('script')

        <script>
            let table;
            let tableDetailPembelian;
        
            $(function() {
                table = $('#tablePenjualan').DataTable({
                    paging: true,
                    lengthChange: true,
                    searching: true,
                    ordering: true,
                    responsive: true,
                    autoWidth: true,
                   
                });
        
                tableDetailPenjualan = $('#tableDetailPenjualan').DataTable({
                    paging: true,
                    lengthChange: true,
                    searching: true,
                    ordering: true,
                    columns: [{
                            data: 'DT_RowIndex',
                        },
                        {
                            data: 'kode_barang'
                        },
                        {
                            data: 'harga_jual'
                        },
                        {
                            data: 'jumlah'
                        },
                        {
                            data: 'sub_total'
                        }
                    ]
                });
            });
        
            $('#tablePenjualan').on('click', '.button-lihat-detail', function() {
                let id_penjualan = $(this).data('penjualan-id');
                let no_faktur = $(this).data('no-faktur');
                $('span.kode-penjualan').text(no_faktur);
                tableDetailPenjualan.ajax.url(`/penjualan/detail/data/${id_penjualan}`).load();
                console.log(id_penjualan)
            })
        </script>

            @if (session()->has('success'))
                <script>
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Pembelian Telah DiTambahkan',
                        showConfirmButton: false,
                        timer: 1500
                    })
                </script>
            @endif


            @if ($errors->any())
            <script>
                $(function(){
                    $('#exampleModal').modal('show');
                })
            </script>
            @endif
        @endpush
        @include('admin.partials.footer')
