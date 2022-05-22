<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Customers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function index()
    {
        $customer = Customers::find(\Auth::user()->customer_id);
        if ($customer) {
            return view('front.dashboard.account')->with('customer', $customer);
        }
        return redirect()->route('home');
    }

    public function update(Request $request)
    {
        $customer = Customers::find(Auth::user()->customer_id);

        if ($customer) {
            $validator = Validator::make($request->all(), [
                'firstname' => ['required', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'phonenumber' => ['required'],
                'address' => ['required'],
                'country' => ['required'],
                'city' => ['required'],
                'state' => ['required'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . auth()->user()->id]
            ])->validate();

            $customer->firstname = $request->input('firstname');
            $customer->lastname = $request->input('lastname');
            $customer->phonenumber = $request->input('phonenumber');
            $customer->company_name = $request->input('companyname');
            $customer->address = $request->input('address');
            $customer->country = $request->input('country');
            $customer->city = $request->input('city');
            $customer->state = $request->input('state');
            $customer->tax_id = $request->input('tax_id');
            $customer->tax_office = $request->input('tax_office');

            $customer->update();

            $user = User::find(Auth::user()->id);
            $user->name = $request->input('firstname') . ' ' . $request->input('lastname');
            $user->email = $request->input('email');

            $user->update();
            return redirect()->route('account')->with('success', 'Bilgileriniz başarıyla güncellendi.');
        }
        return redirect()->route('home');
    }
}
