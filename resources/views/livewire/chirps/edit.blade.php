<?php

use function Livewire\Volt\{rules, mount, state};

state(['chirp', 'message']);

rules(['message' => 'required|string|max:255']);

mount(fn() => ($this->message = $this->chirp->message));

$update = function () {
    $this->authorize('update', $this->chirp);
    $validated = $this->validate();
    $this->chirp->update($validated);
    $this->dispatch('chirp-updated');
};

$cancel = fn () => $this->dispatch('chirp-edit-canceled');

?>

<div>
    <form wire:submit="update">
        <textarea wire:model="message" placeholder="{{ __('What\'s on your mind?') }}"
            class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"></textarea>

        <x-input-error :messages="$errors->get('message')" class="mt-2" />
        <x-primary-button class="mt-4">{{ __('Chirp') }}</x-primary-button>
    </form>
</div>
