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
                    <h6 class="mb-4">My Profile</h6>
                    <form>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" value="{{ auth()->user()->name }}"
                                readonly>
                            @error('nama')
                                <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="text" class="form-control" id="email" value="{{ auth()->user()->email }}"
                                readonly>
                            @error('email')
                                <div class="form-text text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <button type="button" class="btn btn-info"
                            wire:click="edit({{ auth()->user()->id }})">Edit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if ($editpage)
        @include('profile.edit')
    @endif
</div>