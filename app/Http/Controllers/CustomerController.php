<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $datas = Levels::all();
        $datas = Customers::orderBy('id', 'desc')->get();
        $title = "Data Customer";
        return view('customer.index', compact('datas', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Tambah Customer";
        return view('customer.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Customers::create($request->all());
        return redirect()->to('customer')->with('success', 'Data Berhasil Ditambahkan');
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
        $edit = Customers::find($id); //ketika data tidak ada, akan muncul blank
        $title = "Edit Customer";
        // $level = Levels::findOrFail($id); //ketika data tidak ada, akan muncul error 404
        // $level = Levels::where('id', $id)->first();
        return view('customer.edit', compact('edit', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $customer = Customers::find($id);
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->address = $request->address;
        $customer->save();
        return redirect()->to('customer')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customers::find($id);
        $customer->delete();
        return redirect()->to('customer')->with('success', 'Data Berhasil Dihapus');
    }
}
