<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Product;
use App\Unit;
use App\Ingredient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        require_once app_path().'/Helpers/helpers.php';
        require_once app_path().'/Helpers/date_time.php';

        \Validator::extend('not_exists', function ($attribute, $value, $parameters) {
            return \DB::table($parameters[0])
                ->where($parameters[1], $value)
                ->count() < 1;
        });
        $products = Unit::all();
        view()->share('products', $products);
        $product = Product::all();
        view()->share('product', $product);
        $ingredient = Ingredient::all();
        view()->share('ingredient', $ingredient);
        // $productNotif = Product::whereRaw('sisa_stok <= min_stok')->get();
        // view()->share('productNotif', $productNotif);
        // $supp = Supplier::where('status', 1)->get();
        // view()->share('supp', $supp);
        // $transac = Transaction::all();
        // view()->share('transac', $transac);
        // $productApprove = Product::where('status', 0)->get();
        // view()->share('productApprove', $productApprove);
        // $productDelete = Product::where('status', 2)->get();
        // view()->share('productDelete', $productDelete);
        // $targets = TargetPenjualan::first();
        // view()->share('targets', $targets);
        // $distri = Distributor::all();
        // view()->share('distri', $distri);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
