<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            แก้ไขห้อง
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">แบบฟอร์ม</div>
                        <div class="card-body">
                            <form method="POST" action="{{url('/employee/update/'.$user->id)}}" enctype="multipart/form-data">
                                @csrf
                                <div>
                                    <x-jet-label for="name" value="{{ __('Name') }}" value="{{$user->name}}" />
                                    <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                                </div>

                                <div class="mt-4">
                                    <x-jet-label for="email" value="{{ __('Email') }}" />
                                    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $user->email)" required />
                                </div>

                                <div class="mt-4">
                                    <x-jet-label for="tel" value="{{ __('Telephone') }}" />
                                    <x-jet-input id="tel" class="block mt-1 w-full" type="text" name="tel" :value="old('tel', $user->tel)" required />
                                </div>

                                <div class="mt-4">
                                    <x-jet-label for="start_date" value="{{ __('Start Date') }}" />
                                    <x-jet-input id="start_date" class="block mt-1 w-full" type="date" name="start_date" :value="old('start_date', $user->start_date)" required />
                                </div>

                                <div class="mt-4">
                                    <x-jet-label for="birthday" value="{{ __('Birthday') }}" />
                                    <x-jet-input id="birthday" class="block mt-1 w-full" type="date" name="birthday" :value="old('birthday', $user->birthday)" required />
                                </div>

                                <div class="mt-4">
                                    <x-jet-label for="address" value="{{ __('Address') }}" />
                                    <x-jet-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address', $user->address)" required />
                                </div>

                                <div class="mt-4">
                                    <x-jet-label for="image" value="{{ __('Image') }}" />
                                    <x-jet-input id="image" class="block mt-1 w-full" type="file" name="image" />
                                </div>


                                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                <div class="mt-4">
                                    <x-jet-label for="terms">
                                        <div class="flex items-center">
                                            <x-jet-checkbox name="terms" id="terms" />
                                            <div class="ml-2">
                                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </x-jet-label>
                                </div>
                                @endif

                                {{-- เพิ่มฟิลด์ userType --}}
                                <input type="hidden" name="userType" value="1">

                                <div class="flex items-center justify-end mt-4">
                                    <x-jet-button type="submit" class="ml-4">
                                        {{ __('ยืนยันการแก้ไข') }}
                                    </x-jet-button>
                                </div>
                            </form>
</x-app-layout>