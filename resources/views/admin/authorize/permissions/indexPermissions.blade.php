<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Permissions
        </h2>
    </x-slot>
    <!-- Content -->
    <div class="justify-between w-full px-4 pt-4 md:flex sm:px-6 md:px-8 lg:ps-72 flex-column">
        {{-- table --}}
        <!-- Table Section -->
        <div class="md:w-2/3">
            <!-- Card -->
            <div class="flex flex-col">
                <div class="-m-1.5 overflow-x-auto">
                    <div class="p-1.5 min-w-full inline-block align-middle">
                        <div
                            class="overflow-hidden bg-white border border-gray-200 shadow-sm rounded-xl dark:bg-neutral-800 dark:border-neutral-700">
                            <!-- Header -->
                            <div
                                class="grid gap-3 px-6 py-4 border-b border-gray-200 md:flex md:justify-between md:items-center dark:border-neutral-700">
                                <div>
                                    <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                                        Permissions
                                    </h2>
                                    <p class="text-sm text-gray-600 dark:text-neutral-400">
                                        Add Permissions, edit and more.
                                    </p>
                                </div>
                                <div>
                                    <div class="inline-flex gap-x-2">
                                    </div>
                                </div>
                            </div>
                            <!-- End Header -->
                            <!-- Table -->
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                <thead class="bg-white dark:bg-neutral-800">
                                    <tr>
                                        <th scope="col" class="py-3 ps-6 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span
                                                    class="text-xs font-semibold tracking-wide text-gray-800 uppercase dark:text-neutral-200">
                                                    No
                                                </span>
                                            </div>
                                        </th>
                                        <th scope="col" class="py-3 ps-6 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span
                                                    class="ml-2 text-xs font-semibold tracking-wide text-gray-800 uppercase dark:text-neutral-200">
                                                    Name
                                                </span>
                                            </div>
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-start">
                                            <div class="flex items-center gap-x-2">
                                                <span
                                                    class="text-xs font-semibold tracking-wide text-gray-800 uppercase dark:text-neutral-200">
                                                    Roles
                                                </span>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                @php
                                    $no = 1;
                                @endphp
                                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                    @forelse ($permissions as $row)
                                        <tr>
                                            <td class="size-px whitespace-nowrap">
                                                <div class="px-6 py-3">
                                                    <span
                                                        class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">{{ $no++ }}</span>
                                                </div>
                                            </td>
                                            <td class="size-px whitespace-nowrap">
                                                <div class="py-3 ps-6 lg:ps-3 xl:ps-0 pe-6">
                                                    <div class="flex items-center gap-x-3">
                                                        <div class="grow">
                                                            <span
                                                                class="block ml-4 text-sm font-semibold text-gray-800 dark:text-neutral-200">{{ $row->name }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="h-px w-72 whitespace-nowrap">
                                                <div class="px-6 py-3">
                                                    @foreach ($row->roles as $role)
                                                        <span
                                                            class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                                            {{ $role->name }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td class="size-px whitespace-nowrap">
                                                <div class="px-6 py-1.5 flex gap-2">
                                                    <a href="{{ route('permissions.index') }}?edit={{ $row->id }}"
                                                        class="inline-flex items-center text-sm font-medium text-blue-600 gap-x-1 decoration-2 hover:underline focus:outline-none focus:underline dark:text-blue-500">
                                                        Edit
                                                    </a>
                                                    <form onsubmit="return confirm('are you sure?')" method="POST"
                                                        action="{{ route('permissions.destroy', $row->id) }}">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit"
                                                            class="inline-flex items-center text-sm font-medium text-red-600 gap-x-1 decoration-2 hover:underline focus:outline-none focus:underline dark:text-blue-500">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <h1
                                            class="block mt-4 text-sm font-semibold text-center text-gray-800 dark:text-neutral-200">
                                            No data</h1>
                                    @endforelse
                                </tbody>
                            </table>
                            <!-- End Table -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Card -->
        </div>
        <!-- End Table Section -->
        <!-- form -->
        <div class="md:w-1/3">
            <!-- Card Section -->
            <div class="w-full px-4 mt-2 sm:px-6 lg:px-8 lg:py-14 md:mt-0">
                <!-- Card -->
                <div class="p-4 bg-white shadow rounded-xl sm:p-7 dark:bg-neutral-900">
                    <div class="mb-8 text-center">
                        <h2 class="text-2xl font-bold text-gray-800 md:text-3xl dark:text-neutral-200">
                            @if ($edit)
                                Edit Permission
                            @else
                                Form Permission
                            @endif
                        </h2>
                        <p class="text-sm text-gray-600 dark:text-neutral-400">
                            Add & Edit Permission
                        </p>
                    </div>
                    @if ($edit)
                        <form method="POST" action="{{ route('permissions.update', $edit->id) }}">
                            @method('PUT')
                        @else
                            <form method="POST" action="{{ route('permissions.store') }}">
                    @endif
                    @csrf
                    <!-- Section -->
                    <div
                        class="py-6 border-t border-gray-200 first:pt-0 last:pb-0 first:border-transparent dark:border-neutral-700 dark:first:border-transparent">
                        <div class="mt-2 space-y-3">
                            <input id="af-payment-payment-method" type="text"
                                class="block w-full px-3 py-2 text-sm border-gray-200 rounded-lg shadow-sm pe-11 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                placeholder="Name Permission" name="permission"
                                value="@if ($edit) {{ $edit->name }} @endif" required>
                            @error('permission')
                                <span class="text-red-400">{{ $message }}</span>
                            @enderror
                            <select required name="roles[]" multiple
                                class="block w-full px-3 py-2 text-sm border-gray-200 rounded-lg shadow-sm select-multiple pe-11 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">

                                @foreach ($roles as $role)
                                    <option
                                        value="{{ $role->name }}"{{ in_array($role->name, $permissionRoles) ? 'selected' : '' }}>
                                        {{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- End Section -->
                    <div class="flex justify-end mt-5 gap-x-2">
                        <a href="{{ route('permissions.index') }}">
                            <button type="button"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-800 bg-white border border-gray-200 rounded-lg shadow-sm gap-x-2 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
                                Cancel
                            </button>
                        </a>
                        @if ($edit)
                            <button type="submit"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-yellow-600 border border-transparent rounded-lg gap-x-2 hover:bg-yellow-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                Update
                            </button>
                        @else
                            <button type="submit"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                                Save
                            </button>
                        @endif
                    </div>
                    </form>

                </div>
                <!-- End Card -->
            </div>
            <!-- End Card Section -->
        </div>
        <!-- end form -->
        @push('scriptjs')
            <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
            <script>
                // In your Javascript (external .js resource or <script> tag)
                $(document).ready(function() {
                    $('.select-multiple').select2();
                });
            </script>
        @endpush
    </div>
</x-app-layout>
