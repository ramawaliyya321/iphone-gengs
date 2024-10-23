<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <h1>Laporan Transaksi</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Seri</th>
                <th scope="col">Jenis</th>
                <th scope="col">Kapasitas</th>
                <th scope="col">Nama Peminjam</th>
                <th scope="col">Tanggal Pesan</th>
                <th scope="col">Alamat</th>
                <th scope="col">Lama</th>
                <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transaksi as $data)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$data->iphone->seri}}</td>
                    <td>{{$data->iphone->jenis}}</td>
                    <td>{{$data->iphone->kapasitas}}</td>
                    <td>{{$data->nama}}</td>
                    <td>{{$data->tgl_pesan}}</td>
                    <td>{{$data->alamat}}</td>
                    <td>{{$data->lama}}</td>
                    <td>{{$data->total}}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">Data tidak ada!</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>