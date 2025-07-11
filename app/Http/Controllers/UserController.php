<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $datas = Levels::all();
        $datas = User::orderBy('id', 'desc')->get();
        $title = "Data User";
        return view('user.index', compact('datas', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah User";
        return view('user.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        User::create($request->all());
        // toast('Data Berhasil Ditambah', 'success');
        alert()->success('Tambah Berhasil', 'Data Berhasil Ditambah');
        return redirect()->to('user')->with('success', 'Data Berhasil Ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id); //ketika data tidak ada, akan muncul blank
        $title = "Edit User";
        // $level = Levels::findOrFail($id); //ketika data tidak ada, akan muncul error 404
        // $level = Levels::where('id', $id)->first();
        return view('user.edit', compact('user', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = $request->password;
        }
        $user->save();
        // toast('Data Berhasil Diubah', 'success');
        alert()->success('Ubah Berhasil', 'Data Berhasil Diubah');
        return redirect()->to('user')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        // toast('Data Berhasil Dihapus', 'success');
        alert()->success('Hapus Berhasil', 'Data Berhasil Dihapus');
        return redirect()->to('user')->with('success', 'Data Berhasil Dihapus');
    }
}
