<x-app-layout>
    <x-cards.small>
        <div class="mb-4 text-sm text-gray-700 dark:text-white">
            Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to the email address you provided in your profile settings.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-buttons.primair type="submit" class="px-3 py-2 text-xs font-medium">
                        Resend Verification Email
                    </x-buttons.primair>
                </div>
            </form>

            <div class="flex space-x-2">
                <x-links.btn-secondary class="px-3 py-2 text-xs font-medium" href="{{ route('profile.show') }}">
                    Edit Profile
                </x-links.btn-secondary>

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf

                    <x-buttons.secondary class="px-3 py-2 text-xs font-medium" type="submit">
                        {{ __('Log Out') }}
                    </x-buttons.secondary>
                </form>
            </div>
        </div>
    </x-cards.small>
</x-app-layout>
