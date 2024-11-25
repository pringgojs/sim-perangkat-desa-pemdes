<div>
    {{-- <p wire:loading class="text-red-500">loading....</p> --}}
    <x-table :headers="['', 'Kecamatan', 'Desa', 'Jenis Jabatan', 'Siltap', 'Tunjangan']" title="Daftar Siltap Desa">
        <!-- Table Content -->
        <x-slot:table>
            @foreach ($village_siltaps as $index => $item)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">

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

                        @endphp

                        <x-utils.dropdown-menu-action :id="$item->id" :items="$menu"
                            modalName="modalConfirmDelete" />
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                        {{ $item->village->district->name }} <br>{{ $item->village->district->getCode() }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                        {{ $item->village->name }} <br>{{ $item->village->code }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                        {{ $item->positionType->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                        {{ format_rupiah($item->siltap) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                        {{ format_rupiah($item->tunjangan) }}</td>
                </tr>
            @endforeach
        </x-slot:table>

        <!-- Footer for Pagination -->
        <x-slot:footer>
            {{ $village_siltaps->links() }}
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
