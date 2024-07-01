<x-app-layout>
    


    <div class="p-4 sm:ml-64">

       @include('candidate.navigation')
      


        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 p-4 ">

            

            @foreach ($listings as $listing)
                <a href="#"
                    class="w-full max-w-sm m-2 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-700">
                    <div class="flex justify-end px-4 pt-4">
                        <p class=" dark:text-white"> save </p>
                        
                    </div>
                    <div class="flex flex-col ml-3 pb-3">
                        <div class="flex mb-2 pb-3">

                            <div class="flex size-12 shrink-0 items-center justify-center rounded-lg  mr-2 bg-[#FF2D20]/10 sm:size-16">
                                @if ($listing->company->logo)
                                    <img src="{{ Storage::url($listing->company->logo) }}" alt="{{ $listing->company->name }}"
                                    class="rounded-lg object-cover w-16 h-16">
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
                            <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                {{$listing->location}} 
                            </span>
                            
                            <span class="bg-indigo-100 text-indigo-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-indigo-900 dark:text-indigo-300">
                                {{$listing->contract_type}}
                            </span>
                            <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">
                                Apply before: {{$listing->due_date}} 
                            </span>

                            
                        </div>
                        
                
                    </div>
                </a>
            @endforeach


            <div class="mt-4">
                {{ $listings->links('vendor.pagination.tailwind') }} <!-- Pagination links -->
            </div>



        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const successMessage = document.getElementById("success-message");

            if (successMessage) {
                setTimeout(function() {
                    successMessage.style.display = "none";
                }, 5000); // Hide the message after 5 seconds (5000 milliseconds)
            }
        });
    </script>


</x-app-layout>
                
                            