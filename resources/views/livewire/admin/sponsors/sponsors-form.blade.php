<div class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">

    <form wire:submit.prevent="save" enctype="multipart/form-data" method="POST" class="space-y-6">
        @csrf
        <div>
            <x-form.label for="name" value="Name" />
            <x-form.input wire:model="sponsor.name" type="text" name="name" id="name" :value="old('name')" required autofocus />
            <x-form.input-error for="sponsor.name" class="mt-2" />
        </div>
        <div>
            <x-form.label for="link" value="WebUrl" />
            <x-form.input wire:model="sponsor.link" type="url" name="link" id="name" :value="old('link')" required />
            <x-form.input-error for="sponsor.link" class="mt-2" />
        </div>
        <div>
            <x-form.label for="image" value="Image" />
            <x-form.input wire:model="sponsor.image" type="file" name="image" id="image" required />
            <x-form.input-error for="sponsor.image" class="mt-2" />
            <div wire:loading wire:target="sponsor.image" />
            <x-popups.loading />
        </div>

        <div class="mt-6">
            <label class="relative inline-flex items-center mr-5 cursor-pointer">
                <input wire:model="sponsor.published"
                       name="published"
                       id="published"
                       type="checkbox"
                       value="1"
                       class="sr-only peer"
                       checked
                >
                <div class="w-11 h-6 bg-gray-200 rounded-full peer dark:bg-gray-700 peer-focus:ring-4 peer-focus:ring-orange-500 dark:peer-focus:ring-orange-500 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-orange-500"></div>
                <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">published</span>
            </label>



        </div>
        <div class="flex justify-end space-x-2">
            <x-buttons.secondary type="button" class="px-3 py-2 text-xs font-medium" onclick="history.back()" >Cancel</x-buttons.secondary>
            <x-buttons.primair class="px-3 py-2 text-xs font-medium">Save</x-buttons.primair>
        </div>
    </form>
</div>
