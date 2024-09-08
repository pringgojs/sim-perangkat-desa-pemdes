<div>
    {{ print_r($series) }}
    <div wire:ignore>
        <div id="bar-chart-{{ $id }}"></div>
    </div>
</div>
@script
    <script>
        // document.addEventListener('livewire:mount', function() {
        console.log('bar kepanggil 1');
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

        Livewire.hook('morph.updated', (component) => {
            // Cek apakah data series atau kategori berubah
            // console.log('json($series)');
            // console.log(@json($series));

            const newSeries = @json($series);
            const newCategories = @json($legend);

            // console.log('newSeries');
            // console.log(newSeries);
            if (JSON.stringify(newSeries) !== JSON.stringify(currentSeries) || JSON.stringify(newCategories) !==
                JSON.stringify(currentCategories)) {
                // console.log('ini kepanggil gak yaaaa');
                currentSeries = newSeries;
                currentCategories = newCategories;

                if (chart) {
                    chart.updateSeries(newSeries); // Update data series

                    chart.updateOptions({
                        xaxis: {
                            categories: newCategories, // Update kategori
                        }
                    });
                }
            }
        });


        Livewire.on('update-chart', ({
            legend,
            series
        }) => {
            console.log('update-chart');
            console.log(series);
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
