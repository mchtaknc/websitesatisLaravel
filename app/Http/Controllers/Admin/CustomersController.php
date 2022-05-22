<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customers;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CustomersController extends Controller
{
    private $messages = [
        'required' => ':attribute doldurulması zorunludur.',
        'unique' => 'Bu :attribute daha önce alınmış.',
    ];

    private $attributes = [
        'firstname'     => 'Ad',
        'lastname'      => 'Soyad',
        'phonenumber'   => 'Telefon',
        'country'       => 'Ülke',
        'city'          => 'Şehir',
        'state'         => 'İlçe',
        'email'         => 'E-Posta',
        'password'      => 'Şifre',
    ];

    public function index()
    {
        $customers = DB::table('customers')
            ->join('users', 'customers.id', 'users.customer_id')
            ->where('users.role', 'customer')
            ->select('customers.*', 'users.*')
            ->get();
        return view('admin.customers.index')->with('customers', $customers);
    }

    public function create()
    {
        return view('admin.customers.add');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'firstname'     => 'required',
                'lastname'      => 'required',
                'phonenumber'   => 'required',
                'address'       => 'required',
                'country'       => 'required',
                'city'          => 'required',
                'state'         => 'required',
                'email'         => 'required|unique:users,email',
                'password'      => 'required'
            ],
            $this->messages,
            $this->attributes
        )->validate();

        $customer = new Customers;
        $customer->firstname = $request->input('firstname');
        $customer->lastname = $request->input('lastname');
        $customer->phonenumber = $request->input('phonenumber');
        $customer->address = $request->input('address');
        $customer->country = $request->input('country');
        $customer->city = $request->input('city');
        $customer->state = $request->input('state');
        $customer->company_name = $request->input('company_name');
        $customer->tax_id = $request->input('tax_id');
        $customer->tax_office = $request->input('tax_office');

        $customer->save();

        $user = new User;
        $user->customer_id = $customer->id;
        $user->role = 'customer';
        $user->name = $request->input('firstname') . ' ' . $request->input('lastname');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));

        $user->save();

        return redirect()->route('admin.customers')->with('success', 'Müşteri başarıyla oluşturuldu.');
    }


    public function edit($id)
    {
        $customers = Customers::find($id);
        if ($customers) {
            return view('admin.customers.edit')->with('customer', $customers);
        }
        return redirect()->route('admin.customers')->withErrors(['Hata' => "Müşteri bulunamadı."]);
    }

    public function update(Request $request, $id)
    {
        $customer = Customers::find($id);
        if (!$customer) {
            return redirect()->route('admin.customers')->withErrors(['Hata' => 'Müşteri bulunamadı.']);
        }

        $validator = Validator::make(
            $request->all(),
            [
                'firstname'     => 'required',
                'lastname'      => 'required',
                'phonenumber'   => 'required',
                'address'       => 'required',
                'country'       => 'required',
                'city'          => 'required',
                'state'         => 'required',
                'email'         => 'required|unique:users,email,' . $customer->user->id,
            ],
            $this->messages,
            $this->attributes
        )->validate();

        $customer->firstname = $request->input('firstname');
        $customer->lastname = $request->input('lastname');
        $customer->phonenumber = $request->input('phonenumber');
        $customer->address = $request->input('address');
        $customer->country = $request->input('country');
        $customer->city = $request->input('city');
        $customer->state = $request->input('state');
        $customer->company_name = $request->input('company_name');
        $customer->tax_id = $request->input('tax_id');
        $customer->tax_office = $request->input('tax_office');

        $customer->save();

        $user = User::find($customer->user->id);
        $user->name = $request->input('firstname') . ' ' . $request->input('lastname');
        $user->email = $request->input('email');
        if (!empty($request->input('password'))) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        return redirect()->route('admin.customers')->with('success', 'Müşteri başarıyla güncellendi.');
    }

    public function destroy($id)
    {
        $customers = Customers::find($id);
        if ($customers) {
            $customers->delete();
            if ($customers->user != null) {
                $customers->user->delete();
            }
            return redirect()->route('admin.customers')->with('success', 'Müşteri başarıyla silindi.');
        }
        return redirect()->route('admin.customers')->withErrors(['Hata' => 'Müşteri bulunamadı.']);
    }
}
