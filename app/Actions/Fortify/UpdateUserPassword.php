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
            'password.required' => "Inserisci un password (6 caratteri min)",
            'password.regex' => "La password deve essere lunga almeno 6 caratteri e contenere: 1 maiuscola ,1 numero, 1 carattere speciale",
            'password_confirmation.same' => "Le due password non corrispondono",
            'current_password.required' => "Il campo password attuale è obbligatorio"
        ])->after(function ($validator) use ($user, $input) {
            if (!isset($input['current_password']) || !Hash::check($input['current_password'], $user->password)) {
                session()->flash("error_message", "Password attuale non valida");

                $validator->errors()->add('current_password', "La password attuale non è valida");
            }
        })->validate();

        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();
    }
}
