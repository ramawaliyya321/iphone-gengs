@extends('layout.template')
@section('title', 'Transaksi - iPhoneGengs')

@section('content')
    @if (auth()->user()->role == 'admin')
        @livewire('LihatTransaksi')
        @livewire('TransaksiComponent')
    @else
        @livewire('TransaksiComponent')
    @endif
@endsection