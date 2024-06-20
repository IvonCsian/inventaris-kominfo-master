<?php

namespace App\Http\Controllers;

use App\Models\lapshow;
use App\Models\laporan;
use App\Models\kendaraan;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class lapshowController extends Controller
{
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
        ]);
        try {
            $lapshow = new laporan;
            $lapshow->nama = $request->get('nama');
            $lapshow->nipl = $request->get('nipl');
            $lapshow->id_kendaraan = $request->get('kendaraan');
            $lapshow->tanggal = $request->get('tanggal');
            $lapshow->isi = $request->get('isi');
            $lapshow->updated_at = null;
            if ($request->hasFile('foto_konten')) {
                $photos = $request->file('foto_konten');
                $filename = date('His') . '.' . $photos->getClientOriginalExtension();
                $path = public_path('img/barang');
                if ($photos->move($path, $filename)) {
                    $lapshow->foto = $filename;
                }else{
                    return redirect()->back()->withError('Terjadi kesalahan.');
                }
            }
            $lapshow->id_user = Auth::user()->id;
            $lapshow->save();
            return redirect()->route('laporan.lapshowpdf')->withStatus('Berhasil menambahkan data');
        } catch (Exception $e) {
            return redirect()->route('laporan.lapshowpdf')->withError('Terjadi kesalahan');
        }
    }
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
        return view('pages.laporan.lapshowpdf',$data);
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
            'nipl' => 'required|max:50',
            'nama' => 'required',
            'kendaraan' => 'required|not_in:0',
            'tanggal' => 'required',
            'isi' => 'required',
            'foto_konten' => 'required',
        ]);
        try{
            $lapshow = laporan::withTrashed()->find($id);
            $lapshow->nama = $request->get('nama');
            $lapshow->id_kendaraan = $request->get('kendaraan');
            $lapshow->tanggal = $request->get('tanggal');
            $lapshow->isi = $request->get('isi');
            $lapshow->updated_at = now();
            $lapshow->nipl = $request->get('nipl');
            if ($request->hasFile('foto_konten')) {
                $photos = $request->file('foto_konten');
                $last_path = public_path().'/img/barang/'.$lapshow->foto;
                unlink($last_path);
                $filename = date('His') . '.' . $photos->getClientOriginalExtension();
                $path = public_path('img/barang');
                if ($photos->move($path, $filename)) {
                    $lapshow->foto = $filename;
                }else{
                    return redirect()->back()->withError('Terjadi kesalahan.');
                }
            }
            $lapshow->id_user = Auth::user()->id;
            $lapshow->update();
            return redirect()->route('laporan.lapshowpdf')->withStatus('Berhasil mengganti data');
        } catch (Exception $e) {
            return $e;
            return redirect()->route('laporan.lapshowpdf')->withError('Terjadi kesalahan');
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
        return view('pages.laporan.lapshowpdf',$data);
    }
    // public function restore($id)
    // {
    //     try {
    //         laporan::withTrashed()->where('id',$id)->update([
    //             'is_active' => true,
    //             // 'updated_at' => null,
    //         ]);
    //         $restore = laporan::withTrashed()->where('id',$id);
    //         $restore->restore();
    //         return redirect()->route('laporan.lapshowpdf')->withStatus('Berhasil mengganti status data.');
    //     } catch (Exception $e) {
    //         return redirect()->route('laporan.lapshowpdf')->withError('Terjadi kesalahan.');
    //     } catch (QueryException $e){
    //         return redirect()->route('laporan.lapshowpdf')->withError('Terjadi kesalahan.');
    //     }
    // }
    public function pdfDownload($id)
    {
        $data = laporan::latest();
        // CONTOH PERTAMA 
        // $query = $data->where('id',$id)->get();
        // contoh kedua 
        $query = $data->find($id);
        
        return view('pages.laporan.lapshowpdf',['data' => $query]);
    }
}