<x-app-layout>
    <x-cards.small>
        <div class="mb-4 text-sm text-gray-700 dark:text-white">
            This is a secure area of the application. Please confirm your password before continuing.
        </div>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div>
                <x-form.label for="password" value="{{ __('Password') }}" />
                <x-form.input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" autofocus />
                <x-form.input-error for="password" class="mt-2" />
            </div>

            <div class="flex justify-end mt-4">
                <x-buttons.primair class="px-3 py-2 text-xs font-medium">Confirm</x-buttons.primair>
            </div>
        </form>
    </x-cards.small>
</x-app-layout>
