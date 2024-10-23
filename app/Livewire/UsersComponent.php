<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class UsersComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
    public $addpage, $editpage = false;
    public $nama, $email, $password, $role, $id;
    public function render()
    {
        $data['user'] = User::paginate(5);
        return view('livewire.users-component',$data);
    }

    public function create(){
        $this->reset();
        $this->addpage = true;
    }

    public function store(){
        $this->validate([
            'nama'=>'required',
            'email'=>'required|email',
            'password'=>'required',
            'role'=>'required'
        ],[
            'nama.required'=>'Tidak boleh kosong!',
            'email.required'=>'Tidak boleh kosong!',
            'email.email'=>'Tidak sesuai format!',
            'password.required'=>'Tidak boleh kosong!',
            'role.required'=>'Harus pilih!',
        ]);
        User::create([
            'name'=>$this->nama,
            'email'=>$this->email,
            'password'=>Hash::make($this->password),
            'role'=>$this->role
        ]);
        session()->flash('success','Berhasil dibuat!');
        $this->reset();
    }
    public function destroy($id){
        $find=User::find($id);
        $find->delete();
        session()->flash('success','Berhasil hapus data!');
        $this->reset();
    }

    public function edit($id){
        $this->reset();
        $find=User::find($id);
        $this->nama=$find->name;
        $this->email=$find->email;
        $this->role=$find->role;
        $this->id=$find->id;
        $this->editpage= true;
    }

    public function update(){
        $find=User::find($this->id);
        if($this->password==""){
            $find->update([
                'name'=>$this->nama,
                'email'=>$this->email,
                'role'=>$this->role,
            ]);
        }else{
            $find->update([
                'name'=>$this->nama,
                'email'=>$this->email,
                'password'=> Hash::make($this->password),
                'role'=>$this->role,
            ]);
        }  
        session()->flash('success','Berhasil diubah!');
        $this->reset();
    }
}
