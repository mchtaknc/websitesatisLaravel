<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Library\Iyzico;
use App\Library\Whois;
use App\Models\Cart;
use App\Models\Customers;
use App\Models\OrderProducts;
use App\Models\Orders;
use App\Models\Packages;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    private $attributes = [
        'firstname' => 'Ad',
        'lastname' => 'Soyad',
        'phonenumber' => 'Telefon',
        'country' => 'Ülke',
        'city' => 'Şehir',
        'state' => 'İlçe',
        'email' => 'E-Posta',
        'password' => 'Şifre',
        'payment_method' => 'Ödeme yöntemi',
        'agreement' => 'Sözleşme',
    ];

    public function getAddToCart(Request $request, $id)
    {
        $product = Packages::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $domain = "";
        $theme = "Varsayılan";
        if ($request->get('tema') !== null && !empty($request->get('tema'))) {
            $theme = $request->get('tema');
        }
        $cart = new Cart($oldCart);
        $cart->add($product, $domain, $theme, $product->id);
        $request->session()->put('cart', $cart);
        if (Session::has('coupon')) {
            $oldCart = Session::get('cart');
            $coupon = Session::get('coupon');
            $coupon['discount'] = (($oldCart->totalPrice * $coupon['discountPrice']) / 100);
            Session::put('coupon', $coupon);
        }
        return redirect()->route('product.form', $id);
    }

    public function updateTotalPrice()
    {
        $html = view('front.ajax.totalprice')->render();

        return response()->json($html, 200);
    }

    public function getCart()
    {
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return $oldCart != null ? view('front.shop.shopping-cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]) : view('front.shop.shopping-cart');
    }

    public function removeCart($id)
    {
        if (!Session::Has('cart')) {
            return redirect()->route('product.cart');
        }
        $oldCart = Session::get('cart');
        if (array_key_exists($id, $oldCart->items)) {
            $oldCart->totalPrice -= $oldCart->items[$id]['price'];
            $oldCart->taxPrice = $oldCart->totalPrice * 0.18;
            $oldCart->taxTotal = $oldCart->totalPrice * 1.18;
            unset($oldCart->items[$id]);

            if (Session::has('coupon')) {
                $coupon = Session::get('coupon');
                $coupon['discount'] = (($oldCart->totalPrice * $coupon['discountPrice']) / 100);
                Session::put('coupon', $coupon);
            }

            if (empty($oldCart->items)) {
                Session::forget('cart');
                Session::forget('coupon');
            }
        }
        return redirect()->route('product.cart')->with('success', 'Seçmiş olduğunuz ürün sepetten kaldırılmıştır.');
    }

    public function checkoutForm()
    {
        if (!Session::has('cart')) {
            return redirect()->route('home');
        }
        return view('front.shop.checkout');
    }

    public function form($id)
    {
        $product = Packages::find($id);
        if ($product) {
            return view('front.shop.shop-details', ['product_id' => $id]);
        }
        return redirect()->route('home');
    }

    public function checkout(Request $request)
    {
        $cart = Session::get('cart');
        $rules = [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'phonenumber' => 'required',
            'address' => 'required',
            'country' => 'required',
            'city' => 'required',
            'state' => 'required',
            'agreement' => 'required',
            'payment_method' => 'required',
        ];

        if (!auth()->check()) {
            $rules['email'] = 'required|unique:users,email';
            $rules['password'] = 'required|min:8';
            $rules['password_confirmation'] = 'required|same:password';

            $customer_id = Customers::create([
                'firstname' => $request['firstname'],
                'lastname' => $request['lastname'],
                'phonenumber' => $request['lastname'],
                'company_name' => $request['companyname'],
                'address' => $request['lastname'],
                'country' => $request['lastname'],
                'city' => $request['lastname'],
                'state' => $request['lastname'],
                'tax_id' => $request['tax_id'],
                'tax_office' => $request['tax_office'],
            ])->id;

            $user_id = User::create([
                'customer_id' => $customer_id,
                'name' => $request['firstname'] . ' ' . $request['lastname'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ])->id;

            Auth::loginUsingId($user_id);
        }

        $validator = Validator::make(
            $request->all(),
            $rules,
        )->validate();

        $totalPrice = $cart->taxTotal;

        if (Session::has('coupon')) {
            $coupon = Session::get('coupon');
            $totalPrice = $cart->taxTotal - $coupon['discount'];
        }
        $orders = Orders::create([
            'customer_id' => auth()->user()->customer_id,
            'order_no' => 'STD-' . time(),
            'subtotal' => $cart->totalPrice,
            'total' => $cart->taxTotal,
            'status' => 'waiting',
            'payment_method' => $request->payment_method,
            'payment_details' => null,
        ]);
        if ($request->payment_method == 'bank_transfer') {
            return view('front.shop.bank-transfer')->with('totalPrice', $totalPrice);
        } else {
            $items = array();
            foreach ($cart->items as $item) {
                OrderProducts::create([
                    'order_id' => $orders->id,
                    'item_id' => $item['item']->id,
                    'item_quantity' => $item['qty'],
                    'price' => $item['price'],
                    'domain' => $item['domain']['domain'],
                    'theme' => $item['theme'],
                ]);

                $items[] =
                    [
                        'id' => 'LMR' . $item['item']->id,
                        'name' => $item['item']->name,
                        'category' => 'Website',
                        'price' => $item['price'],
                    ];
            }
            $iyzico = new Iyzico();
            $payment = $iyzico->setForm([
                'conversationId' => rand(1, 100000000),
                'price' => $cart->totalPrice,
                'paidPrice' => $totalPrice,
                'basketId' => rand(1, 10000),
                'order_no' => $orders->order_no,
                'user' => auth()->user()->id,
            ])
                ->setBuyer([
                    'id' => auth()->user()->customer_id,
                    'firstname' => $request->firstname,
                    'lastname' => $request->lastname,
                    'phone' => $request->phonenumber,
                    'email' => $request->email,
                    'identityNumber' => '99999999999',
                    'address' => $request->address,
                    'ip' => '',
                    'city' => $request->city,
                    'country' => $request->country,
                ])
                ->setBilling([
                    'contactName' => $request->firstname,
                    'city' => $request->city,
                    'country' => $request->country,
                    'address' => $request->address,
                ])
                ->setItems($items)
                ->paymentForm();

            return view('front.shop.checkout', [
                'payment' => $payment->getCheckoutFormContent(),
                'paymentStatus' => $payment->getStatus(),
            ]);
        }
    }

    public function callback(Request $request)
    {
        $iyzico = new Iyzico();
        $token = $request->token;
        $conversationId = 123456789;
        $response = $iyzico->callbackForm($token, $conversationId);
        Orders::where('order_no', $request->order)->update([
            'status' => $response->getPaymentStatus(),
            'payment_details' => $response->getRawResult(),
        ]);
        Session::forget('paket');
        Session::forget('coupon');
        Session::forget('cart');
        return view('front.shop.callback', [
            'paymentStatus' => $response->getPaymentStatus(),
            'status' => $response->getStatus(),
            'error' => $response->getErrorCode(),
            'errorMessage' => $response->getErrorMessage(),
        ]);
    }

    public function addDomain(Request $request, $id)
    {
        $request->validate([
            'domain' => 'required',
            'installDomain' => 'required|in:owndomain,domainregister,domaintransfer',
        ], [
            'domain.required' => "Bir alan adı girmek zorunludur.",
            'installDomain.required' => "Alan adı seçeneklerinden bir tanesinin seçilmesi zorunludur.",
            'installDomain.in' => "Parametre Hatalı!",
        ]);

        $product = Packages::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $theme = "Varsayılan";
        if ($request->get('tema') !== null && !empty($request->get('tema'))) {
            $theme = $request->get('tema');
        }
        $cart = new Cart($oldCart);
        $cart->add($product, "", $theme, $product->id);
        $request->session()->put('cart', $cart);
        if (Session::has('coupon')) {
            $oldCart = Session::get('cart');
            $coupon = Session::get('coupon');
            $coupon['discount'] = (($oldCart->totalPrice * $coupon['discountPrice']) / 100);
            Session::put('coupon', $coupon);
        }
        if ($cart != null && array_key_exists($id, $cart->items)) {
            $cart->items[$id]['domain'] = [
                'domain' => $request->domain,
                'domain_type' => $request->installDomain,
            ];
            return redirect()->route('product.cart');
        }
        return redirect()->route('home');
    }

    public function domainWhois(Request $request)
    {
        $whois = new Whois();
        $info = array();
        if (!empty($request->domain)) {
            /* $domain = $request->domain;
            $domain = trim($domain);
            if (substr(strtolower($domain), 0, 7) == "http://" || substr(strtolower($domain), 0, 8) == "https://") $domain = substr($domain, 8);
            if (substr(strtolower($domain), 0, 4) == "www.") $domain = substr($domain, 4);
            $domain = explode(".", $domain, 2);
            $info = $whois->search($domain[0], [$domain[1]]); */
            $info = $whois->lookup($request->domain);
        }

        return response($info, 200);
    }
}
