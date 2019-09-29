<?php

namespace App\Http\Controllers;

use App\Unit;
use Illuminate\Http\Request;

class UnitsController extends Controller
{
    public function index(Request $request)
    {
        $editableUnit = null;
        $units = Unit::withCount('products')->get();

        if (in_array($request->get('action'), ['edit', 'delete']) && $request->has('id')) {
            $editableUnit = Unit::find($request->get('id'));
        }

        return view('units.index', compact('units', 'editableUnit'));
    }

    public function store(Request $request)
    {
        $newUnit = $request->validate([
            'name' => 'required|max:191',
        ]);

        $data = new Unit;
        $data->name = $request->name;
        $data->save();
        
        $data2 = new Unit;
        $data2->setConnection('mysql2');
        $data2->setTable('product_units');
        $data2->name = $request->name;
        $data2->unit_id = $data->id;
        $data2->store_id = 1;
        $data2->save();

        flash(trans('unit.created'), 'success');

        return redirect()->route('products.index');
    }

    public function update(Request $request, $id)
    {
        $unitData = $request->validate([
            'name' => 'required|max:20',
        ]);

        $data = Unit::find($id);
        $data->name = $request->name;
        $data->save();
        
        $data2 = Unit::first()->setConnection('mysql2')->setTable('product_units')->where('unit_id', $id)->where('store_id', 1)->first();
        $data2->name = $request->name;
        $data2->save();

        flash(trans('unit.updated'), 'success');

        return redirect()->route('products.index');
    }

    public function destroy($id)
    {
        Unit::find($id)->delete();
        return back();
    }
}
