<div>
    <div class="w-full px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <!-- Card -->
        <div class="bg-white rounded-md shadow p-4 sm:p-7 dark:bg-neutral-900">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
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
                                        @change="$wire.viewPositionType"
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
                        </div>
                        <div class="mt-5 flex justify-end gap-x-2">
                            <div wire:key="{{ str()->random(50) }}" class="justify-end flex-initial ml-5 -mt-5"
                                wire:loading wire:target='store'>
                                <x-loading />
                            </div>
                            <a href="{{ route('village-staff.edit', ['id' => $staffId]) }}" wire:navigate
                                class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                                Batal
                            </a>
                            <button type="submit" wire:loading.attr="disabled" wire:target='store'
                                class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 focus:outline-none focus:bg-green-700 disabled:opacity-50 disabled:pointer-events-none">
                                {{ $id ? 'Simpan Perubahan' : 'Simpan' }}
                            </button>
                        </div>
                    </form>
                </div>
                <div class="bg-gray-100 text-white p-4 rounded">
                    <!-- Konten kolom kedua -->
                    <!-- List -->
                    @if ($villagePositionType)
                        <div class="space-y-3">
                            <h2 class="text-sm font-medium text-gray-900">Detil Jabatan</h2>
                            <dl class="flex flex-col sm:flex-row gap-1">
                                <dt class="min-w-40">
                                    <span class="block text-sm text-gray-500 dark:text-neutral-500">Jenis
                                        Jabatan:</span>
                                </dt>
                                <dd>
                                    <ul>
                                        <li
                                            class="me-1 inline-flex items-center text-sm text-gray-800 dark:text-neutral-200">

                                            {{ $villagePositionType->position_name }}
                                        </li>
                                    </ul>
                                </dd>
                            </dl>

                            <dl class="flex flex-col sm:flex-row gap-1">
                                <dt class="min-w-40">
                                    <span class="block text-sm text-gray-500 dark:text-neutral-500">Kode Jabatan:</span>
                                </dt>
                                <dd>
                                    <ul>
                                        <li
                                            class="me-1 inline-flex items-center text-sm text-gray-800 dark:text-neutral-200">
                                            {{ $villagePositionType->code }}
                                        </li>
                                    </ul>
                                </dd>
                            </dl>
                            <dl class="flex flex-col sm:flex-row gap-1">
                                <dt class="min-w-40">
                                    <span class="block text-sm text-gray-500 dark:text-neutral-500">Status
                                        Jabatan:</span>
                                </dt>
                                <dd>
                                    <ul>
                                        <li
                                            class="me-1 inline-flex items-center text-sm text-gray-800 dark:text-neutral-200">
                                            {{ $villagePositionType->positionTypeStatus->name }}
                                        </li>
                                    </ul>
                                </dd>
                            </dl>


                            <dl class="flex flex-col sm:flex-row gap-1">
                                <dt class="min-w-40">
                                    <span class="block text-sm text-gray-500 dark:text-neutral-500">Siltap:</span>
                                </dt>
                                <dd>
                                    <ul>
                                        <li
                                            class="me-1 inline-flex items-center text-sm text-gray-800 dark:text-neutral-200">
                                            {{ format_rupiah($villagePositionType->siltap) }}
                                        </li>
                                    </ul>
                                </dd>
                            </dl>
                            <dl class="flex flex-col sm:flex-row gap-1">
                                <dt class="min-w-40">
                                    <span class="block text-sm text-gray-500 dark:text-neutral-500">Tunjangan:</span>
                                </dt>
                                <dd>
                                    <ul>
                                        <li
                                            class="me-1 inline-flex items-center text-sm text-gray-800 dark:text-neutral-200">
                                            {{ format_rupiah($villagePositionType->tunjangan) }}

                                        </li>
                                    </ul>
                                </dd>
                            </dl>
                            <dl class="flex flex-col sm:flex-row gap-1">
                                <dt class="min-w-40">
                                    <span class="block text-sm text-gray-500 dark:text-neutral-500">Status
                                        Parkir:</span>
                                </dt>
                                <dd>
                                    <ul>
                                        <li
                                            class="me-1 inline-flex items-center text-sm text-gray-800 dark:text-neutral-200">
                                            {{ $villagePositionType->is_parkir ? 'Ya' : 'Tidak' }}
                                        </li>
                                    </ul>
                                </dd>
                            </dl>
                        </div>
                    @endif
                    <!-- End List -->
                </div>
            </div>


        </div>
    </div>
</div>
