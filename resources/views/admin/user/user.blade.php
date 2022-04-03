@include('admin.partials.header')

<!-- sidebar menu -->
@include('admin.partials.sidebar')
<!-- /sidebar menu -->


<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>User </h3>
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
                                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Level</th>
                                                <th>Menu</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($user as $u)
                                                <tr>
                                                    <td>
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td>
                                                        {{ $u->name }}
                                                    </td>
                                                    <td>
                                                        {{ $u->email }}
                                                    </td>
                                                    <td>
                                                        {{ $u->level }}
                                                    </td>
                                                    <td>
                                <form action="{{ route('user.destroy', $u->id) }}" class="d-inline deleted"
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
                    <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="createTugasModalLabel">User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                ariar-label="Close"></button>
                        </div>
                        <div class="modal-body text-start">
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Name" value="{{ old('name') }}">
                                <label class="form-floating" for="title">Name</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="email" class="form-control" id="email" name="email" placeholder="email"
                                    value="{{ old('email') }}">
                                <label class="form-floating" for="title">Email</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Password" >
                                <label class="form-floating" for="title">Passwword</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                                    placeholder="Password_confitmation">
                                <label class="form-floating" for="title">Passwword Confirmation</label>
                            </div>
                            <div class="form-floating mb-4">
                                <select name="level" id="level">
                                    <option value="2">
                                        EDP
                                        </option>
                                    <option value="3">
                                        OPERATOR
                                        </option>
                                </select>
                                <label class="form-floating" for="title">Level</label>
                            </div>


                            <button type="submit" class="btn btn-primary added-produk">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- /page content -->

@include('admin.partials.footer')