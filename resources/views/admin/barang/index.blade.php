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
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <span class="fw-bold me-1">&plus;</span> Tambah
                            </button>
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
                                                <th>Kode Barang</th>
                                                <th>Nama Produk</th>
                                                <th>Nama Barang</th>
                                                <th>satuan</th>
                                                <th>Harga Jual</th>
                                                <th>Stok</th>
                                                <th>Ditarik</th>
                                                <th>Menu</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($barang as $b)
                                                <tr>
                                                    <td>
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td>
                                                        {{ $b->kode_barang }}
                                                    </td>
                                                    <td>
                                                        {{ $b->produk->nama_produk }}
                                                    </td>
                                                    <td>
                                                        {{ $b->nama_barang }}
                                                    </td>
                                                    <td>
                                                        {{ $b->satuan }}
                                                    </td>
                                                    <td>
                                                        {{ $b->harga_jual }}
                                                    </td>
                                                    <td>
                                                        {{ $b->stok }}
                                                    </td>
                                                    <td>
                                                        <div class="form-check form-switch">
                                                            <input class="ditarik form-check-input switch-xl" type="checkbox" role="switch" id="flexSwitchCheckDefault" style="height: 35px; width: 100%;" {{ $cek = ($b->ditarik==1?"checked":"") }}>
                                                          </div>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#exampleModal{{ $b->id }}">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <div class="modal fade" id="exampleModal{{ $b->id }}"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <form action="{{ route('barang.update', $b->id) }}"
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
                                                                                <input type="hidden" class="form-control" id="id" name="id" value="{{ old('id') ?? $b->id }}">       

                                                                            <div class="form-group">
                                                                                <label for="title"> <b> kode barang:  {{ $b->kode_barang }}</b> </label>       
                                                                              </div>
                                                                              <div class="form-floating mb-4">
                                                                                    <select class="form-select" name="produk_id" id="produk_id"
                                                                                        aria-label="Default select example">
                                                                                        @foreach ($produk as $p)
                                                                                            <option value="{{$p->id }}" @if($b->produk_id == $p->id) selected @endif>{{ $p->nama_produk }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                              </div>
                                                                                    <div class="form-floating mb-4">
                                                                                        <input type="text" class="form-control" id="nama" name="nama_barang"
                                                                                            placeholder="Nama Barang" value="{{ old('nama_barang') ?? $b->nama_barang }}">
                                                                                        <label class="form-floating" for="title">Nama Barang</label>
                                                                                    </div>
                                                                                    <div class="form-floating mb-4">
                                                                                        <input type="text" class="form-control" id="satuan" name="satuan" placeholder="Satuan"
                                                                                            value="{{ old('satuan') ?? $b->satuan }}">
                                                                                        <label class="form-floating" for="title">Satuan Barang</label>
                                                                                    </div>
                                                                                    <div class="form-floating mb-4">
                                                                                        <input type="number" class="form-control" id="harga_jual" name="harga_jual"
                                                                                            placeholder="Harga Jual" value="{{ old('harga_jual') ?? $b->harga_jual }}">
                                                                                        <label class="form-floating" for="title">Harga Jual</label>
                                                                                    </div>
                                                                                    <div class="form-floating mb-4">
                                                                                        <input type="number" class="form-control" id="stok" name="stok" placeholder="Stock"
                                                                                            value="{{ old('stok') ?? $b->stok }}">
                                                                                        <label class="form-floating" for="title">Stock</label>
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


                                <form action="{{ route('barang.destroy', $b->id) }}" class="d-inline deleted"
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
                    <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="createTugasModalLabel">Produk</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                ariar-label="Close"></button>
                        </div>
                        <div class="modal-body text-start">
                            <div class="form-floating mb-4">
                                <select class="form-select" name="produk_id" id="produk_id"
                                    aria-label="Default select example">
                                    @foreach ($produk as $p)
                                        <option value="{{ $p->id }}">{{ $p->nama_produk }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" id="nama" name="nama_barang"
                                    placeholder="Nama Barang" value="{{ old('nama_barang') }}">
                                <label class="form-floating" for="title">Nama Barang</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" id="satuan" name="satuan" placeholder="Satuan"
                                    value="{{ old('satuan') }}">
                                <label class="form-floating" for="title">Satuan Barang</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" id="harga_jual" name="harga_jual"
                                    placeholder="Harga Jual" value="{{ old('harga_jual') }}">
                                <label class="form-floating" for="title">Harga Jual</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="number" class="form-control" id="stok" name="stok" placeholder="Stock"
                                    value="{{ old('stok') }}">
                                <label class="form-floating" for="title">Stock</label>
                            </div>

                            <button type="submit" class="btn btn-primary added-produk">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- /page content -->

        @push('script')
        <script>
            $('#datatable').on('click','.ditarik',function(){
                let kodeBarang = $(this).closest('tr').find('td:eq(1)').text()
                let checked = ($(this).closest('tr').find('.ditarik').is(':checked')?1:0)
                let data = {kode_barang:kodeBarang,
                            ditarik : checked,
                            _token: "{{ csrf_token() }}"};
                $.post('{{ route("ditarik") }}', data, function(res){
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
                        title: 'Barang gagal DiTarik',
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
                        title: 'Barang Telah DiTambahkan',
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
                        title: 'Barang Telah DiEdit',
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
