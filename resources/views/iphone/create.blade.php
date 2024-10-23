<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Add iPhone</h6>
                <form>
                    <div class="mb-3">
                        <label for="seri" class="form-label">Seri</label>
                        <input type="text" class="form-control" wire:model="seri" id="seri" value="{{@old('seri')}}">
                        @error('seri')
                            <div class="form-text text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="imei" class="form-label">IMEI</label>
                        <input type="text" class="form-control" wire:model="imei" id="imei" value="{{@old('imei')}}">
                        @error('imei')
                            <div class="form-text text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="jenis" class="form-label">Jenis</label>
                        <select name="" class="form-select" wire:model="jenis">
                            <option value="">Pilih</option>
                            <option value="Pro">Pro</option>
                            <option value="Pro XL">Pro XL</option>
                            <option value="Non-Pro">Non-Pro</option>
                        </select>
                        @error('jenis')
                            <div class="form-text text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="kapasitas" class="form-label">Kapasitas</label>
                        <input type="text" class="form-control" wire:model="kapasitas" id="kapasitas"
                            value="{{@old('kapasitas')}}">
                        @error('kapasitas')
                            <div class="form-text text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="text" class="form-control" wire:model="harga" id="harga" value="{{@old('harga')}}">
                        @error('harga')
                            <div class="form-text text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto iPhone</label>
                        <input type="file" class="form-control" wire:model="foto" id="foto" value="{{@old('foto')}}">
                        @error('foto')
                            <div class="form-text text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <button type="button" wire:click="store" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>