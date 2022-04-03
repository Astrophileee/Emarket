@include('admin.partials.header')

<!-- sidebar menu -->
@include('admin.partials.sidebar')
<!-- /sidebar menu -->

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Pembelian</h3>
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
                            <a href="/admin/pembelian/create" type="button" class="btn btn-success"><span class="fw-bold me-1">&plus;</span> Tambah</a>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="tablePembelian" class="table table-striped table-bordered"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Kode Masuk</th>
                                                <th>Operator</th>
                                                <th>Pemasok</th>
                                                <th>Tanggal</th>
                                                <th>Total</th>
                                                <th>Menu</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pembelian as $p)
                                                <tr>
                                                    <td>
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td>
                                                        {{ $p->kode_masuk }}
                                                    </td>
                                                    <td>
                                                        {{ $p->user->name }}
                                                    </td>
                                                    <td>
                                                        {{ $p->pemasok->nama_pemasok  }}
                                                    </td>
                                                    <td>
                                                        {{ $p->tanggal_masuk }}
                                                    </td>
                                                    <td>
                                                        Rp.{{ $p->total }}
                                                    </td>
                                                    <td>
                                                        <button type="button" class="button-lihat-detail btn btn-sm btn-info mr-1" title="Lihat Detail" data-toggle="modal" data-target="#exampleModal" data-pembelian-id="{{ $p->id }}" data-kode-pembelian="{{ $p->kode_masuk }}">Lihat Detail</button>
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
          <h5 class="modal-title" id="exampleModalLabel">Detail Pembelian</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-4 mt-2 text-right">
                <b>Kode Pembelian : </b><span class="ml-2 badge badge-success kode-pembelian"></span>
            </div>
            <table id="tableDetailPembelian" class="table table-striped table-sm">
                <thead>
                    <th>#</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Jenis Produk</th>
                    <th>Harga Beli</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
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
                table = $('#tablePembelian').DataTable({
                    paging: true,
                    lengthChange: true,
                    searching: true,
                    ordering: true,
                    responsive: true,
                    autoWidth: true,
                   
                });
        
                tableDetailPembelian = $('#tableDetailPembelian').DataTable({
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
                            data: 'nama_barang'
                        },
                        {
                            data: 'jenis_produk'
                        },
                        {
                            data: 'harga_beli'
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
        
            $('#tablePembelian').on('click', '.button-lihat-detail', function() {
                let id_pembelian = $(this).data('pembelian-id');
                let kode_pembelian = $(this).data('kode-pembelian');
                $('span.kode-pembelian').text(kode_pembelian);
                tableDetailPembelian.ajax.url(`/pembelian/detail/data/${id_pembelian}`).load();
                console.log(id_pembelian)
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
