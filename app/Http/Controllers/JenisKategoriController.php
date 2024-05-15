<?php

namespace App\Http\Controllers;

use App\Models\JenisKategori;
use Exception;
use Illuminate\Http\Request;

class JenisKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Data Jenis Kategori';
        $data['data'] = JenisKategori::latest()->get();
        return view('pages.jenis-kategori.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Tambah Jenis Kategori';
        return view('pages.jenis-kategori.create',$data);
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
        ]);
        try {
            $jenisKategori = new JenisKategori;
            $jenisKategori->nama_jenis = $request->get('name');
            $jenisKategori->save();
            return redirect()->route('jenis-kategori.index')->withStatus('Berhasil tambahkan data.');
        } catch (Exception $e) {
            return redirect()->route('jenis-kategori.index')->withError('Terjadi Kesalahan');
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
        $data['title'] = 'Edit Data Jenis Kategori';
        $data['data'] = JenisKategori::find($id);
        return view('pages.jenis-kategori.edit',$data);
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
        ]);
        try {
            $jenisKategori = JenisKategori::findOrFail($id);
            $jenisKategori->nama_jenis = $request->get('name');
            $jenisKategori->update();
            return redirect()->route('jenis-kategori.index')->withStatus('Berhasil edit data.');
        } catch (Exception $e) {
            return redirect()->route('jenis-kategori.index')->withError('Terjadi Kesalahan');
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
        JenisKategori::findOrFail($id)->delete();
        return redirect()->route('jenis-kategori.index')->withStatus('Berhasil hapus data.');

    }
}
