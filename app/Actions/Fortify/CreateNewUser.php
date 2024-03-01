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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',

            'tel' => ['required', 'string', 'max:255'],
            'start_date' => ['date', 'nullable'],
            'birthday' => ['date', 'nullable'],
            'address' => ['string', 'nullable'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],

        ])->validate();
       


        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),

            'tel' => $input['tel'],
            'start_date' => $input['start_date'],
            'birthday' => $input['birthday'],
            'address' => $input['address'],
            'image' => $this->uploadImage($input['image']) ?? '',
        ]);
    }
    /**
     * Upload image and return the path.
     *
     * @param  \Illuminate\Http\UploadedFile|null  $image
     */
    protected function uploadImage($image): ?string
    {
        if ($image) {
            $imagePath = $image->store('user_images', 'public');
            return $imagePath;
        }
        return null;
    }
}
