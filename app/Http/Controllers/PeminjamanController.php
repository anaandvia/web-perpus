<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\buku;
use App\Models\user;
use App\Models\Peminjaman;
use Symfony\Contracts\Service\Attribute\Required;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->level == 'admin') {
            return view('data.peminjaman', [
                'title' => 'Peminjaman',
                'Peminjamans' => peminjaman::all()
            ]);
        } else {
            return view('data.peminjaman', [
                'title' => 'Peminjaman',
                'Peminjamans' => peminjaman::where('anggota_id', auth()->user()->id)->get()
            ]);
        }
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
    public function store(Request $request, $id)
    {
    }
    public function peminjaman(Request $request, $buku_id)
    {

        $anggota_id = auth()->user()->id;

        $buku_id = $request->id;

        $Peminjaman = peminjaman::create([
            'anggota_id' => $anggota_id,
            'buku_id' => $buku_id,
            'tgl_pinjam' => $request->tgl_pinjam,
            'tgl_kembali' => $request->tgl_kembali,
            'status' => '1',
        ]);

        $up_stok = $request->validate([
            'stok' => 'required',
        ]);

        buku::where('id', $buku_id)
            ->update($up_stok);

        return redirect('/data/buku')->with('success', 'Peminjaman Buku Berhasil!');
        return redirect('/data/buku')->with('failed', 'Peminjaman Buku Berhasil Gagal!');
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

        $up_status = $request->validate([
            'status' => 'required',
        ]);
        peminjaman::where('id', $id)
            ->update($up_status);

        $buku_id = $request->buku_id;

        $up_stok = $request->validate([
            'stok' => 'required',
        ]);
        buku::where('id', $buku_id)
            ->update($up_stok);

        return redirect('/data/peminjaman')->with('success', 'Status Peminjaman Buku Berhasil Di Ubah!');
        return redirect('/data/peminjaman')->with('failed', 'Status Peminjaman Buku Gagal Di Ubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $i = peminjaman::find($id);
        $i->delete();
        return redirect('/data/peminjaman')->with('success', 'Berhasil DiHapus!');
    }
}
