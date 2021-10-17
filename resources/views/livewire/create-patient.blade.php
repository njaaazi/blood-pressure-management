<div>

    <form>
        <x-modal-button class="bg-blue-400 hover:bg-blue-500 mb-4" wire:click="$set('showModal', true)">Create patient</x-modal-button>

        <x-modal wire:model.defer="showModal" style="display: none">
                <x-slot name="title">
                    Enter patient information
                </x-slot>

                <x-slot name="body">

                    <div class="mb-2">
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input wire:model.defer="name" type="text" name="name" id="name" placeholder="Patient name" autocomplete="given-name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">

                        @error('name') <span class="error text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-2">
                        <label for="birthdate" class="block text-sm font-medium text-gray-700">Birthday</label>
                        <input wire:model.defer="birthdate"  type="date" name="birthdate" id="birthdate" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        @error('birthdate') <span class="error text-red-500">{{ $message }}</span> @enderror

                    </div>

                    <div class="mb-2">
                        <label for="sex" class="block text-sm font-medium text-gray-700">Sex</label>
                        <select wire:model.defer="sex" id="sex" name="sex" autocomplete="country" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option hidden>Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>

                        @error('sex') <span class="error text-red-500">{{ $message }}</span> @enderror
                    </div>

                </x-slot>

                <x-slot name="footer">

                    <x-modal-button class="bg-gray-400  hover:bg-gray-500" wire:click="$set('showModal', false)"> Cancel </x-modal-button>

                    <x-modal-button class="bg-blue-400 hover:bg-blue-500" wire:click="create"> Submit </x-modal-button>
                </x-slot>

        </x-modal>

    </form>

    @if (session()->has('message'))
        <div class="text-green-500 mb-2">
            {{ session('message') }}
        </div>
    @endif

</div>
