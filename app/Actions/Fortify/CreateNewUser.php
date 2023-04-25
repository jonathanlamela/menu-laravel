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
            'email.required' => "L'indirizzo email è obbligatorio",
            'email.unique' => "Indirizzo email in uso",
            'email.email' => "Indirizzo email non valido",
            'password.required' => "Inserisci una password (6 caratteri min)",
            'password.min' => "Inserisci almeno 6 caratteri",
            'password.regex' => "La password deve essere lunga almeno 6 caratteri e contenere: 1 maiuscola ,1 numero, 1 carattere speciale",
            'password_confirmation.same' => "Le due password non corrispondono",
            'firstname.required' => 'Il campo nome è obbligatorio',
            'lastname.required' => 'Il campo nome è obbligatorio',
            'firstname.string' => 'Il campo nome può contenere solo lettere',
            'lastname.string' => 'Il campo cognome può contenere solo lettere',
        ])->validate();

        return User::create([
            'firstname' => $input['firstname'],
            'lastname' => $input['lastname'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
