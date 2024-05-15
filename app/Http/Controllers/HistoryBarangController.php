<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class HistoryBarangController extends Controller
{
    public function history()
    {
        $update = Activity::where('log_name','Barang')->where('description','updated')->get();
        $title = 'History Barang';
        $delete = Barang::onlyTrashed()->get();
        // return $update;
        return view('pages.barang.history',compact('update','title','delete'));

    }
}
