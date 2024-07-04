<?php

namespace App\Http\Controllers;

use App\Models\buku;

use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('data.buku', [
            'title' => 'Buku',
            'Bukus' => Buku::all()
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
        $Add_b = $request->validate([
            'judul_buku' => 'required',
            'n_hal' => 'required',
            'tgl_terbit' => 'required',
            'stok' => 'required',
        ]);

        buku::create($Add_b);

        return redirect('/data/buku')->with('success', 'Data Berhasil Ditambahkan!');
        return redirect('/data/buku')->with('failed', 'Data Gagal Ditambahkan!');
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
        $Update_b = $request->validate([
            'judul_buku' => 'required',
            'n_hal' => 'required',
            'tgl_terbit' => 'required',
            'stok' => 'required',
        ]);

        buku::where('id', $id)
            ->update($Update_b);

        return redirect('/data/buku')->with('success', 'Data Berhasil Di Update!');
        return redirect('/data/buku')->with('failed', 'Data Gagal Di Update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $b = buku::find($id);
        $b->delete();

        return redirect('/data/buku')->with('success', 'Data Berhasil Di Hapus!');
    }
}
