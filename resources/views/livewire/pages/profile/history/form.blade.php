<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <x-modal id="formModalHistory" maxWidth="2xl" wire:model="formModalHistory">
        {{-- <div
            class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg"> --}}

        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
            <div class="flex">
                <div class="mb-8 flex-auto">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-neutral-200">
                        Form Identitas Pribadi
                    </h2>
                    <p class="text-sm text-gray-600 dark:text-neutral-400">
                        Lengkapi semua kolom dibawah ini dengan data yang sesungguhnya.
                    </p>
                </div>
                <div>
                    {{-- {!! $form->village_staff->labelDataStatus() !!} --}}
                </div>
            </div>
            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">

                <form wire:submit="store">

                    <!-- Grid -->
                    <div class="grid sm:grid-cols-12 gap-2 sm:gap-6">
                        <div class="sm:col-span-3">
                            <label for="af-account-full-name"
                                class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                                Nama lengkap <span x-text="isReadonly"></span>
                            </label>
                        </div>
                        <!-- End Col -->
                        <div class="sm:col-span-9">
                            <div class="sm:flex">
                                <input wire:model="form.name" type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                    placeholder="Ex. Maria">
                            </div>
                            @error('form.name')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="sm:col-span-3">
                            <label for="af-account-bio"
                                class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                                Jenis jabatan
                            </label>
                        </div>

                        <div class="sm:col-span-9">
                            <select id="positionTypes" wire:model="form.position_type"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
                                {{-- <option selected>Choose a position type</option> --}}
                                @foreach ($positions as $item)
                                    <option value="{{ $item->id }}">{{ ucfirst($item->name) }}</option>
                                @endforeach
                            </select>
                        </div>

                        @php
                            $positions = [
                                key_option('sekretaris_desa'),
                                key_option('kepala_desa'),
                                key_option('kepala_wilayah'),
                                key_option('bpd'),
                            ];
                        @endphp

                        {{-- @if (!in_array($position_type->id, $positions)) --}}
                        {{-- jika posisi sekretaris  --}}
                        <div class="sm:col-span-3">
                            <label for="af-account-bio"
                                class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                                Nama jabatan lengkap
                            </label>
                        </div>

                        <div class="sm:col-span-9">
                            <input id="af-account-bio" wire:model="form.position_name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                placeholder="Ex. Kaur Pemerintahan"></input>
                            @error('form.position_name')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        {{-- @endif --}}
                        {{-- sk --}}
                        <div class="sm:col-span-3">
                            <label for="af-account-bio"
                                class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                                Nomor SK
                            </label>
                        </div>

                        <div class="sm:col-span-9">
                            <input id="af-account-bio" wire:model="form.sk_number"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                placeholder="Ex. 182/XXX"></input>
                            @error('form.sk_number')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="sm:col-span-3">
                            <label for="af-account-bio"
                                class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                                TMT SK
                            </label>
                        </div>

                        <div class="sm:col-span-9">
                            <input id="af-account-bio" wire:model="form.sk_tmt" type="date"
                                wire:change="calculatePensiunDate"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                placeholder=""></input>
                            @error('form.sk_tmt')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="sm:col-span-3">
                            <label for="af-account-bio"
                                class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                                Tanggal SK
                            </label>
                        </div>

                        <div class="sm:col-span-9">
                            <input id="af-account-bio" wire:model="form.sk_date" type="date"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                placeholder=""></input>
                            @error('form.sk_date')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="sm:col-span-3">
                            <label for="af-account-bio"
                                class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                                Tanggal Pensiun
                            </label>
                        </div>

                        <div class="sm:col-span-9">
                            <input readonly id="af-account-bio" wire:model="form.pensiun" type="date"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                placeholder=""></input>
                            <span class="text-green-500">*Untuk BPD dan Kades tanggal pensiun diambil dari
                                perhitungan SK TMT,
                                sedangkan jenis perangkat yang lain dari tanggal lahir</span>
                        </div>
                    </div>
                    <!-- End Grid -->

                    {{-- <div class="mt-5 flex justify-end gap-x-2">
                                <div wire:key="{{ str()->random(50) }}" class="justify-end flex-initial ml-5 -mt-5"
                                    wire:loading wire:target='store'>
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
                            </div> --}}
                </form>
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
</div>
