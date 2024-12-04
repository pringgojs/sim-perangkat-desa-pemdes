<div>
    <x-table :headers="['Desa', 'Total Anggaran Perbulan', 'Total Anggaran ' . $counter . ' Bulan']" title="Data Anggaran Setiap Desa">
        <!-- Table Content -->
        <x-slot:table>
            @foreach ($this->items as $index => $item)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                        {{ $item->village_name }} <br> {{ $item->village_code }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                        {{ format_rupiah($item->total_anggaran) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                        {{ format_rupiah($item->total_anggaran * $counter) }}</td>
                </tr>
            @endforeach
        </x-slot:table>

        <!-- Footer for Pagination -->
        <x-slot:footer>
            {{ $this->items->links() }}
        </x-slot:footer>
    </x-table>
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
