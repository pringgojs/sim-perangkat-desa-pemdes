<div>
    <style>
        table {
            font-family: "Inter", sans-serif;

            thead {
                top: 0;
                position: sticky;

                th {
                    &:first-child {
                        position: sticky;
                        left: 0;
                    }
                }
            }

            tbody tr,
            thead tr {
                position: relative;
            }

            tbody th {
                position: sticky;
                left: 0;
            }
        }
    </style>
    <div class="sm:flex sm:items-center mb-5">
        <div class="sm:flex-auto">
            <h1 class="text-base font-semibold leading-6 text-gray-900">Village Staff Status Pending</h1>
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            {{-- <a onclick="Livewire.dispatch('openModal', { component: 'modals.form-user' })" type="button"
                class="block rounded bg-green-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm cursor-pointer hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create
                New</a> --}}
        </div>
    </div>

    {{-- @livewire('pages.dashboard.section.filter') --}}
    <x-staff.table :$staffs :$staff />
    {{-- <livewire:pages.village-staff.section.table :staffs="$staffs" /> --}}
</div>
