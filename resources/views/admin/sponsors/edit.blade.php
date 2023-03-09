<x-admin-layout>
    @push('styles')
        <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
        <link
            href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
            rel="stylesheet"
        />
    @endpush

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-orange-500 leading-tight">
            TBV-TripleB Edit sponsor <i class="fa-regular fa-images mr-4 mx-4"></i>
        </h2>
    </x-slot>

    <div class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
        <form action="/admin/sponsors/{{ $sponsor->id }}" enctype="multipart/form-data" method="POST" class="space-y-6">
            @csrf
            @method('PATCH')

            <div>
                <x-form.label for="name" value="Sponsor name" />
                <x-form.input type="text" name="name" id="name" :value="old('name', $sponsor->name)" required autofocus />
                <x-form.input-error for="name" class="mt-2" />
            </div>

            <div>
                <x-form.label for="link" value="UrlWeb" />
                <x-form.input type="url" name="link" id="link" :value="old('link', $sponsor->link)" required />
                <x-form.input-error for="link" class="mt-2" />
            </div>

            <div>
                <x-form.label for="image" value="Sponsor image" />
                <input type="file" name="image" id="image" accept="image/*">
                <x-form.input-error for="image" class="mt-2" />
            </div>

            <label class="relative inline-flex items-center mr-5 cursor-pointer">
                <input name="published"
                       id="published"
                       type="checkbox"
                       value="1" {{ old('published', $sponsor->published) == 1 ? 'checked' : '' }}
                       class="sr-only peer"
                >
                <div class="w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-orange-500 dark:peer-focus:ring-orange-500 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-orange-500"></div>
                <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">published</span>
            </label>
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
                acceptedFileTypes: ['image/*'],
                server: {
                    load: (source, load, error, progress, abort, headers) => {
                        const myRequest = new Request(source);
                        fetch(myRequest).then((res) => {
                            return res.blob();
                        })
                            .then(load);
                    },
                    process: '{{ route('admin.upload') }}',
                    revert: '{{ route('admin.revert') }}',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    onload: (response) => {
                        return JSON.parse(response);
                    }
                },
                files: [
                    {
                        source: '{{ Storage::disk('public')->url($sponsor->image) }}',
                        options: {
                            type: 'local',
                        },
                    }
                ],
            });
        </script>
    @endpush
</x-admin-layout>
