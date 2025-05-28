<div class="flex justify-between items-center w-full p-4 bg-gray-50">
    <div>
        <x-filament::button color="gray" wire:click="$parent.closeModal()">
            Close
        </x-filament::button>
    </div>
    <div>
        <x-filament::button
            color="primary"
            wire:click="checkPaymentStatus({{ $bookingId }})"
            icon="heroicon-o-arrow-path">
            Check Payment Status
        </x-filament::button>
    </div>
</div>