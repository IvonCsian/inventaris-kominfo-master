<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Data User';
        $sql =new User;
        if (Auth::user()->role == 'super-admin') {
            $data['data'] = $sql->get();
        } elseif (Auth::user()->role == 'admin' && Auth::user()->role == 'operator') {
            $data['data'] = $sql->where('role','!=', 'super-admin')->get();
        } else {
            $data['data'] = $sql->where('role','!=', 'super-admin')->where('role','!=', 'admin')->get();
        }
        return view('pages.users.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['title'] = 'Tambah User';
        return view('pages.users.create',$data);
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
            'nip' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'jabatan' => 'required',
            'jabatan_keanggotaan' => 'required',
        ]);
        try {
            $user = new User;
            $user->name = $request->get('name');
            $user->nip = $request->get('nip');
            $user->email = $request->get('email');
            $user->jabatan = $request->get('jabatan');
            $user->password = Hash::make($request->get('password'));
            $user->role = $request->get('role');
            $user->jabatan_keanggotaan = $request->get('jabatan_keanggotaan');
            $user->save();
            return redirect()->route('user.index')->withStatus('Berhasil menambahkan data.');
        } catch (Exception $th) {
            return redirect()->route('user.index')->withError('Terjadi kesalahan.');
        } catch (QueryException $e) {
            return redirect()->route('user.index')->withError('Terjadi kesalahan.');
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
        $data['title'] = 'Edit Data User';
        $data['data'] = User::find($id);
        return view('pages.users.edit',$data);
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
            'email' => 'required',
            'jabatan' => 'required',
            'jabatan_keanggotaan' => 'required',
            ]);
        try {
            $user = User::find($id);
            $user->name = $request->get('name');
            $user->nip = $request->get('nip');
            $user->email = $request->get('email');
            $user->jabatan = $request->get('jabatan');
            $user->jabatan_keanggotaan = $request->get('jabatan_keanggotaan');
            $user->update();
            return redirect()->route('user.index')->withStatus('Berhasil mengganti data.');
        } catch (Exception $th) {
            return redirect()->route('user.index')->withError('Terjadi kesalahan.');
        } catch (QueryException $e) {
            return redirect()->route('user.index')->withError('Terjadi kesalahan.');
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
        User::find($id)->delete();
        return redirect()->route('user.index')->withStatus('Berhasil menambahkan data');
    }
}
