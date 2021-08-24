<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Purchase;
use App\Models\Sitesetting;
use App\Models\User;
use Paystack;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    // public function __construct()
    // {
    //     $this->paystackKey = Sitesetting::find(1)->first()->sk_test;
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::latest()->get();

        return view('products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // $products = Product::latest()->get();

        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $product = new Product();
        $product->title = $request->title;
        $product->price = $request->price;
        $product->color = $request->color;
        $product->model  = $request->model;
        $product->description = $request->description;
        $product->status = 1;
        $product->discount = $request->discount;



        $img = $request->file('image');

        $imgFullname = $img->getClientOriginalName();
        $imgExt = $img->getClientOriginalExtension();
        // $imgnameonly =pathinfo(preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '_', $imgFullname)), PATHINFO_FILENAME);
        $imgnameonly = pathinfo($imgFullname, PATHINFO_FILENAME);
        $imgToDb = $imgnameonly . '_' . time() . '.' . $imgExt;
        $path = $img->storeAs('public/products/cover_images', $imgToDb);

        $product->image = $imgToDb;

        if ($product->save()) {
            $product->TrackID = 'PRTID-' . $product->id;
            $product->save();
        }
        return back()->with('success', 'Product Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
        return view('products.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        if ($request->file('image')) {
            $product = Product::find($id);

            $img = $request->file('image');

            $imgFullname = $img->getClientOriginalName();
            $imgExt = $img->getClientOriginalExtension();
            // $imgnameonly =pathinfo(preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '_', $imgFullname)), PATHINFO_FILENAME);
            $imgnameonly = pathinfo($imgFullname, PATHINFO_FILENAME);
            $imgToDb = $imgnameonly . '_' . time() . '.' . $imgExt;
            $path = $img->storeAs('public/products/cover_images', $imgToDb);

            $product->image = $imgToDb;

            $product->save();
        }

        Product::whereId($product)->update($request->except('_token', '_method', 'image', $product));
        return back()->with('success', 'Product Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
        $product->delete();
        return back()->with('success', 'Product Deleted');
    }

    public function filterItems(Request $request)
    {

        if (!is_null($request->status)) {
            if ($request->status == 'any') {
                $data['products'] = Product::all();
            } elseif ($request->status !== 'any') {
                $data['products'] = Product::where('status', $request->status)->get();
            }
        }

        return view('products.index')->with($data);
    }

    public function marketplace()
    {
        $data['products'] = Product::latest()->get();
        return view('products.products')->with($data);
    }

    // following functions handles purchasing
    public function addToCart(Request $request)
    {
        //dd($request->all());

        $book_id = $request->id;
        if ($request->id) {
            $cart_id = $request->id;
        } else {
            $cart_id = $book_id;
        }

        $product = Product::findOrFail($book_id);

        $qty = $request->qty ? $request->qty : 1;
        $oldCart = $request->session()->has('cart') ? $request->session()->get('cart') : null;
        $cart = new Cart($oldCart);

        $cart->add($product, $cart_id,  $qty);

        $request->session()->put('cart', $cart);
        return back()->with('success', 'Item added to Cart');
    }
    public function getCart(Request $request)
    {

        //dd(request()->session()->get('cart'));
        $data['currency'] = '₦';

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        $data['products'] = $cart->items;
        //dd($data['products']);
        // foreach($products as $pro){
        //     dd($pro['item']['title']);
        // }


        $data['totalPrice'] = $cart->totalPrice;

        $data['totalQty'] = $cart->totalQty;
        //dd($totalPrice,$totalQty);
        $data['relatedProducts'] = Product::where('status', 1)->take(4);
        //get fee from city

        $u = Auth::user()->id;
        $user = User::findOrFail($u);

        // $fees = ShipFee::where('city', $user->city)->first();

        // if ($fees != null) {
        //     $shipfee = $fees->fee;
        // } else {
        //     return redirect(route('editProfile', [$user->id]))->with('warning', 'Fill in Your Details');
        // }

        //    $gTotal = $shipfee + $totalPrice;
        return  view('products.cart')->with($data);
    }

    public function reduceItemByOne($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id);
        Session::put('cart', $cart);
        return back();
    }
    public function addItemByOne($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->addByOne($id);
        Session::put('cart', $cart);
        return back();
    }

    public function removeItem($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        Session::put('cart', $cart);
        return back()->with('Danger', 'Item removed from Cart');
    }

    public function emptyCart()
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        Session::forget('cart');
        $cart = null;

        return redirect(route('MP'));
    }
    public function checkouts()
    {
        if (Auth::check()) {
            return redirect(route('editProfile', Auth::user()->id));
        }
    }
    public function checkout()
    {
        if (Auth::user()) {
            $user = Auth::user();
            $currency = '₦';
            //    $countries = Country::all();
            // $categories = Category::all();
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
            $u = Auth::user()->id;
            $user = User::findOrFail($u);

            // $fee = ShipFee::where('city', $user->city)->first();


            // if (($fee->fee) != null) {
            //     $shipfee = $fee->fee;
            // }

            $products = $cart->items;
            $totalPrice = $cart->totalPrice;
            $totalPriceCheckout = $totalPrice * 100;
            $totalQty = $cart->totalQty;


            return  view('products.checkout', compact(['products', 'totalPrice', 'totalQty', 'totalPriceCheckout', 'user', 'currency']));
        }
    }
    public function pay(Request $request)
    {
        // $pro = Product::where('id', $request->product_id);
        // foreach ($pro as $p) {
        //     $reference = \Str::random(4) . time();

        //     $payment = new Purchase();
        //     $payment->user_id = Auth::user()->id;
        //     $payment->amount = $p->amount;
        //     $payment->product_id = $p->id;
        //     $payment->reference = $reference;
        //     $payment->status = 'in process';
        //     $payment->save();

        //     $callback_url = route('verify-property-pay');
        //     $curl = curl_init();
        //     curl_setopt_array($curl, array(
        //         CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
        //         CURLOPT_RETURNTRANSFER => true,
        //         CURLOPT_CUSTOMREQUEST => "POST",
        //         CURLOPT_POSTFIELDS => json_encode([
        //             'amount' => $request->amount * 100,
        //             'email' => Auth::user()->email,
        //             'callback_url' => $callback_url,
        //             'metadata' => ['reference' => $reference, 'product' => $request->product_id],
        //         ]),
        //         CURLOPT_HTTPHEADER => [
        //             "authorization: Bearer " . $this->paystackKey, //replace this with your own test key
        //             "content-type: application/json",
        //             "cache-control: no-cache"
        //         ],
        //     ));
        //     $response = curl_exec($curl);
        //     $err = curl_error($curl);
        //     if ($err) {
        //         // there was an error contacting the Paystack API
        //         die('Curl returned error: ' . $err);
        //     }
        //     $tranx = json_decode($response, true);
        //     if (!$tranx['status']) {
        //         // there was an error from the API
        //         print_r('API returned error: ' . $tranx['message']);
        //     }
        //     // comment out this line if you want to redirect the user to the payment page
        //     print_r($tranx);
        //     // redirect to page so User can pay
        //     // uncomment this line to allow the user redirect to the payment page
        //     return redirect($tranx['data']['authorization_url']);
        // }

    }
    // public function verifyPayment()
    // {
    //     $curl = curl_init();
    //     $reference = isset($_GET['reference']) ? $_GET['reference'] : '';
    //     if (!$reference) {
    //         die('No reference supplied');
    //     }
    //     curl_setopt_array($curl, array(
    //         CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_HTTPHEADER => [
    //             "accept: application/json",
    //             "authorization: Bearer " . $this->paystackKey,
    //             "cache-control: no-cache"
    //         ],
    //     ));
    //     $response = curl_exec($curl);
    //     $err = curl_error($curl);
    //     if ($err) {
    //         // there was an error contacting the Paystack API
    //         die('Curl returned error: ' . $err);
    //     }
    //     $tranx = json_decode($response, true);
    //     // dd($tranx);
    //     if (!$tranx['status']) {
    //         // there was an error from the API
    //         die('API returned error: ' . $tranx->message);
    //     }
    //     if ('success' == $tranx['data']['status']) {
    //         $payment = Purchase::where('reference', $tranx['data']['metadata']['reference'])->first();
    //         $payment->status = 'success';
    //         $payment->save();



    //         $pro = Product::find($payment->product_id);
    //         $pro->status = '3';
    //         $pro->save();

    //         return redirect(route('payment-success'));
    //         // transaction was successful...
    //         // please check other things like whether you already gave value for this ref
    //         // if the email matches the customer who owns the product etc
    //         // Give value
    //     }
    // }

    // public function redirectToGateway()
    // {
    //     request()->metadata = json_encode(request()->all());
    //     return Paystack::getAuthorizationUrl()->redirectNow();
    // }


    /**
     * Obtain Paystack payment information
     * @return void
     */
    // public function handleGatewayCallback()
    // {
    //     $paymentDetails = Paystack::getPaymentData();

    //     //dd($paymentDetails);
    //     // Now you have the payment details,
    //     // you can store the authorization_code in your db to allow for recurrent subscriptions
    //     // you can then redirect or do whatever you want
    //     $item_status = data_get($paymentDetails, 'data.metadata.item_status');

    //     if ($item_status == 1) {
    //         $paid = new Purchase();

    //         $paid->reference =  data_get($paymentDetails, 'data.reference');
    //         $amount = data_get($paymentDetails, 'data.amount');
    //         $paid->amount = $amount / 100;
    //         $paid->email = data_get($paymentDetails, 'data.customer.email');
    //         $paid->bank = data_get($paymentDetails, 'data.authorization.bank');
    //         $paid->card_type = data_get($paymentDetails, 'data.authorization.card_type');
    //         $paid->title = data_get($paymentDetails, 'data.metadata.title');
    //         $book_id = data_get($paymentDetails, 'data.metadata.book_id');
    //         $paid->name = data_get($paymentDetails, 'data.metadata.name');
    //         $paid->phone = data_get($paymentDetails, 'data.metadata.phone');
    //         //
    //         $paid->fees = data_get($paymentDetails, 'data.fees');
    //         $paid->publish_id  = data_get($paymentDetails, 'data.metadata.book_id');


    //         $paid->status = data_get($paymentDetails, 'status');
    //         $paid->paid_at = data_get($paymentDetails, 'data.paidAt');

    //         if ($paid->save()) {

    //             $book = Publish::with('author')->findOrFail($book_id);

    //             $url = URL::temporarySignedRoute('down', now()->addMinutes(2880), ['id' => $book->id, 'email' => $paid->email]);
    //             $data = array('url' => $url, 'book' => $book, 'name' => $paid->name);
    //             // dd($url);
    //             Mail::to($paid->email)->send(new Mailtrap($data));

    //             return view('pages/thanks', ['email' => $paid->email, 'book' => $book, 'Uname' => $paid->name]);
    //         }
    //     } else {

    //         ///second one
    //         if (Auth::user()) {
    //             //$paymentDetails = Paystack::getPaymentData();

    //             //   //dd($paymentDetails);
    //             //   $paymentDetails = Paystack::getPaymentData();
    //             $cart = Session::get('cart');
    //             // $cart = new Cart($oldCart);

    //             if ($paymentDetails) {
    //                 $order = new Order();
    //                 $order->order_id = $paymentDetails['data']['reference'];
    //                 $order->amount = $paymentDetails['data']['amount'];
    //                 $order->state = $paymentDetails['data']['metadata']['state'];
    //                 $order->address = $paymentDetails['data']['metadata']['address'];
    //                 $order->full_name = $paymentDetails['data']['metadata']['first_name'] . " " . $paymentDetails['data']['metadata']['last_name'];
    //                 //    $order->country = $paymentDetails['data']['metadata']['country'];
    //                 $order->city = $paymentDetails['data']['metadata']['city'];
    //                 $order->quantity = $paymentDetails['data']['metadata']['quantity'];
    //                 $order->phone = $paymentDetails['data']['metadata']['phone'];
    //                 $order->email = $paymentDetails['data']['metadata']['email'];
    //                 $order->paid_at = $paymentDetails['data']['paidAt'];
    //                 $order->currency = $paymentDetails['data']['currency'];
    //                 $order->cart =  base64_encode(serialize($cart));
    //                 //dd($cart->items);
    //                 foreach ($cart->items as $item) {
    //                     $items = $item['item']->title;
    //                     $qty = $item['qty'];
    //                 }
    //                 $order->status = "Pending";

    //                 if (Auth::user()) {
    //                     $order->user_id = Auth::user()->id;
    //                 }
    //                 $order->save();
    //                 $user = User::findOrFail($order->user_id);
    //                 $user->role = 'customer';
    //                 $user->save();
    //                 //dd($user);
    //                 $data = array('user' => $user->name, 'title' => $items, 'order_id' => $order->order_id, 'status' => $order->status, 'qty' => $qty);
    //                 $user->notify(new NewOrder($data));
    //             }
    //             $this->emptyCart();
    //             return redirect(route('profile'));
    //         }
    //     }
    // }

    public function purchaseOnCredit(Request $request){
        $user = User::find(auth()->user()->id);

    }
    public function successPage()
    {
        return view('success');
    }
}
