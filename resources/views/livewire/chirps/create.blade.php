<?php

use function Livewire\Volt\{rules, state};

// Set the initial state
state(['message' => '']);

// Validate the input
rules(['message' => 'required|string|max:255']);

$store = function () {
    // Validate the input
    $validated = $this->validate();

    // Create the chirp
    auth()->user()->chirps()->create($validated);

    // Reset the message input
    $this->message = '';

    $this->dispatch('chirp-created');
};

?>

<div>
    <form wire:submit="store">
        <textarea
            wire:model="message"
            placeholder="{{ __('What\'s on your mind?') }}"
            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
        ></textarea>

        <x-input-error :messages="$errors->get('message')" class="mt-2" />
        <x-primary-button class="mt-4">{{ __('Chirp') }}</x-primary-button>
    </form>
</div>
