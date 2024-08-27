<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    {{-- <div class="p-6 max-w-lg mx-auto bg-white rounded-lg shadow-lg relative overflow-hidden">
        <!-- Badge di Pojok Kanan Atas -->
        <div
            class="absolute top-0 right-0 bg-gray-300 text-gray-700 text-xs font-semibold px-4 py-2 rounded-bl-md rounded-tr-md">
            Badge
        </div>

        <!-- Title dan Deskripsi -->
        <div class="flex justify-between items-start">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Profile</h2>
                <p class="mt-2 text-gray-600">Deskripsi profile singkat ditampilkan di sini.</p>
            </div>
        </div>

        <!-- Content Page -->
        <div class="mt-8">
            <p class="text-gray-700">
                Konten halaman Anda akan ditampilkan di sini. Anda dapat menambahkan teks, gambar, atau elemen lain yang
                diperlukan.
            </p>
        </div>
    </div> --}}



    <div class="max-w-4xl px-4 sm:px-6 lg:px-8 mx-auto"><!-- Card -->
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

            <form wire:submit="store">
                <!-- Grid -->
                <div class="grid sm:grid-cols-12 gap-2 sm:gap-6">
                    <div class="sm:col-span-3">
                        <label class="inline-block text-sm text-gray-800 mt-2.5 dark:text-neutral-200">
                            Scan KTP
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
                            <x-modal id="exampleModal" maxWidth="lg" wire:model="isOpen">
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
                                <div>
                                    <input type="file" wire:model="form.ktp" id="imageInput" style="display: none"
                                        accept="image/*">
                                    <div id="uploadBtn"
                                        class="py-2 px-3 inline-flex items-center cursor-pointer gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                            <polyline points="17 8 12 3 7 8" />
                                            <line x1="12" x2="12" y1="3" y2="15" />
                                        </svg>
                                        Upload scan KTP
                                    </div>
                                </div>
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
                            Address {{ $form->address }}
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

                <div class="mt-5 flex justify-end gap-x-2">
                    <div class="justify-end flex-initial ml-5 -mt-5" wire:loading wire:target='store'>
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
            </form>
        </div>
        <!-- End Card -->
    </div>
    <!-- End Card Section -->
    <script>
        const uploadBtn = document.getElementById('uploadBtn');
        const imageInput = document.getElementById('imageInput');
        const preview = document.getElementById('preview');
        const previewModal = document.getElementById('preview-modal');

        uploadBtn.addEventListener('click', function() {
            imageInput.click();
        });

        imageInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';

                    previewModal.src = e.target.result;
                    previewModal.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.style.display = 'none';

                previewModal.src = '';
                previewModal.style.display = 'none';
            }
        });
    </script>
</div>
