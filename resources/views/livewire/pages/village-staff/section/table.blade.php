<div>
    <x-table :headers="[
        'Aksi',
        'Desa - Kecamatan',
        'Nama 1,2',
        'Status Data',
        'Tempat, Tgl. Lahir',
        'Pendidikan',
        'Jabatan',
        'THP',
    ]" title="Data Perangkat Desa">
        <!-- Table Content -->
        <x-slot:table>
            @foreach ($this->staffs as $index => $item)
                @php
                    $histories = $item->histories;
                @endphp
                <tr>
                    <td>
                        <div class="m-5">

                            {{-- <a @click="$dispatch('set-open-detail', true); $wire.detail('{{ $item->id }}')"
                                    class="inline-flex rounded-lg p-2 bg-green-50 text-green-700 ring-4 ring-white cursor-pointer">
                                    <x-heroicon-o-document-text class="h-5 w-5" />
                                </a> --}}
                            @php
                                $arr = ['diajukan', 'final'];
                                $menuItems = [];
                            @endphp
                            {{-- @if (!in_array($item->dataStatus->key, $arr)) --}}
                            @php
                                $menuItems = [
                                    [
                                        'type' => 'link',
                                        'label' => 'Data Diri',
                                        'url' => route('village-staff.edit', [
                                            'id' => $item->id,
                                            'tab' => 'identity',
                                        ]),
                                        'color' => 'text-gray-800',
                                    ],
                                    [
                                        'type' => 'link',
                                        'label' => 'Riwayat Jabatan',
                                        'url' => route('village-staff.edit', [
                                            'id' => $item->id,
                                            'tab' => 'history',
                                        ]),
                                        'color' => 'text-gray-800',
                                    ],
                                    [
                                        'type' => 'link',
                                        'label' => 'Reset Password',
                                        'url' => route('village-staff.edit', [
                                            'id' => $item->id,
                                            'tab' => 'account',
                                        ]),
                                        'color' => 'text-gray-800',
                                    ],
                                    [
                                        'type' => 'delete',
                                        'label' => 'Delete',
                                        'color' => 'text-red-600',
                                    ],
                                ];
                            @endphp
                            {{-- @endif --}}

                            <x-utils.dropdown-menu-action :id="$item->id" :items="$menuItems"
                                modalName="modalConfirmDelete" />
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                        {{ $item->village->name }} ({{ $item->village->code }}) <br>
                        {{ $item->village->district->name }} ({{ $item->village->district->getCode() }})</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                        {{ $item->name }} <br> {{ $item->another_name }}</td>
                    <td>{!! $item->labelDataStatus() !!}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                        {{ $item->place_of_birth }}{{ $item->place_of_birth ? ', ' . $item->date_of_birth : '' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                        {{ $item->educationLevel->name ?? '-' }}
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-800 dark:text-neutral-200">
                        @foreach ($histories as $history)
                            <p>({{ $history->positionTypeStatus->name }}) {{ $history->position_name }} </p>
                        @endforeach
                        <br>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-800 dark:text-neutral-200">
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($histories as $history)
                            <p>{{ format_rupiah($history->thp) }}</p>
                            @php
                                $total += $history->thp;
                            @endphp
                        @endforeach
                        <p class="font-bold border-t-2">{{ format_rupiah($total) }}</p>
                    </td>
                </tr>
            @endforeach
        </x-slot:table>

        <!-- Footer for Pagination -->
        <x-slot:footer>
            {{ $this->staffs->links() }}
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
            initFlowbite();
            window.HSStaticMethods.autoInit(['dropdown']);
        })
    </script>
@endscript
