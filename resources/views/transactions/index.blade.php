@extends('layouts.app')

@section('title', trans('transaction.list'))

@section('css')
<link rel="stylesheet" href="{{asset('css/custom.css')}}">
<link rel="stylesheet" href="{{asset('css/style.default.css')}}">
<link rel="stylesheet" href="{{asset('vendor/owl.carousel/assets/owl.theme.default.css')}}">
<link rel="stylesheet" href="{{asset('vendor/owl.carousel/assets/owl.carousel.css')}}">
@endsection

@section('content')
<div class="wrapper ">
    <div class="content">
        <div class="container-fluid">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="row">
                <div class="col-md-12">
                    {{--<a href="{{route('cart.index')}}" class="nav-link nav-toggle">
                    <i class="icon-basket-loaded"></i>
                    <span class="title">Transaksi Penjualan</span>
                    </a>--}}
                    <form action="{{ route('cart.add') }}" method="POST">
                        {{ csrf_field() }}
                        <Button type="submit" class="btn btn-info" name="create-cash-draft"
                            id="cash-draft-create-button" value="{{ trans('transaction.create_cash') }}">Buat Transaksi
                            Penjualan</Button>
                        {{--<input type="submit" class="btn btn-default navbar-btn" name="create-credit-draft" id="credit-draft-create-button"
                                        value="{{ trans('transaction.create_credit') }}">--}}
                    </form>
                    <div class="card">

                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Daftar Transaksi</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="">
                                    <thead class="text-primary">
                                        <tr>
                                            <th>No</th>
                                            <th>{{ trans('transaction.invoice_no') }}</th>
                                            <th>{{ trans('app.date') }}</th>
                                            <th>{{ trans('transaction.items_count') }}</th>
                                            <th>{{ trans('transaction.total') }}</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($transactions as $key => $transaction)
                                        <tr>
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $transaction->invoice_no }}</td>
                                            <td>{{ $transaction->created_at->format('Y-m-d') }}</td>
                                            <td>{{ $transaction->items_count }}</td>
                                            <td>{{ formatRp($transaction->payment) }}</td>

                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-sm green dropdown-toggle" type="button"
                                                        data-toggle="dropdown" aria-expanded="false"> Actions

                                                    </button>
                                                    <ul class="dropdown-menu pull-left" role="menu">
                                                            <li style="padding:0 15px">
                                                    {{ link_to_route('transactions.show', trans('app.show'), $transaction->invoice_no,
                                                    ['class' => 'btn btn-warning btn-sm']) }}
                                                        </li>
                                                        <li style="padding:5px 0 5px 16px;">
                                                    <form action="{{route('delete.transaction',$transaction->id)}}"
                                                        method="POST">
                                                        {{csrf_field()}} {{method_field('DELETE')}}
                                                        <button type="button"
                                                            onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ?')){return this.form.submit()}else{return false}"
                                                            class="btn btn-danger btn-sm"><i class="icon-trash"></i>
                                                            Hapus</button>
                                                    </form>
                                                        </li>
                                            </td>

                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="12">
                                                Transaksi tidak ditemukan
                                                @if (request('q'))
                                                dengan keyword <em class="strong">{{ request('q') }}</em>
                                                @endif
                                                @if (request('date'))
                                                dan pada tanggal <em class="strong">{{ request('date') }}</em>.
                                                @endif
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="pull-right">{{$transactions->links("pagination::bootstrap-4")}}</div>
                            </div>
                        </div>
                    </div>
                </div>

                @foreach($transactions as $key => $transaction)
                <div class="modal fade" id="editData{{$transaction->id}}" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Edit Ongkir</h4>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{url('transactions/edit/'.$transaction->id)}}">
                                    {{csrf_field()}}{{method_field('PUT')}}

                                    <div class="form-group row">
                                        <label for="invoice_no"
                                            class="col-md-4 col-form-label text-md-right">Invoice</label>

                                        <div class="col-md-8">
                                            <input id="invoice_no" type="text" class="form-control" name="invoice_no"
                                                value="{{$transaction->invoice_no}}" disabled>

                                            @if ($errors->has('invoice_no'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('invoice_no') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="ongkir" class="col-md-4 col-form-label text-md-right">Ongkir</label>

                                        <div class="col-md-8">
                                            <input id="ongkir" type="number" min="0" class="form-control"
                                                value="{{$transaction->ongkir}}" name="ongkir">

                                            @if ($errors->has('ongkir'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('ongkir') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="no_resi" class="col-md-4 col-form-label text-md-right">No
                                            resi</label>

                                        <div class="col-md-8">
                                            <input id="no_resi" type="text" class="form-control" name="no_resi"
                                                value="{{$transaction->no_resi}}">

                                            @if ($errors->has('no_resi'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('no_resi') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="no_resi" class="col-md-4 col-form-label text-md-right">Jenis
                                            Pembayaran</label>

                                        <div class="col-md-8">
                                            <select name="jenis_pembayaran" class="form-control">
                                                {{-- <option value="">Jenis Pembayaran</option> --}}
                                                <option
                                                    {{ $transaction->jenis_pembayaran ==  'BCA' ? 'selected="selected"' : '' }}>
                                                    BCA</option>
                                                <option
                                                    {{ $transaction->jenis_pembayaran ==  'BRI' ? 'selected="selected"' : '' }}>
                                                    BRI</option>
                                                <option
                                                    {{ $transaction->jenis_pembayaran ==  'BNI' ? 'selected="selected"' : '' }}>
                                                    BNI</option>
                                                <option
                                                    {{ $transaction->jenis_pembayaran ==  'MDR' ? 'selected="selected"' : '' }}>
                                                    MDR</option>
                                                <option
                                                    {{ $transaction->jenis_pembayaran ==  'PIUTANG' ? 'selected="selected"' : '' }}>
                                                    PIUTANG</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-12">
                                            <button type="submit" id="edit" class="btn btn-primary"
                                                style="float:right;">Edit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endsection

                @section('ext_css')
                {!! Html::style(url('css/plugins/jquery.datetimepicker.css')) !!}
                @endsection

                @push('ext_js')
                {!! Html::script(url('js/plugins/jquery.datetimepicker.js')) !!}
                @endpush

                @section('script')
                <script>
                    (function () {
                        $('.date-select').datetimepicker({
                            timepicker: false,
                            format: 'Y-m-d',
                            closeOnDateSelect: true
                        });
                    })();
                </script>
                <script>
                    $(document).ready(function () {
                        $('#example').DataTable({
                            "paging": true,
                            "ordering": false,
                            "searching": true,
                            "info": false,
                            "bPaginate": false,
                            "bLengthChange": false,
                            "bFilter": true,
                            "bInfo": false,
                            "bAutoWidth": false
                        });
                    });
                </script>
                @endsection