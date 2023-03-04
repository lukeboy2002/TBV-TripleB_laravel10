<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-orange-500 leading-tight">
            TBV-TripleB Edit slide <i class="fa-regular fa-images mr-4 mx-4"></i>
        </h2>
    </x-slot>

    <livewire:admin.slides.slide-edit :slide="$slide"/>
</x-admin-layout>
