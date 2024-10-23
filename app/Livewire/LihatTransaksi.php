<?php

namespace App\Livewire;

use App\Models\Transaksi;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class LihatTransaksi extends Component
{
    use WithPagination, WithoutUrlPagination;

    #[On('lihat-transaksi')]
    public function render()
    {
        if (auth()->user()->role == 'anggota') {
            $data['transaksi'] = Transaksi::where('user_id', auth()->user()->id)->paginate(10);
        } else {
            $data['transaksi'] = Transaksi::paginate(10);
        }
        return view('livewire.lihat-transaksi', $data);
    }

    public function proses($id){
        $transaksi=Transaksi::find($id);
        $transaksi->update([
            'status'=> 'PROSES'
        ]);
        session()->flash('success','Berhasil proses data!');
    }

    public function selesai($id){
        $transaksi=Transaksi::find($id);
        $transaksi->update([
            'status'=> 'SELESAI'
        ]);
        session()->flash('success','Berhasil proses data!');
    }

    public function return($id){
        $transaksi=Transaksi::find($id);
        $transaksi->update([
            'status'=> 'RETURN'
        ]);
        session()->flash('success','Berhasil proses data!');
    }
}
