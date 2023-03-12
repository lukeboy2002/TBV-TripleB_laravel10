<div>
    <x-popups.loading />

    <div class="overflow-x-auto relative shadow-md sm:rounded-lg px-4 py-2">
        <div class="flex justify-between items-center space-x-4 pb-4">
            <div class="flex items-center">
                <label for="search" class="sr-only">Search</label>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                    </div>
                    <input wire:model="search" type="text" name="search" id="search" class="pl-9 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-orange-500 focus:border-orange-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-orange-500 dark:focus:border-orange-500" placeholder="Search" required>
                </div>
            </div>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3"></th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            <button wire:click="sortBy('username')" class="uppercase">Username</button>
                            <x-icons.sort-icon
                                field="username"
                                :sortField="$sortField"
                                :sortAsc="$sortAsc"
                            />
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <div class="flex items-center">
                            <button wire:click="sortBy('email')" class="uppercase">Email</button>
                            <x-icons.sort-icon
                                field="email"
                                :sortField="$sortField"
                                :sortAsc="$sortAsc"
                            />
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Role
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3 flex justify-end space-x-4">
                        Actions
                    </th>
                </tr>
                </thead>
                <tbody>
                @forelse($users as $user )
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="{{ $user->username }}" class="h-10 w-auto" >
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $user->username }}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $user->email }}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            @foreach ($user->roles as $role)
                                @if($role->id == 1)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    {{ $role->name }}
                                </span>
                                @elseif ($role->id == 2)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    {{ $role->name }}
                                </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ $role->name }}
                                </span>
                                @endif
                            @endforeach
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">

                        </th>
                        <td class="px-6 py-4 flex justify-end space-x-4">
                            @if ($user->trashed())
                                <x-links.btn-secondary href="{{ route('admin.users.trashed.restore' , $user->id) }}" class="px-3 py-2 text-xs font-medium"><i class="fa-solid fa-recycle"></i></x-links.btn-secondary>
                                <x-links.btn-danger href="{{ route('admin.users.trashed.destroy' , $user->id) }}" class="px-3 py-2 text-xs font-medium"><i class="fa-regular fa-trash-can"></i></x-links.btn-danger>
                            @else
                                <x-links.btn-succes href="#" class="px-2.5 py-2.5 text-xs font-medium"><i class="fa-solid fa-id-card"></i></x-links.btn-succes>
                                <x-links.btn-primair href="{{ route('admin.users.edit' , $user) }}" class="px-2.5 py-2.5 text-xs font-medium"><i class="fa-solid fa-user-pen"></i></x-links.btn-primair>
                                <x-buttons.danger type="button" wire:click="deleteId({{ $user->id }})" class="px-2.5 py-2.5 text-xs font-medium"><i class="fa-solid fa-user-slash"></i></x-buttons.danger>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" colspan="5" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            There are no users
                        </th>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-4 py-4">
            {{ $users->links() }}
        </div>
    </div>

    <!-- Modal -->
    <div class="hidden" @if ($showModal) style="display:block" @endif aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <x-modals.small>
            <div class="sm:flex sm:items-start">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-gray-200 dark:bg-white sm:mx-0 sm:h-10 sm:w-10">
                        <i class="fa-solid fa-trash-can"></i>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white" id="modal-title">Delete User</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500 dark:text-gray-200 mb-3">
                                Make sure you want to do this.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full mt-5 sm:mt-4 flex justify-end space-x-2">
                <x-buttons.secondary wire:click="close" class="px-3 py-2 text-xs font-medium" data-dismiss="modal">Close</x-buttons.secondary>
                <x-buttons.danger wire:click.prevent="delete()" class="px-3 py-2 text-xs font-medium">Delete</x-buttons.danger>
            </div>
        </x-modals.small>
    </div>
</div>