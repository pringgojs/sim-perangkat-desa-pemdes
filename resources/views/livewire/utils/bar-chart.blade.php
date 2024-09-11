<div>
    <p class="font-bold">{{ print_r($series) }}</p>

    <div class="font-bold">{{ $title }}</div>
    <div wire:ignore>
        <div id="bar-chart-{{ $id }}"></div>
    </div>
</div>
@script
    <script>
        let chart;
        let currentSeries = @json($series); // Menyimpan data awal
        let currentCategories = @json($legend); // Menyimpan kategori awal

        Livewire.hook('component.init', ({
            component,
            cleanup
        }) => {
            var chartElement = document.querySelector("#bar-chart-{{ $id }}");

            if (chartElement && chartElement.innerHTML === "") {
                var tailwindColors = [
                    '#10B981', // green-500
                    '#F59E0B', // yellow-500
                    '#3B82F6', // blue-500
                    '#EF4444', // red-500
                    '#8B5CF6', // purple-500
                ];

                // Fungsi untuk memotong array warna sesuai dengan jumlah legend
                function getDynamicColors(count) {
                    return tailwindColors.slice(0, count);
                }

                // Ambil warna dinamis berdasarkan jumlah legend atau kategori
                var dynamicColors = getDynamicColors(currentCategories.length);

                var options = {
                    chart: {
                        type: 'bar',
                        height: 350
                    },
                    series: currentSeries,
                    xaxis: {
                        categories: currentCategories,
                    },
                    colors: dynamicColors, // Set warna bar chart
                };

                chart = new ApexCharts(chartElement, options);
                chart.render();
            }

            cleanup(() => {
                if (chart) {
                    chart.destroy(); // Hapus chart saat komponen dihapus
                }
            });
        });


        /* disini, legend dan series harus dikirim dari BAKEND. meskipun properti sudah diset reaktif, nyatanya ketika dipanggil di livewire on update data masih data old */
        Livewire.on('update-chart', ({
            legend,
            series
        }) => {
            if (chart) {
                chart.updateSeries(series);

                chart.updateOptions({
                    xaxis: {
                        categories: legend,
                    }
                });
            }
        });
    </script>
@endscript
