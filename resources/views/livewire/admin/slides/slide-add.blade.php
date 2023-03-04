<div class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
    <form wire:submit.prevent="save" enctype="multipart/form-data" method="POST" class="space-y-6">
        @csrf
        <div>
            <x-form.label for="title" value="Title" />
            <x-form.input wire:model="title" type="text" name="title" id="title" :value="old('title')" required autofocus />
            <x-form.input-error for="title" class="mt-2" />
        </div>

        <div>
            <x-form.label for="subtitle" value="Subtitle" />
            <x-form.input wire:model="subtitle" type="text" name="subtitle" id="subtitle" :value="old('subtitle')" required />
            <x-form.input-error for="subtitle" class="mt-2" />
        </div>

        <div>
            <x-form.label for="image" value="Slide image" />
            <x-form.input wire:model="image" type="file" name="image" id="image" :value="old('image')" required />
            <x-form.input-error for="subtitle" class="mt-2" />
        </div>
        <div wire:loading wire:target="image">
            <x-popups.loading />
        </div>

        <label class="relative inline-flex items-center mr-5 cursor-pointer">
            <input wire:model="status"
                   name="status"
                   id="status"
                   type="checkbox"
                   value="1"
                   class="sr-only peer"
                   checked
            >
            <div class="w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-orange-500 dark:peer-focus:ring-orange-500 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-orange-500"></div>
            <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">published</span>
        </label>
        <fieldset class="hidden md:block border border-gray-900 dark:border-white rounded-md px-3 py-2 shadow-sm ">
            <legend class="mt-1 text-orange-500 text-lg mx-2 px-2">Preview</legend>

            <div class="bg-gray-50 dark:bg-gray-700 h-96">
                <div class="relative w-full overflow-hidden">
                    <div class="relative float-left w-full">
                        @if ($image)
                            <img src="{{$image->temporaryUrl()}}"
                                 class="block w-full max-h-96 object-center object-cover"
                                 alt="Preview"
                            >
                        @else
                            <div class="block w-full h-96"></div>
                        @endif
                        <div class="absolute inset-0 flex flex-col h-full items-center justify-center">
                            <h5 class="text-4xl font-black text-orange-500">{{$title}}</h5>
                            <p class="font-semibold text-orange-500">{{ $subtitle }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
        <div class="flex justify-end space-x-2 pt-2">
            <x-buttons.secondary type="button" onclick="history.back()" class="px-3 py-2 text-xs font-medium">Cancel</x-buttons.secondary>
            <x-buttons.primair class="px-3 py-2 text-xs font-medium">Save</x-buttons.primair>
        </div>
    </form>
</div>
