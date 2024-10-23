<div>
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-12">
                <div class="bg-light rounded h-100 p-4">
                    @if (session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            {{session('success')}}
                        </div>
                    @endif
                    <h6 class="mb-4">Data Laporan Transaksi</h6>
                    <div class="row">
                        <div class="col-md-4">
                            <input type="date" wire:model="tanggal1" class="form-control" placeholder="Tanggal">
                        </div>
                        <div class="col-md-2">Sampai dengan</div>
                        <div class="col-md-4">
                            <input type="date" wire:model="tanggal2" class="form-control" placeholder="Tanggal">
                        </div>
                        <div class="col md-2">
                            <button class="btn btn-sm btn-primary" wire:click="cari">Filter</button>
                        </div>
                    </div>
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
                    {{$transaksi->links()}}
                    <button class="btn btn-primary" wire:click="export">Export to PDF</button>
                </div>
            </div>
        </div>
    </div>
</div>