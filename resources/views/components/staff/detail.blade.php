<div>
    <div x-data="{ open: false }" @set-open-detail.window="open = $event.detail" x-show="open" @click.away="open = false"
        class="fixed inset-0 flex z-50 justify-end">
        <!-- Background overlay -->
        <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-black bg-opacity-50"></div>

        <!-- Drawer -->
        <div x-show="open" x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full" class="relative bg-white w-96 h-full shadow-xl">

            <div class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl">
                <div class="px-4 py-6 sm:px-6">
                    <div class="flex items-start justify-between">
                        <h2 id="slide-over-heading" class="text-base font-semibold leading-6 text-gray-900">Profile</h2>
                        <div class="ml-3 flex h-7 items-center">
                            <button type="button" @click="open = false"
                                class="relative rounded-md bg-white text-gray-400 hover:text-gray-500 focus:ring-2 focus:ring-indigo-500">
                                <span class="absolute -inset-2.5"></span>
                                <span class="sr-only">Close panel</span>
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Main -->
                <div>
                    <div class="pb-1 sm:pb-6">
                        <div>
                            @php
                                $sourceImg = asset('images/ktp.png');
                                if ($staff) {
                                    $sourceImg = $staff->ktp_scan ? asset('storage/' . $staff->ktp_scan) : $sourceImg;
                                }
                            @endphp
                            <x-modal id="exampleModal" maxWidth="lg" wire:model="modalPreview">
                                <div class="p-6">
                                    <img id="preview-modal"
                                        class="inline-block w-auto h-72 rounded ring-2 ring-white dark:ring-neutral-900"
                                        src="{{ $sourceImg }}" alt="Avatar">
                                </div>
                            </x-modal>
                            <div onclick="document.getElementById('exampleModal')._x_dataStack[0].show = true"
                                class="relative h-40 sm:h-56">
                                <img class="absolute h-full w-full object-cover" src="{{ $sourceImg }}"
                                    alt="">
                            </div>
                            <div class="mt-6 px-4 sm:mt-8 sm:flex sm:items-end sm:px-6">
                                <div class="sm:flex-1">
                                    <div>
                                        <div class="flex items-center">
                                            <h3 class="text-xl font-bold text-gray-900 sm:text-2xl">
                                                {{ $staff->name ?? '' }}</h3>
                                            <span
                                                class="ml-2.5 inline-block h-2 w-2 flex-shrink-0 rounded-full bg-green-400">
                                                <span class="sr-only">Online</span>
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-500">{{ $staff->position_name ?? '' }}</p>
                                    </div>
                                    <div class="mt-5 flex flex-wrap space-y-3 sm:space-x-3 sm:space-y-0">
                                        <button type="button"
                                            onclick="document.getElementById('modalConfirm')._x_dataStack[0].show = true"
                                            class="inline-flex w-full flex-shrink-0 items-center justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 sm:flex-1">Setujui</button>
                                        <button type="button"
                                            class="inline-flex w-full flex-1 items-center justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Minta
                                            Perbaikan</button>
                                        <div class="ml-3 inline-flex sm:ml-0">
                                            <div class="relative inline-block text-left">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 pb-5 pt-5 sm:px-0 sm:pt-0">
                        <dl class="space-y-8 px-4 sm:space-y-6 sm:px-6">
                            <div>
                                <dt class="text-sm font-medium text-gray-500 sm:w-40 sm:flex-shrink-0">Address</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">
                                    <p>{{ $staff->address ?? '' }}</p>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 sm:w-40 sm:flex-shrink-0">Place, Date of
                                    birth</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">{{ $staff->place_of_birth ?? '' }},
                                    {{ $staff->date_of_birth ?? '' }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 sm:w-40 sm:flex-shrink-0">Position Type
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">
                                    {{ $staff->positionType->name ?? '' }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 sm:w-40 sm:flex-shrink-0">Phone Number
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:col-span-2">
                                    {{ $staff->phone_number ?? '' }}</dd>
                            </div>
                        </dl>
                    </div>

                    <div class="p-5">
                        <h3 class="font-medium text-gray-900">SK Information</h3>
                        <dl class="mt-2 divide-y divide-gray-200 border-b border-t border-gray-200">

                            <div class="flex justify-between py-3 text-sm font-medium">
                                <dt class="text-gray-500">SK number</dt>
                                <dd class="text-gray-900">{{ $staff->sk_number ?? '' }}</dd>
                            </div>
                            <div class="flex justify-between py-3 text-sm font-medium">
                                <dt class="text-gray-500">SK TMT</dt>
                                <dd class="text-gray-900">{{ $staff->sk_tmt ?? '' }}</dd>
                            </div>
                            <div class="flex justify-between py-3 text-sm font-medium">
                                <dt class="text-gray-500">SK Date</dt>
                                <dd class="text-gray-900">{{ $staff->sk_date ?? '' }}</dd>
                            </div>

                            {{-- @if (key_option('bpd')) --}}

                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal confirm --}}
    <x-modal id="modalConfirm" maxWidth="md" wire:model="modalConfirm">
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
                    <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Konfirmasi</h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">Anda yakin ingin data sudah benar ? Data yang sudah
                            difinalisasi tidak dapat diedit kembali.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
            <button wire:click="processFinal" type="button" wire:loading.attr="disabled" wire:target='processFinal'
                class="inline-flex w-full justify-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 sm:ml-3 sm:w-auto">Ya,
                Finalisasi sekarang</button>
            <div class="justify-end flex-initial ml-5 -mt-5" wire:loading wire:target='processFinal'>
                @livewire('utils.loading')
            </div>
        </div>
        {{-- </div> --}}
    </x-modal>
</div>
