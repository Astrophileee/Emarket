<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Pengajuan</title>

    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>
<body>
    <h3 class="text-center">Laporan Pengajuan</h3>

    <table width="100%" border="1px" style="border-collapse: collapse;" cellpadding="3">
        <thead>
            <tr>
                <th width="5%" style="text-align: left;">No</th>
                <th style="text-align: left;">Nama Pengaju</th>
                <th style="text-align: left;">Nama Barang</th>
                <th style="text-align: left;">Tanggal Pengajuan</th>
                <th style="text-align: left;">Jumlah</th>
                <th style="text-align: left;">Terpenuhi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $d)
            <tr>
                <td>{{ $d->id }}</td>
                <td>
                    {{ $d->pelanggan->nama }}
                </td>
                <td>
                    {{ $d->nama_barang }}
                </td>
                <td>
                    {{ $d->tgl_pengajuan }}
                </td>
                <td>
                    {{ $d->jumlah }}
                </td>
                <td>{{ $d->terpenuhi }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>