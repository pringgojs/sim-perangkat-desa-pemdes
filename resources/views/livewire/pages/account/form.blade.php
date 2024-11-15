<div>

    <div x-cloak class="bg-white  p-4 relative overflow-hidden dark:bg-neutral-800">
        <div class="flex">
            <div class="mb-8 flex-auto">
                <h2 class="text-xl font-bold text-gray-800 dark:text-neutral-200">
                    Informasi Akun
                </h2>
                <p class="text-sm text-gray-600 dark:text-neutral-400">
                    Reset password apabila ada kendala login
                </p>
            </div>
        </div>

        <form wire:submit="store" x-data="{
            password: $wire.entangle('password').live,
            username: $wire.entangle('username'),
            copied: '',
            disabledCopyButton: true
        }">

            <div class="flex mb-5">
                <div>Username</div>
                <div class="font-bold ml-2">{{ $staff->user->username }}</div>
                <div x-clipboard="username" class="cursor-pointer" @click="copied = 'username'">
                    <svg class="w-6 h-6"
                        :class="copied == 'username' ? 'text-green-500 dark:text-green-400' : 'text-gray-800 dark:text-white'"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linejoin="round" stroke-width="2"
                            d="M9 8v3a1 1 0 0 1-1 1H5m11 4h2a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1h-7a1 1 0 0 0-1 1v1m4 3v10a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1v-7.13a1 1 0 0 1 .24-.65L7.7 8.35A1 1 0 0 1 8.46 8H13a1 1 0 0 1 1 1Z" />
                    </svg>
                </div>
            </div>
            <div>
                <label for="hs-trailing-multiple-add-on" class="sr-only"></label>
                <div class="flex rounded-lg shadow-sm">
                    <input type="text" wire:model='password' x-model="password" id="hs-trailing-multiple-add-on"
                        name="inline-add-on"
                        class="py-3 px-4 block w-full border-gray-200 rounded-lg rounded-e-none text-sm focus:z-10 focus:border-green-500 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                        placeholder="Tulis password baru...">
                    <div wire:click="$set('password', '{{ $this->generatePassword }}')" @click="copied=''"
                        class="px-4 cursor-pointer inline-flex items-center min-w-fit border border-s-0 border-gray-200 bg-gray-50 hover:bg-gray-200 dark:bg-neutral-700 dark:border-neutral-600">
                        {{-- <span class="text-sm text-gray-500 dark:text-neutral-400"> --}}
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        {{-- </span> --}}
                    </div>
                    <div x-clipboard="password" @click="copied='password'"
                        :disabled="password == '' ? disabledCopyButton = true : disabledCopyButton = false"
                        class="px-4 cursor-pointer inline-flex items-center min-w-fit rounded-e-md border border-s-0 border-gray-200 bg-gray-50 hover:bg-gray-200  dark:bg-neutral-700 dark:border-neutral-600">
                        {{-- <span class="text-sm text-gray-500 dark:text-neutral-400"> --}}
                        <svg class="w-6 h-6"
                            :class="copied == 'password' ? 'text-green-500 dark:text-green-400' :
                                'text-gray-800 dark:text-white'"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linejoin="round" stroke-width="2"
                                d="M9 8v3a1 1 0 0 1-1 1H5m11 4h2a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1h-7a1 1 0 0 0-1 1v1m4 3v10a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1v-7.13a1 1 0 0 1 .24-.65L7.7 8.35A1 1 0 0 1 8.46 8H13a1 1 0 0 1 1 1Z" />
                        </svg>
                        {{-- </span> --}}
                    </div>
                </div>
            </div>

            <div class="mt-5 flex justify-end gap-x-2">
                <div wire:key="{{ str()->random(50) }}" class="justify-end flex-initial ml-5 -mt-5" wire:loading
                    wire:target='store'>
                    <x-loading />
                </div>
                <button type="submit" wire:loading.attr="disabled" wire:target='store'
                    class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-green-600 text-white hover:bg-green-700 focus:outline-none focus:bg-green-700 disabled:opacity-50 disabled:pointer-events-none">
                    Ubah Password
                </button>
            </div>
        </form>
    </div>
</div>
