<x-app-layout>




    @include('admin.sidebar')

    <div class="p-4 sm:ml-64">


        <div class="p-4 border-2 border-gray-200 border-solid rounded-lg dark:border-gray-700">

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
                <!-- Edit Department Modal -->
                <div x-show="editModal" class="fixed inset-0 flex items-center justify-center z-50">
                    <div class="modal">
                        <!-- Modal Content for Editing -->
                        <div class="p-4 bg-white shadow-md rounded-md">
                            <!-- Add your edit form here -->

                            <p>Edit Categories Form</p>
                            <!-- Close Button -->
                            <button @click="editModal = false"
                                class="mt-4 px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-md">Cancel</button>
                        </div>
                    </div>
                </div>

                <!-- Delete Category Modal -->
                <div x-show="deleteModal" class="fixed inset-0 flex items-center justify-center z-50">
                    <div class="modal">
                        <!-- Modal Content for Deleting -->
                        <div
                            class="p-4 dark:bg-slate-900 border border-solid border-rose-500 bg-white shadow-md rounded-lg">
                            <p class="text-xl text-center text-red-600">Confirm Deletion</p>
                            <p class="text-center my-4 dark:text-white">Are you sure you want to delete this category?
                            </p>
                            <div class="flex justify-center space-x-4">
                                <!-- Cancel Button -->
                                <button @click="deleteModal = false"
                                    class="px-4 py-2 bg-gray-300 hover:bg-gray-400 rounded-md">
                                    Cancel
                                </button>

                                @foreach ($categories as $category)
                              
                                    <!-- Delete Button for each category -->
                                    <form method="POST" action="{{ route('categories.destroy', $category->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md">Delete</button>
                                    </form>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>



                <form action="{{ url('categories') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="w-1/3 mb-4">
                        <p class="text-gray-900 dark:text-white text-lg text-center">Add a new category</p>
                        {{-- name --}}
                        <div class="mb-6 ">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category
                                name</label>
                            <input type="text" id="name" name="name"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                                placeholder="Department name" required>
                        </div>



                    </div>
                    <div>

                        <button type="submit"
                            class="mb-6 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Register
                            new category</button>
                    </div>

                </form>

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 ">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Created At
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $category->id }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $category->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $category->created_at }}
                                    </td>
                                    <td class="px-6 py-4">

                                        <!-- Edit Button -->
                                        <button @click="editModal = true"
                                            class="text-white bg-green-500 hover:bg-green-600 px-2 py-2 rounded"">Edit</button>
                                        <!-- Delete Button -->
                                        <button @click="deleteModal = true; categoriesIdToDelete = {{ $category->id }}"
                                            class="text-white bg-rose-500 hover:bg-rose-600 px-2 py-2 rounded">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                </div>

            </div>
        </div>
    </div>


</x-app-layout>
