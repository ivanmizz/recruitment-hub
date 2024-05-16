<x-app-layout>




    @include('admin.sidebar')

    <div class="p-4 sm:ml-64">


        <div class="p-4 border-2 border-gray-200 border-solid rounded-lg dark:border-gray-700">


            <!-- Modal toggle to create category-->
            <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal"
                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">
                Create new category
            </button>

            <!-- Main register staff modal -->
            <div id="authentication-modal" tabindex="-1" aria-hidden="true"
                class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <button type="button"
                            class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="authentication-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="px-6 py-6 lg:px-8">
                            <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Add a new category
                            </h3>
                            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class=" mb-4">
                                    <p class="text-gray-900 dark:text-white text-lg text-center">
                                    </p>
                                    {{-- Category name --}}
                                    <div class="mb-6 ">
                                        <label for="name"
                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                            </label>
                                        <input type="text" id="name" name="name"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                                             required>
                                    </div>
                                    
                                </div>
                                <div>

                                    <button type="submit"
                                        class="mb-6 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Register
                                        new category</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

            <!-- update modal -->
            @foreach ($categories as $category)
                <div id="update-modal-{{ $category->id }}" tabindex="-1" aria-hidden="true"
                    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative w-full max-w-md max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <button type="button"
                                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="update-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="px-6 py-6 lg:px-8">
                                <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Update category
                                    details
                                </h3>
                                <form action="{{ route('categories.update', $category->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <div class=" mb-4">
                                        <p class="text-gray-900 dark:text-white text-lg text-center">
                                        </p>
                                        {{-- category --}}
                                        <div class="mb-6 ">
                                            <label for="category"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category
                                                name</label>
                                            <input type="text" id="category" name="category"
                                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                                                value="{{ old('category', $category->name) }}">
                                        </div>
                                        
                                    
                                    </div>
                                    <div>

                                        <button type="submit"
                                            class="mb-6 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Update category details
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach



            @if (session('success'))
                <div id="success-message"
                    class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    <span class="block sm:inline">{{ session('success') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </span>
                </div>
            @endif


            <div x-data="{ editModal: false, deleteModal: false, departmentIdToDelete: null }">



                <!-- Delete category Modal -->
                <div x-show="deleteModal" class="fixed inset-0 flex items-center justify-center z-50">
                    <div class="modal">
                        @foreach ($categories as $category)
                            <tr>
                                <!-- other staff information columns -->
                                <td class="px-6 py-4">
                                    <!-- Edit Button -->
                                    <button @click="editModal = true; staffIdToEdit = {{ $category->id }}"
                                        class="text-blue-600 hover:underline cursor-pointer">Edit</button>
                                    <!-- Delete Button -->
                                    <button @click="deleteModal = true; staffIdToDelete = {{ $category->id }}"
                                        class="text-red-600 hover:underline cursor-pointer">Delete
                                    </button>
                                </td>
                            </tr>

                            <!-- Delete Staff Modal for this staff member -->
                            <div x-show="deleteModal && staffIdToDelete === {{ $category->id }}"
                                class="fixed inset-0 flex items-center justify-center z-50">
                                <div class="modal">
                                    <!-- Modal Content for Deleting -->
                                    <div
                                        class="p-4 dark:bg-slate-900 border border-solid border-rose-500 bg-white shadow-md rounded-lg">
                                        <p class="text-xl text-center text-red-600">Confirm Deletion</p>
                                        <p class="text-center my-4 dark:text-white">Are you sure you want to remove
                                            this
                                            category?</p>
                                        <div class="flex justify-center space-x-4">
                                            <!-- Cancel Button -->
                                            <button @click="deleteModal = false"
                                                class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-md">Cancel</button>
                                            <!-- Delete Button -->
                                            <form method="POST" action="{{ route('categories.destroy', $category->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

                <div class="relative overflow-x-auto shadow-md mt-4 sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                
                                
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>  
                                <th scope="col" class="px-6 py-3">
                                    Creation date
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                   
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $category->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $category->created_at }}
                                    </td>
                                    
                                    <td class="px-6 py-4">

                                        <!-- Edit Button -->
                                        <button data-modal-toggle="update-modal-{{ $category->id }}"
                                            class="text-white bg-green-700 hover:bg-green-800 font-medium rounded text-sm px-2 py-2 text-center dark:bg-green-600 dark:hover:bg-green-700"
                                            type="button">
                                            Edit
                                        </button>
                            
                                        <!-- Delete Button -->
                                        <button @click="deleteModal = true; staffIdToDelete = {{ $category->id }}"
                                            class="text-white bg-rose-700 hover:bg-rose-800  font-medium rounded text-sm px-2 py-2 text-center dark:bg-rose-600 dark:hover:bg-rose-700 ">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $categories->links('vendor.pagination.tailwind') }}
                    </div>

                </div>

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
