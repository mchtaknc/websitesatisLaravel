<?php

namespace App\Actions\Fortify;

use App\Models\Customers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        $validator = Validator::make($input, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'phonenumber' => ['required'],
            'address' => ['required'],
            'country' => ['required'],
            'city' => ['required'],
            'state' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
        ])->validate();

        $customer = Customers::create([
            'firstname' => $input['firstname'],
            'lastname' => $input['lastname'],
            'phonenumber' => $input['lastname'],
            'company_name' => $input['companyname'],
            'address' => $input['lastname'],
            'country' => $input['lastname'],
            'city' => $input['lastname'],
            'state' => $input['lastname'],
            'tax_id' => $input['tax_id'],
            'tax_office' => $input['tax_office'],
        ]);

        return User::create([
            'customer_id' => $customer->id,
            'name' => $input['firstname'] . ' ' . $input['lastname'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
