@extends('layouts.pdf')

@section('title', $transaction->invoice_no.' - '.trans('transaction.invoice_print'))

@section('style')
<style>
    body {
        font-family: 'Arial', sans-serif;
        font-size: 9px;
    }
    .border-bottom {
        border-bottom: 1px solid #000;
    }
</style>
@endsection

@section('content')
<div id="head" class="row">
    <div class="col-md-8" style="padding:25px;">
        <table style="color:#686868;" width="100%" class="text-center">
            <tr>
                <th><center><img src="{{asset('img/logo.jpeg')}}" height="60px;"></center>
                </th>
            </tr>
            {{-- <tr>
                <th style="color:#843763;"><center>Perumahan Gaharu Residence Sukatani Tapos, Kota
                        Depok, Jawa Barat, 16454</center></th>
            </tr> --}}
            <tr>
                <th style="color:#843763;"><center>Telp: {{ config('store.phone') }}</center></th>
            </tr>
        </table>
    </div>
</div>
<div id="cs" class="row">
    <div class="col-md-8" style="background:#fcfcfc;padding:25px;">
        <table style="color:#686868;">
            <tr>
                <th style="font-size:11px;color:#686868;">Costumer</th>
                <th class="text-right" style="font-size:15px;color:#843763;float:right;">{{
                    $transaction->customer['name'] }}</th>
            </tr>
            <tr>
                <th>No Telp</th>
                <th class="text-right" style="width:75px;color:#843763;float:right;">{{ $transaction->customer['phone']
                    }}</th>
            </tr>
            <tr>
                <th style="font-size:11px;color:#686868;">Alamat Pengiriman</th>
                <th></th>
            </tr>
            <tr>
                <th class="" style="width:400px;font-size:15px;color:#843763;float:right;">{{
                    $transaction->alamat_kirim }}</th>
                <th></th>
            </tr>
            <tr>
                <th>Kabupaten/Kota</th>
                <th class="text-right" style="width:75px;color:#843763;float:right;">{{ $transaction->kab_kota }}</th>
            </tr>
            <tr>
                <th>Jasa Pengiriman</th>
                <th class="text-right" style="width:75px;color:#843763;float:right;">{{ $transaction->jasa_kirim }}</th>
            </tr>
            <tr>
                <th>No Resi</th>
                <th class="text-right" style="width:75px;color:#843763;float:right;">{{ $transaction->no_resi}}</th>
            </tr>
        </table>
    </div>
</div>

@endsection