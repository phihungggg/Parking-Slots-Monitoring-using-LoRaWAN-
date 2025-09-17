<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        //$this->redirect('/login', navigate: true);
    }
}; ?>



<div class="ml-auto flex flex-row gap-1">
    @auth
    <button wire:click="logout" class="w-full text-left bg-transparent mt-2">
        <x-dropdown-link>
            {{ __('Log Out') }}
        </x-dropdown-link>
    </button>

    @else
    <a href="{{ route('login') }}" class=" login mt-6 ml-auto md:mr-10 mr-2 text-white">Sign in </a>
    @endauth
    <a href="{{ route('reservations') }}" class="reservation bg-green-400 text-black rounded-md shadow-lg px-2 py-1 mt-5 mr-2 mb-2 md:bg-green-500">Reservations</a>
</div>
