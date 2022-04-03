    @include('admin.partials.header')

    <!-- sidebar menu -->
    @include('admin.partials.sidebar')
    <!-- /sidebar menu -->

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Supplier</h3>
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
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <span class="fw-bold me-1">&plus;</span> Tambah
                                </button>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-box table-responsive">
                                        <table id="datatable" class="table table-striped table-bordered"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Kode Pemasok</th>
                                                    <th>Nama Pemasok</th>
                                                    <th>Alamat</th>
                                                    <th>Kota</th>
                                                    <th>No Telpon</th>
                                                    <th>Menu</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pemasok as $p)
                                                    <tr>
                                                        <td>
                                                            {{ $loop->iteration }}
                                                        </td>
                                                        <td>
                                                            {{ $p->kode_pemasok }}
                                                        </td>
                                                        <td>
                                                            {{ $p->nama_pemasok }}
                                                        </td>
                                                        <td>
                                                            {{ $p->alamat }}
                                                        </td>
                                                        <td>
                                                            {{ $p->kota }}
                                                        </td>
                                                        <td>
                                                            {{ $p->no_telp }}
                                                        </td>
                                                        <td>
                                                            <button type="button" class="btn btn-primary"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal{{ $p->id }}">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <div class="modal fade"
                                                                id="exampleModal{{ $p->id }}" tabindex="-1"
                                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <form
                                                                            action="{{ route('pemasok.update', $p->id) }}"
                                                                            method="POST" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="createTugasModalLabel"> Edit Pemasok
                                                                                </h5>
                                                                                <button type="button"
                                                                                    class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body text-start">
                                                                                <input type="hidden" class="form-control" id="id" name="id" value="{{ old('id') ?? $p->id }}">

                                                                                <div class="form-group">
                                                                                    <label for="title"> <b> Kode Pemasok:  {{ $p->kode_pemasok }}</b> </label>       
                                                                                  </div>

                                                                                  <div class="form-floating mb-4">
                                                                                    <input type="text" class="form-control" id="nama_pemasok" name="nama_pemasok"
                                                                                        placeholder="Nama Pemasok" value="{{ old('nama_pemasok') ?? $p->nama_pemasok }}">
                                                                                    <label class="form-floating" for="title">Nama Pemasok</label>
                                                                                </div>
                                                                                <div class="form-floating mb-4">
                                                                                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat"
                                                                                        value="{{ old('alamat') ?? $p->alamat }}">
                                                                                    <label class="form-floating" for="title">Alamat</label>
                                                                                </div>
                                                                                <div class="form-floating mb-4">
                                                                                    <input type="text" class="form-control" id="kota" name="kota"
                                                                                        placeholder="Kota" value="{{ old('kota') ?? $p->kota }}">
                                                                                    <label class="form-floating" for="title">Kota</label>
                                                                                </div>
                                                                                <div class="form-floating mb-4">
                                                                                    <input type="number" class="form-control" id="no_telp" name="no_telp" placeholder="no Telpo"
                                                                                        value="{{ old('no_telp') ?? $p->no_telp }}">
                                                                                    <label class="form-floating" for="title">no Telpo</label>
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


                                    <form action="{{ route('pemasok.destroy', $p->id) }}" class="d-inline deleted"
                                        method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger delete-produk">
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
                        <form action="{{ route('pemasok.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="createTugasModalLabel">Pemasok</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-start">

                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control" id="nama" name="nama_pemasok"
                                        placeholder="Nama Pemasok" value="{{ old('nama_pemasok') }}">
                                    <label class="form-floating" for="title">Nama Pemasok</label>
                                    @error('nama_pemasok')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control" id="nama" name="alamat"
                                        placeholder="Alamat" value="{{ old('alamat') }}">
                                    <label class="form-floating" for="title">Alamat</label>
                                    @error('alamat')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control" id="nama" name="kota"
                                        placeholder="Kota" value="{{ old('kota') }}">
                                    <label class="form-floating" for="title">Kota</label>
                                    @error('kota')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control" id="nama" name="no_telp"
                                        placeholder="No Telpon" value="{{ old('no_telp') }}">
                                    <label class="form-floating" for="title">No Telpon</label>

                                    @error('no_telp')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary added-produk">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /page content -->

            @push('script')
                <script>
                    $('.delete-produk').click(function(e) {
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
                            title: 'Pemasok Telah DiTambahkan',
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
                            title: 'Pemasok Telah DiEdit',
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
