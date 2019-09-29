<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use App\TargetPenjualan;
use App\Transaction;
use App\Customer;
use App\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $years = getYears();
        $months = getMonths();
        $year = $request->get('year', date('Y'));
        $month = $request->get('month', date('m'));
        $reports = $this->getMonthlyReports($year, $month);
        $reportsStok = $this->getStokMonthlyReports($year, $month);

        // $cs = Customer::select('name', 'no_telp','type', DB::raw('SUM(total_transaksi) as total'), DB::raw('COUNT(total_transaksi) as jumlah'))
        // ->groupBy(['no_telp'])
        // ->where('type', 'cash')
        // ->orderBy('total', 'desc')
        // ->limit(6)
        // ->get();

        // $res = Customer::select('name', 'no_telp','type', DB::raw('SUM(total_transaksi) as total'), DB::raw('COUNT(total_transaksi) as jumlah'))
        // ->groupBy(['no_telp'])
        // ->where('type', 'credit')
        // ->orderBy('total', 'desc')
        // ->limit(6)
        // ->get();

        // $target = TargetPenjualan::first();
        // $stokDashboard = Product::whereRaw('sisa_stok <= min_stok')->limit(8)->get();
        // dd($reports);
        return view('dashboard', compact('reports','reportsStok', 'months', 'years', 'month', 'year'));
    }

    private function getMonthlyReports($year, $month)
    {
        $rawQuery = 'DATE(created_at) as date, count(`id`) as count';
        $rawQuery .= ', sum(payment) AS amount';

        $reportsData = DB::table('transactions')->select(DB::raw($rawQuery))
            ->where(DB::raw('YEAR(created_at)'), $year)
            ->where(DB::raw('MONTH(created_at)'), $month)
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $reports = [];
        foreach ($reportsData as $report) {
            $key = substr($report->date, -2);
            $reports[$key] = $report;
            $reports[$key]->payment = $report->amount;
        }

        return collect($reports);
    }

    private function getStokMonthlyReports($year, $month)
    {
            $rawQuery = 'DATE(created_at) as date, count(`id`) as count';
            $rawQuery .= ', sum(harga) AS amount';
    
            $reportsData = DB::table('stoks')->select(DB::raw($rawQuery))
                ->where(DB::raw('YEAR(created_at)'), $year)
                ->where(DB::raw('MONTH(created_at)'), $month)
                ->groupBy('date')
                ->orderBy('date', 'asc')
                ->get();   
                
                $reports = [];
                foreach ($reportsData as $report) {
                    $key = substr($report->date, -2);
                    $reports[$key] = $report;
                    $reports[$key]->harga = $report->amount;
                }
        
        return collect($reports);
    }
}
