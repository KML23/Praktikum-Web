<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Http\Resources\productsResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class productsController extends Controller
{
    /**
     * Menampilkan daftar produk.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $products = Product::all();
        return new productsResource(true, 'List Data Products', $products);
    }

    /**
     * Menyimpan data produk baru.
     *
     * @param mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'csname' => 'required|string',
            'description' => 'required|string',
            'release' => 'required|string',
            'price' => 'required|string',
            'img_cs' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Upload image
        $img_cs = $request->file('img_cs');
        $img_cs->storeAs('public/products', $img_cs->hashName());

        // Simpan data produk
        $product = Product::create([
            'csname' => $request->csname,
            'description' => $request->description,
            'release' => $request->release,
            'price' => $request->price,
            'img_cs' => $img_cs->hashName(),
        ]);

        return new productsResource(true, 'Data Product Berhasil Ditambahkan!', $product);
    }

    /**
     * update
     *
     * @param mixed $request
     * @param mixed $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'csname' => 'required|string',
            'description' => 'required|string',
            'release' => 'required|string',
            'price' => 'required|string',
            'img_cs' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        if ($request->hasFile('img_cs')) {
            $img_cs = $request->file('img_cs');
            $img_cs->storeAs('public/products', $img_cs->hashName());
            Storage::delete('public/products/' . $product->img_cs);

            $product->update([
                'csname' => $request->csname,
                'description' => $request->description,
                'release' => $request->release,
                'price' => $request->price,
                'img_cs' => $img_cs->hashName(),
            ]);
        } else {
            $product->update([
                'csname' => $request->csname,
                'description' => $request->description,
                'release' => $request->release,
                'price' => $request->price,
            ]);
        }

        return new productsResource(true, 'Data Product Berhasil Diubah!', $product);
    }

    /**
     * destroy
     *
     * @param mixed $id
     * @return void
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        Storage::delete('public/products/' . $product->img_cs);
        $product->delete();

        return new productsResource(true, 'Data Product Berhasil Dihapus!', null);
    }
}
