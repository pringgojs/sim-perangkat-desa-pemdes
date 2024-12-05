<div>
    <div class="w-full px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <!-- Card -->
        <div class="bg-gradient-to-bl from-blue-100 via-transparent rounded-md p-4 sm:p-7 dark:bg-neutral-900">
            <div class="grid grid-cols-2 gap-4">
                <div class=" text-white p-4 rounded">
                    <!-- Konten kolom pertama -->
                    <form wire:submit="store">
                        <!-- Section -->
                        <div
                            class="grid sm:grid-cols-12 gap-2 sm:gap-4 py-8 first:pt-0 last:pb-0 border-t first:border-transparent border-gray-200 dark:border-neutral-700 dark:first:border-transparent">
                            <div class="sm:col-span-12">
                                <h2 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">
                                    Form Riwayat Jabatan Perangkat Desa
                                </h2>
                                <p class="text-sm text-gray-600 dark:text-neutral-400">
                                    Lengkapi semua kolom dibawah ini.
                                </p>
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
                                    <select id="villagePositionTypes" wire:model="form.villagePositionType"
                                        @change="$wire.checkSiltap"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
                                        <option selected>Pilih jenis jabatan</option>
                                        @foreach ($villagePositionTypes as $item)
                                            <option value="{{ $item->id }}">{{ ucfirst($item->position_name) }} -
                                                {{ $item->code }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    @error('form.positionType')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="sm:col-span-3">
                                <label
                                    class="inline-block text-sm font-medium text-gray-500 mt-2.5 dark:text-neutral-500">
                                    Status Jabatan
                                </label>
                            </div>
                            <!-- End Col -->

                            <div class="sm:col-span-9">
                                <div class="sm:flex p-1 space-y-1">
                                    <select id="positionTypeStatus" wire:model="form.positionTypeStatus"
                                        class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
                                        <option selected>Pilih status jabatan</option>
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
                            </div>

                            <div class="sm:col-span-3">
                                <div class="inline-block">
                                    <label for="af-submit-application-phone"
                                        class="inline-block text-sm font-medium text-gray-500 mt-2.5 dark:text-neutral-500">
                                    </label>
                                </div>
                            </div>
                            <!-- End Col -->

                            {{-- @dd($form) --}}
                            <div class="sm:col-span-9">
                                <div class="flex items-center mb-4">
                                    <input id="default-checkbox" type="checkbox" wire:model="form.isParkir"
                                        value="1"
                                        class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="default-checkbox"
                                        class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Jabatan
                                        Parkir</label>

                                </div>
                            </div>
                            <div class="sm:col-span-3">
                                <label for="af-account-bio"
                                    class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                                    Nomor SK
                                </label>
                            </div>

                            <div class="sm:col-span-9">
                                <input id="af-account-bio" wire:model="form.skNumber"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                    placeholder="Ex. 182/XXX"></input>
                                @error('form.skNumber')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- <div class="sm:col-span-3">
                            <label for="af-account-bio"
                                class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                                TMT SK
                            </label>
                        </div>
    
                        <div class="sm:col-span-9">
                            <input id="af-account-bio" wire:model="form.skTmt" type="date"
                                wire:change="calculatePensiunDate"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                placeholder=""></input>
                            @error('form.skTmt')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div> --}}
                            <div class="sm:col-span-3">
                                <label for="input-date-sk"
                                    class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                                    Tanggal SK
                                </label>
                            </div>

                            <div class="sm:col-span-9">
                                {{-- @dd($form->skDate) --}}
                                <input id="input-date-sk" wire:model="form.skDate" type="date"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                    placeholder=""></input>
                                @error('form.skDate')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="sm:col-span-3">
                                <label for="af-account-bio-1"
                                    class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                                    Pejabatan Penanda-tangan SK
                                </label>
                            </div>

                            <div class="sm:col-span-9">
                                <input id="af-account-bio-1" wire:model="form.authorizedSignature"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                    placeholder=""></input>
                                @error('form.authorizedSignature')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="sm:col-span-3">
                                <label for="input-date-appointment"
                                    class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                                    Tanggal Pelantikan
                                </label>
                            </div>


                            <div class="sm:col-span-9">
                                <input id="input-date-appointment" wire:model="form.dateOfAppointment" type="date"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                    placeholder=""></input>
                            </div>


                            <div class="sm:col-span-3">
                                <label for="input-dateofoffice"
                                    class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                                    Tanggal Berakhir Masa Jabatan
                                </label>
                            </div>

                            <div class="sm:col-span-9">
                                <input id="input-endateofoffcie" wire:model="form.enddateOfOffice" type="date"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                    placeholder=""></input>
                                {{-- @error('form.enddateOfOffice')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror --}}
                            </div>

                            <!-- End Col -->
                            <div class="sm:col-span-3">
                                <div class="inline-block">
                                    <label for="af-submit-application-phone"
                                        class="inline-block text-sm font-medium text-gray-500 mt-2.5 dark:text-neutral-500">
                                        Tunjangan
                                    </label>
                                </div>
                            </div>
                            <!-- End Col -->

                            <div class="sm:col-span-9">
                                <div class="relative mt-2 rounded-md shadow-sm">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <span class="text-gray-500 sm:text-sm">Rp</span>
                                    </div>
                                    <input x-mask:dynamic="$money($input, '.')" wire:model="form.tunjangan"
                                        type="text"
                                        class="block w-full rounded-md border-0 py-2 pl-9 pr-12 text-gray-900 ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6"
                                        placeholder="" aria-describedby="price-currency">
                                </div>
                                <div>
                                    @error('form.tunjangan')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- End Col -->
                            <div class="sm:col-span-3">
                                <div class="inline-block">
                                    <label for="af-submit-application-phone"
                                        class="inline-block text-sm font-medium text-gray-500 mt-2.5 dark:text-neutral-500">
                                        Siltap
                                    </label>
                                </div>
                            </div>
                            <!-- End Col -->

                            <div class="sm:col-span-9">
                                <div class="relative mt-2 rounded-md shadow-sm">
                                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                        <span class="text-gray-500 sm:text-sm">Rp</span>
                                    </div>
                                    <input x-mask:dynamic="$money($input, '.')" wire:model="form.siltap"
                                        type="text"
                                        class="block w-full rounded-md border-0 py-2 pl-9 pr-12 text-gray-900 ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-green-600 sm:text-sm sm:leading-6"
                                        placeholder="" aria-describedby="price-currency">
                                </div>

                                <div>
                                    @error('form.siltap')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 flex justify-end gap-x-2">
                            <div wire:key="{{ str()->random(50) }}" class="justify-end flex-initial ml-5 -mt-5"
                                wire:loading wire:target='store'>
                                <x-loading />
                            </div>
                            <a href="{{ route('village-staff.edit', ['id' => $staff->id]) }}" wire:navigate
                                class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                                Batal
                            </a>
                            <button type="submit" wire:loading.attr="disabled" wire:target='store'
                                class="py-2 px-3 w-full items-center gap-x-2 text-center text-sm font-medium rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 focus:outline-none focus:bg-green-700 disabled:opacity-50 disabled:pointer-events-none">
                                {{ $id ? 'Simpan Perubahan' : 'Simpan' }}
                            </button>
                        </div>
                    </form>
                </div>

                @php
                    $title = 'Data Referensi Siltap & Tunjangan Desa ' . $staff->village->name;
                @endphp
                <div x-data="{ copied: '' }">
                    <x-table :headers="['Jabatan', 'Siltap', 'Tunjangan']" :title="$title">
                        <!-- Table Content -->
                        <x-slot:table>
                            @foreach ($this->siltapTable as $index => $item)
                                <tr x-data="{ siltap: '{{ $item->siltap }}', tunjangan: '{{ $item->tunjangan }}' }">
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">
                                        {{ $item->positionType->name }}</td>

                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                        <div class="flex items-center space-x-2">
                                            <span
                                                class="text-gray-700 font-medium">{{ format_rupiah($item->siltap) }}</span>
                                            <div x-clipboard="siltap" @click="copied = 'siltap-{{ $item->id }}'">
                                                <svg class="w-6 h-6"
                                                    :class="copied == 'siltap-{{ $item->id }}' ?
                                                        'text-green-500 dark:text-green-400' :
                                                        'text-gray-800 dark:text-white'"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" fill="none"
                                                    viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 8v3a1 1 0 0 1-1 1H5m11 4h2a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1h-7a1 1 0 0 0-1 1v1m4 3v10a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1v-7.13a1 1 0 0 1 .24-.65L7.7 8.35A1 1 0 0 1 8.46 8H13a1 1 0 0 1 1 1Z" />
                                                </svg>
                                            </div>

                                        </div>
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">
                                        <div class="flex items-center space-x-2">
                                            <span
                                                class="text-gray-700 font-medium">{{ format_rupiah($item->tunjangan) }}</span>
                                            <div x-clipboard="tunjangan"
                                                @click="copied = 'tunjangan-{{ $item->id }}'">
                                                <svg class="w-6 h-6"
                                                    :class="copied == 'tunjangan-{{ $item->id }}' ?
                                                        'text-green-500 dark:text-green-400' :
                                                        'text-gray-800 dark:text-white'"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" fill="none"
                                                    viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M9 8v3a1 1 0 0 1-1 1H5m11 4h2a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1h-7a1 1 0 0 0-1 1v1m4 3v10a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1v-7.13a1 1 0 0 1 .24-.65L7.7 8.35A1 1 0 0 1 8.46 8H13a1 1 0 0 1 1 1Z" />
                                                </svg>
                                            </div>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </x-slot:table>
                    </x-table>
                </div>
            </div>
        </div>
    </div>
</div>
