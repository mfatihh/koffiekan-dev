@extends('layouts.pdf')

@section('title', $transaction->invoice_no.' - '.trans('transaction.invoice_print'))

@section('style')
<style>
    body {
        font-family: 'Arial', sans-serif;
        font-size: 8px;
    }
    .border-bottom {
        border-bottom: 1px solid #000;
    }
</style>
@endsection

@section('content')
<div id="head" class="row">
    <div class="col-md-5" style="padding:25px;">
        <table style="color:#686868;" width="100%">
            <tr>
                <th><img src="{{asset('img/logo.jpeg')}}" height="60px;">
                </th>
                <th style="color:#843763;font-size:15px;text-align:right;float:right;">INVOICE</th>
            </tr>
            <tr>
                <th style="color:#843763;">{{ $transaction->created_at->format('d M Y') }}</th>
                <th></th>
            </tr>
            <tr>
                <th style="color:#843763;">{{ $transaction->created_at->format('H:i:s') }}</th>
            </tr>
        </table>
    </div>
</div>
<div id="cs" class="row">
    <div class="col-md-5" style="background:#fcfcfc;padding:25px;">
        <table style="color:#686868;">
            <tr>
                <th style="font-size:11px;color:#686868;">Costumer</th>
                <th class="text-right" style="font-size:15px;color:#843763;float:right;">{{
                    $transaction->customer['name'] }}</th>
            </tr>
            <tr>
                <th>No Invoice</th>
                <th class="text-right" style="width:75px;color:#843763;float:right;">{{ $transaction->invoice_no }}</th>
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
<div class="row">
    <div class="col-md-5" style="background:#f2f2f2;padding:0 25px 25px 25px;"><br><br>
        <table class="table" style="color:#686868;">
            <tr>
                <th class="border-bottom">Barang</th>
                <th class="border-bottom">Jumlah</th>
                <th class="text-right border-bottom" style="width:90px">{{ trans('product.item_subtotal') }}</th>
            </tr>
            <?php $discountTotal = 0; ?>
            @foreach($transaction->items as $key => $item)
            <tr>
                <td class="strong border-bottom">{{ $key + 1 }})&nbsp;{{ $item['name'] }}</td>

                <td class="border-bottom" style="vertical-align: top;">{{ $item['qty'] }}</td>
                <td class="text-right border-bottom">{{ formatRp($item['subtotal']) }}</td>
            </tr>
            <?php $discountTotal += $item['item_discount_subtotal'] ?>
            @endforeach
            <tr>
                <th colspan="2" class="text-right">Diskon :</th>
                <th class="text-right">{{ $transaction['diskon'] }} %</th>
            </tr>
            <tr>
                <th colspan="2" class="text-right">Potongan :</th>
                <th class="text-right">{{ formatRp($transaction['potongan_harga']) }}</th>
            </tr>
            <tr>
                <th colspan="2" class="text-right">Ongkir :</th>
                <th class="text-right">{{ formatRp($transaction['ongkir']) }}</th>
            </tr>
            <tr>
                <th colspan="2" class="text-right">{{ trans('transaction.total') }} :</th>
                <th class="text-right" style="color:#843763;">{{ formatRp($transaction['total']) }}</th>
            </tr>
        </table>
        <div class="foot"><br><br>
            <p style="float:right;font-size:7px;color:#686868;"><b>Perumahan Gaharu Residence Sukatani Tapos, Kota
                    Depok, Jawa Barat, 16454 | Telp: {{ config('store.phone') }}</b></p>
        </div>
    </div>
</div>

@endsection