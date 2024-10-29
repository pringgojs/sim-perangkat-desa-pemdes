<div>
    <x-table :headers="['Kecamatan', 'Desa', 'Jabatan', 'Siltap', 'Tunjangan', 'Status Jabatan', 'Status Parkir', 'Aksi']" title="Daftar Jabatan Desa">
        <!-- Table Content -->
        <x-slot:table>
            @foreach ($village_position_types as $index => $item)
                <tr>
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
                    <td>
                        <div class="flex flex-none items-center gap-x-2">
                            <a href="{{ route('village-position-type.edit', ['id' => $item->id]) }}" wire:navigate
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

                                    <p class="mb-3 font-normal text-sm text-gray-500 dark:text-gray-400">
                                        Anda yakin ingin
                                        menghapus jabatan
                                        <b>{{ ucwords(strtolower($item->name)) }}</b>?
                                    </p>
                                    <a wire:key="item-{{ $item->id }}" wire:click="delete('{{ $item->id }}')"
                                        class="cursor-pointer item-right rounded-md bg-red-50 px-2.5 py-1.5 text-sm font-semibold text-red-900 shadow-sm ring-1 ring-inset ring-red-300 hover:bg-red-50">
                                        Ya, hapus!
                                    </a>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </x-slot:table>

        <!-- Footer for Pagination -->
        <x-slot:footer>
            {{ $village_position_types->links() }}
        </x-slot:footer>
    </x-table>
</div>
