<?php

namespace App\Livewire;

use App\Models\Iphone;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class TransaksiComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $addpage, $lihatpage = false;
    public $nama, $ponsel, $alamat, $lama, $tgl_pesan, $iphone_id, $harga, $total;
    public $dataTransaksi = array();
    public function mount()
    {
        if (Auth::user()->role === 'anggota') {
            $this->nama = Auth::user()->name;
        }
    }

    public function render()
    {
        $data['iphone'] = Iphone::paginate(5);
        $data['users'] = User::where('role', 'anggota')->get();
        return view('livewire.transaksi-component', $data);
    }

    public function create($id, $harga)
    {
        $this->iphone_id = $id;
        $this->harga = $harga;
        $this->addpage = true;
    }

    public function hitung()
    {
        $lama = $this->lama;
        $harga = $this->harga;
        $this->total = $lama * $harga;
    }
    public function store()
    {
        $this->validate([
            'nama' => 'required',
            'ponsel' => 'required',
            'alamat' => 'required',
            'lama' => 'required|integer',
            'tgl_pesan' => 'required',
        ], [
            'nama.required' => 'Nama tidak boleh kosong!',
            'ponsel.required' => 'No. Telepon tidak boleh kosong!',
            'alamat.required' => 'Alamat tidak boleh kosong!',
            'lama.required' => 'Lama peminjaman tidak boleh kosong!',
            'lama.integer' => 'Lama peminjaman harus berupa angka!',
            'tgl_pesan.required' => 'Tanggal pesan tidak boleh kosong!',
        ]);

        $selectedUser = User::where('name', $this->nama)->first();

        if (!$selectedUser) {
            session()->flash('error', 'User tidak ditemukan!');
            return;
        }

        $jumlahPeminjaman = Transaksi::where('user_id', $selectedUser->id)
        ->where('status', '!=', 'SELESAI')
        ->count();

        if ($jumlahPeminjaman >= 2) {
            session()->flash('error', 'Maksimal peminjaman adalah 2 unit.');
            $this->reset();
            return;
        }

        $find = Transaksi::where('iphone_id', $this->iphone_id)
            ->where('tgl_pesan', $this->tgl_pesan)
            ->where('status', '!=', 'SELESAI')->count();
        if ($find == 1) {
            session()->flash('error', 'iPhone sudah ada yang meminjam!');
        } else {
            $this->lama = intval($this->lama);
            $denda = $this->hitungDenda($this->lama);
            $this->total = ($this->lama * $this->harga) + $denda;

            Transaksi::create([
                'user_id' => $selectedUser->id,
                'iphone_id' => $this->iphone_id,
                'nama' => $this->nama,
                'ponsel' => $this->ponsel,
                'alamat' => $this->alamat,
                'lama' => $this->lama,
                'tgl_pesan' => $this->tgl_pesan,
                'total' => $this->total,
                'status' => 'WAIT',
            ]);
            session()->flash('success', 'Berhasil disimpan!');
        }
        $this->dispatch('lihat-transaksi');
        $this->reset();
    }

    public function hitungDenda($lama)
    {
        $maksimalHari = 5;
        $dendaPerHari = 100000;

        if ($lama > $maksimalHari) {
            $kelebihanHari = $lama - $maksimalHari;
            return $kelebihanHari * $dendaPerHari; 
        }
        return 0;
    }

    public function lihat()
    {
        $data['transaksi'] = Transaksi::paginate(10);
        $this->lihatpage = true;
    }

}
