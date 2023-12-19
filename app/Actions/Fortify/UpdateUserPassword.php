<?php

namespace App\Actions\Fortify;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;

class UpdateUserPassword implements UpdatesUserPasswords
{

    /**
     * Validate and update the user's password.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {

        Validator::make($input, [
            'current_password' => ['required', 'string'],
            'password' => 'required|min:6|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{0,}$/',
            'password_confirmation' => 'same:password',
        ], [
            'password.required' => __("account.password_required"),
            'password.regex' =>  __("account.password_regex"),
            'password_confirmation.same' =>  __("account.password_confirmation_same"),
            'current_password.required' =>  __("account.current_password_required"),
        ])->after(function ($validator) use ($user, $input) {
            if (!isset($input['current_password']) || !Hash::check($input['current_password'], $user->password)) {
                session()->flash("error_message",  __("account.current_password_invalid"));

                $validator->errors()->add('current_password', __("account.current_password_invalid"));
            }
        })->validate();

        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();
    }
}
