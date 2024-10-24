<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ProfileComponent extends Component
{
    public $nama, $email, $password, $id;
    public $editpage = false;
    public function render()
    {
        $data['user'] = User::get();
        return view('livewire.profile-component', $data);
    }

    public function edit($id)
    {
        $this->reset();
        $find = User::find($id);
        if ($find) {
            $this->id = $find->id;
            $this->nama = $find->name;
            $this->email = $find->email;
            $this->editpage = true;
        } else {
            session()->flash('error', 'User tidak ditemukan.');
        }
    }

    public function update()
    {
        $this->validate([
            'nama' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->id),
            ],
        ], [
            'email.unique' => 'Email sudah digunakan oleh pengguna lain.',

        ]);
        $find = User::find($this->id);
        if ($this->password == "") {
            $find->update([
                'name' => $this->nama,
                'email' => $this->email,
            ]);
        } else {
            $find->update([
                'name' => $this->nama,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]);
        }
        session()->flash('success', 'Berhasil diubah!');
        $this->reset();
    }
}
