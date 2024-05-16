<x-app-layout>

    @include('admin.sidebar')
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-solid rounded-lg dark:border-gray-700">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="px-6 py-3">ID</th>
                        <th class="px-6 py-3">Name</th>
                        <th class="px-6 py-3">Email</th>
                        <th class="px-6 py-3">Role</th>
                        <th class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <td class="px-6 py-4">{{ $user->id }}</td>
                            <td class="px-6 py-4">{{ $user->name }}</td>
                            <td class="px-6 py-4">{{ $user->email }}</td>
                            <td class="px-6 py-4">{{ $user->usertype }}</td>
                            <td class="px-6 py-4"> Edit</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $users->links('vendor.pagination.tailwind') }} <!-- Pagination links -->
            </div>



        </div>
    </div>


</x-app-layout>
