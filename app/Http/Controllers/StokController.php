<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Ingredient;
use App\Stok;
use DB;

class StokController extends Controller
{
    public function index()
    {
        $stok = Product::select('name', 'kode_produk','supplier', 'sisa_stok' )->get();
        return view('stok/index', compact('stok'));
    }

    public function stok()
    {
        $stok = Product::select('name', 'kode_produk', 'sisa_stok')->whereRaw('sisa_stok <= min_stok')->get();
        return view('stok/index', compact('stok'));
    }


    public function kartuStok(Request $request)
    {
        //$produk = Product::all();
        $years = getYears();
        $months = getMonths();
        $reqproduk = $request->produk;
        $year = $request->get('year', date('Y'));
        $month = $request->get('month', date('m'));
        if($reqproduk != null){
            $stok = $this->getMonthlyReports($year, $month, $reqproduk);
            $stokSum = $this->getStokSum($year, $month, $reqproduk);
            return view('stok/kartustok', compact('stok','stokSum', 'months', 'years', 'month', 'year'));
        }else{
            $stok = Stok::join('ingredient', 'ingredient.id', 'stoks.kode_produk')->orderBy('stoks.created_at', 'desc')->select('stoks.*', 'ingredient.ingredient_nama')->get();
            return view('stok/kartustok', compact('stok', 'months', 'years', 'month', 'year'));
        }

    }

    public function addStok(Request $request)
    {
        $stok = new Stok;
        $stok->masuk = $request->masuk;
        $stok->kode_produk = $request->kode_produk;
        $stok->save();
        
        $stok2 = new Stok;
        $stok2->setConnection('mysql2');
        $stok2->setTable('stoks');
        $stok2->store_id = 1;
        $stok2->masuk = $request->masuk;
        $stok2->kode_produk = $request->kode_produk;
        $stok2->save();

        $ing  =Ingredient::where('id', $request->kode_produk)->first();
        $ing->stok = $ing->stok + $request->masuk;
        $ing->save();
        return back();
    }

    private function getMonthlyReports($year, $month, $reqproduk)
    {
        $reportsData = Stok::join('ingredient', 'ingredient.id', 'stoks.kode_produk')->select('stoks.*','ingredient.ingredient_nama', DB::raw('SUM(keluar) as keluar'),DB::raw('SUM(masuk) as masuk'), DB::raw('SUM(harga) as harga'),DB::raw('DATE(stoks.created_at) as date'))
        ->groupBy(['date'])
        ->whereYear('stoks.created_at', $year)
        ->whereMonth('stoks.created_at', $month)
        ->where('kode_produk', $reqproduk)
        ->orderBy('stoks.created_at', 'desc')
        ->get();

        //dd($reportsData);
        return $reportsData;
        
    }

    private function getStokSum($year, $month, $reqproduk){
            $rawQuery = 'DATE(created_at) as date, count(`id`) as count';
            $rawQuery .= ', sum(keluar) AS keluar';
            $rawQuery .= ', sum(harga) AS harga';
    
            $reportsData = DB::table('stoks')->select(DB::raw($rawQuery))
                ->where(DB::raw('YEAR(created_at)'), $year)
                ->where(DB::raw('MONTH(created_at)'), $month)
                ->where('kode_produk', $reqproduk)
                ->groupBy('date')
                ->orderBy('date', 'asc')
                ->get();   
                
                $reports = [];
                foreach ($reportsData as $report) {
                    $key = substr($report->date, -2);
                    $reports[$key] = $report;
                    $reports[$key]->keluar = $report->keluar;
                    $reports[$key]->harga = $report->harga;
                }
        
        return collect($reports);
    }
}
