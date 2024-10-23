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
                    <h6 class="mb-4">Data Unit iPhone</h6>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Seri</th>
                                <th scope="col">IMEI</th>
                                <th scope="col">Jenis</th>
                                <th scope="col">Kapasitas</th>
                                <th>Harga</th>
                                <th>Foto</th>
                                <th>
                                    Proses
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($iphone as $data)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$data->seri}}</td>
                                    <td>{{$data->imei}}</td>
                                    <td>{{$data->jenis}}</td>
                                    <td>{{$data->kapasitas}}</td>
                                    <td>{{$data->harga}}</td>
                                    <td>
                                        <img src="{{asset('storage/iphone/'.$data->foto)}}" alt="{{$data->seri}}" style="width: 150px">
                                    </td>
                                    <td>
                                        <button class="btn btn-info" wire:click="edit({{$data->id}})">Edit</button>
                                        <button class="btn btn-danger" wire:click="destroy({{$data->id}})">Delete</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">Data tidak ada!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{$iphone->links()}}
                    <button wire:click="create" class="btn btn-primary">Tambah</button>
                </div>
            </div>
        </div>
    </div>
    @if ($addpage)
        @include('iphone.create')
    @endif
    @if ($editpage)
        @include('iphone.edit')
    @endif
</div>