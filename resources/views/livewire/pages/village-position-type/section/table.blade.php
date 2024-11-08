<div>
    <x-table :headers="['', 'Kecamatan', 'Desa', 'Jabatan', 'Siltap', 'Tunjangan', 'Status Jabatan', 'Status Parkir']" title="Daftar Jabatan Desa">
        <!-- Table Content -->
        <x-slot:table>
            @foreach ($village_position_types as $index => $item)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                        @php
                            $menuItems = [];
                            if ($item->staffHistory) {
                                $ar = [
                                    'type' => 'link',
                                    'label' => $item->staffHistory->villageStaff->name ?? '-',
                                    'url' => route('village-staff.edit', [
                                        'id' => $item->staffHistory->villageStaff->id,
                                    ]),
                                    'color' => 'text-gray-800',
                                ];

                                $menuItems[] = $ar;
                            }
                        @endphp
                        @php
                            $menu = [
                                [
                                    'type' => 'link',
                                    'label' => 'Edit',
                                    'url' => route('village-position-type.edit', ['id' => $item->id]),
                                    'color' => 'text-gray-800',
                                ],
                                [
                                    'type' => 'delete',
                                    'label' => 'Delete',
                                    'color' => 'text-red-600',
                                ],
                            ];

                            $menuItems = array_merge($menuItems, $menu);
                        @endphp

                        <x-utils.dropdown-menu-action :id="$item->id" :items="$menuItems"
                            modalName="modalConfirmDelete" />
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                        {{ $item->village->district->name }} <br>{{ $item->village->district->getCode() }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                        {{ $item->village->name }} <br>{{ $item->village->code }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                        {{ $item->position_name }} <br> {{ $item->code }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                        {{ format_rupiah($item->siltap) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                        {{ format_rupiah($item->tunjangan) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                        {{ $item->positionTypeStatus->name }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                        {{ $item->is_parkir ? 'Ya' : 'Tidak' }}
                    </td>
                </tr>
            @endforeach
        </x-slot:table>

        <!-- Footer for Pagination -->
        <x-slot:footer>
            {{ $village_position_types->links() }}
        </x-slot:footer>
    </x-table>

    {{-- modal confirm --}}
    <x-utils.modal-delete desc="Anda yakin ingin menghapus data ini ? data yang sudah dihapus tidak dapat dikembalikan!"
        id="modalConfirmDelete" wire:ignore />
</div>

@script
    <script>
        Livewire.hook('morph.updated', ({
            el,
            component
        }) => {
            initFlowbite()
        })
    </script>
@endscript
