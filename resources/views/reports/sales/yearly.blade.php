@extends('layouts.app')

@section('title', __('report.yearly', ['year' => $year]))

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
@endsection

@section('content')
<div class="wrapper" style="padding:40px;">
<h2>Laporan Penjualan</h2><br>

{{ Form::open(['method' => 'get', 'class' => 'form-inline well well-sm']) }}
{{ Form::label('year', __('report.view_yearly_label'), ['class' => 'control-label','style'=>'margin-right:10px;']) }}
{{ Form::select('year', $years, $year, ['class' => 'form-control','style'=>'margin-right:10px;']) }}
{{ Form::submit(__('report.view_report'), ['class' => 'btn btn-info btn-sm','style'=>'margin-right:10px;']) }}
{{ link_to_route('reports.sales.yearly', __('report.this_year'), [], ['class' => 'btn btn-default btn-sm']) }}
{{ Form::close() }}
<div class="row">
<div class="col-md-6 card" style="padding:10px 30px 30px 30px;">
        <div class="portlet-title tabbable-line">
            <div class="caption">
                <i class="icon-globe font-red"></i>
                <h2>Grafik Penjualan</h2>
            </div>
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#portlet_ecommerce_tab_1" data-toggle="tab"> Tahun {{ $year }}</a>
                </li>
            </ul>
        </div>
        <div class="portlet-body">
            <div class="tab-content">
                <div class="tab-pane active" id="portlet_ecommerce_tab_1">
                    <div id="yearly-chart"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="card col-md-6 table-responsive">
        <div class="panel-heading"><h3 class="panel-title">{{ __('report.detail') }}</h3></div>
        <div class="panel-body">
        <table class="table table-striped table-bordered ">
            <thead>
                <th class="text-center">{{ __('time.month') }}</th>
                <th class="text-center">{{ __('transaction.transaction') }}</th>
                <th class="text-right">{{ __('report.omzet') }}</th>
                <th class="text-center">{{ __('app.action') }}</th>
            </thead>
            <tbody>
                @php $chartData = []; @endphp
                @foreach(getMonths() as $monthNumber => $monthName)
                @php
                    $any = isset($reports[$monthNumber]);
                    $omzet = $any ? $reports[$monthNumber]->omzet : 0
                @endphp
                <tr>
                    <td class="text-center">{{ monthId($monthNumber) }}</td>
                    <td class="text-center">{{ $any ? $reports[$monthNumber]->count : 0 }}</td>
                    <td class="text-right">{{ formatRp($omzet) }}</td>
                    <td class="text-center">
                        {{ link_to_route(
                            'reports.sales.monthly',
                            __('report.view_monthly'),
                            ['month' => $monthNumber, 'year' => $year],
                            [
                                'class' => 'btn btn-info btn-xs',
                                'title' => __('report.monthly', ['year_month' => monthId($monthNumber)]),
                                'title' => __('report.monthly', ['year_month' => monthId($monthNumber).' '.$year]),
                            ]
                        ) }}
                    </td>
                </tr>
                @php
                    $chartData[] = ['month' => monthId($monthNumber), 'value' => $omzet];
                @endphp
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-center">{{ trans('app.total') }}</th>
                    <th class="text-center">{{ $reports->sum('count') }}</th>
                    <th class="text-right">{{ formatRp($reports->sum('omzet')) }}</th>
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
    new Morris.Line({
        element: 'yearly-chart',
        data: {!! collect($chartData)->toJson() !!},
        xkey: 'month',
        ykeys: ['value'],
        labels: ["{{ __('report.omzet') }} Rp"],
        parseTime:false,
        goals: [0],
        goalLineColors : ['red'],
        smooth: true,
        lineWidth: 2,
    });
})();
</script>
@endsection
