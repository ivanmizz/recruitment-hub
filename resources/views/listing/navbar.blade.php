<nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo">
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Recruitment Hub</span>
        </a>

       
        <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
            @auth
            <a href="{{ route('dashboard') }}" type="button"
                class="text-white rounded-full dark:text-white mr-2 font-medium  text-sm px-4 py-2 text-center border border-rose-700 hover:text-rose-700">
                Dashboard
            </a> 
            @endauth

            @guest
            <a href="{{ route('login') }}" type="button"
                class="text-white rounded-full dark:text-white mr-2 font-medium  text-sm px-4 py-2 text-center border border-blue-700 hover:text-blue-700">
                Login
            </a>
            <a href="{{ route('register') }}" type="button"
                class="text-white rounded-full bg-blue-700  hover:bg-blue-800  font-medium text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Register
            </a>
            @endguest
        </div>
       
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
            <ul
                class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                <li>
                    <x-navbar-link href="{{ route('home') }}" :active="request()->routeIs('home')" >
                        Home
                    </x-navbar-link>
                </li>

                <li>
                    <x-navbar-link href="{{ route('jobs') }}" :active="request()->routeIs('jobs')">
                        Jobs
                    </x-navbar-link>
                </li>
                <li>
                    <x-navbar-link href="{{ route('companies') }}" :active="request()->routeIs('companies')">
                        Companies
                    </x-navbar-link>
                </li>
            </ul>
        </div>
    </div>
</nav>
