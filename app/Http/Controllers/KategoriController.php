<?php

namespace App\Http\Controllers;

use App\Models\JenisKategori;
use App\Models\Kategori;
use Exception;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Data Kategori';
        $data['data'] = Kategori::latest()->get();
        return view('pages.kategori.index',$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Edit Data Kategori';
        $data['data'] = JenisKategori::latest()->get();
        return view('pages.kategori.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'kategori_jenis' => 'required|not_in:0',
            'status' => 'required',
        ]);
        try {
            $kategori = new Kategori;
            $kategori->nama = $request->get('name');
            $kategori->id_jenis = $request->get('kategori_jenis');
            $kategori->status = $request->get('status');
            $kategori->save();
            return redirect()->route('kategori.index')->withStatus('Berhasil menambahkan data');
        } catch (Exception $e) {
            return redirect()->route('kategori.index')->withError('Terjadi kesalahan');
        }
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
        $data['title'] = 'Edit Data Kategori';
        $data['data'] = Kategori::find($id);
        $data['kategori'] = JenisKategori::latest()->get();
        return view('pages.kategori.edit',$data);
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
        $request->validate([
            'name' => 'required',
            'kategori_jenis' => 'required|not_in:0',
            'status' => 'required',
        ]);
        try {
            $kategori = Kategori::findOrFail($id);
            $kategori->nama = $request->get('name');
            $kategori->id_jenis = $request->get('kategori_jenis');
            $kategori->status = $request->get('status');
            $kategori->update();
            return redirect()->route('kategori.index')->withStatus('Berhasil mengedit data');
        } catch (Exception $e) {
            return redirect()->route('kategori.index')->withError('Terjadi kesalahan');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kategori::findOrFail($id)->delete();
        return redirect()->route('kategori.index')->withStatus('Berhasil menghapus data');

    }
}
