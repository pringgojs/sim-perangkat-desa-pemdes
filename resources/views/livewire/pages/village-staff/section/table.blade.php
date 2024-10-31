<div>
    <x-table :headers="[
        'Aksi',
        'Desa - Kecamatan',
        'Nama 1,2',
        'Jabatan Definitif',
        'Jabatan PLT/PLH/PJ',
        'Tempat, Tgl. Lahir',
        'Pendidikan',
        'Status Data',
    ]" title="Data Perangkat Desa">
        <!-- Table Content -->
        <x-slot:table>
            @foreach ($staffs as $index => $item)
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
                            @if (!in_array($item->dataStatus->key, $arr))
                                {{-- <a onclick="Livewire.dispatch('openModal', { component: 'modals.form-village-staff', arguments: {id: '{{ $item->id }}'} })"
                                    class="inline-flex rounded-lg p-2 bg-purple-50 text-purple-700 ring-4 ring-white cursor-pointer">
                                    <x-heroicon-o-pencil class="h-5 w-5" />
                                </a>

                                <a id="dropdownDefaultButton-{{ $item->id }}"
                                    data-dropdown-toggle="dropdown-{{ $item->id }}"
                                    class="inline-flex rounded-lg p-2 bg-red-50 text-red-700 ring-4 ring-white cursor-pointer">
                                    <x-heroicon-o-trash class="h-5 w-5" />
                                </a>

                                <div id="dropdown-{{ $item->id }}"
                                    class="z-10 hidden  mr-10 bg-white divide-y divide-gray-100 rounded-lg shadow w-64 dark:bg-gray-700">
                                    <div
                                        class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

                                        <p class="mb-3 font-normal text-sm text-gray-500 dark:text-gray-400">Are you
                                            sure
                                            you
                                            want to delete <b>{{ ucwords(strtolower($item->user->name)) }}</b>?</p>
                                        <a wire:key="item-{{ $item->id }}"
                                            wire:click="delete('{{ $item->id }}')"
                                            class="cursor-pointer item-right rounded-md bg-red-50 px-2.5 py-1.5 text-sm font-semibold text-red-900 shadow-sm ring-1 ring-inset ring-red-300 hover:bg-red-50">
                                            Ya, hapus!
                                        </a>
                                    </div>
                                </div> --}}
                                @php
                                    $menuItems = [
                                        [
                                            'type' => 'link',
                                            'label' => 'Riwayat Jabatan',
                                            'url' => route('village-staff.history', ['id' => $item->id]),
                                            'color' => 'text-gray-800',
                                        ],
                                        [
                                            'type' => 'link',
                                            'label' => 'Edit',
                                            'url' => route('village-staff.edit', ['id' => $item->id]),
                                            'color' => 'text-gray-800',
                                        ],
                                        [
                                            'type' => 'delete',
                                            'label' => 'Delete',
                                            'color' => 'text-red-600',
                                        ],
                                    ];
                                @endphp
                            @endif


                            <x-utils.dropdown-menu-action :id="$item->id" :items="$menuItems" />
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                        {{ $item->village->name }} ({{ $item->village->code }}) <br>
                        {{ $item->village->district->name }} ({{ $item->village->district->getCode() }})</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                        {{ $item->name }} <br> {{ $item->another_name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                        {{ $item->position_name }} <br> {{ $item->position_code }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                        {{ $item->position_plt_name }} <br> {{ $item->position_plt_code }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                        {{ $item->place_of_birth }}{{ $item->place_of_birth ? ', ' . $item->date_of_birth : '' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                        {{ $item->educationLevel->name ?? '-' }}
                    </td>
                    <td>{!! $item->labelDataStatus() !!}</td>

                </tr>
            @endforeach
        </x-slot:table>

        <!-- Footer for Pagination -->
        <x-slot:footer>
            {{ $staffs->links() }}
        </x-slot:footer>
    </x-table>

    {{-- modal confirm --}}
    <x-utils.modal-delete id="modalConfirm" wire:ignore />
</div>


@script
    <script>
        Livewire.hook('morph.updated', ({
            el,
            component
        }) => {
            console.log('Reinitializing dropdown');

            initFlowbite();
            window.HSStaticMethods.autoInit(['dropdown']);
        })
    </script>
@endscript
