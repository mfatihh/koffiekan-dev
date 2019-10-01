<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ingredient;
use App\KategoryIngredient;
use App\Unit;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $satuan = Unit::all();
        $data = Ingredient::join('kategory_ingredient', 'kategory_ingredient.id', 'ingredient.kategory_ingredient_id')->orderBy('ingredient.created_at', 'desc')->get();
        $kating = KategoryIngredient::orderBy('id', 'desc')->get();
        return view('ingredient/index', compact('data','satuan', 'kating'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $data = $request->validate([
            'ingredient_nama' => 'required',
            'nilai' => 'required',
            'satuan' => 'required'
            //'satuan' => 'required'
        ]);

        $data = new Ingredient;
        $data->ingredient_nama = $request->ingredient_nama;
        $data->stok = $request->nilai;
        $data->kategory_ingredient_id = $request->kategory_ingredient_id;
        $data->harga_satuan = $request->harga;
        $data->satuan_harga = $request->satuan_harga;
        $data->satuan = $request->satuan;
        $data->save();
        
        $data2 = new Ingredient;
        $data2->setConnection('mysql2');
        $data2->setTable('ingredient');
        $data2->ingredient_id = $data->id;
        $data2->store_id = 1;
        $data2->ingredient_nama = $request->ingredient_nama;
        $data2->stok = $request->nilai;
        $data->kategory_ingredient_id = $request->kategory_ingredient_id;
        $data2->harga_satuan = $request->harga;
        $data2->satuan_harga = $request->satuan_harga;
        $data2->satuan = $request->satuan;
        
        $data2->save();
        
        return redirect()->route('ingredient.index')->with('message', 'Tambah data berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'ingredient_nama' => 'required',
            //'satuan' => 'required'
        ]);

        $data = Ingredient::find($id);
        $data->ingredient_nama = $request->ingredient_nama;
        $data->stok = $request->nilai;
        $data->harga_satuan = $request->harga;
        $data->satuan_harga = $request->satuan_harga;
        $data->satuan = $request->satuan;
        $data->save();
        
        $data2 = Ingredient::first()->setConnection('mysql2')->setTable('ingredient')->where('ingredient_id', $id)->where('store_id', 1)->first();
        $data2->store_id = 1;
        $data2->ingredient_nama = $request->ingredient_nama;
        $data2->stok = $request->nilai;
        $data2->harga_satuan = $request->harga;
        $data2->satuan_harga = $request->satuan_harga;
        $data2->satuan = $request->satuan;
        
        $data2->save();
        return redirect()->route('ingredient.index')->with('message', 'Update data berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Ingredient::find($id);
        $data->delete();
        return redirect()->route('ingredient.index')->with('message', 'Hapus data berhasil');;
    }
}
