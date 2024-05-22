<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use App\Models\User;

class LogUserController extends Controller
{
    public function loguser()
    {
        $data['title'] = 'LOG User Aplikasi';
        $data['data'] = Activity::all();
        $data['data']->transform(function($value) {
            $user = User::find($value->causer_id)->email ?? '-';
            $value->user = $user;
            return $value;
        });
        // return $data;
        return view('pages.log-user.index',$data);
    }
}
