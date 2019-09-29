<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profil/index');
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
        //
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
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255']
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect()->route('profil.index');
    }

    public function gantiAva(Request $request, $id)
    {
        $this->validate($request, [
            'avatar' => 'required|mimes:jpg,jpeg,png|max:10000', // max 10MB
        ]);
        // tampung berkas yang sudah diunggah ke variabel baru
        $file = $request->file('avatar');
        dd($file);
        // simpan berkas yang diunggah ke sub-direktori 'public/avatar'
        // direktori 'avatar' otomatis akan dibuat jika belum ada
        $filename = 'avatar-'. str_random(16) . $file->getClientOriginalName();
        // save to storage/app/photos as the new $filename
        $path = $file->move('img/avatar/', $filename);
        $file = User::find($id)->update([
            'avatar' => $filename,
        ]);
        return redirect()->route('profil.index');
    }

    public function gantiPassword(Request $request, $id)
    {
        $this->validate($request, [
            'password' => ['required', 'min:6', 'confirmed'],
        ]);
        $user = User::find($id);
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('profil.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
