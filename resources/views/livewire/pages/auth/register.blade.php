<?php

use App\Models\User;
use App\Models\Ville;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $prenom = '';
    public string $tel = '';
    public int $ville_id = 0;
    public string $password = '';
    public string $password_confirmation = '';

    public function mount()
    {
        $this->ville_id = Ville::query()->first()?->id ?? 0;
    }

    public function register(): void
    {
        $validated = $this->validate([
            'prenom' => ['required', 'string', 'max:255'],
            'tel' => ['required', 'regex:/^(06|07)[0-9]{8}$/', 'unique:users,tel'],
            'ville_id' => ['required', 'exists:villes,id'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['is_admin'] = 0;

        // dd($validated);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }

    public function villes()
    {
        return Ville::all();
    }
};
?>

<div>
    <form wire:submit="register">

        <div style="margin-bottom: 1.25rem;">
            <a href="/" style="display: flex; align-items: center; font-weight: bold; color: #0d6efd; text-decoration: none; font-size: 1.25rem;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" style="margin-right: 0.75rem;" viewBox="0 0 16 16">
                    <path d="M8 .5l-6.5 6V14a1 1 0 001 1h3v-4a1 1 0 011-1h2a1 1 0 011 1v4h3a1 1 0 001-1V6.5L8 .5z"/>
                    <path fill-rule="evenodd" d="M8 7.293l.646-.647a.5.5 0 01.708 0l.646.647c.442.442.707 1.03.707 1.707 0 .677-.265 1.265-.707 1.707L8 13.207l-2.293-2.5A2.5 2.5 0 015.707 9c0-.677.265-1.265.707-1.707l.646-.647a.5.5 0 01.708 0L8 7.293z" clip-rule="evenodd"/>
                </svg>
                Maroc Happyo
            </a>
        </div>

        <!-- Prénom -->
        <div>
            <x-input-label for="prenom" :value="__('Prénom')" />
            <x-text-input wire:model="prenom" id="prenom" class="block mt-1 w-full" type="text" name="prenom" required autofocus autocomplete="given-name" />
            <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
        </div>

        <!-- Tel -->
        <div class="mt-4">
            <x-input-label for="tel" :value="__('Numéro de téléphone')" />
            <x-text-input wire:model="tel" id="tel" class="block mt-1 w-full" type="text" name="tel" required />
            <x-input-error :messages="$errors->get('tel')" class="mt-2" />
        </div>

        <!-- Ville Select -->
        <div class="mt-4">
            <x-input-label for="ville_id" :value="__('Ville')" />
            <select wire:model="ville_id" id="ville_id" name="ville_id" required class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                @foreach($this->villes() as $ville)
                    <option value="{{ $ville->id }}">{{ $ville->ville }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('ville_id')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Mot de passe')" />
            <x-text-input wire:model="password" id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmez le mot de passe')" />
            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Submit -->
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Registre') }}
            </x-primary-button>
        </div>
    </form>
</div>

</div>
