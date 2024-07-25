<x-app-layout>

    @include('recruiter.sidebar')
    <div class="p-4 sm:ml-64">

        @if (session('success'))
            <div id="success-message"
                class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
                role="alert">
                <div
                    class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                    </svg>
                    <span class="sr-only">Check icon</span>
                </div>
                <div class="ms-3 text-sm font-normal">{{ session('success') }}</div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                    data-dismiss-target="#toast-success" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif


        <table class="w-full text-sm text-left text-gray-500 mt-4">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th class="px-6 py-3">Listing</th>
                    <th class="px-6 py-3">Candidate</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Phone</th>
                    <th class="px-6 py-3">Cover Letter</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Message</th>
                    <th class="px-6 py-3">Resume</th>
                    <th class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($applications as $application)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">

                        <td class="px-6 py-4">{{ $application->listing }}</td>
                        <td class="px-6 py-4">{{ $application->candidate_name }}</td>
                        <td class="px-6 py-4">{{ $application->candidate_email }}</td>
                        <td class="px-6 py-4">{{ $application->candidate_phone }}</td>
                        <td class="px-6 py-4">{{ $application->cover_letter }}</td>
                        <td class="px-6 py-4">{{ $application->message }}</td>
                        <td class="px-6 py-4">{{ $application->status }}</td>
                        <td class="px-6 py-4">{{ $application->resume }}</td>
                        <td class="px-6 py-4">
                            <button data-modal-target="update-modal-{{ $application->id }}"
                                data-modal-toggle="update-modal-{{ $application->id }}"
                                href="{{ route('application.edit', $application->id) }}"
                                class= "text-white bg-green-700 hover:bg-green-800  font-medium rounded text-sm px-2 py-2 text-center dark:bg-green-600 dark:hover:bg-green-700">
                                Edit
                            </button>
                            <button data-modal-target="delete-modal" data-modal-toggle="delete-modal"
                                class="text-white bg-rose-700 hover:bg-rose-800  font-medium rounded text-sm px-2 py-2 text-center dark:bg-rose-600 dark:hover:bg-rose-700"
                                type="button">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- UPDATE APPLICATION MODAL --}}
        @foreach ($applications as $application)
        <div id="update-modal-{{ $application->id }}" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Edit company details
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-toggle="crud-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form class="p-4 md:p-5" action="{{ route('application.update', $application->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="grid gap-4 mb-4 grid-cols-2">

                            <div class="col-span-2 sm:col-span-1">
                                <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Category
                                </label>
                                <select id="category" name="category"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $company->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-span-2">
                                <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                    Message
                                </label>
                                <input type="text" name="message" id="message" 
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    value="{{ $application->message }}" >
                            </div>    
                        </div>
                        <button type="submit"
                            class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                             Update application
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach

        {{-- DELETE MODAL --}}
        @foreach ($applications as $application)
        <div id="delete-modal" tabindex="-1"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button"
                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="popup-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are
                            you sure you want to delete this application?</h3>

                        <form action="{{ route('application.destroy', $application->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                Yes, I'm sure
                            </button>

                            <button data-modal-hide="popup-modal" type="button"
                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No,
                                cancel
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach


        <div class="mt-4">
            {{ $applications->links('vendor.pagination.tailwind') }} <!-- Pagination links -->
        </div>



    </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const successMessage = document.getElementById("success-message");

            if (successMessage) {
                setTimeout(function() {
                    successMessage.style.display = "none";
                }, 3000); 
            }
        });
    </script>


</x-app-layout>
