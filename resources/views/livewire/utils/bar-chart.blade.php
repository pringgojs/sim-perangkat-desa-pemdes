<div>
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
                var options = {
                    chart: {
                        type: 'bar',
                        height: 350
                    },
                    series: currentSeries,
                    xaxis: {
                        categories: currentCategories,
                    },
                    colors: ['rgb(5, 122, 85)'], // Set warna bar chart
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
                console.log(series);
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
