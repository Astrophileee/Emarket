@include('admin.partials.header')

<!-- sidebar menu -->
@include('admin.partials.sidebar')
<!-- /sidebar menu -->

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Create Penjualan</h3>
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

<div class="container">
            <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    <i class="fas fa-truck-moving"></i> Pilih Member
  </button>
  <br>
  <p style="font-size:15px;">
      <b>Nama Member :</b> <span style="font-size: 15px" class="nama_pelanggan"></span>
  </p>
  <p style="font-size:15px;">
    <b>No Telpon :</b><span style="font-size: 15px" class="no_telp"></span>
  </p>
<p style="font-size:15px;">
    <b>Alamat :</b><span style="font-size: 15px" class="alamat"></span>
</p>

<form class="form-horizontal form-label-left input_mask" action="{{ route('penjualan.store') }}" id="formTransaksi" method="POST">
    @csrf
    <input type="hidden" class="pelanggan_id" name="pelanggan_id">
    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
        <label class="control-label col-md-6 col-sm-6 col-xs-12">Tanggal Penjualan</label>
        <div class="col-md-6 col-sm-12 col-xs-12">
            <input type="date" class="data-picker form-control col-md-12 col-xs-12" name="tanggal_masuk" required value="{{ date('Y-m-d') }}">
        </div>
    </div>


<div class="row" style="font-size: 15px">
    <div class="col-md-2"><b>Barang : </b> </div>
    <div class="input-group mb-3 col-md-6">
        <input type="text" class="form-control" placeholder="Kode barang" aria-label="Recipient's username" aria-describedby="button-addon2">
        <button class="btn button-pilih-barang btn-outline-success" type="button" id="button-addon2" data-bs-toggle="modal" data-bs-target="#exampleModalBarang">Pilih</button>
      </div>
    </div>

    <table id="tblTransaksi" class="table table-sm table-bordered">
        <thead>
            <th>Kode</th>
            <th>Nama</th>
            <th>harga Beli</th>
            <th>QTY</th>
            <th>Total</th>
            <th><i class="fas fa-cog"></i></th>
        </thead>
        <tbody>

        </tbody>
    </table>

    <div class="row" style="text-align: right;margin-bottom:10px">
        <div class="col-md-12">
            <div class="col-md-12 col-xs-12 col-md-offset-6" style="text-align: right">
            <label for="" class="control-label col-md-3 col-sm-6 col-xs-12">Total Harga</label>
                <div class="col-md-3 col-sm-3 col-xs-12" style="text-align: right; margin-right:0;padding-right:0;">
                    <input class="form-control col-md-6 col-xs-12" required id="totalHarga" name="total" type="text" disabled>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-6 col-xs-12" style="text-align: right; margin-right:0;padding-right:0;">
            <div class="col-md-12 col-sm-9 col-xs-12">
                <button type="submit" class="btn btn-success">Simpan Transaksi</button>
            </div>
        </div>
    </div>

</div>


<!-- Modal -->
<div class="modal fade" id="exampleModalBarang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="x-content">
              <div class="row">
                  <div class="col-sm-12">
                      <div class="card-box table-responsive">
                          <table id="tablePilihBarang" class="table table-striped table-bordered" style="width: 100%">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Kode Barang</td>
                                <td>Nama Barang</td>
                                <td>Jenis Produk</td>
                                <td>Harga Jual</td>
                                
                                <td>Menu</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($barang as $b)
                            <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $b->kode_barang }}
                            </td>
                            <td>
                                {{ $b->nama_barang }}
                            </td>
                            <td>
                                {{ $b->produk->nama_produk }}
                            </td>
                            <td>
                                {{ $b->harga_jual }}
                            </td>
                            <td>
                                <button type="button" class="pilihBarangBtn btn btn-primary" data-barang-id="{{$b->id}}" data-bs-dismiss="modal">
                                  <span class="fw-bold me-1">&plus;</span> Pilih
                                </button>
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
    </div>
  </div>
