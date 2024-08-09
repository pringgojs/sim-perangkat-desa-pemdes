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
            <h1 class="text-base font-semibold leading-6 text-gray-900">Dashboard</h1>
        </div>
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            {{-- <a onclick="Livewire.dispatch('openModal', { component: 'modals.form-user' })" type="button"
                class="block rounded bg-green-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm cursor-pointer hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create
                New</a> --}}
        </div>
    </div>

    {{-- @livewire('pages.dashboard.section.filter') --}}

    {{-- Success is as dangerous as failure. --}}
    <div class="p-4 font-sans flex flex-col h-screen bg-white mt-5">
        <div class="grid xl:grid-span-2 lg:grid-span-2 md:grid-span-5 sm:grid-span-6 gap-4">
            <div class="col-start-1 col-end-3">
                <h3 class="text-base font-semibold leading-6 text-gray-900">Data Account</h3>
            </div>
            <div class="col-end-7 col-span-2">
                <div class="flex items-center">
                    <label for="simple-search" class="sr-only">Search</label>
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <x-bi-search class="w-4 h-4 text-gray-500 dark:text-gray-400" />
                        </div>
                        <input type="text" wire:model.live.debounce.1000ms="search" id="simple-search"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded focus:ring-green-500 focus:border-green-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Search by company name or email ... " required>
                    </div>
                </div>
            </div>
        </div>
        <div class="shadow overflow-scroll border-b border-gray-200 mt-5 sm:rounded">
            <table class="w-full">
                <thead class="z-10 divide-y divide-gray-200">
                    <tr class="bg-gray-100 divide-x divide-gray-200" x-data>
                        <th scope="col"
                            class="w-64 px-6 py-3 text-left text-xs font-bold text-gray-800 uppercase tracking-wider bg-gray-200">
                            Account
                        </th>
                        {{-- <template x-for="n in 16" :key="`th-${n}`"> --}}
                        @foreach ($headers as $item)
                            <th scope="col"
                                class="w-32 px-6 py-3 text-center text-xs font-bold text-gray-800 uppercase tracking-wider">
                                {{ $item }}
                            </th>
                        @endforeach

                        {{-- Kolom untuk tombol action --}}
                        <th scope="col"
                            class="w-64 px-6 py-3 text-left text-xs font-bold text-gray-800 uppercase tracking-wider">
                            Action
                        </th>
                        {{-- </template> --}}
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" x-data>
                    <tr class="divide-x divide-gray-200">
                        <th class="px-6 py-4 whitespace-nowrap  bg-gray-100 border-r border-gray-200">
                            <div class="flex items-center gap-4 truncate">
                                <img class="w-10 h-10 rounded-full" src="{{ asset('images/user.png') }}" alt="">
                                <div class="font-medium dark:text-white text-sm text-left">
                                    <div clas="">Pringgo Juni Saputro</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                        Dinas Komunikasi, Informatika dan Statistik
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="flex items-center">
                                    <div class="text-left">
                                        <div class="text-sm font-bold text-gray-900">
                                            </div>
                                    </div>
                                </div> --}}
                        </th>

                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="px-2 inline-flex text-xs leading-5">
                                @pringgojs
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="px-2 inline-flex text-xs leading-5">
                                https://pringgojs.ponorogo.go.id
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="px-2 inline-flex text-xs leading-5">
                                pringgo.juni@gmail.com
                            </span>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-center">

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mt-5">
        </div>
    </div>

</div>
