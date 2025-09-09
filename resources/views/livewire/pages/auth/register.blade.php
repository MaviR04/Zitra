<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $phone_number = '';
    public string $address = '';
    public ?string $dietary_preference = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'phone_number' => ['required', 'string', 'max:15'],
            'address'=> ['required','string','max:255'],
            'dietary_preference'=> ['nullable','string']
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <form wire:submit="register">
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input wire:model="password" id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    <!-- Phone Number -->   
        <div>
            <x-input-label for="phone_number" :value="__('Phone Number')" />
            <x-text-input id="phone_number" 
                        class="block mt-1 w-full" 
                        type="text" 
                        wire:model="phone_number" 
                        :value="old('phone_number')" 
                        placeholder="(716) 123-4567" 
                        required 
                        autocomplete="tel" />
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>

        <!-- Address -->
        <div class="mt-4">
            <x-input-label for="address" :value="__('Address')" />
            <textarea id="address" 
                    wire:model="address" 
                    class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm  dark:bg-gray-900" 
                    placeholder="Address" 
                    required 
                    autocomplete="street-address">{{ old('address') }}</textarea>
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="dietary_preference" :value="__('Dietary Preference')" />
            <div class="mt-2 space-y-2">
                <label class="flex items-center">
                    <input type="radio" wire:model="dietary_preference" value="none" />
                    <span class="ml-2 dark:text-gray-200">{{ __('None') }}</span>
                </label>
                <label class="flex items-center">
                    <input type="radio" wire:model="dietary_preference" value="vegetarian" />
                    <span class="ml-2 dark:text-gray-200">{{ __('Vegetarian') }}</span>
                </label>
                <label class="flex items-center">
                    <input type="radio" wire:model="dietary_preference" value="vegan" />
                    <span class="ml-2 dark:text-gray-200">{{ __('Vegan') }}</span>
                </label>
                <label class="flex items-center">
                    <input type="radio" wire:model="dietary_preference" value="gluten_free" />
                    <span class="ml-2 dark:text-gray-200">{{ __('Gluten Free') }}</span>
                </label>
            </div>
            <x-input-error :messages="$errors->get('dietary_preference')" class="mt-2" />
        </div>
        

        


        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</div>
