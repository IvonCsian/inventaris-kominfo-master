<?php

namespace App\Http\Controllers;

use App\Models\laporan;
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
        $data['title'] = 'Data Laporan';
        Session::forget('bulan');
        Session::forget('tahun');
        if ($request->has('bulan') || $request->has('tahun')) {
            Session::put('bulan',$request->get('bulan'));
            Session::put('tahun',$request->get('tahun'));
        }
        $data['data'] = laporan::latest()->when($request->get('tahun'),function ($query) use ($request)
                    {
                        $query->whereYear('tanggal',$request->get('tahun'));

                    })
                    ->when($request->get('bulan'),function ($query) use ($request)
                    {
                        $query->whereMonth('tanggal',$request->get('bulan'));

                    })
                    // ->withTrashed()
                    ->latest()
                    ->paginate(10)
                    ->withQueryString();
        return view('pages.laporan.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Tambah data laporan';
        $data['kendaraan'] = Kendaraan::latest()->get();
        return view('pages.laporan.create',$data);
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
            'nipl' => 'required|max:50',
            'nama' => 'required',
            'kendaraan' => 'required|not_in:0',
            'tanggal' => 'required',
            'isi' => 'required',
            'foto_konten' => 'required',
        ],[
            'nipl.required' => "NAK - NIK Tidak Boleh Kosong!",
            'nama.required' => "Nama Anggota Tidak Boleh Kosong!",
            'kendaraan.required' => "Kendaraan Tidak Boleh Kosong!",
            'tanggal.required' => "Tanggal Laporan Tidak Boleh Kosong!",
            'isi.required' => "Isi Laporan Tidak Boleh Kosong!",
        ]);
        try {
            $laporan = new laporan;
            $laporan->nama = $request->get('nama');
            $laporan->nipl = $request->get('nipl');
            $laporan->id_kendaraan = $request->get('kendaraan');
            $laporan->tanggal = $request->get('tanggal');
            $laporan->isi = $request->get('isi');
            $laporan->updated_at = null;
            if ($request->hasFile('foto_konten')) {
                $photos = $request->file('foto_konten');
                $filename = date('His') . '.' . $photos->getClientOriginalExtension();
                $path = public_path('img/barang');
                if ($photos->move($path, $filename)) {
                    $laporan->foto = $filename;
                }else{
                    return redirect()->back()->withError('Terjadi kesalahan.');
                }
            }
            $laporan->id_user = Auth::user()->id;
            $laporan->save();
            return redirect()->route('laporan.index')->withStatus('Berhasil menambahkan data');
        } catch (Exception $e) {
            return redirect()->route('laporan.index')->withError('Terjadi kesalahan');
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
        $data['title'] = 'Detail Data Laporan';
        $data['data'] = Laporan::find($id);
        return view('pages.laporan.show',$data);
    }

    public function pdfDownload(Request $request)
    {
        $data = laporan::latest();

        if (Session::has('bulan') || Session::has('tahun')) {
            $query = $data->when($request->session()->has('tahun'),function ($query) use ($request)
                     {
                         $query->whereYear('tanggal',$request->session()->get('tahun'));

                     })
                     ->when($request->session()->has('bulan'),function ($query) use ($request)
                     {
                         $query->whereMonth('tanggal',$request->session()->get('bulan'));

                     })
                     ->get();
        }else{
            $query = $data->get();
        }
        return view('pages.laporan.pdf',['data' => $query]);
    }
    public function formatNumber($param)
    {
        return (int)str_replace('.', '', $param);
    }
    public function pecahBulan($param)
    {
        return explode('-', $param);
    }

    public function deletePermanent($id)
{
    // Retrieve the model instance
    $data = laporan::withTrashed()->where('id', $id)->firstOrFail();
    
    // Construct the path to the image
    $last_path = public_path('/img/barang/' . $data->foto);
    
    // Check if the file exists before attempting to delete it
    if (file_exists($last_path)) {
        unlink($last_path);
    }

    // Permanently delete the record
    $data->forceDelete();

    // Redirect back with a success message
    return redirect()->route('laporan.index')->with('status', 'Data berhasil dihapus permanent!');
}

}
