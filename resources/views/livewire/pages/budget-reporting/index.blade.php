<div>
    <div class="sm:flex sm:items-center mb-5">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Budget Anggaran</h1>
        </div>
    </div>
    @livewire('utils.filter', ['table' => 'pages.budget-reporting.section.table', 'useArea' => true, 'useDate' => true])
    @livewire('pages.budget-reporting.section.table')
</div>
