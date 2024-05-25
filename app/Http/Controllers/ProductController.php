<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['list']);
        $this->middleware('api')->only(['store','update','destroy']);
    }

    public function list()
    {
        $categories = Category::all(); // inisialisasi variabel $categories dengan data kategori
        return view('product.index', compact('categories')); // meneruskan variabel $categories ke view
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products=Product::with('category')->get();
        // return response()->json([
        //     'success' => true,
        //     'data' => $products
        // ]);
        try {
            // Load products with their categories
            $products = Product::with('category')->get();
    
            return response()->json(['success' => true, 'data' => $products], 200);
        } catch (\Exception $e) {
            \Log::error('Error fetching products: '.$e->getMessage());
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat mengambil data produk'], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // Validasi request
            $request->validate([
                'nama_barang' => 'required|string|max:255',
                'id_kategori' => 'required|exists:categories,id',
                'harga' => 'required|numeric',
                'deskripsi' => 'required|string',
                'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
    
            // Proses upload gambar
            if ($request->hasFile('gambar')) {
                $image = $request->file('gambar');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/produk');
                $image->move($destinationPath, $name);
            }
    
            // Simpan data produk
            $product = new Product();
            $product->nama_barang = $request->nama_barang;
            $product->id_kategori = $request->id_kategori;
            $product->harga = $request->harga;
            $product->deskripsi = $request->deskripsi;
            $product->gambar = $name;
            $product->save();
    
            return response()->json(['success' => true, 'message' => 'Produk berhasil ditambah'], 200);
    
        } catch (\Exception $e) {
            // Log error
            \Log::error('Error saat menyimpan produk: '.$e->getMessage());
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat menyimpan produk'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $Product)
    {
        return response()->json([
            'success' => true,
            'data' => $Product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $Product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_produk)
    {
        $validator = Validator::make($request->all(), [
            'id_kategori'=> 'required',
            'nama_barang'=> 'required',
            'harga'=> 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|image|mimes:jpg,png,jpeg,webp'
        ]);

        if($validator->fails()) {
            return response()->json(
                $validator->errors(),
                422
            );
        }

        $Product = Product::findOrFail($id_produk);
        $input = $request->all();

        // if ($request->has('gambar')) {
        //     File::delete('uploads/produk/' . $Product->gambar);

        //     $gambar = $request->file('gambar');
        //     $nama_gambar = time() . rand(1,9) . '.' . $gambar->getClientOriginalExtension();
        //     $gambar->move('uploads/produk' , $nama_gambar);
        //     $input['gambar'] = $nama_gambar;
        // }else {
        //     unset($input['gambar']);
        // }
        if ($request->has('gambar')) {
            // Hapus gambar lama dari galeri
            Galeri::where('id_produk', $Product->id_produk)->delete();
    
            // Simpan gambar baru ke tabel galeri
            $gambar = $request->file('gambar');
            $nama_gambar = time() . rand(1,9) . '.' . $gambar->getClientOriginalExtension();
            $gambar->move('uploads/produk' , $nama_gambar);
            Galeri::create([
                'id_produk' => $Product->id_produk,
                'url_galeri' => $nama_gambar
            ]);
        }

        $Product->update($input);

        return response() -> json([
            'success' => true,
            'message' => 'success',
            'data' => $Product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $Product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_produk)
    {
        File::delete('uploads/produk/ . $Product->gambar');
        $Product->delete();

        return response() -> json([
            'success' => true,
            'message' => 'success'
        ]);
    }
}
