<?php

namespace App\Http\Controllers;

// use App\Models\Cart;
use App\Models\About;
use App\Models\Order;
use App\Models\Slider;
// use App\Models\Payment;
use App\Models\Product;
use App\Models\Category;
// use App\Models\Testimoni;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    
    public function index()
    {
        $sliders = Slider::all();
        $categories = Category::all();
        $products = Product::skip(0)->take(8)->get();
        return view('home.index', compact('sliders', 'categories', 'products'));
    }

    public function products($id_category)
    {
        $products = Product::where('id_kategori', $id_category)->get();
        return view('home.products', compact('products'));
    }

    public function searchProducts(Request $request)
    {
    $searchTerm = $request->input('search');
    $produk = Product::where('nama_barang', 'like', "%$searchTerm%")->get();

    return response()->json(['produk' => $produk]);

    }


    // public function add_to_cart(Request $request)
    // {
    //     $input = $request->all();
    //     Cart::create($input);
    // }

    // public function delete_from_cart(Cart $cart)
    // {
    //     $cart->delete();
    //     return redirect('/cart');
    // }

    public function product($id_product)
    {
        $produk = Product::find($id_product);
        $latest_products = Produk::orderByDesc('created_at')->offset(0)->limit(10)->get();
        return view('home.product', compact('product', 'latest_products'));
    }

    // public function product_search(Request $request)
    // {
    //     // Gunakan $products sesuai kebutuhan dalam pencarian
    //     $productName = $request->input('name');
    //     $searchedProducts = Product::where('name', 'like', "%$productName%")->get();

    //     return response()->json(['products' => $searchedProducts]);
    // }
    // public function showSearchForm()
    // {
    //     return view('home.search'); // Sesuaikan dengan nama file view Anda
    // }
    
    // public function cart()
    // {
    //     if (!Auth::guard('webmember')->user()) {
    //         return redirect('/login_member');
    //     }
    //     $carts = Cart::where('id_member', Auth::guard('webmember')->user()->id)->where('is_checkout', 0)->get();
    //     $cart_total = Cart::where('id_member', Auth::guard('webmember')->user()->id)->where('is_checkout', 0)->sum('total');
    //     return view('home.cart', compact('carts','cart_total'));
    // }

    // public function get_kota($id)
    // {
    //     $curl = curl_init();

    //     curl_setopt_array($curl, array(
    //         CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=" . $id,
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => "",
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 30,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => "GET",
    //         CURLOPT_HTTPHEADER => array(
    //             "key: 1adb8efa384245ff3bc71d4d2429518a"
    //         ),
    //     ));

    //     $response = curl_exec($curl);
    //     $err = curl_error($curl);

    //     curl_close($curl);

    //     if ($err) {
    //         echo "cURL Error #:" . $err;
    //     } else {
    //         echo $response;
    //     }
    // }

    // public function get_ongkir($destination, $weight)
    // {
    //     $curl = curl_init();

    //     curl_setopt_array($curl, array(
    //         CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => "",
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 30,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => "POST",
    //         CURLOPT_POSTFIELDS => "origin=369&destination=" . $destination . "&weight=" . $weight . "&courier=jne",
    //         CURLOPT_HTTPHEADER => array(
    //             "content-type: application/x-www-form-urlencoded",
    //             "key: 1adb8efa384245ff3bc71d4d2429518a"
    //         ),
    //     ));

    //     $response = curl_exec($curl);
    //     $err = curl_error($curl);

    //     curl_close($curl);

    //     if ($err) {
    //         echo "cURL Error #:" . $err;
    //     } else {
    //         echo $response;
    //     }
    // }

    public function checkout_orders(Request $request)
    {
        $id = DB::table('orders')->insertGetId([
            'id_member' => $request->id_member,
            'invoice' => date('ymds'),
            'grand_total' => $request->cart_total,
            'status' => 'Baru',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        foreach($request->input('id_product') as $key => $id_product) {
            DB::table('orders_details')->insert([
                'id_order' => $id,
                'id_produk' => $id_product,
                'jumlah' => $request->input('jumlah')[$key],
                'total' => $request->input('total')[$key],
                'created_at'=> date('Y-m-d H:i:s')
            ]);
        }

        Cart::where('id_member', Auth::guard('webmember')->user()->id)->update([
            'is_checkout' => 1
        ]);

    }

    public function checkout()
    {

        // $about = About::first();
        $orders = Order::where('id_member', Auth::guard('webmember')->user()->id)->latest()->first();
        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => "",
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 30,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => "GET",
        //     CURLOPT_HTTPHEADER => array(
        //         "key: 1adb8efa384245ff3bc71d4d2429518a"
        //     ),
        // ));

        // $response = curl_exec($curl);
        // $err = curl_error($curl);

        // curl_close($curl);

        // if ($err) {
        //     echo "cURL Error #:" . $err;
        // }

        // $provinsi = json_decode($response);
        return view('home.checkout', compact('orders'));
    }

    // public function payments(Request $request)
    // {
    //     Payment::create([
    //         'id_order' => $request->id_order,
    //         'id_member' => Auth::guard('webmember')->user()->id,
    //         'jumlah' => $request->jumlah,
    //         'provinsi' => $request->provinsi,
    //         'kabupaten' => $request->kabupaten,
    //         'kecamatan' => "",
    //         'detail_alamat' => $request->detail_alamat,
    //         'status' => 'Pending',
    //         'no_rekening' => $request->no_rekening,
    //         'atas_nama' => $request->atas_nama,
    //     ]);
    //     return redirect('/orders');
    // }

    public function orders()
    {
        $orders = Order::where('id_member', Auth::guard('webmember')->user()->id)->get();
        // $payments = Payment::where('id_member', Auth::guard('webmember')->user()->id)->get();
        return view('home.orders', compact('orders'));
    }

    public function about()
    {
        // $about = About::first();
        $testimonies = Testimoni::all();
        return view('home.about', compact('about', 'testimonies'));
    }

    public function contact()
    {
        return view('home.contact');
    }

    public function faq()
    {
        return view('home.faq');
    }

    
}
