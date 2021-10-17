<div>
    <x-modal-button class="bg-blue-400 hover:bg-blue-500 mb-4" wire:click="$set('showModal', true)">Create blood pressure</x-modal-button>

    <form>

        <x-modal wire:model.defer="showModal" style="display: none">
            <x-slot name="title">
                Enter blood pressure information
            </x-slot>

            <x-slot name="body">

                <div class="mb-2">
                    <label for="systolic" class="block text-sm font-medium text-gray-700">Systolic</label>
                    <input wire:model.defer="systolic" type="number" name="systolic" id="systolic" placeholder="Enter systolic" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">

                    @error('systolic') <span class="error text-red-500">{{ $message }}</span> @enderror
                </div>

                <div class="mb-2">
                    <label for="diastolic" class="block text-sm font-medium text-gray-700">Diastolic</label>
                    <input wire:model.defer="diastolic" type="number" name="diastolic" id="diastolic" placeholder="Enter diastolic" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">

                    @error('diastolic') <span class="error text-red-500">{{ $message }}</span> @enderror
                </div>

            </x-slot>

            <x-slot name="footer">

                <x-modal-button class="bg-gray-400  hover:bg-gray-500" wire:click="$set('showModal', false)"> Cancel </x-modal-button>

                <x-modal-button class="bg-blue-400 hover:bg-blue-500" wire:click="createBloodPressure({{$patient->id}})"> Submit </x-modal-button>
            </x-slot>

        </x-modal>

    </form>

    @if (session()->has('message'))
        <div class="text-green-500 mb-2">
            {{ session('message') }}
        </div>
    @endif

</div>
