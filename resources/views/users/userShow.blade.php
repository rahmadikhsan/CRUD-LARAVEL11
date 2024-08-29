<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Users
        </h2>
    </x-slot>
    <!-- Content -->
    <div class="w-full px-4 pt-10 sm:px-6 md:px-8 lg:ps-72">
        <!-- your content goes here ... -->
        <header>
            <h1 class="text-black">Show User {{ $id }}</h1>
        </header>
    </div>
    <!-- End Content -->
    <!-- ========== END MAIN CONTENT ========== -->
</x-app-layout>
