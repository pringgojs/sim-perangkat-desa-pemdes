<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="border rounded shadow-sm p-6 bg-white dark:bg-neutral-800 dark:border-neutral-700">
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto mb-5">
                <div class="p-1.5 min-w-full inline-block align-middle ">
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                            <caption
                                class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                                Daftar jabatan desa
                            </caption>
                            <thead>
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-bold text-black uppercase dark:text-neutral-500">
                                        Kecamatan</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-bold text-black uppercase dark:text-neutral-500">
                                        Desa</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-bold text-black uppercase dark:text-neutral-500">
                                        Jabatan</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-bold text-black uppercase dark:text-neutral-500">
                                        Siltap</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-bold text-black uppercase dark:text-neutral-500">
                                        Tunjangan</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-bold text-black uppercase dark:text-neutral-500">
                                        Status Jabatan</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-bold text-black uppercase dark:text-neutral-500">
                                        Status Parkir</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-bold text-black uppercase dark:text-neutral-500">
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                @foreach ($village_position_types as $item)
                                    <tr>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                            {{ $item->village->district->name }} <br>
                                            {{ $item->village->district->getCode() }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            {{ $item->village->name }} <br>
                                            {{ $item->village->code }}
                                        </td>

                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            {{ $item->position_name }} <br>
                                            {{ $item->code }}

                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            {{ format_rupiah($item->siltap) }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            {{ format_rupiah($item->tunjangan) }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            {{ $item->positionTypeStatus->name }}
                                        </td>

                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            {{ $item->is_parkir ? 'Ya' : 'Tidak' }}
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                            <a href="{{ route('village-position-type.edit', ['id' => $item->id]) }}"
                                                wire:navigate
                                                class="inline-flex rounded-lg p-2 bg-purple-50 text-purple-700 ring-4 ring-white">
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

                                                    <p
                                                        class="mb-3 font-normal text-sm text-gray-500 dark:text-gray-400">
                                                        Anda yakin ingin
                                                        menghapus jabatan
                                                        <b>{{ ucwords(strtolower($item->name)) }}</b>?
                                                    </p>
                                                    <a wire:key="item-{{ $item->id }}"
                                                        wire:click="delete('{{ $item->id }}')"
                                                        class="cursor-pointer item-right rounded-md bg-red-50 px-2.5 py-1.5 text-sm font-semibold text-red-900 shadow-sm ring-1 ring-inset ring-red-300 hover:bg-red-50">
                                                        Ya, hapus!
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{ $village_position_types->links() }}
        </div>
    </div>
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
