@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
@endsection

@section('content')

    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-4">
            <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">info_outline</i>
                    </div>
                    <p class="card-category"> Total Penjualan bulan ini </p>
                    <h5 class="card-title"> {{ formatRp($reports->sum('amount')) }} </h5>
                </div>
                <div class="card-footer">
                    <a class="stats" href="{{route('transactions.index')}}">
                        View
                        more
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
        </div>


        <div class="col-md-4">
            <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                    <div class="card-icon">
                        <i class="material-icons">store</i>
                    </div>
                    <p class="card-category"> Total Keuntungan bulan ini </p>
                    <h5 class="card-title"> {{ formatRp($reports->sum('amount')-$reportsStok->sum('amount')) }} </h5>
                </div>

                <div class="card-footer">
                    <a class="stats" href=" {{url('reports/sales')}} ">
                        View
                        more
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                    <div class="card-icon">
                        <i class="fa fa-shopping-cart fa-icon-medium"></i>
                    </div>
                    <p class="card-category"> Total Expenditure </p>
                    <h5 class="card-title"> {{ formatRp($reportsStok->sum('amount')) }} </h5>
                </div>
                <div class="card-footer">
                    <a class="stats" href="{{url('stok/kartu')}}">
                        View
                        more
                        <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    <div class="col-md-12">
        <div class="card card-chart">
            <div class="card-header card-header-success" style="background:#fff;">
                <div class="ct-chart" width="100%;" id="monthly-chart"></div>
            </div>
            <div class="card-body">
                <h4 class="card-title">Grafik Penjualan</h4>
                <p class="card-category">
                    <span class="text-success"><i class="fa fa-long-arrow-up"></i>  </span> Bulan {{ $months[$month] }}
                </p>
            </div>
            {{-- <div class="card-footer">
                        <div class="stats">
                          <i class="material-icons">access_time</i> updated 4 minutes ago
                        </div>
                      </div> --}}
        </div>
    </div>
</div>


@php $chartData = []; @endphp
@foreach(monthDateArray($year, $month) as $dateNumber)
    @php
        $any = isset($reports[$dateNumber]);
        $count = $any ? $reports[$dateNumber]->count : 0;
        $subtotal = $any ? $reports[$dateNumber]->amount : 0;
    @endphp
                   
     @php
        $chartData[] = ['date' => $dateNumber, 'value' => ($subtotal) ];
    @endphp
@endforeach
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