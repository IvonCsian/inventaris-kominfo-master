<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\kendaraan;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['title'] = 'Data Barang';
        Session::forget('bulan');
        Session::forget('tahun');
        if ($request->has('bulan') || $request->has('tahun')) {
            Session::put('bulan',$request->get('bulan'));
            Session::put('tahun',$request->get('tahun'));
        }
        $data['data'] = Barang::latest()->when($request->get('tahun'),function ($query) use ($request)
                    {
                        $query->whereYear('tahun',$request->get('tahun'));

                    })
                    ->when($request->get('bulan'),function ($query) use ($request)
                    {
                        $query->whereMonth('tahun',$request->get('bulan'));

                    })
                    // ->withTrashed()
                    ->latest()
                    ->paginate(10)
                    ->withQueryString();
        return view('pages.barang.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Tambah data barang';
        $data['kendaraan'] = Kendaraan::latest()->get();
        return view('pages.barang.create',$data);
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
            'nipb' => 'required|max:50',
            'name' => 'required',
            'kendaraan' => 'required|not_in:0',
            'merk' => 'required',
            'bahan' => 'required',
            'ukuran' => 'required',
            'tahun' => 'required',
            'asal_barang' => 'required',
            'kondisi_barang' => 'required',
            'jumlah_barang' => 'required',
            'harga_barang' => 'required',
            'gambar_konten' => 'required',
        ],[
            'nipb.required' => "NAK - NIK Tidak Boleh Kosong!",
            'name.required' => "Nama Anggota Tidak Boleh Kosong!",
            'kendaraan.required' => "Kendaraan Tidak Boleh Kosong!",
            'merk.required' => "Muatan Kendaraan Tidak Boleh Kosong!",
            'bahan.required' => "Kondisi Oli dan Radiator Kendaraan Tidak Boleh Kosong!",
            'ukuran.required' => "Kondisi Rem dan Lampu Kendaraan Tidak Boleh Kosong!",
            'tahun.required' => "Masa Berlaku STNK Kendaraan Tidak Boleh Kosong!",
            'asal_barang.required' => "Kondisi Ban dan Wipper Kendaraan Tidak Boleh Kosong!",
            'kondisi_barang.required' => "Kondisi Klakson Tidak Boleh Kosong!",
            'jumlah_barang.required' => "Jumlah Penumpang Tidak Boleh Kosong!",
            'harga_barang.required' => "Meteran Akhir Kendaraan Tidak Boleh Kosong!",
        ]);
        try {
            $barang = new Barang;
            $barang->nama_barang = $request->get('name');
            $barang->nipb = $request->get('nipb');
            $barang->id_kendaraan = $request->get('kendaraan');
            $barang->merk = $request->get('merk');
            $barang->ukuran = $request->get('ukuran');
            $barang->bahan = $request->get('bahan');
            $barang->tahun = $request->get('tahun');
            $barang->asal_barang = $request->get('asal_barang');
            $barang->kondisi_barang = $request->get('kondisi_barang');
            $barang->jumlah_barang = $request->get('jumlah_barang');
            $barang->updated_at = null;
            $barang->harga_barang = $this->formatNumber($request->get('harga_barang'));
            if ($request->hasFile('gambar_konten')) {
                $photos = $request->file('gambar_konten');
                $filename = date('His') . '.' . $photos->getClientOriginalExtension();
                $path = public_path('img/barang');
                if ($photos->move($path, $filename)) {
                    $barang->foto_barang = $filename;
                }else{
                    return redirect()->back()->withError('Terjadi kesalahan.');
                }
            }
            $barang->id_user = Auth::user()->id;
            $barang->save();
            return redirect()->route('barang.index')->withStatus('Berhasil menambahkan data');
        } catch (Exception $e) {
            return redirect()->route('barang.index')->withError('Terjadi kesalahan');
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
        $data['title'] = 'Detail Data Barang';
        $data['data'] = Barang::find($id);
        return view('pages.barang.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title'] = 'Edit Barang';
        // $data['data'] = Barang::withTrashed()->find($id);
        $data['data'] = Barang::find($id);
        $data['kendaraan'] = kendaraan::latest()->get();
        return view('pages.barang.edit',$data);
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
            'nipb' => 'required|max:50',
            'name' => 'required',
            'kendaraan' => 'required|not_in:0',
            'bahan' => 'required',
            'ukuran' => 'required',
            'tahun' => 'required',
            'asal_barang' => 'required',
            'kondisi_barang' => 'required',
            'jumlah_barang' => 'required',
            'harga_barang' => 'required',
        ]);
        try{
            $barang = Barang::withTrashed()->find($id);
            $barang->nama_barang = $request->get('name');
            $barang->id_kendaraan = $request->get('kendaraan');
            $barang->merk = $request->get('merk');
            $barang->ukuran = $request->get('ukuran');
            $barang->bahan = $request->get('bahan');
            $barang->tahun = $request->get('tahun');
            $barang->asal_barang = $request->get('asal_barang');
            $barang->kondisi_barang = $request->get('kondisi_barang');
            $barang->jumlah_barang = $request->get('jumlah_barang');
            $barang->updated_at = now();
            $barang->nipb = $request->get('nipb');

            $barang->harga_barang = $this->formatNumber($request->get('harga_barang'));
            if ($request->hasFile('gambar_konten')) {
                $photos = $request->file('gambar_konten');
                $last_path = public_path().'/img/barang/'.$barang->foto_barang;
                unlink($last_path);
                $filename = date('His') . '.' . $photos->getClientOriginalExtension();
                $path = public_path('img/barang');
                if ($photos->move($path, $filename)) {
                    $barang->foto_barang = $filename;
                }else{
                    return redirect()->back()->withError('Terjadi kesalahan.');
                }
            }
            $barang->id_user = Auth::user()->id;
            $barang->update();
            return redirect()->route('barang.index')->withStatus('Berhasil mengganti data');
        } catch (Exception $e) {
            return $e;
            return redirect()->route('barang.index')->withError('Terjadi kesalahan');
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
        // $barang = Barang::find($id);
        Barang::withTrashed()->where('id',$id)->update([
            'is_active' => '0',
            // 'updated_at' => null,

        ]);
        Barang::withTrashed()->where('id',$id)->delete();
        return redirect()->route('barang.index')->withStatus('Berhasil menghapus data');

    }
    public function pdfDownload(Request $request)
    {
        $data = Barang::latest();

        if (Session::has('bulan') || Session::has('tahun')) {
            $query = $data->when($request->session()->has('tahun'),function ($query) use ($request)
                     {
                         $query->whereYear('tahun',$request->session()->get('tahun'));

                     })
                     ->when($request->session()->has('bulan'),function ($query) use ($request)
                     {
                         $query->whereMonth('tahun',$request->session()->get('bulan'));

                     })
                     ->get();
        }else{
            $query = $data->get();
        }
        return view('pages.barang.pdf',['data' => $query]);
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
            Barang::withTrashed()->where('id',$id)->update([
                'is_active' => true,
                // 'updated_at' => null,
            ]);
            $restore = Barang::withTrashed()->where('id',$id);
            $restore->restore();
            return redirect()->route('barang.index')->withStatus('Berhasil mengganti status data.');
        } catch (Exception $e) {
            return redirect()->route('barang.index')->withError('Terjadi kesalahan.');
        } catch (QueryException $e){
            return redirect()->route('barang.index')->withError('Terjadi kesalahan.');
        }
    }

    public function deletePermanent($id)
    {
        $data = Barang::withTrashed()->where('id',$id);
        $last_path = public_path().'/img/barang/'.$data->foto_barang;
        unlink($last_path);
        $data->forceDelete();
        return redirect()->route('barang.index')->with('status', 'Data berhasil dihapus permanent!');
    }
}
