<x-app-layout>
    @include('candidate.navigation')


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


            <div
                class="bg-white dark:bg-slate-800 text-gray-900  dark:text-gray-200 border dark:border-gray-700 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 ">
                    {{ __('These are the jobs you applied to ') }}
                </div>
                
        </div>

        @foreach ($applications as $application)
                    <div href="#"
                        class="w-full max-w-2xl mt-2 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 ">
                

                        <div class="flex flex-col ml-3 pb-3 mt-2">
                            <div class="flex mb-2 pb-3">

                                <div
                                    class="flex size-12 shrink-0 items-center justify-center rounded-lg  mr-2 bg-[#FF2D20]/10 sm:size-16">
                                    @if ($application->listing->company->logo)
                                        <img src="{{ Storage::url($application->listing->company->logo) }}"
                                            alt="{{ $listing->company->name }}"
                                            class="rounded-lg object-cover w-16 h-16">
                                    @endif
                                </div>
                                <div>
                                    <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                                        {{ $application->listing->title }}
                                    </h5>
                                    <p class="font-normal text-lg text-gray-700 dark:text-gray-400">
                                        {{ $application->listing->company->name }}
                                    </p>
                                    <p class="font-normal text-lg text-gray-700 dark:text-gray-400">
                                        Status:
                                        <span class="bg-green-100 text-green-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300"> {{ $application->status }}</span>

                                    </p>
                                    <p class="font-normal text-lg text-gray-700 dark:text-gray-400">
                                        {{ $application->message}}
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
                                        {{ $application->listing->location }}
                                    </span>

                                    <span
                                        class="bg-indigo-100 text-indigo-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-indigo-900 dark:text-indigo-300">
                                        {{ $application->listing->contract_type }}
                                    </span>
                                    <span
                                        class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">
                                        Applied on: {{ $application->created_at }}
                                    </span>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            
    </div>
</x-app-layout>
