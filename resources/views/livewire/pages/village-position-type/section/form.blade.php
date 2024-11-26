<div>
    <div class="max-w-4xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <!-- Card -->
        <div class="bg-white rounded-md shadow p-4 sm:p-7 dark:bg-neutral-900">
            <form wire:submit="store">
                <!-- Section -->
                <div
                    class="grid sm:grid-cols-12 gap-2 sm:gap-4 py-8 first:pt-0 last:pb-0 border-t first:border-transparent border-gray-200 dark:border-neutral-700 dark:first:border-transparent">
                    <div class="sm:col-span-12">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">
                            Form Jabatan Desa
                        </h2>
                        <p class="text-sm text-gray-600 dark:text-neutral-400">
                            Manage your name, password and account settings.
                        </p>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-3">
                        <label for="af-submit-application-full-name"
                            class="inline-block text-sm font-medium text-gray-500 mt-2.5 dark:text-neutral-500">
                            Kecamatan
                        </label>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">
                        <div class="sm:flex">
                            <div class="p-1 space-y-1">
                                <div class="max-w-sm" @on-item-selected="$wire.getVillage($event.detail)">
                                    <livewire:utils.select-search wire:model="form.district" callback="on-item-selected"
                                        value="{{ $form->district }}" :options="$districts" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-3">
                        <label for="af-submit-application-email"
                            class="inline-block text-sm font-medium text-gray-500 mt-2.5 dark:text-neutral-500">
                            Desa
                        </label>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">
                        <div class="sm:flex p-1 space-y-1 ">
                            <select id="villages" wire:model="form.village"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
                                <option selected>Choose a village</option>
                                @foreach ($villages as $item)
                                    <option value="{{ $item->id }}">{{ ucfirst($item->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            @error('form.village')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-3">
                        <label for="af-submit-application-email"
                            class="inline-block text-sm font-medium text-gray-500 mt-2.5 dark:text-neutral-500">
                            Jenis Jabatan
                        </label>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">
                        <div class="sm:flex p-1 space-y-1 ">
                            <select id="positionTypes" wire:model="form.positionType" @change="$wire.getSiltap"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
                                <option selected>Choose a position type</option>
                                @foreach ($positionTypes as $item)
                                    <option value="{{ $item->id }}">{{ ucfirst($item->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            @error('form.positionType')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- <div class="sm:col-span-3">
                        <label class="inline-block text-sm font-medium text-gray-500 mt-2.5 dark:text-neutral-500">
                            Status Jabatan
                        </label>
                    </div> --}}
                    <!-- End Col -->

                    {{-- <div class="sm:col-span-9">
                        <div class="sm:flex p-1 space-y-1">
                            <select id="positionTypeStatus" wire:model="form.positionTypeStatus"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
                                <option selected>Choose a position type status</option>
                                @foreach ($positionTypeStatus as $item)
                                    <option value="{{ $item->id }}">{{ ucfirst($item->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            @error('form.positionTypeStatus')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> --}}
                    <!-- End Col -->
                    <div class="sm:col-span-3">
                        <div class="inline-block">
                            <label for="af-submit-application-phone"
                                class="inline-block text-sm font-medium text-gray-500 mt-2.5 dark:text-neutral-500">
                                Nama Jabatan
                            </label>
                        </div>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">
                        <input wire:model="form.positionName" type="text"
                            class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:border-green-500 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                        <div>
                            @error('form.positionName')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="sm:col-span-3">
                        <div class="inline-block">
                            <label for="af-submit-application-phone"
                                class="inline-block text-sm font-medium text-gray-500 mt-2.5 dark:text-neutral-500">
                                Kode Jabatan
                            </label>
                        </div>
                    </div>
                    <div class="sm:col-span-9">
                        <input wire:model="form.code" type="text"
                            class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:border-green-500 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                        <div>
                            @error('form.code')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- <div class="sm:col-span-3">
                        <div class="inline-block">
                            <label for="af-submit-application-phone"
                                class="inline-block text-sm font-medium text-gray-500 mt-2.5 dark:text-neutral-500">
                            </label>
                        </div>
                    </div> --}}
                    <!-- End Col -->

                    {{-- <div class="sm:col-span-9">
                        <div class="flex items-center mb-4">
                            <input id="default-checkbox" type="checkbox" wire:model="form.isParkir" value="1"
                                class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="default-checkbox"
                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Jabatan Parkir</label>

                        </div>
                    </div> --}}

                    <!-- End Col -->
                    {{-- <div class="sm:col-span-3">
                        <div class="inline-block">
                            <label for="af-submit-application-phone"
                                class="inline-block text-sm font-medium text-gray-500 mt-2.5 dark:text-neutral-500">
                                Tunjangan
                            </label>
                        </div>
                    </div> --}}
                    <!-- End Col -->

                    {{-- <div class="sm:col-span-9">
                        <div class="relative mt-2 rounded-md shadow-sm">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <span class="text-gray-500 sm:text-sm">Rp</span>
                            </div>
                            <input readonly x-mask:dynamic="$money($input, '.')" wire:model="form.tunjangan"
                                type="text"
                                class="block w-full rounded-md border-0 py-2 pl-9 pr-12 text-gray-900 ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6"
                                placeholder="" aria-describedby="price-currency">
                        </div>
                        <div>
                            @error('form.tunjangan')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> --}}
                    <!-- End Col -->
                    {{-- <div class="sm:col-span-3">
                        <div class="inline-block">
                            <label for="af-submit-application-phone"
                                class="inline-block text-sm font-medium text-gray-500 mt-2.5 dark:text-neutral-500">
                                Siltap
                            </label>
                        </div>
                    </div> --}}
                    <!-- End Col -->

                    {{-- <div class="sm:col-span-9">
                        <div class="relative mt-2 rounded-md shadow-sm">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <span class="text-gray-500 sm:text-sm">Rp</span>
                            </div>
                            <input readonly x-mask:dynamic="$money($input, '.')" wire:model="form.siltap"
                                type="text"
                                class="block w-full rounded-md border-0 py-2 pl-9 pr-12 text-gray-900 ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6"
                                placeholder="" aria-describedby="price-currency">
                        </div>

                        <div>
                            @error('form.siltap')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> --}}
                </div>
                <div class="mt-5 flex justify-end gap-x-2">
                    <div wire:key="{{ str()->random(50) }}" class="justify-end flex-initial ml-5 -mt-5" wire:loading
                        wire:target='store'>
                        <x-loading />
                    </div>
                    <button type="button"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                        Batal
                    </button>
                    <button type="submit" wire:loading.attr="disabled" wire:target='store'
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 focus:outline-none focus:bg-green-700 disabled:opacity-50 disabled:pointer-events-none">
                        Simpan perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
