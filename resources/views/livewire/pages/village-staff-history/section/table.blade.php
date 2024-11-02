<div>
    {{-- Stop trying to control. --}}
    <div class="space-y-4 mb-3">
        <!-- Card 1 -->
        @foreach ($histories as $item)
            <div class="bg-gray-100 p-4 rounded-lg  grid grid-cols-12 items-center gap-4">
                <!-- Left Section -->
                <div class="col-span-6">
                    <h3 class="text-md font-bold text-gray-900">{{ $item->position_name }}
                        @if ($item->is_active)
                            <span class="bg-green-100 text-green-600 text-sm px-2 py-1 rounded">Aktif</span>
                        @else
                            <span class="bg-yellow-100 text-yellow-600 text-sm px-2 py-1 rounded">Non-aktif</span>
                        @endif
                    </h3>
                    <p class="text-gray-500 text-sm">{{ $item->positionTypeStatus->name ?? '' }} per
                        {{ $item->getDateOfApp() }}
                    </p>
                    <div class="flex space-x-2 text-sm mt-2">
                        <span data-tooltip-target="tooltip-approver-default-"
                            class="flex items-center bg-gray-100 text-gray-600 text-sm px-2 py-1 rounded">
                            <svg class="h-4 w-4 rounded-full mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                            </svg>
                            {{ $item->getEndDateOfOff() }}
                        </span>
                        <div id="tooltip-approver-default-" role="tooltip"
                            class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                            Tanggal berakhir - {{ $item->getEndDateOfOff() }}
                            <div class="tooltip-arrow" data-popper-arrow></div>
                        </div>
                    </div>
                </div>


                <!-- Middle Section -->
                <div class="col-span-3 flex items-center justify-center text-sm">
                </div>

                <!-- Right Section -->
                <div class="col-span-3 flex items-center justify-end space-x-4">
                    <a href="" wire:navigate
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">Non-aktifkan
                    </a>
                    <div class="relative inline-block text-left">
                        @php
                            $menuItems = [
                                [
                                    'type' => 'link',
                                    'label' => 'Detil jabatan',
                                    'url' => route('village-staff.history', ['id' => '3424']),
                                    'color' => 'text-gray-800',
                                ],
                                [
                                    'type' => 'link',
                                    'label' => 'Ubah',
                                    'url' => route('village-staff.edit', ['id' => '920']),
                                    'color' => 'text-gray-800',
                                ],
                                [
                                    'type' => 'delete',
                                    'label' => 'Hapus',
                                    'color' => 'text-red-600',
                                ],
                            ];
                        @endphp

                        <x-utils.dropdown-menu-action :id="$item->id" :items="$menuItems" />
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
