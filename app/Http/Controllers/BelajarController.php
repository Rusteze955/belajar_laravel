<?php

namespace App\Http\Controllers;

use App\Models\Count;
use Illuminate\Http\Request;

class BelajarController extends Controller
{
    public function index()
    {
        return view('aritmatika');
    }

    public function tambah()
    {
        $title = "Tambah-tambahan";
        $jumlah = 0;
        $error = null;
        return view('tambah', compact('title', 'jumlah', 'error'));
    }
    public function kurang()
    {
        $title = "Pengurangan";
        $kurang = 0;
        return view('kurang', compact('title', 'kurang'));
    }

    public function tambahAction(Request $request)
    {
        $request->validate(
            [
                'angka1' => 'required',
                'angka2' => 'required'
            ]
        );

        $angka1 = $request->angka1;
        $angka2 = $request->angka2;
        $error = null;
        $jumlah = null;

        if (!is_numeric($angka1) || !is_numeric($angka2)) {
            $error = "Data Harus Numeric";
        } else {
            $jumlah = $angka1 + $angka2;
        }

        if ($error == null) {
            Count::create([
                'jenis' => $request->jenis,
                'angka1' => $angka1,
                'angka2' => $angka2,
                'hasil' => $jumlah
            ]);
        }

        return view('tambah', compact('jumlah', 'error'));
    }
    public function kurangAction(Request $request)
    {
        $angka1 = $request->angka1;
        $angka2 = $request->angka2;
        $kurang = $angka1 - $angka2;
        return view('kurang', compact('kurang'));
    }

    public function editDataHitung(string $id)
    {
        $title = "Edit Penambahan";
        $error = null;
        $jumlah = null;

        // SELECT * FROM counts WHERE id =$id
        $count = Count::findOrFail($id);
        $jenis = $count->jenis;

        if ($jenis == "tambah") {
            $title = "Edit Penambahan";
            if (!is_numeric($count->angka1) || !is_numeric($count->angka2)) {
                $error = "Inputan harus numeric";
            } else {
                $jumlah = $count->angka1 + $count->angka2;
            }
            return view('tambah.edit', compact('title', 'error', 'jumlah', 'count'));
        }
    }

    public function updateTambahan(Request $request, string $id)
    {
        $angka1 = $request->angka1;
        $angka2 = $request->angka2;

        $count = $angka1 + $angka2;
        // SELECT * FROM counts WHERE id =$id
        // Update FROM counts SET angka1 = $angka1, angka2 = $angka2 WHERE id =$id
        $data = Count::findOrFail($id);
        $data->jenis = $request->jenis;
        $data->angka1 = $angka1;
        $data->angka2 = $angka2;
        $data->hasil = $count;
        $data->save();

        return redirect()->route('edit.data-hitung', $id)->with(['status' => 'Data Berhasil Diupdate']);
    }

    public function softDeleteTambahan(string $id)
    {
        // SELECT * FROM counts WHERE id =$id
        $sDel = Count::findOrFail($id);
        // DELETE FROM counts WHERE id =$id
        $sDel->delete();
        return redirect()->route('data.hitungan')->with('status', 'Data Berhasil Dihapus');
    }

    public function viewHitungan()
    {
        $counts = Count::all();
        return view('data-hitungan', compact('counts'));
    }
    public function update($name)
    {
        return "Selamat datang $name";
    }
}
