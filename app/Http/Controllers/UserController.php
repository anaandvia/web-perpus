<?php

namespace App\Http\Controllers;

use App\Models\user;
use App\Models\peminjaman;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('data.anggota', [
            'title' => 'Anggota',
            'Users' => User::all()
        ]);
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
        $no_anggota = User::max('no_anggota') + 1;

        $User = user::create([
            'no_anggota' => $no_anggota,
            'nama' => $request->nama,
            'tgl_lahir' => $request->tgl_lahir,
            'jk' => $request->jk,
            'password' => bcrypt('123456'),
            'level' => 'anggota',
        ]);

        return redirect('/data/anggota')->with('success', 'Data Berhasil Ditambahkan!');
        return redirect('/data/anggota')->with('failed', 'Data Gagal Ditambahkan!');
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
    }

    public function updateanggota(Request $request, $id)
    {
        $Update_fq = $request->validate([
            'nama' => 'required',
            'tgl_lahir' => 'required',
            'jk' => 'required',
            'level' => 'required',
        ]);

        user::where('id', $id)
            ->update($Update_fq);

        return redirect('/data/anggota')->with('success', 'Data Berhasil Diubah!');
        return redirect('/data/anggota')->with('failed', 'Data Gagal Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Peminjaman::where('anggota_id', $id)->exists()) {
            return redirect('/data/anggota')->with('failed', 'Data Gagal Dihapus karena masih memiliki peminjaman!');
        } else {
            $i = user::find($id);
            $i->delete();
        }
        return redirect('/data/anggota')->with('success', 'Data Berhasil Dihapus!');
    }
}
