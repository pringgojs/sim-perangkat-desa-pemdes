<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div class="relative z-50 bg-white rounded-lg shadow dark:bg-gray-700 ">
        <!-- Modal header -->
        <div class="flex items-center justify-between p-4 rounded-t md:p-5 dark:border-gray-600">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                {{ $id ? 'Perbaruhi  Perangkat Desa' : 'Tambah Perangkat Desa' }}
            </h3>
            <button type="button" wire:click="$dispatch('closeModal')"
                class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-hide="static-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>
        <!-- Modal body -->
        <div class="p-4 space-y-4 md:p-5">
            <form x-data="" wire:submit="store" class="space-y-4 md:space-y-6" autocomplete="off">
                <div>
                    <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Nama</label>
                    <input type="text" wire:model="form.name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                        placeholder="Pringgo D. Red">
                    <div>
                        @error('form.name')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Username
                    </label>
                    <input type="text" wire:model="form.username" x-mask="aaaaaaaaaaaaaaaa"
                        placeholder="Contoh: pringgojs" autocomplete="off"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
                    <div>
                        @error('form.username')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Email (Optional)
                    </label>
                    <input type="email" wire:model="form.email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                        placeholder="Contoh: pringgojs@gmail.com">
                    <div>
                        @error('form.email')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                @if (auth()->user()->hasRole('administrator'))

                    <div>
                        <label for="districts"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kecamatan</label>
                        <select id="districts" wire:model="form.district" wire:change="getVillages"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
                            <option selected>Pilih kecamatan</option>
                            @foreach ($districts as $item)
                                <option value="{{ $item->id }}">{{ ucfirst($item->name) }}</option>
                            @endforeach
                        </select>
                        <div>
                            @error('form.district')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="villages"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Desa</label>
                        <select id="villages" wire:model="form.village" wire:change="getVillagePositionType"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
                            <option selected>Pilih desa</option>
                            @foreach ($villages as $item)
                                <option value="{{ $item->id }}">{{ ucfirst($item->name) }}</option>
                            @endforeach
                        </select>
                        <div>
                            @error('form.village')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                @endif

                <div>
                    <label for="positionTypes"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jabatan</label>
                    <select id="villagePositionTypes" wire:model="form.village_position_type"
                        wire:change="getPositionNow"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500">
                        <option selected>Pilih jenis jabatan</option>
                        @foreach ($village_position_types as $item)
                            <option value="{{ $item->id }}">{{ ucfirst($item->position_name) }} -
                                {{ $item->code }} ({{ $item->positionTypeStatus->name }})</option>
                        @endforeach
                    </select>
                    <div>
                        @error('form.village_position_type')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                @if ($positionNow)
                    <div>
                        <div class="flex p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                            role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                <span class="font-medium">Informasi:</span>
                                <ul class="mt-1.5 list-disc list-inside">
                                    <li>Jabatan yang dipilih sudah diisi oleh {{ $positionNow->villageStaff->name }}
                                    </li>
                                    <li>Apabila jabatan yang dipilih sudah diisi oleh perangkat dengan
                                        status aktif, maka perangkat tersebut akan dinon-aktifkan dari
                                        jabatan yang dipilih.</li>
                                    <li>Apabila jabatan yang dipilih merupakan jabatan definitif, maka akan
                                        mengganti status jabatan definitif saat ini dari
                                        {{ $positionNow->villageStaff->name }}.</li>
                                    <li>Apabila jabatan yang dipilih merupakan jabatan Plt/Plh/Pj, maka akan
                                        mengganti status jabatan Plt/Plh/Pj saat ini dari
                                        {{ $positionNow->villageStaff->name }}.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- generate password --}}
                <div>
                    <label for="generate-password"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                    <div x-data="{
                        cpanelpassword: $wire.entangle('form.password').live,
                        copied: false,
                        disabledCopyButton: true
                    }">
                        <label for="hs-trailing-multiple-add-on" class="sr-only"></label>
                        <div class="flex rounded-lg shadow-sm">
                            <input type="text" wire:model='form.password' x-model="cpanelpassword"
                                id="hs-trailing-multiple-add-on" name="inline-add-on"
                                class="py-3 px-4 block w-full border-gray-200 rounded-lg rounded-e-none text-sm focus:z-10 focus:border-green-500 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                placeholder="">
                            <div wire:click="$set('form.password', '{{ $this->generatePassword }}')"
                                @click="copied=false"
                                class="px-4 cursor-pointer inline-flex items-center min-w-fit border border-s-0 border-gray-200 bg-gray-50 hover:bg-gray-200 dark:bg-neutral-700 dark:border-neutral-600">
                                {{-- <span class="text-sm text-gray-500 dark:text-neutral-400"> --}}
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                                {{-- </span> --}}
                            </div>
                            <div x-clipboard="cpanelpassword" @click="copied=true"
                                :disabled="cpanelpassword == '' ? disabledCopyButton = true : disabledCopyButton = false"
                                class="px-4 cursor-pointer inline-flex items-center min-w-fit rounded-e-md border border-s-0 border-gray-200 bg-gray-50 hover:bg-gray-200  dark:bg-neutral-700 dark:border-neutral-600">
                                {{-- <span class="text-sm text-gray-500 dark:text-neutral-400"> --}}
                                <svg class="w-6 h-6"
                                    :class="copied ? 'text-green-500 dark:text-green-400' :
                                        'text-gray-800 dark:text-white'"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linejoin="round" stroke-width="2"
                                        d="M9 8v3a1 1 0 0 1-1 1H5m11 4h2a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1h-7a1 1 0 0 0-1 1v1m4 3v10a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1v-7.13a1 1 0 0 1 .24-.65L7.7 8.35A1 1 0 0 1 8.46 8H13a1 1 0 0 1 1 1Z" />
                                </svg>
                                {{-- </span> --}}
                            </div>
                        </div>
                    </div>
                </div>


                <div class="flex">
                    <button type="submit" wire:loading.attr="disabled" wire:target='store'
                        wire:loading.class.remove="bg-green-600"
                        class="flex-initial w-full text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                        Submit
                    </button>
                    <div class="justify-end flex-initial ml-5 -mt-5" wire:loading wire:target='store'>
                        @livewire('utils.loading')
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
