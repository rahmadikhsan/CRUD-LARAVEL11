<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Roles
        </h2>
    </x-slot>
    <!-- Content -->
    <div class="w-full px-4 pt-4 sm:px-6 md:px-8 lg:ps-72">
        <div class="max-w-[85rem] px-4 py-4 sm:px-6 lg:px-8 lg:py-5 mx-auto">
            <!-- Card -->
            <div class="card">
                <div class=" card-body">
                    <form action="{{ route('roles.update', $role->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="flex w-full gap-2">
                            <div class="w-1/2 space-y-3">
                                <input name="role" type="text"
                                    class="block w-full px-4 py-3 text-sm border-gray-200 rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                    value="{{ $role->name }}" required>
                            </div>
                            <button type="submit"
                                class="inline-flex items-center px-4 py-3 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                Update
                            </button>
                        </div>
                        <hr class="w-1/2 mt-4 bg-gray-800" />
                        <h1 class="mt-4 text-xl text-gray-800">Permissions : </h1>
                        <ul class="flex flex-col max-w-sm">
                            @foreach ($permissions as $permission)
                                <li
                                    class="inline-flex items-center px-4 py-3 -mt-px text-sm font-medium text-gray-800 bg-white border gap-x-2 first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-neutral-800 dark:border-neutral-700 dark:text-white">
                                    <div class="relative flex items-start w-full">
                                        <div class="flex items-center h-5">
                                            <input value="{{ $permission->id }}"
                                                id="hs-list-group-item-checkbox-{{ $permission->id }}"
                                                name="permissions[]" type="checkbox"
                                                class="border-gray-200 rounded disabled:opacity-50 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                                                {{ $role->permissions->contains($permission) ? 'checked' : '' }}>
                                        </div>
                                        <label for="hs-list-group-item-checkbox-{{ $permission->id }}"
                                            class="ms-3.5 block w-full text-sm text-gray-400 dark:text-neutral-500">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </form>
                </div>
            </div>
            <!-- End Card -->
        </div>
    </div>
</x-app-layout>
