<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Add Transaksi</h6>
                <form>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Pemesan</label>
                        @if (auth()->user()->role == 'admin')
                            <select class="form-select" wire:model="nama" id="nama">
                                <option value="">-- Pilih Nama Pemesan --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->name }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('nama')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        @else
                            <input type="text" class="form-control" id="nama" value="{{ auth()->user()->name }}" readonly>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="ponsel" class="form-label">No. Telepon</label>
                        <input type="text" class="form-control" wire:model="ponsel" id="ponsel" value="{{@old('ponsel')}}">
                        @error('ponsel')
                            <div class="form-text text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <input type="text" class="form-control" wire:model="alamat" id="alamat" value="{{@old('alamat')}}">
                        @error('alamat')
                            <div class="form-text text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="lama" class="form-label">Lama Peminjaman (Hari)</label>
                        <input type="number" class="form-control" wire:model="lama" wire:change="hitung" id="lama" value="{{@old('lama')}}" min="1">
                        @error('lama')
                            <div class="form-text text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tgl_pesan" class="form-label">Tanggal Pemesanan</label>
                        <input type="date" class="form-control" wire:model="tgl_pesan" id="tgl_pesan" value="{{@old('tgl_pesan')}}">
                        @error('tgl_pesan')
                            <div class="form-text text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label>Total:</label>
                        <p>Rp {{ number_format($total, 2) }}</p>
                    </div>
                    <div class="mb-3">
                        <label>Denda (jika ada):</label>
                        @php
                            $denda = $this->hitungDenda($lama);
                        @endphp
                        <p>Rp {{ number_format($denda, 2) }}</p>
                    </div>
                    <div class="mb-3">
                        <label>Total Pembayaran:</label>
                        @php
                            $totalPembayaran = $total + $denda;
                        @endphp
                        <p>Rp {{ number_format($totalPembayaran, 2) }}</p>
                    </div>
                    <button type="button" wire:click="store" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
