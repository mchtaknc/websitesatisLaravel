<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class PasswordChangeController extends Controller
{
    public function index()
    {
        return view('front.dashboard.password');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'current_password' => 'required',
                'new_password' => 'required|min:8|different:current_password',
                'new_password_confirmation' => 'required|same:new_password'
            ],
            [
                'current_password.required' => 'Lütfen geçerli şifrenizi giriniz.',
                'new_password.required' => 'Lütfen yeni şifrenizi giriniz.',
                'new_password.min' => 'Yeni şifreniz minimum 8 karakterden oluşmalıdır.',
                'new_password.different' => 'Yeni şifreniz geçerli şifrenizden farklı olmalıdır.',
                'new_password_confirmation.required' => 'Lütfen şifre tekrarını giriniz.',
                'new_password_confirmation.same' => 'Yeni şifreniz tekrarıyla eşleşmemektedir.'
            ]
        )->validate();

        if (!Hash::check($request->input('current_password'), \Auth::user()->password)) {
            return redirect()->route('password')->with('error', 'Geçerli şifreniz yanlıştır.');
        }

        User::find(\Auth::user()->id)->update(['password' => Hash::make($request->new_password)]);

        return redirect()->route('password');
    }
}
