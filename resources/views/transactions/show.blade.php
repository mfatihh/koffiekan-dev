@extends('layouts.app')

@section('title', $transaction->invoice_no . ' - ' . trans('transaction.detail'))


@section('content')
<div class="wrapper container">
    <form action="{{ route('cart.add') }}" method="POST">
            {{ csrf_field() }}
            <input type="submit" class="btn btn-default navbar-btn" name="create-cash-draft" id="cash-draft-create-button"
                value="Buat transaksi baru">
            {{-- <input type="submit" class="btn btn-default navbar-btn" name="create-credit-draft" id="credit-draft-create-button"
                value="{{ trans('transaction.create_credit') }}"> --}}
        </form><hr>
    <div class="row container">
        <div class="col-md-8 col-md-offset-2 card">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ trans('transaction.items') }}</h3>
                </div>
                
                <div class="panel-body table-responsive">
                    @if(session()->has('message'))
                    <div class="alert success">
                      <span class="closebtn">&times;</span>  
                      <strong>Success!</strong>  {{ session()->get('message') }}
                    </div>
                    @endif
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th>{{ trans('transaction.invoice_no') }}</th>
                                <th class="text-primary strong">{{ $transaction->invoice_no }}</th>
                            </tr>
                            <tr>
                                <th>{{ trans('app.date') }}</th>
                                <th>{{ $transaction->created_at->format('Y-m-d') }}</th>
                            </tr>
                            <tr>
                                <th>{{ trans('app.table_no') }}</th>
                                <th>{{ trans('product.name') }}</th>
                                <th class="">Harga</th>
                                {{-- <th class="text-right">{{ trans('product.item_discount') }}</th> --}}
                                <th class="">{{ trans('product.item_qty') }}</th>
                                <th class="">{{ trans('product.item_subtotal') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $discountTotal = 0; ?>
                            @foreach($transaction->items as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    {{ $item['name'] }} <br>
                                </td>
                                <td class="">{{ formatRp($item['price']) }}</td>
                                {{-- <td class="text-right">{{ formatRp($item['item_discount']) }}</td> --}}
                                <td class="">{{ $item['qty'] }}</td>
                                <td class="">{{ formatRp($item['subtotal']) }}</td>
                            </tr>
                            <?php $discountTotal += $item['item_discount_subtotal'] ?>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-right">Total :</th>
                                <th class="text-right">{{ formatRp($transaction['payment'])}}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection