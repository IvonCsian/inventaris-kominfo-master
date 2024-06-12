<?php

namespace App\Http\Controllers;

use App\Models\kendaraan;
use App\Models\barang;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class HistorykendaraanController extends Controller
{
    public function history()
    {
        $update = Activity::where('log_name','kendaraan')->where('description','updated')->get();
        $title = 'History Kendaraan';
        $delete = kendaraan::onlyTrashed()->get();
        // return $update;
        return view('pages.kendaraan.history',compact('update','title','delete'));

    }
}
