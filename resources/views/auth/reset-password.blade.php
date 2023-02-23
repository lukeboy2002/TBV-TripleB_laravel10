<x-app-layout>
    <x-cards.small>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="block">
                <x-form.label for="email" value="Email" />
                <x-form.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                <x-form.input-error for="email" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-form.label for="password" value="Password" />
                <x-form.input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                <x-form.input-error for="password" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-form.label for="password_confirmation" value="Confirm Password" />
                <x-form.input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-form.input-error for="password_confirmation" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-buttons.primair type="submit" class="px-3 py-2 text-xs font-medium">
                    Reset Password
                </x-buttons.primair>
            </div>
        </form>
    </x-cards.small>
</x-app-layout>
