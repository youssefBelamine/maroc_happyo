<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        // dump("login1");
        $this->validate();
        
        $this->form->authenticate();
        // dump("login2");

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: false);
    }
}; ?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login">

        <div style="margin-bottom: 1.25rem;">
            <a href="/" style="display: flex; align-items: center; font-weight: bold; color: #0d6efd; text-decoration: none; font-size: 1.25rem;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" style="margin-right: 0.75rem;" viewBox="0 0 16 16">
                    <path d="M8 .5l-6.5 6V14a1 1 0 001 1h3v-4a1 1 0 011-1h2a1 1 0 011 1v4h3a1 1 0 001-1V6.5L8 .5z"/>
                    <path fill-rule="evenodd" d="M8 7.293l.646-.647a.5.5 0 01.708 0l.646.647c.442.442.707 1.03.707 1.707 0 .677-.265 1.265-.707 1.707L8 13.207l-2.293-2.5A2.5 2.5 0 015.707 9c0-.677.265-1.265.707-1.707l.646-.647a.5.5 0 01.708 0L8 7.293z" clip-rule="evenodd"/>
                </svg>
                Maroc Happyo
            </a>
        </div>
        
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('numéro de téléphone')" />
            <x-text-input wire:model.debounce.500ms="form.tel" id="tel" class="block mt-1 w-full" type="text" name="tel" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('form.tel')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Mot de passe')" />

            <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        {{-- <div class="block mt-4">
            <label for="remember" class="inline-flex items-center">
                <input wire:model="form.remember" id="remember" type="checkbox" class="rounded  border-gray-300  text-indigo-600 shadow-sm focus:ring-indigo-500  " name="remember">
                <span class="ms-2 text-sm text-gray-600 ">{{ __('Remember me') }}</span>
            </label>
        </div> --}}

        <div class="flex items-center justify-between mt-4">
            <div class="flex flex-col space-y-1">
                <a href="{{ route('register') }}" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ __('Créer un compte') }}
                </a>
            </div>
        
            <x-primary-button class="ms-3">
                {{ __('Se connecter') }}
            </x-primary-button>
        </div>
        
        
    </form>
</div>
