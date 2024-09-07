<div>
    {{-- The whole world belongs to you. --}}
    <div class="sm:flex sm:items-center mb-5">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Statistik</h1>
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            {{-- <a onclick="Livewire.dispatch('openModal', { component: 'modals.form-user' })" type="button"
            class="block rounded bg-green-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm cursor-pointer hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Buat Baru</a> --}}
        </div>
    </div>

    <div class="flex items-center">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Tabel di sebelah kiri -->
                @livewire('pages.statistic.section.table')

                <!-- Chart di sebelah kanan -->
                @livewire('pages.statistic.section.chart')

            </div>
        </div>
    </div>
    {{-- @livewire('pages.report.section.filter') --}}
    {{-- @livewire('pages.village-staff.section.table', ['status' => key_option('diajukan')]) --}}
</div>
