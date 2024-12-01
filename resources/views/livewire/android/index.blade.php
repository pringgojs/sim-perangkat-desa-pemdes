<div>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <div class="items-center justify-center  z-10  rounded-3xl bg-white shadow-lg ring-1 ring-gray-900/5">
        <div class="p-0">
            @php
                $iconClass = 'class="size-6 text-gray-600 group-hover:text-green-600"';
                $items = [
                    [
                        'label' => 'Foto KTP',
                        'value' => 'Sudah unggah',
                        'icon' =>
                            '<svg ' .
                            $iconClass .
                            ' xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                            </svg>
                            ',
                    ],
                    [
                        'label' => 'NIK',
                        'value' => '1978986877237879',
                        'icon' =>
                            '<svg 
                            ' .
                            $iconClass .
                            '
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.242 5.992h12m-12 6.003H20.24m-12 5.999h12M4.117 7.495v-3.75H2.99m1.125 3.75H2.99m1.125 0H5.24m-1.92 2.577a1.125 1.125 0 1 1 1.591 1.59l-1.83 1.83h2.16M2.99 15.745h1.125a1.125 1.125 0 0 1 0 2.25H3.74m0-.002h.375a1.125 1.125 0 0 1 0 2.25H2.99" />
                            </svg>',
                    ],

                    [
                        'label' => 'Jenis Kelamin',
                        'value' => 'Laki-laki',
                        'icon' =>
                            '<svg ' .
                            $iconClass .
                            ' xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 0 0-3.7-3.7 48.678 48.678 0 0 0-7.324 0 4.006 4.006 0 0 0-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 0 0 3.7 3.7 48.656 48.656 0 0 0 7.324 0 4.006 4.006 0 0 0 3.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3-3 3" />
                                </svg>
                                ',
                    ],
                    [
                        'label' => 'Tanggal Lahir',
                        'value' => '17 Juni 1997',
                        'icon' =>
                            '<svg ' .
                            $iconClass .
                            ' xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                            </svg>
                            ',
                    ],
                    [
                        'label' => 'Tempat Lahir',
                        'value' => 'Pringgo',
                        'icon' =>
                            '<svg ' .
                            $iconClass .
                            ' xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m.503 3.498 4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 0 0-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0Z" />
                            </svg>
                            ',
                    ],
                    [
                        'label' => 'Alamat',
                        'value' => 'RT. 02/03 Dukuh Pendung, Desa Janti Slahung Po.',
                        'icon' =>
                            '
                        <svg ' .
                            $iconClass .
                            ' xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                        ',
                    ],
                    [
                        'label' => 'No. HP',
                        'value' => '085676678876',
                        'icon' =>
                            '<svg ' .
                            $iconClass .
                            ' xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                            </svg>
                            ',
                    ],
                ];
            @endphp
            {{-- header --}}
            <span class="block pt-2 pb-1 px-3 text-2xl font-bold text-green-600 dark:text-neutral-500">
                PamongApp
            </span>
            <div class="p-4">

                <div class="md:flex md:items-center md:justify-between md:space-x-5">
                    <div class="flex items-start space-x-5 border-solid border-b-2 border-b-gray-200 pb-5">
                        <div class="shrink-0">
                            <div class="relative">
                                <img class="size-16 rounded-full"
                                    src="https://images.unsplash.com/photo-1463453091185-61582044d556?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=1024&h=1024&q=80"
                                    alt="">
                                <span class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></span>
                            </div>
                        </div>
                        <!--
                        Use vertical padding to simulate center alignment when both lines of text are one line,
                        but preserve the same layout if the text wraps without making the image jump around.
                      -->
                        <div class="pt-1.5">
                            <h1 class="text-2xl font-bold text-gray-900">Pringgo Juni Saputro</h1>
                            <p class="text-sm font-medium text-gray-500">Kepala Desa Janti</p>
                            <p class="text-sm font-medium text-gray-500">Kepala Seksi Keuangan</p>
                        </div>
                    </div>
                </div>
            </div>

            <span class="block pt-2 pb-1 px-3 text-sm font-medium uppercase text-gray-400 dark:text-neutral-500">
                Data diri
            </span>
            {{-- end  --}}
            @foreach ($items as $item)
                <div class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm/6 hover:bg-gray-50">
                    <div class="flex size-11 flex-none items-center justify-center rounded-lg  ">
                        {!! $item['icon'] !!}
                    </div>
                    <div class="flex-auto">
                        <a href="#" class="block font-semibold text-gray-900">
                            {{ $item['label'] }}
                            <span class="absolute inset-0"></span>
                        </a>
                        <p class="mt-1 text-gray-600">{{ $item['value'] }}</p>
                    </div>
                </div>
            @endforeach

            {{-- account --}}
            <span class="block pt-2 pb-1 px-3 text-sm font-medium uppercase text-gray-400 dark:text-neutral-500">
                Akun
            </span>
            @php
                $iconClass = 'class="size-6 text-gray-600 group-hover:text-green-600"';
                $items = [
                    [
                        'label' => 'Username',
                        'value' => 'pringgojs',
                        'icon' =>
                            '<svg ' .
                            $iconClass .
                            ' xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" />
                            </svg>
                            ',
                    ],
                    [
                        'label' => 'Reset Password',
                        'value' => 'Ubah password Anda secara berkala',
                        'icon' =>
                            '<svg ' .
                            $iconClass .
                            ' xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            ',
                    ],

                    [
                        'label' => 'Keluar',
                        'value' => 'Keluar dari aplikasi',
                        'icon' =>
                            '<svg ' .
                            $iconClass .
                            ' xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
  <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
</svg>
',
                    ],
                ];
            @endphp
            @foreach ($items as $item)
                <div class="group relative flex items-center gap-x-6 rounded-lg p-4 text-sm/6 hover:bg-gray-50">
                    <div class="flex size-11 flex-none items-center justify-center rounded-lg  ">
                        {!! $item['icon'] !!}
                    </div>
                    <div class="flex-auto">
                        <a href="#" class="block font-semibold text-gray-900">
                            {{ $item['label'] }}
                            <span class="absolute inset-0"></span>
                        </a>
                        <p class="mt-1 text-gray-600">{{ $item['value'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
