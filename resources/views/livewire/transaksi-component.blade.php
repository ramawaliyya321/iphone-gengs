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
                    @if (session()->has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{session('error')}}
                        </div>
                    @endif
                    <h6 class="mb-4">Data iPhone</h6>
                    <div class="row mt-4">
                        <div class="col md-2 mb-3">
                            <input type="text" class="form-control" wire:model="search"
                                placeholder="Cari iPhone berdasarkan seri, kapasitas, atau jenis...">
                        </div>
                        <div class="col md-2">
                            <button class="btn btn-sm btn-primary" wire:click="cari">Cari</button>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($iphone as $data)
                            <div class="col-md-4 mb-4">
                                <div class="card" style="width: 18rem;">
                                    <img src="{{asset('storage/iphone/' . $data->foto)}}" style="height:200px; width:200px"
                                        class="card-img-top" alt="">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$data->seri}}</h5>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">Jenis: {{$data->jenis}}</li>
                                        <li class="list-group-item">Kapasitas: {{$data->kapasitas}}</li>
                                        <li class="list-group-item">Harga per-Hari: {{$data->harga}}</li>
                                    </ul>
                                    <div class="card-body">
                                        <button wire:click="create({{$data->id}},{{$data->harga}})"
                                            class="btn btn-success card-link">Rent</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{$iphone->links()}}
                </div>
            </div>
        </div>
    </div>
    @if ($addpage)
        @include('transaksi.create')
    @endif
</div>