<?php

namespace App\Livewire;

use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class LaporanComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
    public $tanggal1, $tanggal2;
    #[On('lihat-laporan')]
    public function render()
    {
        if ($this->tanggal2 != "") {
            $data['transaksi'] = Transaksi::where('status', 'SELESAI')
                ->whereBetween('tgl_pesan', [$this->tanggal1, $this->tanggal2])
                ->paginate(10);
        } else {
            $data['transaksi'] = Transaksi::where('status', 'SELESAI')->paginate(10);
        }
        return view('livewire.laporan-component', $data);
    }

    public function cari()
    {
        $this->dispatch('lihat-laporan');
    }

    public function export()
    {
        if ($this->tanggal2 != "") {
            $data['transaksi'] = Transaksi::where('status', 'SELESAI')
                ->whereBetween('tgl_pesan', [$this->tanggal1, $this->tanggal2])
                ->get();
            $pdf = Pdf::loadView('laporan.exportpdf', $data)->output();
            return response()->streamDownload(
                fn() => print ($pdf),
                "laporan transaksi " . $this->tanggal1 . ' sampai dengan ' . $this->tanggal2 . ".pdf"
            );
        } else {
            $data['transaksi'] = Transaksi::where('status', 'SELESAI')->get();
            $pdf = Pdf::loadView('laporan.exportpdf', $data)->output();
            return response()->streamDownload(
                fn() => print ($pdf),
                "laporan transaksi.pdf"
            );
        }
    }
}
