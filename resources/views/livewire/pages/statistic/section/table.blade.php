<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    @livewire('pages.statistic.section.filter')

    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border border-gray-300 px-4 py-2 text-left">No.</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Desa</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Total Perangkat Desa</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">Perangkat Mau Pensiun</th>
                    <th class="border border-gray-300 px-4 py-2 text-left">BPD Mau Pensiun</th>
                </tr>
            </thead>
            <tbody>
                <!-- Contoh data -->
                <tr>
                    <td class="border border-gray-300 px-4 py-2">1</td>
                    <td class="border border-gray-300 px-4 py-2">Desa A</td>
                    <td class="border border-gray-300 px-4 py-2">10</td>
                    <td class="border border-gray-300 px-4 py-2">2</td>
                    <td class="border border-gray-300 px-4 py-2">1</td>
                </tr>
                <tr>
                    <td class="border border-gray-300 px-4 py-2">2</td>
                    <td class="border border-gray-300 px-4 py-2">Desa B</td>
                    <td class="border border-gray-300 px-4 py-2">15</td>
                    <td class="border border-gray-300 px-4 py-2">3</td>
                    <td class="border border-gray-300 px-4 py-2">2</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
