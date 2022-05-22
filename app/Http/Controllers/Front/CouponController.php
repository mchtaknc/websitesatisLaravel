<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{
    public function attachCoupon(Request $request)
    {
        $coupon = Coupon::where('code', $request->code)
            ->where('end_date', '>=', now('Europe/Istanbul')->toDateTimeString())
            ->where('start_date', '<=', now('Europe/Istanbul')->toDateTimeString())
            ->where('status', '=', 1)->get();

        if (!$coupon->isNotEmpty()) {
            Session::forget('coupon');
            return response()->json(['message' => 'Bu kupon geçerli değildir.', 'coupon' => false], 422);
        }

        $cart = Session::get('cart');
        $discount = (($cart->totalPrice * $coupon[0]->value) / 100);
        $total = $cart->totalPrice - $discount;

        if (Session::has('coupon')) {
            return response()->json(['message' => 'Kupon zaten kullanımda.', 'coupon' => true], 422);
        }

        Session::put('coupon', [
            'name' => $coupon[0]->code,
            'discountPrice' => $coupon[0]->value,
            'discount' => $discount
        ]);

        $html = view('front.ajax.coupon')->render();
        $total = view('front.ajax.totalprice')->render();
        return response()->json(['discount' => true, 'html' => $html, 'total' => $total], 200);
    }
}
