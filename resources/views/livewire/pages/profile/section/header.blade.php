<div>

    <div class=" ">
        <h2 class="sr-only" id="profile-overview-title">Profile Overview</h2>
        <div class="bg-white p-6 rounded-lg bg-white shadow">
            <div class="sm:flex sm:items-center sm:justify-between">
                <div class="sm:flex sm:space-x-5">
                    <div class="flex-shrink-0">
                        <svg class="mx-auto h-20 w-20 rounded-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>

                    <div class="mt-4 text-center sm:mt-0 sm:pt-1 sm:text-left">
                        <p class="text-sm font-medium text-gray-600">Identitas,</p>
                        <p class="text-xl font-bold text-gray-900 sm:text-2xl">{{ $staff->name ?? '**' }}
                            {!! $staff->labelDataStatus() !!}</p>
                        <p class="text-sm font-medium text-gray-600">
                            @if ($staff->position_is_active)
                                {{ $staff->position_name ? $staff->position_name . ' (' . $staff->position_code . ')' : '' }}
                            @endif
                            @if ($staff->position_plt_is_active)
                                {!! $staff->position_plt_name ? '<br>' . $staff->position_plt_name . ' (' . $staff->position_plt_code . ')' : '' !!}
                            @endif
                            <br>{{ $staff->village->name ?? '' }} - {{ $staff->village->district->name ?? '' }}
                        </p>
                    </div>
                </div>
                <div class="mt-5 flex justify-center sm:mt-0">
                    @if (is_administrator() && $form->village_staff->dataStatus->key != 'final')
                        <a onclick="document.getElementById('modalConfirmDelete')._x_dataStack[0].show = true"
                            class="flex items-center mr-2 justify-center cursor-pointer rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm  hover:bg-green-700 focus:outline-none focus:bg-green-700">Finalisasi
                            Data
                        </a>
                    @endif
                    {{-- <a href="#"
                        class="flex items-center justify-center cursor-pointer rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Unduh
                        Data
                    </a> --}}
                    @if (is_administrator())
                        <div class="relative inline-block text-left">
                            @php
                                $menuItems = [
                                    [
                                        'type' => 'click',
                                        'label' => 'Unduh data',
                                        'action' => 'download',
                                        'param' => $staff->id,
                                        'color' => 'text-gray-800',
                                    ],
                                    [
                                        'type' => 'modal',
                                        'modalName' => 'modalFormRevision',
                                        'label' => 'Minta perbaikan',
                                        'action' => 'revision',
                                        'param' => key_option('revisi'),
                                        'color' => 'text-gray-800',
                                    ],
                                    [
                                        'type' => 'click',
                                        'label' => 'Batalkan status final',
                                        'action' => 'updateStatus',
                                        'param' => key_option('diajukan'),
                                        'color' => 'text-red-800',
                                    ],
                                ];
                            @endphp

                            <x-utils.dropdown-menu-action :id="$staff->id" :items="$menuItems"
                                modalName="modalConfirmDelete" />
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <x-modal id="modalConfirmDelete" maxWidth="md" wire:model="modalConfirmDelete">
        {{-- <div
            class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg"> --}}

        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
                <div
                    class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                    <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                    </svg>
                </div>
                <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                    <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Konfirmasi
                    </h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">Anda yakin ingin data sudah benar ? Data yang sudah disetujui
                            tidak bisa diedit lagi.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
            <button type="button" <button wire:click="finalisasi" type="button"
                class="inline-flex w-full justify-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-800 sm:ml-3 sm:w-auto">Ya,
                Finalisasi sekarang</button>
            <div wire:key="{{ str()->random(50) }}" class="justify-end flex-initial ml-5 -mt-5" wire:loading
                wire:target='finalisasi'>
                <x-loading />
            </div>
        </div>
        {{-- </div> --}}
    </x-modal>

    <x-modal id="modalFormRevision" maxWidth="md" wire:model="modalFormRevision">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Form Revisi
                </h3>
                <button type="button" @click="$dispatch('modal-close')"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5">
                <div class="grid gap-4 mb-4 grid-cols-2">

                    <div class="col-span-2">
                        <label for="description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tuliskan alasan
                            revisi</label>
                        <textarea id="description" rows="4" wire:model="notes"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-green-500 focus:border-green-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                            placeholder="Write product description here"></textarea>
                        @if ($this->error)
                            <p class="text-red-500 text-sm">Kolom alasan harus diisi</p>
                        @endif
                    </div>
                </div>
                <div class="sm:flex sm:flex-row-reverse">
                    <button type="button" <button wire:click="revision" type="button"
                        class="inline-flex w-full justify-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-800 sm:ml-3 sm:w-auto">
                        Simpan</button>
                    <div wire:key="{{ str()->random(50) }}" class="justify-end flex-initial ml-5 -mt-5" wire:loading
                        wire:target='revision'>
                        <x-loading />
                    </div>
                </div>
            </form>
        </div>
    </x-modal>
</div>
