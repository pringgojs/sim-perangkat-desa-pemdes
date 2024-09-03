<div class="overflow-hidden rounded-lg bg-white shadow">
    <h2 class="sr-only" id="profile-overview-title">Profile Overview</h2>
    <div class="bg-white p-6">
        <div class="sm:flex sm:items-center sm:justify-between">
            <div class="sm:flex sm:space-x-5">
                <div class="flex-shrink-0">
                    <svg class="mx-auto h-20 w-20 rounded-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>

                <div class="mt-4 text-center sm:mt-0 sm:pt-1 sm:text-left">
                    <p class="text-sm font-medium text-gray-600">Profile,</p>
                    <p class="text-xl font-bold text-gray-900 sm:text-2xl">{{ $staff->name ?? '**' }}</p>
                    <p class="text-sm font-medium text-gray-600">{{ $staff->position_name ?? '' }} -
                        {{ $staff->village->name ?? '' }} - {{ $staff->village->district->name ?? '' }}</p>
                </div>
            </div>
            <div class="mt-5 flex justify-center sm:mt-0">
                <a href="#"
                    class="flex items-center justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Download
                    profile</a>
            </div>
        </div>
    </div>
</div>
