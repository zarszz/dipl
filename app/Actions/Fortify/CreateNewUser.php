<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

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
        Validator::make($input, [
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'tgl_lahir' => ['required'],
            'alamat' => ['required'],
            'jenis_kelamin' => ['required'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        return User::create([
            'nama' => $input['nama'],
            'email' => $input['email'],
            'tgl_lahir' => $input['tgl_lahir'],
            'alamat' => $input['alamat'],
            'jenis_kelamin' => $input['jenis_kelamin'],
            'role_id' => 3,
            'password' => Hash::make($input['password']),
        ]);
    }
}
