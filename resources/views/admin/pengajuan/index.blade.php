@include('admin.partials.header')

<!-- sidebar menu -->
@include('admin.partials.sidebar')
<!-- /sidebar menu -->

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Pengajuan</h3>
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
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                <span class="fw-bold me-1">&plus;</span> Tambah
                            </button>
                            <a class="btn btn-success mr-2" href="{{ route('pengajuan.excel') }}"
                        target="_blank"><i class="fas fa-file-excel mr-2"></i><span style="color: white">Export EXCEL</span></a>
                        </ul>
                            <a class="btn btn-danger mr-2" href="{{ route('pengajuan.pdf') }}"
                        target="_blank"><i class="fas fa-file-pdf mr-2"></i><span>Export PDF</span></a>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama Pengajuan</th>
                                                <th>Nama Barang</th>
                                                <th>Tanggal Pengajuan</th>
                                                <th>Jumlah</th>
                                                <th>Terpenuhi</th>
                                                <th>Menu</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pengajuan as $p)
                                                <tr>
                                                    <td>
                                                        {{ $p->id }}
                                                    </td>
                                                    <td>
                                                        {{ $p->pelanggan->nama }}
                                                    </td>
                                                    <td>
                                                        {{ $p->nama_barang }}
                                                    </td>
                                                    <td>
                                                        {{ $p->tgl_pengajuan }}
                                                    </td>
                                                    <td>
                                                        {{ $p->jumlah }}
                                                    </td>
                                                    <td>
                                                        <div class="form-check form-switch">
                                                            <input class="terpenuhi form-check-input switch-xl" type="checkbox" role="switch" id="flexSwitchCheckDefault" style="height: 35px; width: 100%;" {{ $cek = ($p->terpenuhi==1?"checked":"") }}>
                                                          </div>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#exampleModal{{ $p->id }}">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <div class="modal fade" id="exampleModal{{ $p->id }}"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <form action="{{ route('pengajuan.update', $p->id) }}"
                                                                        method="POST" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="createTugasModalLabel">Edit Barang</h5>
                                                                                 <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body text-start">
                                                                                <input type="hidden" class="form-control" id="id" name="id" value="{{ old('id') ?? $p->id }}">       

                                                                            <div class="form-group">
                                                                                <label for="title"> <b> Nama Pengajuan:  {{ $p->pelanggan->nama }}</b> </label>       
                                                                            </div>
                                                                            <div class="form-floating mb-4">
                                                                                <select class="form-select" name="pelanggan_id" id="pelanggan_id"
                                                                                    aria-label="Default select example">
                                                                                    @foreach ($pelanggan as $d)
                                                                                        <option value="{{$d->id }}" @if($d->pelanggan_id == $d->id) selected @endif>{{ $d->nama }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                          </div>
                                                                              <div class="form-floating mb-4">
                                                                                <input type="text" class="form-control" id="nama_barang" name="nama_barang"
                                                                                placeholder="Nama Barang" value="{{ old('nama_barang') ?? $p->nama_barang }}">
                                                                            <label class="form-floating" for="title">Nama Barang</label>
                                                                              </div>
                                                                                    <div class="form-floating mb-4">
                                                                                        <input type="date" class="form-control" id="tgl_pengajuan" name="tgl_pengajuan" placeholder="tanggal Pengajuan"
                                                                                            value="{{ old('tgl_pengajuan') ?? $p->tgl_pengajuan }}">
                                                                                        <label class="form-floating" for="title">tanggal Pengajuan</label>
                                                                                    </div>
                                                                                    <div class="form-floating mb-4">
                                                                                        <input type="number" class="form-control" id="jumlah" name="jumlah"
                                                                                            placeholder="Jumlah" value="{{ old('jumlah') ?? $p->jumlah }}">
                                                                                        <label class="form-floating" for="title">Jumlah</label>
                                                                                    </div>

                                                                        </div>
                                                                        <div class="card-footer">
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Submit</button>
                                                                        </div>
                                                                </div>
                                                                @method('PATCH')
                                                                </form>
                                                            </div>
                                                        </div>
                                </div>


                                <form action="{{ route('pengajuan.destroy', $p->id) }}" class="d-inline deleted"
                                    method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger delete-barang">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
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



        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('pengajuan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="createTugasModalLabel">Pengajuan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                ariar-label="Close"></button>
                        </div>
                        <div class="modal-body text-start">
                            <div class="form-floating mb-4">
                                <select class="form-select" name="pelanggan_id" id="pelanggan_id"
                                    aria-label="Default select example">
                                    @foreach ($pelanggan as $p)
                                        <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" id="nama_barang" name="nama_barang"
                                    placeholder="Nama Barang" value="{{ old('nama_barang') }}">
                                <label class="form-floating" for="title">Nama Barang</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="date" class="form-control" id="tgl_pengajuan" name="tgl_pengajuan" placeholder="Tanggal Pengajuan"
                                    value="{{ old('tgl_pengajuan') }}">
                                <label class="form-floating" for="title">Tanggal Pengajuan</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="number" class="form-control" id="jumlah" name="jumlah"
                                    placeholder="Jumlah" value="{{ old('jumlah') }}">
                                <label class="form-floating" for="title">Jumlah</label>
                            </div>
                            <button type="submit" class="btn btn-primary added-produk">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- /page content -->

        @push('script')
        <script>
            $('#datatable').on('click','.terpenuhi',function(){
                let ID = $(this).closest('tr').find('td:eq(0)').text()
                let checked = ($(this).closest('tr').find('.terpenuhi').is(':checked')?1:0)
                let data = {id:ID,
                            terpenuhi : checked,
                            _token: "{{ csrf_token() }}"};
                $.post('{{ route("terpenuhi") }}', data, function(res){
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: res.msg,
                        showConfirmButton: false,
                        timer: 1500
                    })
                }).fail(()=>{ Swal.fire({
                    toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: 'Pengajuan gagal DiTarik',
                        showConfirmButton: false,
                        timer: 1500
                    }) })
            })
        </script>
            <script>
                $('.delete-barang').click(function(e) {
                    e.preventDefault()
                    let data = $(this).closest('tr').find('td:eq(1)').text()
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            $(e.target).closest('form').submit()
                        }
                    })
                })
            </script>

            @if (session()->has('success'))
                <script>
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Pengajuan Telah DiTambahkan',
                        showConfirmButton: false,
                        timer: 1500
                    })
                </script>
            @endif
            @if (session()->has('edited'))
                <script>
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Pengajuan Telah DiEdit',
                        showConfirmButton: false,
                        timer: 1500
                    })
                </script>
            @endif
            @if (session()->has('success'))
                <script>
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Data Telah Ditarik',
                        showConfirmButton: false,
                        timer: 1500
                    })
                </script>
            @endif
        @endpush
        @include('admin.partials.footer')
