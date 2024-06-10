<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @include('admin.sidebar')

    <div class="p-4 sm:ml-64">


        <div class="p-4 border-2 border-gray-200 border-solid rounded-lg dark:border-gray-700">

        <div class="flex ">
            <a 
                class="block max-w-sm m-2 p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    {{$companies}}
                </h5>
                <p class="font-normal text-gray-700 dark:text-gray-400"> Companies
                </p>
            </a>

            <a 
                class="block max-w-sm m-2 p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                   {{$candidates}} 
                </h5>
                <p class="font-normal text-gray-700 dark:text-gray-400"> Candidates
                </p>
            </a>
            <a 
                class="block max-w-sm m-2 p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                   {{$recruiters}} 
                </h5>
                <p class="font-normal text-gray-700 dark:text-gray-400"> Recruiters
                </p>
            </a>

            <a 
                class="block max-w-sm m-2 p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    {{$joblistings}}
                </h5>
                <p class="font-normal text-gray-700 dark:text-gray-400"> Jobs Listings
                </p>
            </a>
        </div>
            <p class="text-gray-100 dark:text-slate-100"> Welcome Admin!</p>
        </div>

    </div>

</x-app-layout>
