<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    private $messages = [
        'required' => ':attribute doldurulması/seçilmesi zorunludur.',
        'unique' => 'Bu :attribute daha önce alınmış.',
        'email' => 'Lütfen :attribute için geçerli bir eposta adresi giriniz.',
        'role' => 'Rol seçilmesi zorunludur.',
    ];

    private $attributes = [
        'name' => 'İsim',
        'email' => 'E-Posta',
        'password' => 'Şifre',
        'role' => 'Rol'
    ];

    public function index()
    {
        $users = User::where('role', 'admin')->get();
        return view('admin.users.index')->with('users', $users);
    }

    public function create()
    {
        return view('admin.users.add');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name'      => 'required',
                'role'      => 'required',
                'password'  => 'required',
                'email'     => 'required|unique:users,email'
            ],
            $this->messages,
            $this->attributes
        )->validate();

        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role = $request->input('role');

        $user->save();

        return redirect()->route('admin.users')->with('success', 'Kullanıcı başarıyla oluşturuldu.');
    }

    public function edit($id)
    {
        $user = User::find($id);
        if ($user) {
            return view('admin.users.edit')->with('user', $user);
        }
        return redirect()->route('admin.users')->withErrors(['Hata' => "Kullanıcı bulunamadı."]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name'      => 'required',
                'role'      => 'required',
                'email'     => 'required|unique:users,email,' . $id
            ],
            $this->messages,
            $this->attributes
        )->validate();
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('admin.users')->withErrors(['Hata' => 'Parametre Hatalı']);
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
        if (!empty($request->input('password'))) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->save();

        return redirect()->route('admin.users')->with('success', 'Kullanıcı başarıyla güncellendi.');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('admin.users')->with('success', 'Kullanıcı başarıyla silindi');
        }
        return redirect()->route('admin.users')->withErrors(['Hata' => "Kullanıcı bulunamadı."]);
    }
}
