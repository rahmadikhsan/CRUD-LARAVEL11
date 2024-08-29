<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="w-full px-6 mt-2 text-yellow-700 sm:px-6 md:px-8 lg:ps-72">
        {{ Breadcrumbs::render('dashboard') }}
    </div>
    <!-- Content -->
    <div class="w-full px-4 pt-10 sm:px-6 md:px-8 lg:ps-72">
        <!-- your content goes here ... -->
        <h1>Hello Admin</h1>
    </div>
    <!-- End Content -->
    <!-- ========== END MAIN CONTENT ========== -->
</x-app-layout>
