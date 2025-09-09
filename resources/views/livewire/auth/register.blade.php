<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Create an account')" :description="__('Enter your details below to create your account')" />

    <!-- Session Status -->
      
    <x-auth-session-status class="text-center" :status="session('status')" />
   
    <form method="POST" wire:submit="register" class="flex flex-col gap-6">
        <!-- Name -->
        <flux:input
            wire:model="name"
            :label="__('Name')"
            type="text"
            required
            autofocus
            autocomplete="name"
            :placeholder="__('Full name')"
        />

        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('Email address')"
            type="email"
            required
            autocomplete="email"
            placeholder="email@example.com"
        />

        <!-- Password -->
        <flux:input
            wire:model="password"
            :label="__('Password')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Password')"
            viewable
        />

        <!-- Confirm Password -->
        <flux:input
            wire:model="password_confirmation"
            :label="__('Confirm password')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Confirm password')"
            viewable
        />
        <flux:input 
        wire:model="phone_number" 
        :label="__('Phone Number')"
        mask="(999) 999-9999"
        autocomplete="Address"
        :placeholder="__('(716) 1234-567')"
        required
        vewable
        />

        <flux:textarea
        wire:model="address" 
        :label="__('Address')"
        type="text"
        autocomplete="Address"
        :placeholder="__('Address')"
        required
        vewable
        />

        <flux:radio.group
        wire:model="dietary_preference"
        :label="__('Dietary Preference')"
         variant="segmented"
        >
            <flux:radio value="none" :label="__('None')" />
            <flux:radio value="vegetarian" :label="__('Vegetarian')" />
            <flux:radio value="vegan" :label="__('Vegan')" />
            <flux:radio value="gluten_free" :label="__('Gluten Free')" />
            
        </flux:radio.group>

    

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full">
                {{ __('Create account') }}
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
        <span>{{ __('Already have an account?') }}</span>
        <flux:link :href="route('login')" wire:navigate>{{ __('Log in') }}</flux:link>
    </div>
</div>
