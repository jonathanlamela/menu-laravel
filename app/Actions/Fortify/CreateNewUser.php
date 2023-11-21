<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {

        Validator::make($input, [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{0,}$/',
            'password_confirmation' => 'same:password',
            'firstname' => 'required|string',
            'lastname' => 'required|string'
        ], [
            'email.required' => __("account.email_required"),
            'email.unique' => __("account.email_unique"),
            'email.email' => __("account.email_valid"),
            'password.required' => __("account.password_required"),
            'password.min' => __("account.password_min"),
            'password.regex' => __("account.password_regex"),
            'password_confirmation.same' => __("account.password_confirmation_same"),
            'firstname.required' => __("account.firstname_required"),
            'lastname.required' => __("account.lastname_required"),
            'firstname.string' => __("account.firstname_string"),
            'lastname.string' => __("account.lastname_string"),
        ])->validate();

        return User::create([
            'firstname' => $input['firstname'],
            'lastname' => $input['lastname'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
