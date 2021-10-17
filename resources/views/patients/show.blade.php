<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Patient Detail View') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex">
                <livewire:create-blood-pressure :patient="$patient" />

                @if($patient->bloodPressure->isNotEmpty())
                    <a  href="{{route('bloodPressure.export', $patient->id) }}">
                        <x-modal-button class="bg-green-400 hover:bg-green-500">Export to CSV</x-modal-button>
                    </a>
                @endif
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3>Name: <strong> {{$patient->name}} </strong></h3>
                    <h3>Birthday: <strong> {{$patient->birthdate}} </strong></h3>
                    <h3>Sex: <strong> {{ucfirst($patient->sex)}} </strong></h3>
                    <h3>Age: <strong> {{$patient->age()}} years old</strong></h3>
                </div>
            </div>

            <div class="mt-16">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-6">
                    {{ __('Blood Pressure records for')}}: {{$patient->name}}
                 </h2>

                <livewire:blood-pressure-table :patient="$patient" />
            </div>

        </div>
    </div>

</x-app-layout>