</form>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Pilih Member</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <table id="datatable" class="table table-striped table-bordered"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kode Member</th>
                                        <th>Nama Member</th>
                                        <th>Alamat</th>
                                        <th>No Telpon</th>
                                        <th>Email</th>
                                        <th>Menu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pelanggan as $p)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                {{ $p->kode_pelanggan }}
                                            </td>
                                            <td>
                                                {{ $p->nama }}
                                            </td>
                                            <td>
                                                {{ $p->alamat }}
                                            </td>
                                            <td>
                                                {{ $p->no_telp }}
                                            </td>
                                            <td>
                                                {{ $p->email }}
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary" onclick="changePembelian(event)" data-id="{{ $p->id }}" data-pelanggan="{{ $p->kode_pelanggan }}" data-nama="{{ $p->nama }}" data-alamat="{{ $p->alamat }}" data-email="{{ $p->email }}" data-notelp="{{ $p->no_telp }}" data-bs-dismiss="modal">
                                                  <span class="fw-bold me-1">&plus;</span> Pilih
                                                </button>
                                              </td>
                                    @endforeach
        </div>
      </div>
    </div>
  </div>

@push('script')
  <script>
      $(function() {
            $('#tablePilihBarang').DataTable({
                paging: true,
                lengthChange: true,
                searching: true,
                ordering: true,
                responsive: true,
                autoWidth: false,
            });
      });
  </script>

  <script>
    const Id = document.querySelector('.pelanggan_id')
    const Nama = document.querySelector('.nama_pelanggan')
    const Notelp = document.querySelector('.no_telp')
    const Alamat = document.querySelector('.alamat')
    function changePembelian(e){
    let id= e.target.getAttribute("data-id")
    let nama_pelanggan = e.target.getAttribute("data-nama")
    let no_telp= e.target.getAttribute("data-notelp")
    let alamat= e.target.getAttribute("data-alamat")
    
    console.log(id) 
    console.log(nama_pelanggan)
    console.log(no_telp)
    console.log(alamat)

    Id.value = id;
    Nama.innerText = nama_pelanggan;
    Notelp.innerText = no_telp;
    Alamat.innerText = alamat;
    }

  </script>

  <script>
      let totalHarga = 0;
      function tambahBarang(a){
          let d = $(a).closest('tr');
          let kodeBarang = d.find('td:eq(1)').text();
          let namaBarang = d.find('td:eq(2)').text();
          let hargaBarang = d.find('td:eq(4)').text();
          let id = $(a).data('barang-id');
          let data = '';
          let tbody = $('#tblTransaksi tbody tr td').text();
          data +='<tr>';
          data +='<td>'+kodeBarang+'</td>';
          data +='<td>'+namaBarang+'</td>';
          data +='<td>'+hargaBarang+'</td>';
          data +='<input type="hidden" name="barang_id[]" value="'+id+'">'
          data +='<input type="hidden" name="harga_jual[]" value="'+hargaBarang+'">'
          data +='<td><input type="number" value="1" name="qty[]" class="qty"></td>';
          data +='<td><span class="subTotal">'+hargaBarang+'</span></td>';
          data +='<td><button type="button" class="btnRemoveBarang btn btn-danger" ><span class="fas fa-trash"></span></button></td>';
          data +='</tr>'
          if(tbody == 'Belum ada data') $('#tblTransaksi tbody tr').remove();

          $('#tblTransaksi tbody').append(data);
          totalHarga += parseFloat(hargaBarang);
          $('#totalHarga').val(totalHarga);
          $('#exampleModalBarang').modal('hide');
      }

      function calcSubTotal(a){
          let qty = parseInt($(a).closest('tr').find('.qty').val());
          let hargaBarang = parseFloat($(a).closest('tr').find('td:eq(2)').text());
          let subTotalAwal = parseFloat($(a).closest('tr').find('.subTotal').text());
          let subTotal = qty * hargaBarang;
          totalHarga += subTotal - subTotalAwal;
          $(a).closest('tr').find('.subTotal').text(subTotal);
          $('#totalHarga').val(totalHarga);
          
      }

      $(function(){
          $('#tblPilihbarang').DataTable();

          //pemilihan Barang
          $('#exampleModalBarang').on('click','.pilihBarangBtn',function(){
              tambahBarang(this);
          });

          //change qty event
          $('#tblTransaksi').on('change','.qty',function(){
              calcSubTotal(this);
          })
          //remove Barang
          $('#tblTransaksi').on('click', '.btnRemoveBarang',function(){
              let subTotalAwal = parseFloat($(this).closest('tr').find('.subTotal').text());
              totalHarga -= subTotalAwal;

              $currentRow = $(this).closest('tr').remove();
              $('#totalHarga').val(totalHarga);
          })
      });

  </script>
@endpush
@include('admin.partials.footer')