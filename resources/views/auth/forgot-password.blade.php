<x-app-layout>
    <x-cards.small>
        <div class="mb-4 text-sm text-gray-700 dark:text-white">
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
        </div>

        <x-popups.messages />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-form.label for="email" value="{{ __('Email') }}" />
                <x-form.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-form.input-error for="email" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-buttons.primair class="px-3 py-2 text-xs font-medium">
                    Email Password Reset Link
                </x-buttons.primair>
            </div>
        </form>
    </x-cards.small>
</x-app-layout>
