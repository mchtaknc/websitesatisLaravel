<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\OrderProducts;
use App\Models\Orders;
use App\Models\Packages;
use DB;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        return view('front.dashboard.orders');
    }

    public function orders(Request $request)
    {
        $orders = DB::table('orders')
            ->join('customers', function ($join) {
                $join->on('customers.id', '=', 'orders.customer_id')
                    ->where('customers.id', '=', auth()->user()->customer_id);
            })
            ->whereIn('orders.status', ['SUCCESS', 'waiting'])->orderBy('orders.created_at', 'desc')->get(['orders.*']);
        if ($request->last_order != '' && $request->last_order == 1) {
            $orders = $orders->take(10);
        }
        $nums = count($orders);

        $array['iTotalRecords'] = $nums;
        $array['iTotalDisplayRecords'] = $nums;
        $array['sEcho'] = 0;
        $array['sColumns'] = "";
        $array['aaData'] = array();
        foreach ($orders as $order) {
            $domains = array();
            $packages = array();
            $orderProducts = \DB::table('order_products')->where('order_id',$order->id)->get();
            foreach ($orderProducts as $orderDetail) {
                $domains[] = $orderDetail->domain . '<br>';
                $package = DB::table('packages')->where('id', $orderDetail->item_id)->first()->name . ' Paket';
                if (isset($orderDetail->theme)) {
                    $package .= ' - ' . $orderDetail->theme . ' Tema <br>';
                }
                $packages[] = $package;
            }

            $data['order_no'] = $order->order_no;
            $data['payment_method'] = $order->payment_method == 'credit_card' ? 'Kredi Kartı' : 'Banka Havalesi';
            $data['domain'] = implode('', $domains);
            $data['package'] = implode('', $packages);
            $data['price'] = $order->total . ' ₺';
            $data['order_date'] = date('d-m-Y H:i:s', strtotime($order->created_at));
            $data['status'] = 'Tamamlandı';
            if ($order->status == 'waiting') {
                $data['status'] = 'Ödeme Bekliyor';
            }
            $array['aaData'][] = $data;
        }

        return response()->json($array, 200);
    }
}
