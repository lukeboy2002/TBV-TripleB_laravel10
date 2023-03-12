<x-admin-layout>
    @push('styles')
        <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
        <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet"/>
    @endpush

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-orange-500 leading-tight">
            TBV-TripleB New members <i class="fa-solid fa-user-tie mr-4 mx-4"></i>
        </h2>
    </x-slot>

    <div class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
        <form action="{{ route('admin.members.store') }}" enctype="multipart/form-data" method="POST" class="space-y-6">
            @csrf
            <div>
                <x-form.label for="username" value="Username" />
                <x-form.input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" />
                <x-form.input-error for="username" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-form.label for="email" value="{{ __('Email') }}" />
                <x-form.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
                <x-form.input-error for="email" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-form.label for="password" value="{{ __('Password') }}" />
                <x-form.input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                <x-form.input-error for="password" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-form.label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-form.input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-form.input-error for="password_confirmation" class="mt-2" />
            </div>

            <div>
                <x-form.label for="image" value="Sponsor image" />
                <input type="file" name="image" id="image" accept="image/*">
                <x-form.input-error for="image" class="mt-2" />
            </div>

            <div class="flex justify-end space-x-2 pt-2">
                <x-buttons.secondary type="button" onclick="history.back()" class="px-3 py-2 text-xs font-medium">Cancel</x-buttons.secondary>
                <x-buttons.primair class="px-3 py-2 text-xs font-medium">Save</x-buttons.primair>
            </div>
        </form>
    </div>
    @push('scripts')
        <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
        <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

        <script>
            // Register the plugins
            FilePond.registerPlugin(FilePondPluginImagePreview);
            FilePond.registerPlugin(FilePondPluginFileValidateType);

            // Init FilePond
            // Get a reference to the file input element
            const inputElement = document.querySelector('#image');

            // Create a FilePond instance
            const pond = FilePond.create(inputElement, {
                server: {
                    process: '{{ route('admin.upload') }}',
                    revert: '{{ route('admin.revert') }}',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }
            });
        </script>
    @endpush

</x-admin-layout>
