@include('admin.partials.header')

<!-- sidebar menu -->
@include('admin.partials.sidebar')
<!-- /sidebar menu -->

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Barang</h3>
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
            <a class="btn btn-danger mr-2" href="{{ route('laporan.pdf_pendapatan', [$tgl_awal, $tgl_akhir]) }}"
                        target="_blank"><i class="fas fa-file-pdf mr-2"></i><span>Export PDF</span></a>
            <form action="{{ route('laporan.pendapatan') }}" method="get">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group row align-items-center">
                            <div class="col-sm-1">
                                <label for="tglMulai">Mulai</label>
                            </div>
                            <div class="col-sm-4">
                                <input type="date" name="tgl_awal"
                                    value="{{ request('tgl_awal') ?? date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y'))) }}"
                                    id="tglAwal" class="form-control">
                            </div>
                            <div class="col-sm-1">
                                <label for="tglAkhir">s/d</label>
                            </div>
                            <div class="col-sm-4">
                                <input type="date" name="tgl_akhir"
                                    value="{{ request('tgl_akhir') ?? date('Y-m-d') }}" id="tglAkhir"
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-md-right mb-md-0 mb-4">
                        <button type="submit" class="btn btn-info btn-xs btn-flat"><i
                                class="fa fa-exchange-alt"></i> Ubah
                            Periode</button>
                    </div>
                </div>
            </form>
            <table class="table table-sm table-stiped table-bordered" style="width: 100%">
            <thead>
                <th>
                    No
                </th>
                <th>
                    Tanggal
                </th>
                <th>
                    Penjualan
                </th>
                <th>
                    pembelian
                </th>
                <th>
                    Pendapatan
                </th>
            </thead>
            </table>

        </div>
        @push('head')
        <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css" rel="stylesheet" />
        @endpush
@push('script')
    <!-- DataTables -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js">
    </script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js">
    </script>
            <script>
                let table;
        
                $(function() {
                    table = $('.table').DataTable({
                        processing: true,
                        autoWidth: false,
                        responsive: true,
                        ajax: {
                            url: '{{ route('laporan.data_pendapatan', [$tgl_awal, $tgl_akhir]) }}',
                        },
                        columns: [{
                                data: 'DT_RowIndex',
                                searchable: false,
                                sortable: false
                            },
                            {
                                data: 'tanggal'
                            },
                            {
                                data: 'penjualan'
                            },
                            {
                                data: 'pembelian'
                            },
                            {
                                data: 'pendapatan'
                            }
                        ],
                        dom: 'Brt',
                        bSort: false,
                        bPaginate: false,
                    });
                });
            </script>
@endpush


        @include('admin.partials.footer')