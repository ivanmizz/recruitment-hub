<x-base-layout>

    <div class="p-4 sm:ml-64">

        @include('listing.navbar')

        <div class="grid grid-cols-1 md:grid-cols-1 gap-4 p-4 ">

            <div
                class="w-full max-w-2xl mt-14  bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 ">
                <div class="flex justify-end px-4 pt-4">

                </div>

                <div class="flex flex-col ml-3 pb-3">
                    <div class="flex  mb-2 pb-3">

                        <div
                            class="flex size-12 shrink-0 items-center justify-center rounded-lg  mr-2 bg-[#FF2D20]/10 sm:size-16">
                            @if ($listing->company->logo)
                                <img src="{{ Storage::url($listing->company->logo) }}" alt="{{ $listing->company->name }}"
                                    class="rounded-lg object-cover w-16 h-16">
                            @endif
                        </div>
                        <div>
                            <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $listing->company->name }}
                            </h5>
                            <p class="font-normal text-lg text-gray-700 dark:text-gray-400">
                                {{ $listing->title }}
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
                            {{ $listing->location }}
                        </span>
                        <span
                            class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-full dark:bg-blue-900 dark:text-blue-300">
                            {{ $listing->category }}
                        </span>
                    </div>
                </div>
            </div>
            <h1 class="dark:text-slate-200 text-2xl">Job Description</h1>

            <div
                class="max-w-2xl p-2 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                {{ $listing->requirement }}

            </div>
        </div>
    </div>

    <!-- APPLY JOB TOGGLE BUTTON -->
    <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
        class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        type="button">
        Apply job
    </button>

    <!-- APPLY JOB MODAL -->
    <div id="crud-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Fill your details for {{ $listing->title }} job
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="crud-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form class="p-4 md:p-5" action="{{ route('application.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="grid gap-4 mb-4 grid-cols-2">
                       
                        <div class="col-span-2">
                            <label for="candidate_name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                                Name</label>
                            <input type="text" name="candidate_name" id="candidate_name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="" required>
                        </div>
                       
                        <div class="col-span-2 ">
                            <label for="candidate_email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="email" name="candidate_email" id="candidate_email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                required="" placeholder="yourname@gmail.com">
                        </div>
                     

                        <div class="col-span-2 ">
                            <label for="candidate_phone"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone number</label>
                            <input type="text" name="candidate_phone" id="candidate_phone" 
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                required="" placeholder="07XXYYYZZZ" pattern="[0-9]{10}">
                        </div>

                        <div class="col-span-2">

                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                for="file_input">Upload your resume</label>
                            <input
                                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                id="resume" name="resume" type="file" accept=".pdf" required/>

                        </div>

                        <div class="col-span-2">
                            <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cover
                                letter</label>
                            <textarea id="cover_letter" name="cover_letter" rows="4"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Andika cover letter hapa " required></textarea>
                        </div>

                        <input type="hidden" name="status" value="received">
                        <input type="hidden" name="listing" value="{{ $listing->id }}">
                        
                    </div>
                    <button type="submit"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Submit 
                    </button>
                </form>

            </div>
        </div>



</x-base-layout>
