<x-app-layout>
    <x-cards.small>
        <div x-data="{ recovery: false }">
            <div class="mb-4 text-sm text-gray-700 dark:text-white" x-show="! recovery">
                Please confirm access to your account by entering the authentication code provided by your authenticator application.
            </div>

            <div class="mb-4 text-sm text-gray-700 dark:text-white" x-show="recovery">
                Please confirm access to your account by entering one of your emergency recovery codes.
            </div>

            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('two-factor.login') }}">
                @csrf
                <div class="mt-4" x-show="! recovery">
                    <x-form.label for="code" value="{{ __('Code') }}" />
                    <x-form.input id="code" class="block mt-1 w-full" type="text" inputmode="numeric" name="code" autofocus x-ref="code" autocomplete="one-time-code" />
                    <x-form.input-error for="code" class="mt-2" />

                </div>

                <div class="mt-4" x-show="recovery">
                    <x-form.label for="recovery_code" value="{{ __('Recovery Code') }}" />
                    <x-form.input id="recovery_code" class="block mt-1 w-full" type="text" name="recovery_code" x-ref="recovery_code" autocomplete="one-time-code" />
                    <x-form.input-error for="recovery_code" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-buttons.secondary type="button" class="px-3 py-2 text-xs font-medium"
                                    x-show="! recovery"
                                    x-on:click="
                                        recovery = true;
                                        $nextTick(() => { $refs.recovery_code.focus() })
                                    ">
                        {{ __('Use a recovery code') }}
                    </x-buttons.secondary>

                    <x-buttons.secondary type="button" class="px-3 py-2 text-xs font-medium"
                                    x-show="recovery"
                                    x-on:click="
                                        recovery = false;
                                        $nextTick(() => { $refs.code.focus() })
                                    ">
                        {{ __('Use an authentication code') }}
                    </x-buttons.secondary>

                    <x-buttons.primair class="ml-4 px-3 py-2 text-xs font-medium">
                        {{ __('Log in') }}
                    </x-buttons.primair>
                </div>
            </form>
        </div>
    </x-cards.small>
</x-app-layout>
