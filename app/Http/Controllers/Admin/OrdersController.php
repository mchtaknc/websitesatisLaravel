<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customers;
use App\Models\OrderProducts;
use App\Models\Orders;
use App\Models\Packages;
use Facade\Ignition\Support\Packagist\Package;
use Illuminate\Http\Request;
use Iyzipay\Model\Customer;
use DB;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Orders::all();
        return view('admin.orders.index', ['orders' => $orders]);
    }

    public function orders()
    {
        $orders = DB::table('orders')->join('customers', function ($join) {
            $join->on('customers.id', '=', 'orders.customer_id');
        })->orderBy('orders.created_at', 'desc')->get(['orders.*','customers.firstname','customers.lastname']);;
        $nums = $orders->count();

        $array['iTotalRecords'] = $nums;
        $array['iTotalDisplayRecords'] = $nums;
        $array['sEcho'] = 0;
        $array['sColumns'] = "";
        $array['aaData'] = array();
        foreach ($orders as $order) {
            $domains = array();
            $packages = array();
            $orderProducts = DB::table('order_products')->where('order_id', $order->id)->get();
            foreach ($orderProducts as $orderDetail) {
                $domains[] = $orderDetail->domain . '<br>';
                $package = DB::table('packages')->where('id', $orderDetail->item_id)->first()->name . ' Paket';
                if (isset($orderDetail->theme)) {
                    $package .= ' - ' . $orderDetail->theme . ' Tema <br>';
                }
                $packages[] = $package;
            }
            $data['customer_id'] = $order->customer_id;
            $data['customer'] = $order->firstname . ' ' . $order->lastname;
            $data['order_no'] = $order->order_no;
            $data['payment_method'] = $order->payment_method == 'credit_card' ? 'Kredi Kartı' : 'Banka Havalesi';
            $data['domain'] = implode('', $domains);
            $data['package'] = implode('', $packages);
            $data['price'] = $order->total . ' ₺';
            $data['order_date'] = date('d-m-Y H:i:s', strtotime($order->created_at));
            $data['status'] = '';
            $data['islemler'] = $order->id;
            if ($order->status == 'SUCCESS') {
                $data['status'] = '<span class="badge badge-success">Başarılı</span>';
            } elseif ($order->status == 'waiting') {
                $data['status'] = '<span class="badge badge-warning">Ödeme Bekliyor</span>';
            } else {
                $data['status'] = '<span class="badge badge-danger">Başarısız</span>';
            }
            $array['aaData'][] = $data;
        }

        return response()->json($array, 200);
    }

    public function create()
    {
        return view('admin.orders.add', ['customers' => Customers::all(), 'packages' => Packages::all()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer' => 'required',
            'order_status' => 'required',
            'order_payment_method' => 'required',
            'order_price' => 'required',
            'order_packages.*' => 'required',
            'order_domain.*' => 'required',
            'order_qty.*' => 'required',
        ], [
            'customer.required' => 'Bir müşteri seçmelisiniz.',
            'order_status.required' => 'Sipariş durumu seçmelisiniz.',
            'order_payment_method.required' => 'Ödeme yöntemi seçmelisiniz.',
            'order_price.required' => 'Ücret bilgisi girmelisiniz.',
            'order_packages.*.required' => 'Bir paket seçmelisiniz.',
            'order_domain.*.required' => 'Müşteri alan adını girmelisiniz.',
            'order_qty.*.required' => 'Miktar girmelisiniz.',
        ]);
        //$package = Packages::find($request->get('order_packages'));
        $order_price = str_replace(',', '', $request->order_price);
        $price = $order_price / 1.18;
        $orders = Orders::create([
            'customer_id' =>  $request->get('customer'),
            'order_no' => 'STD-' . time(),
            'subtotal' => $price,
            'total' => str_replace(',', '', $request->order_price),
            'status' => $request->get('order_status'),
            'payment_method' => $request->get('order_payment_method'),
            'payment_details' => null,
        ]);

        foreach ($request->order_packages as $key => $item) {
            $package = Packages::where('id', $item)->first();
            OrderProducts::create([
                'order_id' => $orders->id,
                'item_id' => $item,
                'item_quantity' => $request->order_qty[$key],
                'price' => $package->price,
                'domain' => $request->order_domain[$key],
                'theme' => 'Varsayılan'
            ]);
        }

        return redirect()->route('admin.orders')->with('success', 'Sipariş başarıyla oluşturuldu.');
    }

    public function edit($id)
    {
        $order = Orders::findOrFail($id);
        return view('admin.orders.edit', ['order' => $order, 'customers' => Customers::all(), 'packages' => Packages::all()]);
    }

    public function update(Request $request, $id)
    {
        $order = Orders::findOrFail($id);
        if (!$order) {
            return redirect()->route('admin.orders')->withErrors(['Hata' => 'Sipariş bulunamadı.']);
        }

        $request->validate([
            'customer' => 'required',
            'order_status' => 'required',
            'order_payment_method' => 'required',
            'order_price' => 'required',
        ], [
            'customer.required' => 'Bir müşteri seçmelisiniz.',
            'order_status.required' => 'Sipariş durumu seçmelisiniz.',
            'order_payment_method.required' => 'Ödeme yöntemi seçmelisiniz.',
            'order_price.required' => 'Ücret bilgisi girmelisiniz.',
        ]);

        $order->customer_id = $request->customer;
        $order->status = $request->order_status;
        $order->total = str_replace(',', '', $request->order_price);
        $order->payment_method = $request->order_payment_method;
        $order->save();
        return redirect()->route('admin.orders')->with('success', 'Sipariş başarıyla güncellendi.');
    }
}
