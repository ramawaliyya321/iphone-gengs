<?php

namespace App\Http\Controllers;

use App\Models\Iphone;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $data['user'] = User::count();
        $data['iphone'] = Iphone::count();
        $data['transaksi'] = Transaksi::where('status','SELESAI')->sum('total');
        return view('home',$data);
    }
}
