<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class LogUserController extends Controller
{
    public function loguser()
    {
        $data['title'] = 'LOG User Aplikasi';
        $data['data'] = Activity::all();

        // return $data;
        return view('pages.log-user.index',$data);
    }
}
