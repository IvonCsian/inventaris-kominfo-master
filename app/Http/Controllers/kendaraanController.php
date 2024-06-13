<?php

namespace App\Http\Controllers;

use App\Models\kendaraan;
use App\Models\barang;
use App\Models\Kategori;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class kendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['title'] = 'Data Kendaraan';
        Session::forget('bulan');
        Session::forget('tahun');
        if ($request->has('bulan') || $request->has('tahun')) {
            Session::put('bulan',$request->get('bulan'));
            Session::put('tahun',$request->get('tahun'));
        }
        $data['data'] = kendaraan::latest()->when($request->get('tahun'),function ($query) use ($request)
                    {
                        $query->whereYear('stnk',$request->get('tahun'));

                    })
                    ->when($request->get('bulan'),function ($query) use ($request)
                    {
                        $query->whereMonth('stnk',$request->get('bulan'));

                    })
                    // ->withTrashed()
                    ->latest()
                    ->paginate(10)
                    ->withQueryString();
        return view('pages.kendaraan.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Tambah data kendaraan';
        $data['kategori'] = Kategori::latest()->get();
        return view('pages.kendaraan.create',$data);
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
            'nopol' => 'required',
            'jenis' => 'required',
            'kategori' => 'required|not_in:0',
            'stnk' => 'required',
            'nipk' => 'required',
        ],[
            'nopol.required' => "Nomor Polisi Tidak Boleh Kosong!",
            'jenis.required' => "Jenis Merk Kendaraan Tidak Boleh Kosong!",
            'kategori.required' => "Kategori Kendaraan Tidak Boleh Kosong!",
            'stnk.required' => "Masa Berlaku STNK Kendaraan Tidak Boleh Kosong!",
            'nipk.required' => "Masa NAK - NIK Tidak Boleh Kosong!",
        ]);
        try {
            $kendaraan = new kendaraan;
            $kendaraan->nopol = $request->get('nopol');
            $kendaraan->jenis = $request->get('jenis');
            $kendaraan->id_kategori = $request->get('kategori');
            $kendaraan->stnk = $request->get('stnk');
            $kendaraan->nipk = $request->get('nipk');
            $kendaraan->updated_at = null;
            $kendaraan->id_user = Auth::user()->id;
            $kendaraan->save();
            return redirect()->route('kendaraan.index')->withStatus('Berhasil menambahkan data');
        } catch (Exception $e) {
            return redirect()->route('kendaraan.index')->withError('Terjadi kesalahan');
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
        $data['title'] = 'Detail Data kendaraan';
        $data['data'] = kendaraan::find($id);
        return view('pages.kendaraan.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title'] = 'Edit kendaraan';
        // $data['data'] = kendaraan::withTrashed()->find($id);
        $data['data'] = kendaraan::find($id);
        $data['kategori'] = Kategori::latest()->get();
        return view('pages.kendaraan.edit',$data);
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
            'nopol' => 'required',
            'jenis' => 'required',
            'kategori' => 'required|not_in:0',
            'stnk' => 'required',
            'nipk' => 'required',
        ]);
        try{
            $kendaraan = kendaraan::withTrashed()->find($id);
            $kendaraan->nopol = $request->get('nopol');
            $kendaraan->jenis = $request->get('jenis');
            $kendaraan->id_kategori = $request->get('kategori');
            $kendaraan->stnk = $request->get('stnk');
            $kendaraan->nipk = $request->get('nipk');
            $kendaraan->updated_at = now();
            $kendaraan->id_user = Auth::user()->id;
            $kendaraan->update();
            return redirect()->route('kendaraan.index')->withStatus('Berhasil mengganti data');
        } catch (Exception $e) {
            return $e;
            return redirect()->route('kendaraan.index')->withError('Terjadi kesalahan');
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
        // $kendaraan = kendaraan::find($id);
        kendaraan::withTrashed()->where('id',$id)->update([
            'is_active' => '0',
            // 'updated_at' => null,

        ]);
        kendaraan::withTrashed()->where('id',$id)->delete();
        return redirect()->route('kendaraan.index')->withStatus('Berhasil menghapus data');

    }
    public function pdfDownload(Request $request)
    {
        
        $data = kendaraan::latest();

        if (Session::has('bulan') || Session::has('tahun')) {
            $query = $data->when($request->session()->has('tahun'),function ($query) use ($request)
                     {
                         $query->whereYear('stnk',$request->session()->get('tahun'));

                     })
                     ->when($request->session()->has('bulan'),function ($query) use ($request)
                     {
                         $query->whereMonth('stnk',$request->session()->get('bulan'));

                     })
                     ->get();
        }else{
            $query = $data->get();
        }
        return view('pages.kendaraan.pdf',['data' => $query]);
    }
    public function formatNumber($param)
    {
        return (int)str_replace('.', '', $param);
    }
    public function pecahBulan($param)
    {
        return explode('-', $param);
    }

    public function restore($id)
    {
        try {
            kendaraan::withTrashed()->where('id',$id)->update([
                'is_active' => true,
                // 'updated_at' => null,
            ]);
            $restore = kendaraan::withTrashed()->where('id',$id);
            $restore->restore();
            return redirect()->route('kendaraan.index')->withStatus('Berhasil mengganti status data.');
        } catch (Exception $e) {
            return redirect()->route('kendaraan.index')->withError('Terjadi kesalahan.');
        } catch (QueryException $e){
            return redirect()->route('kendaraan.index')->withError('Terjadi kesalahan.');
        }
    }

    public function deletePermanent($id)
    {
        // Retrieve the model instance with trashed items
        $data = kendaraan::withTrashed()->where('id', $id)->firstOrFail();
    
        // Permanently delete the record
        $data->forceDelete();
    
        // Redirect back with a success message
        return redirect()->route('kendaraan.index')->with('status', 'Data berhasil dihapus permanent!');
    }
    
}
