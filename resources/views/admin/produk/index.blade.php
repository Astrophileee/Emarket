    @include('admin.partials.header')

    <!-- sidebar menu -->
    @include('admin.partials.sidebar')
    <!-- /sidebar menu -->

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Produk</h3>
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
                                                    <th>Name</th>
                                                    <th>Menu</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($produk as $p)
                                                    <tr>
                                                        <td>
                                                            {{ $loop->iteration }}
                                                        </td>
                                                        <td>
                                                            {{ $p->nama_produk }}
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
                                                                            action="{{ route('produk.update', $p->id) }}"
                                                                            method="POST" enctype="multipart/form-data">
                                                                            @csrf
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="createTugasModalLabel">Produk
                                                                                </h5>
                                                                                <button type="button"
                                                                                    class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body text-start">

                                                                                <div class="form-group">
                                                                                    <label for="title">Nama
                                                                                        Produk</label>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        id="Produk" name="nama_produk"
                                                                                        placeholder="Nama produk"
                                                                                        value="{{ old('nama_produk') ?? $p->nama_produk }}">
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

                                    @if ($p->canDelete())
                                    <form action="{{ route('produk.destroy', $p->id) }}" class="d-inline deleted"
                                        method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger delete-produk">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                        
                                    @else
                                    <button type="submit" class="btn btn-secondary delete-produk" disabled>
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    @endif
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
                        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="createTugasModalLabel">Produk</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-start">

                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control" id="nama" name="nama_produk"
                                        placeholder="Nama Produk" value="{{ old('nama_produk') }}">
                                    <label class="form-floating" for="title">Nama Produk</label>
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
                            title: 'Produk Telah DiTambahkan',
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
                            title: 'Produk Telah DiEdit',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    </script>
                @endif

            @endpush
            @include('admin.partials.footer')
