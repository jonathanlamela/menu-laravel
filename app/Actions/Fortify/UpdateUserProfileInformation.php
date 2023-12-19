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
            'firstname.required' => __("account.firstname_required"),
            'lastname.required' => __("account.lastname_required"),
            'firstname.string' => __("account.firstname_string"),
            'lastname.string' => __("account.lastname_string"),
        ])->validate();


        $user->forceFill([
            'firstname' => $input['firstname'],
            'lastname' => $input['lastname'],
        ])->save();
    }
}
