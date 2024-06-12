<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\kendaraan;
use App\Models\JenisKategori;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    public function index()
    {
        $data['barang'] = Barang::count();
        $data['jenis'] = JenisKategori::count();
        $data['kategori'] = Kategori::count();
        $data['user'] = User::count();
        $data['data'] = Activity::latest()->take(10)->get();
        $data['data']->transform(function($value) {
            $user = User::find($value->causer_id)->email ?? '-';
            $value->user = $user;
            return $value;
        });
        return view('dashboard', $data);
    }

}
