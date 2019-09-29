@extends('layouts.app')

@section('title', __('report.daily', ['date' => dateId($date)]))

@section('css')
<link href="{{asset('css/assets/bootstrap-datepicker3.min.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

@php $dt = Carbon\Carbon::parse($date); @endphp

<div class="wrapper" style="padding:40px;">

<h2>Laporan harian</h2>

{{ Form::open(['method' => 'get', 'class' => 'form-inline well well-sm']) }}
{{ Form::label('date', __('report.view_daily_label'), ['class' => 'control-label', 'style'=>'margin-right:10px;']) }}
{{ Form::date('date', $date, ['required', 'class' => 'form-control', 'style' => 'width:100px', 'style'=>'margin-right:10px;']) }}
{{ Form::submit(__('report.view_report'), ['class' => 'btn btn-info btn-sm']) }}
{{ link_to_route('reports.sales.daily', __('report.today'), [], ['class' => 'btn btn-default btn-sm']) }}
{{ link_to_route(
    'reports.sales.monthly',
    __('report.view_monthly'),
    ['month' => monthNumber($dt->month), 'year' => $dt->year],
    ['class' => 'btn btn-default btn-sm']
) }}
{{ Form::close() }}

<div class="card table-responsive" style="padding:30px;">
    <table class="table">
        <thead>
            <th class="text-center">{{ __('app.table_no') }}</th>
            <th class="text-center">{{ __('app.date') }}</th>
            <th class="text-right">{{ __('report.omzet') }}</th>
            <th class="text-center">{{ __('app.action') }}</th>
        </thead>
        <tbody>
            @forelse($transactions as $key => $transaction)
            <tr>
                <td class="text-center">{{ 1 + $key }}</td>
                <td class="text-center">{{ dateId($transaction->created_at->format('Y-m-d')) }}</td>
                <td class="text-right">{{ formatRp($transaction->payment) }}</td>
                <td class="text-center">
                    {{ link_to_route(
                        'transactions.show',
                        __('app.show'),
                        [$transaction],
                        [
                            'title' => __('app.show_detail_title', ['name' => $transaction->number, 'type' => trans('transaction.transaction')]),
                            'target' => '_blank',
                            'class' => 'btn btn-info btn-xs'
                        ]
                    ) }}
                </td>
            </tr>
            @empty
            <tr><td colspan="4">{{ __('transaction.not_found') }}</td></tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th class="text-right" colspan="2">{{ __('app.total') }}</th>
                <th class="text-right">{{ formatRp($transactions->sum('payment')) }}</th>
                <th>&nbsp;</th>
            </tr>
        </tfoot>
    </table>
</div>
</div>
@endsection

@section('ext_css')
    {{ Html::style(url('css/plugins/jquery.datetimepicker.css')) }}
@endsection

@section('script')
<script src="{{asset('js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script>
<script>
(function() {
    $('#date').datetimepicker({
        timepicker:false,
        format:'Y-m-d',
        closeOnDateSelect: true,
        scrollInput: false
    });
})();
</script>
@endsection
