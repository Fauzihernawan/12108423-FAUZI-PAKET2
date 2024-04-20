<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;


class produkController extends Controller
{
    public function index()
    {
        $produk = Produk::get();
        return view('admin.produk.index', compact('produk'));
    }

    public function tambah()
    {
        return view('admin.produk.form');
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'nm_produk' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

        if ($gambar = $request->file('gambar')) {
            $profileImage = date('YmdHis') . '.' . $gambar->getClientOriginalExtension();
            $gambar->move(public_path('upload/'), $profileImage);
            $input['gambar'] = 'upload/' . $profileImage;
        }

        Produk::create($input);
        return redirect()->route('produk');
    }

    public function edit($id)
    {
        $produk = Produk::find($id)->first();
        return view('admin.produk.form', ['produk' => $produk]);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $produk = Produk::find($id);

        if (!$produk) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan');
        }

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $destinationPath = 'upload/';

            // Jika gambar lama ada, hapus gambar lama dari folder upload
            if ($produk->gambar && file_exists(public_path($produk->gambar))) {
                unlink(public_path($produk->gambar));
            }

            $profileImage = date('YmdHis') . "." . $gambar->getClientOriginalExtension();
            $gambar->move($destinationPath, $profileImage);
            $input['gambar'] = "upload/$profileImage";
        } else {
            // Jika tidak ada gambar baru yang diunggah, hapus input gambar dari data yang akan diupdate
            unset($input['gambar']);
        }

        $produk->update($input);
        return redirect()->route('produk')->with('success', 'Produk berhasil diperbarui');
    }

    public function editStok($id)
    {
        Produk::find($id)->first();
        return view('admin.produk.stok');
    }

    public function updateStok(Request $request, $id)
    {
        $request->validate([
            'stok' => 'required',
        ]);
        $data = [
            'stok' => $request->stok,
        ];

        Produk::find($id)->update($data);
        return redirect()->route('produk');
    }

    public function hapus($id)
    {
        Produk::find($id)->delete();
        return redirect()->route('produk');
    }
}
