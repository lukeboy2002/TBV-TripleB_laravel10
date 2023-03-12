<div id="containerSidebar">
    <div class="py-4 text-gray-500 dark:text-gray-400">
        <a class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200" href="/">
            TBV-TripleB
        </a>

        <div class="mt-10 space-y-4">
            <x-links.dropdown class="block" href="{{ route('admin.settings') }}" :active="request()->routeIs('admin.settings')">
                <i class="fa-solid fa-house mr-4"></i>Dashboard
            </x-links.dropdown>

            <hr class="h-px m-4 bg-gray-200 border-0 dark:bg-gray-700">

            <x-links.dropdown class="block" href="{{ route('admin.slides.index') }}" :active="request()->routeIs('admin.slides*')">
                <i class="fa-regular fa-images mr-4"></i>Slides
            </x-links.dropdown>
                <x-links.dropdown class="block" href="{{ route('admin.sponsors.index') }}" :active="request()->routeIs('admin.sponsors*')">
                    <i class="fa-solid fa-hand-holding-dollar mr-4"></i>Sponsors
                </x-links.dropdown>

            <div class="relative">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="m-4 w-full border-t border-gray-200 dark:border-gray-700"></div>
                </div>
                <div class="relative flex justify-center">
                    <span class="bg-white dark:bg-gray-800 px-2 text-sm text-gray-500">Users</span>
                </div>
            </div>

            <x-links.dropdown class="block m-0" href="{{ route('admin.users.index') }}" :active="request()->routeIs('admin.users*')">
                <i class="fa-solid fa-users mr-4"></i>Users
            </x-links.dropdown>

            <x-links.dropdown class="block" href="{{ route('admin.members.create') }}" :active="request()->routeIs('admin.member*')">
                <i class="fa-solid fa-user-tie mr-4"></i>Add Member
            </x-links.dropdown>

            <hr class="h-px m-4 bg-gray-200 border-0 dark:bg-gray-700">
            {{--<x-links.btn-default class="block" href="{{ route('admin.posts.index') }}" :active="request()->routeIs('admin.posts*')">--}}
            <x-links.dropdown class="block" href="#" :active="request()->routeIs('admin.posts*')">
                <i class="fa-solid fa-blog mr-4"></i>BlogPost
            </x-links.dropdown>

            <x-links.dropdown class="block">
                <i class="fa-solid fa-chart-pie mr-4"></i>Charts
            </x-links.dropdown>

            <x-links.dropdown class="block" href="/">
                <i class="fa-solid fa-toggle-on mr-4"></i>Buttons
            </x-links.dropdown>

            <x-links.dropdown class="block" href="/">
                <i class="fa-solid fa-copy mr-4"></i>Modals
            </x-links.dropdown>

            <x-links.dropdown class="block" href="/">
                <i class="fa-solid fa-table-cells mr-4"></i>Tables
            </x-links.dropdown>
        </div>
    </div>
</div>
