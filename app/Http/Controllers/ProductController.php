<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    //
    public function index(): View
    {
        $products = Product::latest()->paginate();
        return view('products.index', compact('products'));
    }

    public function create(): View
    {
        return view('products.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'jenis_barang' => 'nullable|in:Makanan,Minuman,Bumbu,Obat-obatan,Sabun,Lainnya',
            'harga_pcs' => 'nullable|numeric',
            'harga_2pcs' => 'nullable|numeric',
            'foto_barang' => 'nullable|url',
        ]);

        Product::create([
            'nama_barang' => $request->nama_barang,
            'harga_pcs' => $request->harga_pcs,
            'harga_2pcs' => $request->harga_2pcs,
            'jenis_barang' => $request->jenis_barang,
            'foto_barang' => $request->foto_barang,
        ]);
        return Redirect::route('products.index')->with('success', 'Barang berhasil ditambah');
    }

    public function destroy($id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with(['success' => 'Data produk berhasil dihapus.']);
    }

    public function bulkDelete(Request $request): RedirectResponse
    {
        $ids = $request->input('ids');

        if (!$ids) {
            return redirect()->route('products.index')->with('error', 'Tidak ada produk yang dipilih untuk dihapus.');
        }

        Product::whereIn('id', $ids)->delete();

        return redirect()->route('products.index')->with('success', 'Beberapa produk berhasil dihapus.');
    }
}
