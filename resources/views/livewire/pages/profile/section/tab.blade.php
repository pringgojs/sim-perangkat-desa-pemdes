<div>
    <div x-data="{
        activeTab: @entangle('tabActive'),
        tabs: [
            { 'key': 'identity', 'label': 'Identitas' },
            { 'key': 'history', 'label': 'Riwayat Jabatan' },
            { 'key': 'account', 'label': 'Akun' }
        ]
    }" class="p-4 bg-white rounded-lg shadow-md w-full mt-10 mx-auto">

        <!-- Tab Buttons -->
        <div class="flex items-center border-b border-gray-200 pb-2">
            <template x-for="mtab in tabs" :key="mtab.key">
                <button @click="activeTab = mtab.key; $wire.setActive(mtab.key)"
                    :class="{ 'bg-gray-50 text-gray-900 relative': activeTab === mtab.key }"
                    class="relative px-4 py-2 mx-1 text-gray-600 rounded-lg hover:bg-gray-50 focus:outline-none">

                    <!-- Label text of the tab -->
                    <span x-text="mtab.label"></span>

                    <!-- Indicator bar for the active tab -->
                    <span x-show="activeTab === mtab.key"
                        class="absolute bottom-[-10px] left-0 right-0 mx-auto h-[2px] w-3/4 bg-gray-900 rounded">
                    </span>
                </button>
            </template>

            <button class="ml-auto p-2 focus:outline-none">
                <svg x-show="activeTab === 'identity'" class="w-5 h-5 text-gray-600" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                </svg>

                <svg x-show="activeTab === 'history'"
                    onclick="document.getElementById('formModalHistory')._x_dataStack[0].show = true"
                    class="w-5 h-5 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            </button>
        </div>

        <!-- Tab Content -->
        <div class="p-4 bg-white">
            @if ($tabActive == 'identity')
                @livewire('pages.profile.section.form', ['form' => $form, 'staff' => $staff])
            @endif

            @if ($tabActive == 'history')
                @livewire('pages.village-staff-history.section.table', ['from' => $from, 'staff' => $staff])
                {{-- <div class="space-y-2">
                    <div class="flex items-center space-x-2 p-3 bg-gray-100 rounded-md">
                        <div class="w-8 h-8 bg-gray-300 rounded-full"></div>
                        <div class="space-y-1">
                            <div class="w-32 h-3 bg-gray-300 rounded"></div>
                            <div class="w-24 h-3 bg-gray-200 rounded"></div>
                        </div>
                    </div>
                </div> --}}
            @endif
        </div>
    </div>
</div>
