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
                            <span data-tooltip-target="tooltip-non-active-{{ $item->id }}"
                                class="bg-yellow-100 text-yellow-600 text-sm px-2 py-1 rounded">Non-aktif</span>
                        @endif
                    </h3>
                    <p class="text-gray-500 text-sm">{{ $item->positionTypeStatus->name ?? '' }} per
                        {{ $item->getDateOfApp() }}
                    </p>
                    <div class="flex space-x-2 text-sm mt-2">
                        <span data-tooltip-target="tooltip-approver-default-{{ $item->id }}"
                            class="flex items-center bg-gray-100 text-gray-600 text-sm px-2 py-1 rounded">
                            <svg class="h-4 w-4 rounded-full mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                            </svg>
                            {{ $item->getEndDateOfOff() }}
                        </span>
                        @livewire('utils.tooltip', ['id' => 'tooltip-approver-default-' . $item->id, 'title' => 'Tanggal berakhir - ' . $item->getEndDateOfOff()])
                        @livewire('utils.tooltip', ['id' => 'tooltip-non-active-' . $item->id, 'title' => 'Non-aktif per - ' . $item->getNonActiveAt()])
                    </div>
                </div>


                <!-- Middle Section -->
                <div class="col-span-3 flex items-center justify-center text-sm">
                </div>

                @if (is_sekdes() || is_administrator())
                    <!-- Right Section -->
                    <div class="col-span-3 flex items-center justify-end space-x-4">
                        <div class="relative inline-block text-left">
                            @php
                                $menuItems = [
                                    [
                                        'type' => 'click',
                                        'label' => $item->is_active ? 'Non-aktifkan' : 'Aktifkan',
                                        'action' => 'setActive',
                                        'param' => $item->id,
                                        'color' => 'text-gray-800',
                                    ],
                                    [
                                        'type' => 'link',
                                        'label' => 'Ubah',
                                        'url' => route('village-staff-history.edit', ['id' => $item->id]),
                                        'color' => 'text-gray-800',
                                    ],
                                    [
                                        'type' => 'delete',
                                        'label' => 'Hapus',
                                        'color' => 'text-red-600',
                                    ],
                                ];
                            @endphp

                            <x-utils.dropdown-menu-action :id="$item->id" :items="$menuItems"
                                modalName="modalConfirmDelete" />
                        </div>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
    <x-utils.modal-delete id="modalConfirmDelete" wire:ignore
        desc="Anda yakin ingin menghapus data ini ? Jika status jabatan masih aktif, maka perangkat desa tersebut akan kehilangan jabatan ini. Data yang sudah dihapus tidak dapat dikembalikan!" />
</div>
