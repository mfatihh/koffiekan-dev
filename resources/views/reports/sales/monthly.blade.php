@extends('layouts.app')

@section('title', __('report.monthly', ['year_month' => $months[$month].' '.$year]))

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
@endsection

@section('content')

<div class="wrapper" style="padding:40px;">
<h2>Laporan Penjualan</h2><br>
{{ Form::open(['method' => 'get', 'class' => 'form-inline well well-sm']) }}
{{ Form::label('month', __('report.view_monthly_label'), ['class' => 'control-label', 'style'=>'margin-right:10px;']) }}
{{ Form::select('month', $months, $month, ['class' => 'form-control', 'style'=>'margin-right:10px;']) }}
{{ Form::select('year', $years, $year, ['class' => 'form-control', 'style'=>'padding:10px;margin-right:10px;']) }}
{{ Form::submit(__('report.view_report'), ['class' => 'btn btn-info btn-sm', 'style'=>'margin-right:10px;']) }}
{{ link_to_route('reports.sales.monthly', __('report.this_month'), [], ['class' => 'btn btn-default btn-sm', 'style'=>'margin-right:10px;']) }}
{{ link_to_route('reports.sales.yearly', __('report.view_yearly'), ['year' => $year], ['class' => 'btn btn-default btn-sm']) }}
{{ Form::close() }}
<div class="row content">
<div class="card light bordered col-md-6" style="padding:10px 20px 20px 20px;">
        <div class="portlet-title tabbable-line">
            <div class="caption">
                <i class="icon-globe font-red"></i>
                <h3>Grafik Penjualan</h3>
            </div>
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#portlet_ecommerce_tab_1" data-toggle="tab"> Bulan {{ $months[$month] }}</a>
                </li>
            </ul>
        </div>
        <div class="container">
            <div class="tab-content">
                <div class="tab-pane active" id="portlet_ecommerce_tab_1">
                    <div id="monthly-chart" style="height: 250px;"></div>
                </div>
            </div>
        </div>
    </div>

<div class="card col-md-6 table-responsive">
    <div class="panel-heading"><h3 class="panel-title">{{ __('report.detail') }}</h3></div>
    <div class="panel-body">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <th class="text-center">{{ __('time.date') }}</th>
                <th class="text-center">{{ __('transaction.transaction') }}</th>
                <th class="text-right">{{ __('report.omzet') }}</th>
                <th class="text-center">{{ __('app.action') }}</th>
            </thead>
            <tbody>
                @php $chartData = []; @endphp
                @foreach(monthDateArray($year, $month) as $dateNumber)
                @php
                    $any = isset($reports[$dateNumber]);
                    $count = $any ? $reports[$dateNumber]->count : 0;
                    $subtotal = $any ? $reports[$dateNumber]->amount : 0;
                @endphp
                @if ($any)
                    <tr>
                        <td class="text-center">{{ dateId($date = $year.'-'.$month.'-'.$dateNumber) }}</td>
                        <td class="text-center">{{ $count }}</td>
                        <td class="text-right">{{ formatRp($subtotal) }}</td>
                        <td class="text-center">
                            {{ link_to_route(
                                'reports.sales.daily',
                                __('report.view_daily'),
                                ['date' => $date],
                                [
                                    'class' => 'btn btn-info btn-xs',
                                    'title' => __('report.daily', ['date' => dateId($date)]),
                                ]
                            ) }}
                        </td>
                    </tr>
                @endif
                @php
                    $chartData[] = ['date' => $dateNumber, 'value' => ($subtotal) ];
                @endphp
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-right">{{ __('app.total') }}</th>
                    <th class="text-center">{{ $reports->sum('count') }}</th>
                    <th class="text-right">{{ formatRp($reports->sum('amount')) }}</th>
                    <td>&nbsp;</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
</div>
</div>
@endsection

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script>
(function() {
    new Morris.Area({
        element: 'monthly-chart',
        data: {!! collect($chartData)->toJson() !!},
        xkey: 'date',
        ykeys: ['value'],
        labels: ["{{ __('report.omzet') }} Rp"],
        parseTime:false,
        xLabelAngle: 30,
        goals: [0],
        goalLineColors : ['red'],
        lineWidth: 2,
    });
})();
</script>
@endsection
