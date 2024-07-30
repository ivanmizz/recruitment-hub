
    <x-slot name="header">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    
                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Home') }}
                        </x-nav-link>
                    </div>

                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('application.showMyApplications')" :active="request()->routeIs('application.showMyApplications')">
                            {{ __('My Applications') }}
                        </x-nav-link>
                    </div>
                    
                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('jobs')" :active="request()->routeIs('jobs')">
                            {{ __('Jobs Listings') }}
                        </x-nav-link>
                    </div>

                    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                        <x-nav-link :href="route('jobs')" :active="request()->routeIs('savedjobs')">
                            {{ __('Saved Jobs') }}
                        </x-nav-link>
                    </div>

                    
                   
                </div>
            </div>
        </div>
    

    </x-slot>

