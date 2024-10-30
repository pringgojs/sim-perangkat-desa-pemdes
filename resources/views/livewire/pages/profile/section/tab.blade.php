<div>
    <div x-data="{ activeTab: 'identity' }" class="p-4 bg-white rounded-lg shadow-md w-full mt-10 mx-auto">
        <!-- Tab Buttons -->
        <div class="flex items-center border-b border-gray-200 pb-2">
            <button @click="activeTab = 'identity';$wire.setActive('identity')"
                :class="{ 'bg-gray-50 text-gray-900  relative': activeTab === 'identity' }"
                class="px-4 py-2 mx-1 text-gray-600 rounded-lg hover:bg-gray-50 focus:outline-none">
                Identitas
                <span x-show="activeTab === 'identity'"
                    class="absolute bottom-[-10px] left-0 right-0 mx-auto h-[2px] w-3/4 bg-gray-900 rounded"></span>
            </button>
            <button @click="activeTab = 'history'; $wire.setActive('history')"
                :class="{ 'bg-gray-50 text-gray-900 relative': activeTab === 'history' }"
                class="px-4 py-2 mx-1 text-gray-600 rounded-lg hover:bg-gray-50 focus:outline-none">
                Riwayat Jabatan
                <span x-show="activeTab === 'history'"
                    class="absolute bottom-[-10px] left-0 right-0 mx-auto h-[2px] w-3/4 bg-gray-900 rounded"></span>
            </button>
            <button class="ml-auto p-2 focus:outline-none">
                <svg class="w-5 h-5 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            </button>
        </div>

        <div class="p-4 bg-white">
            @if ($tabActive == 'identity')
                @livewire('pages.profile.section.form', ['form' => $form, 'staff' => $staff])
            @endif

            @if ($tabActive == 'history')
                <div class="space-y-2">
                    <div class="flex items-center space-x-2 p-3 bg-gray-100 rounded-md">
                        <div class="w-8 h-8 bg-gray-300 rounded-full"></div>
                        <div class="space-y-1">
                            <div class="w-32 h-3 bg-gray-300 rounded"></div>
                            <div class="w-24 h-3 bg-gray-200 rounded"></div>
                        </div>
                    </div>
                    <!-- Tambahkan lebih banyak item di sini jika diperlukan -->
                </div>
                {{-- @livewire('pages.profile.section.form', ['form' => $form, 'staff' => $staff]) --}}
            @endif
            <template x-if="activeTab === 'identity">
            </template>
        </div>
        <!-- Tab Content -->
        {{-- <div class="p-4 bg-white">
            <template x-if="activeTab === 'profile'">
                <div class="space-y-2">
                    <div class="flex items-center space-x-2 p-3 bg-gray-100 rounded-md">
                        <div class="w-8 h-8 bg-gray-300 rounded-full"></div>
                        <div class="space-y-1">
                            <div class="w-32 h-3 bg-gray-300 rounded"></div>
                            <div class="w-24 h-3 bg-gray-200 rounded"></div>
                        </div>
                    </div>
                    <!-- Tambahkan lebih banyak item di sini jika diperlukan -->
                </div>
            </template>

            <template x-if="activeTab === 'archived'">
                <div class="text-gray-600">
                    No archived items.
                </div>
            </template>
        </div> --}}
    </div>

</div>
