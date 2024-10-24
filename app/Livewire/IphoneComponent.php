<?php

namespace App\Livewire;

use App\Models\Iphone;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class IphoneComponent extends Component
{
    use WithPagination, WithoutUrlPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $addpage, $editpage = false;
    public $seri, $imei, $jenis, $kapasitas, $harga, $foto, $id, $search;
    #[On('lihat-iphone')]
    public function render()
    {
        if ($this->search!="") {
            $data ['iphone'] = Iphone::where('seri', 'like', '%' . $this->search . '%')
                  ->orWhere('imei', 'like', '%' . $this->search . '%')
                  ->orWhere('jenis', 'like', '%' . $this->search . '%')
                  ->orWhere('kapasitas', 'like', '%' . $this->search . '%')
                  ->paginate(10);
        }else{
            $data['iphone'] = Iphone::paginate(5);
        }
        return view('livewire.iphone-component', $data);
    }

    public function cari()
    {
        $this->dispatch('lihat-iphone');
    }

    public function create()
    {
        $this->addpage = true;
    }

    public function store()
    {
        $this->validate([
            'seri' => 'required',
            'imei' => 'required|unique:iphones,imei',
            'jenis' => 'required',
            'kapasitas' => 'required',
            'harga' => 'required',
            'foto' => 'required|image',
        ], [
            'seri.required' => 'Seri tidak boleh kosong!',
            'imei.required' => 'IMEI tidak boleh kosong!',
            'imei.unique' => 'IMEI ini sudah terdaftar!',
            'jenis.required' => 'Jenis tidak boleh kosong!',
            'kapasitas.required' => 'Kapasitas tidak boleh kosong!',
            'harga.required' => 'Harga tidak boleh kosong!',
            'foto.required' => 'Foto tidak boleh kosong!',
            'foto.image' => 'Gunakan format image!',
        ]);

        $this->foto->storeAs('iphone', $this->foto->hashName());
        Iphone::create([
            'user_id' => auth()->user()->id,
            'seri' => $this->seri,
            'imei' => $this->imei,
            'jenis' => $this->jenis,
            'kapasitas' => $this->kapasitas,
            'harga' => $this->harga,
            'foto' => $this->foto->hashName(),
        ]);
        session()->flash('success', 'Berhasil disimpan!');
        $this->reset();
    }


    public function edit($id)
    {
        $this->editpage = true;
        $this->id = $id;
        $iphone = Iphone::find($id);
        $this->seri = $iphone->seri;
        $this->imei = $iphone->imei;
        $this->jenis = $iphone->jenis;
        $this->kapasitas = $iphone->kapasitas;
        $this->harga = $iphone->harga;
    }

    public function update()
    {
        $this->validate([
            'seri' => 'required',
            'imei' => 'required|unique:iphones,imei,' . $this->id,
            'jenis' => 'required',
            'kapasitas' => 'required',
            'harga' => 'required',
        ], [
            'seri.required' => 'Seri tidak boleh kosong!',
            'imei.required' => 'IMEI tidak boleh kosong!',
            'imei.unique' => 'IMEI ini sudah terdaftar!',
            'jenis.required' => 'Jenis tidak boleh kosong!',
            'kapasitas.required' => 'Kapasitas tidak boleh kosong!',
            'harga.required' => 'Harga tidak boleh kosong!',
        ]);

        $iphone = Iphone::find($this->id);
        if (empty($this->foto)) {
            $iphone->update([
                'user_id' => auth()->user()->id,
                'seri' => $this->seri,
                'imei' => $this->imei,
                'jenis' => $this->jenis,
                'kapasitas' => $this->kapasitas,
                'harga' => $this->harga,
            ]);
        } else {
            $this->foto->storeAs('iphone', $this->foto->hashName());
            $iphone->update([
                'user_id' => auth()->user()->id,
                'seri' => $this->seri,
                'imei' => $this->imei,
                'jenis' => $this->jenis,
                'kapasitas' => $this->kapasitas,
                'harga' => $this->harga,
                'foto' => $this->foto->hashName(),
            ]);
        }
        session()->flash('success', 'Berhasil disimpan!');
        $this->reset();
    }

    public function destroy($id)
    {
        $iphone = Iphone::find($id);
        unlink(public_path('storage/iphone/' . $iphone->foto));
        $iphone->delete();
        session()->flash('success', 'Berhasil dihapus!');
        $this->reset();
    }
}
