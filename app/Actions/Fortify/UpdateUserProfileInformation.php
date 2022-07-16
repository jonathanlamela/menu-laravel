<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make($input, [
            'firstname' => ['required', 'string'],
            'lastname' => ['required', 'string'],
        ], [
            'firstname.required' => 'Il campo nome è obbligatorio',
            'lastname.required' => 'Il campo nome è obbligatorio',
            'firstname.string' => 'Il campo nome può contenere solo lettere',
            'lastname.string' => 'Il campo cognome può contenere solo lettere',
        ])->validate();


        $user->forceFill([
            'firstname' => $input['firstname'],
            'lastname' => $input['lastname'],
        ])->save();
    }
}
