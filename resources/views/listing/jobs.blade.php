<x-base-layout>

    <div class="p-4 sm:ml-64">

        @include('listing.navbar')

        @include('listing.sidebar')

        <div class=""> 
            <form class="max-w-md mx-auto" action="{{ route('listing.search') }}" method="GET">
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
                        placeholder="Search Jobs, Category or Location..." required />
                    <button type="submit"
                        class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                </div>
            </form>
        </div>


        <div class="grid grid-cols-1 md:grid-cols-1 gap-4 p-4 ">

            
            @foreach ($listings as $listing)
                <div href="#"
                    class="w-full max-w-2xl mt-2 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 ">
                    <div class="flex justify-end px-4 pt-4">
                        @auth
                            <a href="" class=" dark:text-white">
                                <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="m17 21-5-4-5 4V3.889a.92.92 0 0 1 .244-.629.808.808 0 0 1 .59-.26h8.333a.81.81 0 0 1 .589.26.92.92 0 0 1 .244.63V21Z" />
                                </svg>
                            </a>
                        @endauth
                        @guest
                            <a href="" class=" dark:text-white">
                                <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="m17 21-5-4-5 4V3.889a.92.92 0 0 1 .244-.629.808.808 0 0 1 .59-.26h8.333a.81.81 0 0 1 .589.26.92.92 0 0 1 .244.63V21Z" />
                                </svg>
                            </a>
                        @endguest
                    </div>

                    <div class="flex flex-col ml-3 pb-3">
                        <div class="flex mb-2 pb-3">

                            <div
                                class="flex size-12 shrink-0 items-center justify-center rounded-lg  mr-2 bg-[#FF2D20]/10 sm:size-16">
                                @if ($listing->company->logo)
                                    <img src="{{ Storage::url($listing->company->logo) }}"
                                        alt="{{ $listing->company->name }}" class="rounded-lg object-cover w-16 h-16">
                                @endif
                            </div>
                            <div>
                                <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    {{ $listing->title }}
                                </h5>
                                <p class="font-normal text-lg text-gray-700 dark:text-gray-400">
                                    {{ $listing->company->name }}
                                </p>
                            </div>
                        </div>
                        <div class="flex justify-start">
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
                                    {{ $listing->location }}
                                </span>

                                <span
                                    class="bg-indigo-100 text-indigo-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-indigo-900 dark:text-indigo-300">
                                    {{ $listing->contract_type }}
                                </span>
                                <span
                                    class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">
                                    Apply before: {{ $listing->due_date }}
                                </span>
                            </div>

                            <div class="flex justify-end">
                                <a href="#" class="flex">
                                    <span class="text-xs">Apply</span>
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                                    </svg>

                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty($listing)
                    <h1> No results</h1>
                @endempty

            @endforeach


            <div class="mt-4">
                {{ $listings->links('vendor.pagination.tailwind') }} <!-- Pagination links -->
            </div>



        </div>
    </div>

</x-base-layout>
