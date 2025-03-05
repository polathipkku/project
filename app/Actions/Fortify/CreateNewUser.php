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

        $imagePath = null;
        if (isset($input['image'])) {
            $imagePath = $input['image']->store('public/profile_photos');
            $imagePath = str_replace('public/', '', $imagePath); // เก็บพาธที่ถูกต้อง
        }

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'tel' => $input['tel'],
            'start_date' => $input['start_date'] ?? null,
            'birthday' => $input['birthday'],
            'address' => $input['address'],
            'image' => $imagePath ?? 'default-avatar.png', // ใช้ default หากไม่มีการอัปโหลด
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
