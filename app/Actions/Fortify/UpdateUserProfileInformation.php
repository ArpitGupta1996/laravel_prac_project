<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, mixed>  $input
     */
    public function update(User $user, array $input): void
    {
        // dd(request()->input('date'));
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required','numeric','min:10', Rule::unique('users')->ignore($user->id)],//phone number added by me
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'date' => ['nullable','date'], //dob field added by me
            'gender'=> ['nullable','string'], //gender field added here
            'martial_status' => ['nullable','string'], //martial status
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
                'phone' => $input['phone'], //added by me
                'date' => $input['date'], //added by me

                'gender' => $input['gender'], //added by me for gender

                'martial_status' => $input['martial_status']
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
