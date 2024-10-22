<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    @livewire('pages.village-position-type.section.filter')

    <div class="border rounded shadow-sm p-6 bg-white dark:bg-neutral-800 dark:border-neutral-700">
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
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
                                            {{ $item->position_name }}
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
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $village_position_types->links() }}
            </div>
        </div>
    </div>
</div>
