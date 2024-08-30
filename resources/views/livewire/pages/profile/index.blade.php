<div>
    <div class="max-w-4xl px-4 sm:px-6 lg:px-8 mx-auto"><!-- Card -->
        {{-- supaya bisa dirender oleh tailwind --}}
        <div class="bg-red-200 text-red-500"></div>
        <div class="bg-blue-200 text-blue-500"></div>
        <div class="bg-yellow-200 text-yellow-500"></div>
        <div class="bg-green-200 text-green-500"></div>
        @if ($form->village_staff->dataStatus->key == 'draft' || $form->village_staff->dataStatus->key == 'revisi')
            <div wire:key="{{ str()->random(50) }}">
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
                                <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Konfirmasi
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">Anda yakin ingin data sudah benar ? Data akan
                                        terkunci selama proses pengajuan.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button wire:click="processFinal" type="button"
                            class="inline-flex w-full justify-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-500 sm:ml-3 sm:w-auto">Ya,
                            Ajukan sekarang</button>
                        <div wire:key="{{ str()->random(50) }}" class="justify-end flex-initial ml-5 -mt-5" wire:loading
                            wire:target='processFinal'>
                            @livewire('utils.loading')
                        </div>
                    </div>
                    {{-- </div> --}}
                </x-modal>
                <div
                    class="flex flex-col bg-white border shadow-sm rounded-xl mb-10 border-gradient animate-border-gradient dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                    <div class="p-4 md:p-7">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                            Penting!
                        </h3>
                        <p class="mt-2 text-gray-500 dark:text-neutral-400">
                            Status data Anda saat ini masih <b>{{ $form->village_staff->dataStatus->name }}</b>, segera
                            ajukan untuk difinalisasi oleh Pemdes.
                        </p>
                        @if ($form->village_staff->dataStatus->key == 'revisi')
                            <p>Catatan revisi: <span class="text-red-600">{{ $form->village_staff->reason_note }}</span>
                            </p>
                        @endif
                        <a class="mt-3 inline-flex cursor-pointer items-center gap-x-1 text-sm font-semibold rounded-lg border border-transparent text-blue-600 decoration-2 hover:text-blue-700 hover:underline focus:underline focus:outline-none focus:text-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-600 dark:focus:text-blue-600"
                            onclick="document.getElementById('modalConfirm')._x_dataStack[0].show = true">
                            Ajukan Finalisasi
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="m9 18 6-6-6-6"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        @endif
        <div class="bg-white rounded-sm shadow p-4 sm:p-7 relative overflow-hidden dark:bg-neutral-800">
            @php
                $color = $form->village_staff->colorDataStatus();
            @endphp
            <div
                class="absolute top-0 right-0 bg-{{ $color['color'] }}-200 text-{{ $color['color'] }}-500 text-lg font-semibold px-4 py-2 rounded-bl-md rounded-tr-md">
                {{ $color['label'] }}
            </div>
            <div class="flex">
                <div class="mb-8 flex-auto">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-neutral-200">
                        Form Profile
                    </h2>
                    <p class="text-sm text-gray-600 dark:text-neutral-400">
                        Manage your name, password and account settings.
                    </p>
                </div>
                <div>
                    {{-- {!! $form->village_staff->labelDataStatus() !!} --}}
                </div>
            </div>

            <form wire:submit="store" x-data="{
                isReadonly: @entangle('isReadonly'),
                setReadonly() {
                    $el.querySelectorAll('input, select, textarea').forEach(element => {
                        console.log('jumlah element:' + element);
                        element.setAttribute('readonly', true);
                        if (element.tagName === 'SELECT' || element.type === 'checkbox' || element.type === 'radio') {
                            element.setAttribute('disabled', true);
                        }
                    });
            
                }
            }" x-init="if (isReadonly) {
                setReadonly()
            };
            $watch('isReadonly', value => $refs.labelKtp.click())"
                x-on:re-init-alpine.window="setReadonly()">
                <!-- Grid -->
                <div class="grid sm:grid-cols-12 gap-2 sm:gap-6">
                    <div class="sm:col-span-3">
                        <label x-ref="labelKtp" @click="setReadonly()"
                            class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                            Scan KTP <strong x-text="isReadonly"></strong>
                        </label>
                    </div>
                    <!-- End Col -->

                    @php
                        $sourceImg = asset('images/ktp.png');
                        if ($form->tmpUrl) {
                            $sourceImg = $form->tmpUrl;
                        } else {
                            if (is_string($form->ktp)) {
                                $sourceImg = asset('storage/' . $form->ktp);
                            }
                        }
                    @endphp

                    <div class="sm:col-span-9">
                        <div class="flex items-center gap-5">
                            <x-modal id="exampleModal" maxWidth="lg" wire:model="modalPreview">
                                <div class="p-6">
                                    <img id="preview-modal"
                                        class="inline-block w-auto h-72 rounded ring-2 ring-white dark:ring-neutral-900"
                                        src="{{ $sourceImg }}" alt="Avatar">
                                </div>
                            </x-modal>
                            <img id="preview"
                                onclick="document.getElementById('exampleModal')._x_dataStack[0].show = true"
                                class="inline-block size-16 rounded ring-2 ring-white cursor-pointer dark:ring-neutral-900"
                                src="{{ $sourceImg }}" alt="Avatar">
                            <div class="flex gap-x-2">
                                <template x-if="!isReadonly">
                                    <div>
                                        <input x-ref="fileInput" type="file" wire:model="form.ktp" id="imageInput"
                                            style="display: none" accept="image/*">
                                        <div id="uploadBtn" @click="$refs.fileInput.click()"
                                            class="py-2 px-3 inline-flex items-center cursor-pointer gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                                <polyline points="17 8 12 3 7 8" />
                                                <line x1="12" x2="12" y1="3" y2="15" />
                                            </svg>
                                            Upload scan KTP
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                        @error('form.ktp')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-3">
                        <label for="af-account-full-name"
                            class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                            Full name
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
                        <label for="af-account-full-name"
                            class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                            Place, date of birth
                        </label>
                    </div>
                    <div class="sm:col-span-9">
                        <div class="mt-2 flex rounded-md shadow-sm">
                            <input type="text" wire:model="form.place_of_birth"
                                class="inline-flex w-2/3 min-w-0 bg-gray-50 rounded-l-md border-r-0 border-gray-300 p-2.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-1 focus:ring-inset focus:ring-green-500 focus:border-green-500 sm:text-sm "
                                placeholder="Ex. Ponorogo">
                            <input type="date" wire:model="form.date_of_birth"
                                class="block w-1/3 min-w-0 flex-1 bg-gray-50 rounded-none rounded-r-md border-0 p-2.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-1 focus:ring-inset focus:ring-green-500 focus:border-green-500 sm:text-sm "
                                placeholder="03-08-1986">

                        </div>
                        @error('form.place_of_birth')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror

                        @error('form.date_of_birth')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="sm:col-span-3">
                        <div class="inline-block">
                            <label for="af-account-phone"
                                class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                                Phone
                            </label>
                            <span class="text-sm text-gray-400 dark:text-neutral-600">
                                {{-- (Optional) --}}
                            </span>
                        </div>


                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">
                        <div class="sm:flex">
                            <input type="text" wire:model="form.phone"
                                class="pe-11 bg-gray-50 border-gray-300 shadow-sm -mt-px -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg text-sm relative focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                placeholder="Ex. +62 85736 8888 999">
                            <select
                                class="py-2 px-3 pe-9 sm:w-auto border-gray-200 shadow-sm -mt-px -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg text-sm relative focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
                                <option selected>Mobile</option>
                            </select>

                        </div>
                        @error('form.phone')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-3">
                        <label for="af-account-gender-checkbox"
                            class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                            Gender
                        </label>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">
                        <div class="sm:flex">
                            <label for="af-account-gender-checkbox"
                                class="flex py-2 px-3 w-full border border-gray-200 shadow-sm -mt-px -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg text-sm relative focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
                                <input type="radio" wire:model="form.gender" value="1"
                                    name="af-account-gender-checkbox"
                                    class="shrink-0 mt-0.5 border-gray-300 rounded-full text-green-600 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-500 dark:checked:bg-green-500 dark:checked:border-green-500 dark:focus:ring-offset-gray-800"
                                    id="af-account-gender-checkbox" checked>
                                <span class="text-sm text-gray-500 ms-3 dark:text-neutral-400">Male</span>
                            </label>

                            <label for="af-account-gender-checkbox-female"
                                class="flex py-2 px-3 w-full border border-gray-200 shadow-sm -mt-px -ms-px first:rounded-t-lg last:rounded-b-lg sm:first:rounded-s-lg sm:mt-0 sm:first:ms-0 sm:first:rounded-se-none sm:last:rounded-es-none sm:last:rounded-e-lg text-sm relative focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
                                <input type="radio" wire:model="form.gender" value="0"
                                    name="af-account-gender-checkbox"
                                    class="shrink-0 mt-0.5 border-gray-300 rounded-full text-green-600 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-500 dark:checked:bg-green-500 dark:checked:border-green-500 dark:focus:ring-offset-gray-800"
                                    id="af-account-gender-checkbox-female">
                                <span class="text-sm text-gray-500 ms-3 dark:text-neutral-400">Female</span>
                            </label>
                        </div>
                        @error('form.gender')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-3">
                        <label for="af-account-bio"
                            class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                            Address
                        </label>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">
                        <textarea type="text" wire:model="form.address"
                            class="py-2 px-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                            rows="6" placeholder="Type your address..."></textarea>
                        @error('form.address')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-3">
                        <label for="af-account-bio"
                            class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                            Position Type
                        </label>
                    </div>

                    <div class="sm:col-span-9">
                        <select id="positionTypes" wire:model="form.position_type"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
                            {{-- <option selected>Choose a position type</option> --}}
                            {{-- @foreach ($position_types as $item) --}}
                            <option value="{{ $position_type->id }}">{{ ucfirst($position_type->name) }}</option>
                            {{-- @endforeach --}}
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

                    @if (!in_array($position_type->id, $positions))
                        {{-- jika posisi sekretaris  --}}
                        <!-- End Col -->
                        <div>
                            <div class="sm:col-span-3">
                                <label for="af-account-bio"
                                    class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                                    Position Name
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
                        </div>
                    @endif
                    {{-- sk --}}
                    <div class="sm:col-span-3">
                        <label for="af-account-bio"
                            class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                            SK Number
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
                            SK TMT
                        </label>
                    </div>

                    <div class="sm:col-span-9">
                        <input id="af-account-bio" wire:model="form.sk_tmt" type="date"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                            placeholder=""></input>
                        @error('form.sk_tmt')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="sm:col-span-3">
                        <label for="af-account-bio"
                            class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                            SK Date
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
                </div>
                <!-- End Grid -->


                <template x-if="!isReadonly">
                    <div class="mt-5 flex justify-end gap-x-2">
                        <div wire:key="{{ str()->random(50) }}" class="justify-end flex-initial ml-5 -mt-5"
                            wire:loading wire:target='store'>
                            @livewire('utils.loading')
                        </div>
                        <button type="button"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                            Cancel
                        </button>
                        <button type="submit" wire:loading.attr="disabled" wire:target='store'
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 focus:outline-none focus:bg-green-700 disabled:opacity-50 disabled:pointer-events-none">
                            Save changes
                        </button>

                    </div>
                </template>
            </form>
        </div>
    </div>
</div>
