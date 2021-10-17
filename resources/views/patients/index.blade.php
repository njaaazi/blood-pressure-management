<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Patients') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex">
                <livewire:create-patient />

                @if($patients->isNotEmpty())
                    <a  href="{{route('patients.export')}}">
                        <x-modal-button class="bg-green-400 hover:bg-green-500"> Export to CSV </x-modal-button>
                    </a>
                @endif
            </div>

            <livewire:patient-table />
        </div>
    </div>


</x-app-layout>
