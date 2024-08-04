<x-base-layout>

    <div class="p-4 sm:ml-64">

        @include('listing.navbar')

        <div class=""> 
            <form class="max-w-3xl mx-auto" action="{{ route('company.search') }}" method="GET">
                <label for="default-search"
                    class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>
                    <input type="search" name="query" id="default-search" required minlength="2"
                        class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Search for companies..." value="{{ old('query', $query ?? '') }}" required />
                    <button type="submit"
                        class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                </div>
            </form>
        </div>



        <div class="grid grid-cols-1 md:grid-cols-1 gap-4 p-4 ">

            @foreach ($companies as $company)
                <div href="#"
                    class="w-full max-w-3xl m-1 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 ">
                    <div class="flex justify-end px-4 pt-4">

                    </div>

                    <div class="flex flex-col ml-3 pb-3">
                        <div class="flex mb-2 pb-3">

                            <div
                                class="flex size-12 shrink-0 items-center justify-center rounded-lg  mr-2 bg-[#FF2D20]/10 sm:size-16">
                                @if ($company->logo)
                                    <img src="{{ Storage::url($company->logo) }}" alt="{{ $company->name }}"
                                        class="rounded-lg object-cover w-16 h-16">
                                @endif
                            </div>
                            <div>
                                <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    {{ $company->name }}
                                </h5>
                                <p class="font-normal text-lg text-gray-700 dark:text-gray-400">
                                    {{ $company->description }}
                                </p>
                            </div>
                        </div>
                        <div class="flex">
                            <svg class="w-[15px] h-[15px] text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="1.7" d="M12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="1.7"
                                    d="M17.8 13.938h-.011a7 7 0 1 0-11.464.144h-.016l.14.171c.1.127.2.251.3.371L12 21l5.13-6.248c.194-.209.374-.429.54-.659l.13-.155Z" />
                            </svg>
                            <span
                                class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                {{ $company->location }}
                            </span>
                            <span
                                class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">
                                {{ $company->category->name }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
            
            @empty($company)
            <h1 class="dark:text-white text-3xl"> No results</h1>
            @endempty




            <div class="mt-4">
                {{ $companies->links('vendor.pagination.tailwind') }} <!-- Pagination links -->
            </div>



        </div>
    </div>

</x-base-layout>
