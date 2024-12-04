<div>
    {{-- In work, do what you enjoy. --}}
    <div x-data="filter()">
        <div class="flex flex-wrap items-center space-x-1 mb-2">
            <div class="relative flex items-center space-x-1">
                <div class="hs-dropdown relative inline-flex [--auto-close:inside]">
                    <button id="hs-dropdown-with-title" type="button"
                        class="hs-dropdown-toggle py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-md border border-gray-300 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                        aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                        Filter
                        <svg class="hs-dropdown-open:rotate-180 size-4" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                    </button>

                    <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 divide-y divide-gray-200 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700"
                        role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-with-title">
                        @if ($useArea)
                            <div class="p-1 space-y-0.5">
                                <span
                                    class="block pt-2 pb-1 px-3 text-xs font-medium uppercase text-gray-400 dark:text-neutral-500">
                                    Wilayah
                                </span>
                                <div
                                    class="hs-dropdown [--strategy:static] md:[--strategy:absolute] [--adaptive:none] [--auto-close:inside] [--is-collapse:true] md:[--is-collapse:false] relative">
                                    <div @click="area='district';" id="hs-header-base-dropdown-sub"
                                        class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                        :class="area == 'district' ? 'bg-green-100' : ''" href="#">
                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                                        </svg>

                                        Kecamatan
                                    </div>
                                    <div class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] md:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 relative md:w-48 hidden z-10 md:mt-2 md:!mx-[10px] md:top-0 md:start-full ps-7 md:ps-0 md:bg-white md:rounded-lg md:shadow-md dark:bg-neutral-800 dark:divide-neutral-700 before:hidden md:before:block before:absolute before:-end-5 before:top-0 before:h-full before:w-5 md:after:hidden after:absolute after:top-1 after:start-[18px] after:w-0.5 after:h-[calc(100%-0.25rem)] after:bg-gray-100 dark:md:bg-neutral-800 dark:after:bg-neutral-700"
                                        role="menu" aria-orientation="vertical"
                                        aria-labelledby="hs-header-base-dropdown-sub">
                                        <div class="p-1 space-y-1">
                                            <div class="max-w-sm">
                                                <div class="relative">
                                                    <input type="text" x-model="searchDistrict"
                                                        class="peer py-2 px-3 ps-11 block w-full bg-gray-100 border-transparent rounded-lg text-sm focus:border-green-500 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                                        placeholder="Cari...">
                                                    <div
                                                        class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                                                        <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="size-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="overflow-y-scroll max-h-48 space-y-0.5 ">
                                                <template x-for="item in filteredDistricts">
                                                    <a @click="addSelectedDistrict(item);doFilter()"
                                                        class="p-2 md:px-3 capitalize flex items-center text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 dark:focus:text-neutral-300"
                                                        :class="checkInSelectedDistrict(item.id) ? 'bg-green-100' : ''"
                                                        href="#" x-text="item.name">
                                                    </a>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="hs-dropdown [--strategy:static] md:[--strategy:absolute] [--adaptive:none] [--auto-close:inside] [--is-collapse:true] md:[--is-collapse:false] relative">

                                    <div @click="area='village';" id="hs-header-base-dropdown-sub-village"
                                        class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                        :class="area == 'village' ? 'bg-green-100' : ''" href="#">
                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d=" M5.25 7.5A2.25 2.25 0 0 1 7.5 5.25h9a2.25 2.25 0 0 1 2.25 2.25v9a2.25 2.25 0 0
                                                    1-2.25 2.25h-9a2.25 2.25 0 0 1-2.25-2.25v-9Z" />
                                        </svg>

                                        Desa
                                    </div>
                                    <div class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] md:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 relative md:w-48 hidden z-10 md:mt-2 md:!mx-[10px] md:top-0 md:start-full ps-7 md:ps-0 md:bg-white md:rounded-lg md:shadow-md dark:bg-neutral-800 dark:divide-neutral-700 before:hidden md:before:block before:absolute before:-end-5 before:top-0 before:h-full before:w-5 md:after:hidden after:absolute after:top-1 after:start-[18px] after:w-0.5 after:h-[calc(100%-0.25rem)] after:bg-gray-100 dark:md:bg-neutral-800 dark:after:bg-neutral-700"
                                        role="menu" aria-orientation="vertical"
                                        aria-labelledby="hs-header-base-dropdown-sub-village">
                                        <div class="p-1 space-y-1">
                                            <div class="max-w-sm">
                                                <div class="relative">
                                                    <input type="text" x-model="searchVillage"
                                                        class="peer py-2 px-3 ps-11 block w-full bg-gray-100 border-transparent rounded-lg text-sm focus:border-green-500 focus:ring-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                                                        placeholder="Cari...">
                                                    <div
                                                        class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                                                        <svg class="shrink-0 size-4 text-gray-500 dark:text-neutral-500"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="size-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="overflow-y-scroll max-h-48 space-y-0.5 ">
                                                <template x-for="item in filteredVillages">
                                                    <div>
                                                        <a @click="addSelectedVillage(item);doFilter()"
                                                            class="p-2 md:px-3 capitalize flex items-center text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 dark:focus:text-neutral-300"
                                                            :class="checkInSelectedVillage(item.id) ? 'bg-green-100' : ''"
                                                            href="#" x-html="item.name +'<br>'+ item.code">
                                                        </a>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($usePositionType)
                            <div class="p-1 space-y-0.5">
                                <span
                                    class="block pt-2 pb-1 px-3 text-xs font-medium uppercase text-gray-400 dark:text-neutral-500">
                                    Jabatan
                                </span>
                                <div class="overflow-y-scroll max-h-32 space-y-0.5 ">
                                    <template x-for="item in positionTypes">
                                        <a @click="positionType == item.id ? positionType = '' : positionType=item.id;setPositionTypeName(item.name);doFilter()"
                                            class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                            :class="positionType == item.id ? 'bg-green-100' : ''" href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="shrink-0 size-4"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M14.25 6.087c0-.355.186-.676.401-.959.221-.29.349-.634.349-1.003 0-1.036-1.007-1.875-2.25-1.875s-2.25.84-2.25 1.875c0 .369.128.713.349 1.003.215.283.401.604.401.959v0a.64.64 0 0 1-.657.643 48.39 48.39 0 0 1-4.163-.3c.186 1.613.293 3.25.315 4.907a.656.656 0 0 1-.658.663v0c-.355 0-.676-.186-.959-.401a1.647 1.647 0 0 0-1.003-.349c-1.036 0-1.875 1.007-1.875 2.25s.84 2.25 1.875 2.25c.369 0 .713-.128 1.003-.349.283-.215.604-.401.959-.401v0c.31 0 .555.26.532.57a48.039 48.039 0 0 1-.642 5.056c1.518.19 3.058.309 4.616.354a.64.64 0 0 0 .657-.643v0c0-.355-.186-.676-.401-.959a1.647 1.647 0 0 1-.349-1.003c0-1.035 1.008-1.875 2.25-1.875 1.243 0 2.25.84 2.25 1.875 0 .369-.128.713-.349 1.003-.215.283-.4.604-.4.959v0c0 .333.277.599.61.58a48.1 48.1 0 0 0 5.427-.63 48.05 48.05 0 0 0 .582-4.717.532.532 0 0 0-.533-.57v0c-.355 0-.676.186-.959.401-.29.221-.634.349-1.003.349-1.035 0-1.875-1.007-1.875-2.25s.84-2.25 1.875-2.25c.37 0 .713.128 1.003.349.283.215.604.401.96.401v0a.656.656 0 0 0 .658-.663 48.422 48.422 0 0 0-.37-5.36c-1.886.342-3.81.574-5.766.689a.578.578 0 0 1-.61-.58v0Z">
                                                </path>
                                            </svg>
                                            <span x-text="item.name"></span>
                                        </a>
                                    </template>
                                </div>
                            </div>
                        @endif

                        @if ($usePositionStatus)
                            <div class="p-1 space-y-0.5">
                                <span
                                    class="block pt-2 pb-1 px-3 text-xs font-medium uppercase text-gray-400 dark:text-neutral-500">
                                    Status Jabatan
                                </span>
                                <div class="overflow-y-scroll max-h-32 space-y-0.5 ">
                                    <template x-for="item in positionTypeStatus">
                                        <a @click="positionStatus == item.id ? positionStatus = '' : positionStatus=item.id;setPositionStatusName(item.name);doFilter()"
                                            class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                            :class="positionStatus == item.id ? 'bg-green-100' : ''" href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="shrink-0 size-4"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M14.25 6.087c0-.355.186-.676.401-.959.221-.29.349-.634.349-1.003 0-1.036-1.007-1.875-2.25-1.875s-2.25.84-2.25 1.875c0 .369.128.713.349 1.003.215.283.401.604.401.959v0a.64.64 0 0 1-.657.643 48.39 48.39 0 0 1-4.163-.3c.186 1.613.293 3.25.315 4.907a.656.656 0 0 1-.658.663v0c-.355 0-.676-.186-.959-.401a1.647 1.647 0 0 0-1.003-.349c-1.036 0-1.875 1.007-1.875 2.25s.84 2.25 1.875 2.25c.369 0 .713-.128 1.003-.349.283-.215.604-.401.959-.401v0c.31 0 .555.26.532.57a48.039 48.039 0 0 1-.642 5.056c1.518.19 3.058.309 4.616.354a.64.64 0 0 0 .657-.643v0c0-.355-.186-.676-.401-.959a1.647 1.647 0 0 1-.349-1.003c0-1.035 1.008-1.875 2.25-1.875 1.243 0 2.25.84 2.25 1.875 0 .369-.128.713-.349 1.003-.215.283-.4.604-.4.959v0c0 .333.277.599.61.58a48.1 48.1 0 0 0 5.427-.63 48.05 48.05 0 0 0 .582-4.717.532.532 0 0 0-.533-.57v0c-.355 0-.676.186-.959.401-.29.221-.634.349-1.003.349-1.035 0-1.875-1.007-1.875-2.25s.84-2.25 1.875-2.25c.37 0 .713.128 1.003.349.283.215.604.401.96.401v0a.656.656 0 0 0 .658-.663 48.422 48.422 0 0 0-.37-5.36c-1.886.342-3.81.574-5.766.689a.578.578 0 0 1-.61-.58v0Z">
                                                </path>
                                            </svg>
                                            <span x-text="item.name"></span>
                                        </a>
                                    </template>
                                </div>
                            </div>
                        @endif

                        @if ($useStatusData)
                            <div class="p-1 space-y-0.5">
                                <span
                                    class="block pt-2 pb-1 px-3 text-xs font-medium uppercase text-gray-400 dark:text-neutral-500">
                                    Status Data
                                </span>
                                <div class="overflow-y-scroll max-h-32 space-y-0.5 ">
                                    <template x-for="item in listStatusData">
                                        <a @click="statusData == item.id ? statusData = '' : statusData=item.id;setStatusDataName(item.name);doFilter()"
                                            class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                            :class="statusData == item.id ? 'bg-green-100' : ''" href="#">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="shrink-0 size-4"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M14.25 6.087c0-.355.186-.676.401-.959.221-.29.349-.634.349-1.003 0-1.036-1.007-1.875-2.25-1.875s-2.25.84-2.25 1.875c0 .369.128.713.349 1.003.215.283.401.604.401.959v0a.64.64 0 0 1-.657.643 48.39 48.39 0 0 1-4.163-.3c.186 1.613.293 3.25.315 4.907a.656.656 0 0 1-.658.663v0c-.355 0-.676-.186-.959-.401a1.647 1.647 0 0 0-1.003-.349c-1.036 0-1.875 1.007-1.875 2.25s.84 2.25 1.875 2.25c.369 0 .713-.128 1.003-.349.283-.215.604-.401.959-.401v0c.31 0 .555.26.532.57a48.039 48.039 0 0 1-.642 5.056c1.518.19 3.058.309 4.616.354a.64.64 0 0 0 .657-.643v0c0-.355-.186-.676-.401-.959a1.647 1.647 0 0 1-.349-1.003c0-1.035 1.008-1.875 2.25-1.875 1.243 0 2.25.84 2.25 1.875 0 .369-.128.713-.349 1.003-.215.283-.4.604-.4.959v0c0 .333.277.599.61.58a48.1 48.1 0 0 0 5.427-.63 48.05 48.05 0 0 0 .582-4.717.532.532 0 0 0-.533-.57v0c-.355 0-.676.186-.959.401-.29.221-.634.349-1.003.349-1.035 0-1.875-1.007-1.875-2.25s.84-2.25 1.875-2.25c.37 0 .713.128 1.003.349.283.215.604.401.96.401v0a.656.656 0 0 0 .658-.663 48.422 48.422 0 0 0-.37-5.36c-1.886.342-3.81.574-5.766.689a.578.578 0 0 1-.61-.58v0Z">
                                                </path>
                                            </svg>
                                            <span x-text="item.name"></span>
                                        </a>
                                    </template>
                                </div>
                            </div>
                        @endif

                        @if ($usePositionParkir || $useNullPerson)
                            <div class="p-1 space-y-0.5">
                                <span
                                    class="block pt-2 pb-1 px-3 text-xs font-medium uppercase text-gray-400 dark:text-neutral-500">
                                    Lainnya
                                </span>
                                @if ($usePositionParkir)
                                    <a @click="isParkir = !isParkir;doFilter()"
                                        class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                        :class="isParkir ? 'bg-green-100' : ''" href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="shrink-0 size-4"
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 0 1-1.125-1.125v-3.75ZM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-8.25ZM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-2.25Z" />
                                        </svg>
                                        Jabatan parkir
                                    </a>
                                @endif
                                @if ($useNullPerson)
                                    <a @click="isNullPerson = !isNullPerson;doFilter()"
                                        class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                        :class="isNullPerson ? 'bg-green-100' : ''" href="#">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="shrink-0 size-4"
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 0 1-1.125-1.125v-3.75ZM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-8.25ZM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-2.25Z" />
                                        </svg>
                                        Jabatan kosong
                                    </a>
                                @endif
                            </div>
                        @endif

                        @if ($useDate)
                            <div class="p-1 space-y-0.5">
                                <span
                                    class="block pt-2 pb-1 px-3 text-xs font-medium uppercase text-gray-400 dark:text-neutral-500">
                                    Tanggal
                                </span>
                                @if ($useDateToday)
                                    <a @click="dateType == 'today' ? dateType = '' : dateType='today';doFilter()"
                                        class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                        :class="dateType == 'today' ? 'bg-green-100' : ''" href="#">
                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                        </svg>

                                        Hari ini
                                    </a>
                                @endif
                                @if ($useDateThisMonth)
                                    <a @click="dateType == 'this-month' ? dateType = '' : dateType='this-month';doFilter()"
                                        class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                        :class="dateType == 'this-month' ? 'bg-green-100' : ''" href="#">
                                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                        </svg>

                                        Bulan ini
                                    </a>
                                @endif
                                @if ($useDateOtherMonth)
                                    {{-- bulan tertentu --}}
                                    <div x-data="{ showOptionMonth: false }">
                                        <a x-ref="btnOtherMonth" @click="showOptionMonth=!showOptionMonth;"
                                            class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                            :class="dateType == 'other-month' ? 'bg-green-100' : ''" href="#">
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                            </svg>
                                            Bulan Tertentu
                                        </a>
                                        {{-- select bulan --}}
                                        <div x-show='showOptionMonth' x-anchor.right-end="$refs.btnOtherMonth" x-cloak
                                            x-transition @click.away="showOptionMonth= !showOptionMonth"
                                            class="inline-flex z-10 w-48 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                            role="menu" aria-orientation="vertical" aria-labelledby="menu-button"
                                            tabindex="-1">
                                            <div class="py-1 capitalize" role="none">
                                                <div class="block p-4 text-sm text-gray-700" role="menuitem"
                                                    tabindex="-1" id="menu-item-1">
                                                    <x-label for=""
                                                        class="text-xs font-medium text-gray-700 dark:text-gray-200">
                                                        bulan
                                                    </x-label>
                                                    <select name='month' x-model="month"
                                                        class="bg-gray-50 border px-4 capitalize border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                                        required>
                                                        <option value="" selected disabled>pilih bulan</option>
                                                        @foreach (months() as $month)
                                                            <option value="{{ $month['value'] }}">{{ $month['name'] }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <x-label for=""
                                                        class="mt-4 text-xs text-gray-700 dark:text-gray-200">
                                                        tahun
                                                    </x-label>
                                                    <x-input x-mask="9999" x-model="year" type="text"
                                                        class="w-full py-2.5" name='year' placeholder="Tahun"
                                                        required />
                                                    <x-button class="w-full mt-3 text-sm"
                                                        @click="dateType == 'other-month' ? dateType = '' : dateType='other-month';doFilter()"><span
                                                            class="mx-auto">Simpan</span></x-button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if ($useDateRange)
                                    {{-- date range --}}
                                    <div x-data="{ showOptionDaterange: false }">
                                        <a x-ref="btnDateRange"
                                            @click="dateType == 'date-range' ? dateType = '' : dateType='date-range';showOptionDaterange=!showOptionDaterange;"
                                            class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                            :class="dateType == 'date-range' ? 'bg-green-100' : ''" href="#">
                                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                            </svg>
                                            Range tanggal
                                        </a>
                                        {{-- date range --}}
                                        <div x-show='showOptionDaterange' x-anchor.right-start="$refs.btnDateRange"
                                            x-cloak x-transition
                                            @click.away="showOptionDaterange= !showOptionDaterange"
                                            class="inline-flex z-10 w-48 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                            role="menu" aria-orientation="vertical" aria-labelledby="menu-button"
                                            tabindex="-1">
                                            <div class="py-1 capitalize" date-rangepicker role="none">
                                                <div class="block p-4 text-sm text-gray-700" role="menuitem"
                                                    tabindex="-1" id="menu-item-1">
                                                    <x-label for=""
                                                        class="text-xs mb-2 font-medium text-gray-700 dark:text-gray-200">
                                                        Tanggal awalnya
                                                    </x-label>
                                                    <x-input class="w-full py-2 focus:border-green-500"
                                                        x-model="dateStart" id="datepicker-range-start"
                                                        name="start" type="date" />
                                                    <x-label for=""
                                                        class="mt-4 text-xs mb-2 text-gray-700 dark:text-gray-200">
                                                        Tanggal akhir
                                                    </x-label>
                                                    <x-input class="w-full py-2 focus:border-green-500"
                                                        x-model="dateEnd" id="datepicker-range-end" name="end"
                                                        type="date" />

                                                    <x-button class="w-full mt-3 text-sm" @click="doFilter()"><span
                                                            class="mx-auto">Simpan</span></x-button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
                <div class="relative flex items-center space-x-1">
                    <div class="flex items-center">
                        <label for="simple-search" class="sr-only">Search</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <x-bi-search class="w-4 h-4 text-gray-500 dark:text-gray-400" />
                            </div>
                            <input type="text" x-model="search" id="simple-search" @change="doFilter()"
                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded focus:ring-green-500 focus:border-green-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
                                placeholder="Cari ... " required>
                        </div>
                    </div>
                </div>

                <div class="relative flex items-center space-x-1">
                    <div wire:loading class="-mt-6">
                        @livewire('utils.loading', key(\Illuminate\Support\Str::random(10)))
                    </div>
                </div>
                <div class="flex-grow"></div>
                <div class="flex flex-wrap items-center content-center space-x-1">
                    {{-- <button type="button" class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Button text</button> --}}
                    <div class="relative flex items-center">
                        {{-- @can('transaksi.pengeluaran.barang.export transaction') --}}
                        <button wire:click="$dispatchTo('{{ $table }}','export')"
                            class="flex
                            items-center rounded-md bg-white py-2.5 px-4 text-sm font-semibold text-gray-900 shadow-sm
                            ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                            <x-bytesize-download class="h-5 w-5 mr-2" />
                            Unduh
                        </button>
                        {{-- @endcan --}}
                        {{-- @can('transaksi.pengeluaran.barang.export transaction detail') --}}
                        {{-- <button wire:click="exportDetail"
                            class="flex items-center rounded-md ml-1 bg-white  py-2.5 px-4 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                            <x-bytesize-download class="h-5 w-5 mr-2" />
                            Detail Transaksi
                        </button> --}}
                        {{-- @endcan --}}
                    </div>
                </div>
                <div class="relative flex items-center space-x-1">
                    <button class="hidden" x-ref="btnFilter"
                        wire:click="$dispatchTo('{{ $table }}','filter', {area, search, positionType, selectedDistrict, selectedVillage, positionStatus, isParkir, isNullPerson, statusData, dateType, search, month, year, dateStart, dateEnd})"></button>
                    {{-- @click="$wire.filter(area, search, positionType, selectedDistrict, selectedVillage, positionStatus, isParkir, isNullPerson, statusData)"></button> --}}
                </div>
            </div>
        </div>
        <div class="flex mb-5">
            {{-- Filter: --}}
            <template x-if="positionTypeName">
                <span
                    class="inline-flex items-center gap-x-1.5 py-1.5 ps-3 pe-2 mr-1 rounded-md text-xs font-medium bg-green-100 text-green-800 dark:bg-green-800/30 dark:text-green-500">
                    <p x-html="positionTypeName"></p>
                    <button type="button" @click="positionType = '';setPositionTypeName(positionTypeName);doFilter()"
                        class="shrink-0 size-4 inline-flex items-center justify-center rounded-md hover:bg-green-200 focus:outline-none focus:bg-green-200 focus:text-green-500 dark:hover:bg-green-900">
                        <span class="sr-only">Remove badge</span>
                        <x-ionicon-close-outline class="shrink-0 size-3" />
                    </button>
                </span>
            </template>
            <template x-if="positionStatusName">
                <span
                    class="inline-flex items-center gap-x-1.5 py-1.5 ps-3 pe-2 mr-1 rounded-md text-xs font-medium bg-green-100 text-green-800 dark:bg-green-800/30 dark:text-green-500">
                    <p x-html="positionStatusName"></p>
                    <button type="button"
                        @click="positionStatus = '';setPositionStatusName(positionStatus);doFilter()"
                        class="shrink-0 size-4 inline-flex items-center justify-center rounded-md hover:bg-green-200 focus:outline-none focus:bg-green-200 focus:text-green-500 dark:hover:bg-green-900">
                        <span class="sr-only">Remove badge</span>
                        <x-ionicon-close-outline class="shrink-0 size-3" />
                    </button>
                </span>
            </template>


            <template x-if="statusDataName">
                <span
                    class="inline-flex items-center gap-x-1.5 py-1.5 ps-3 pe-2 mr-1 rounded-md text-xs font-medium bg-green-100 text-green-800 dark:bg-green-800/30 dark:text-green-500">
                    <p x-html="statusDataName"></p>
                    <button type="button" @click="statusData = '';setStatusDataName(statusData);doFilter()"
                        class="shrink-0 size-4 inline-flex items-center justify-center rounded-md hover:bg-green-200 focus:outline-none focus:bg-green-200 focus:text-green-500 dark:hover:bg-green-900">
                        <span class="sr-only">Remove badge</span>
                        <x-ionicon-close-outline class="shrink-0 size-3" />
                    </button>
                </span>
            </template>

            <template x-if="isParkir">
                <span
                    class="inline-flex items-center gap-x-1.5 py-1.5 ps-3 pe-2 mr-1 rounded-md text-xs font-medium bg-green-100 text-green-800 dark:bg-green-800/30 dark:text-green-500">
                    Jabatan parkir Ya
                    <button @click="isParkir = !isParkir;doFilter()" type="button"
                        class="shrink-0 size-4 inline-flex items-center justify-center rounded-md hover:bg-green-200 focus:outline-none focus:bg-green-200 focus:text-green-500 dark:hover:bg-green-900">
                        <span class="sr-only">Remove badge</span>
                        <x-ionicon-close-outline class="shrink-0 size-3" />
                    </button>
                </span>
            </template>

            <template x-if="isNullPerson">
                <span
                    class="inline-flex items-center gap-x-1.5 py-1.5 ps-3 pe-2 mr-1 rounded-md text-xs font-medium bg-green-100 text-green-800 dark:bg-green-800/30 dark:text-green-500">
                    Jabatan kosong Ya
                    <button @click="isNullPerson = !isNullPerson;doFilter()" type="button"
                        class="shrink-0 size-4 inline-flex items-center justify-center rounded-md hover:bg-green-200 focus:outline-none focus:bg-green-200 focus:text-green-500 dark:hover:bg-green-900">
                        <span class="sr-only">Remove badge</span>
                        <x-ionicon-close-outline class="shrink-0 size-3" />
                    </button>
                </span>
            </template>


            <template x-if="dateType">
                <span
                    class="inline-flex items-center gap-x-1.5 py-1.5 ps-3 pe-2 mr-1 rounded-md text-xs font-medium bg-green-100 text-green-800 dark:bg-green-800/30 dark:text-green-500">
                    Tanggal: <div
                        x-html="dateType =='today' ? 'hari ini': dateType == 'this-month' ? 'bulan ini' : dateType == 'other-month' ? '' : ''">
                    </div>
                    <div
                        x-html="dateType == 'other-month' ? month +'/'+ year : dateType == 'date-range' ? dateStart +' - '+ dateEnd : ''">
                    </div>
                    <button @click="dateType = '';doFilter()" type="button"
                        class="shrink-0 size-4 inline-flex items-center justify-center rounded-md hover:bg-green-200 focus:outline-none focus:bg-green-200 focus:text-green-500 dark:hover:bg-green-900">
                        <span class="sr-only">Remove badge</span>
                        <x-ionicon-close-outline class="shrink-0 size-3" />
                    </button>
                </span>
            </template>

            {{-- <x-bi-dot v-show="selectedDistrictName.length > 0" class="size-8 shrink-0" /> --}}

            {{-- <template x-show="selectedDistrictName"> --}}
            <template x-for="dst in selectedDistrictName">
                <span
                    class="inline-flex items-center gap-x-1.5 py-1.5 ps-3 pe-2 mr-1 rounded-md text-xs font-medium bg-green-100 text-green-800 dark:bg-green-800/30 dark:text-green-500">
                    <p x-html="dst.name"></p>
                    <button type="button" @click="addSelectedDistrict(dst);doFilter()"
                        class="shrink-0 size-4 inline-flex items-center justify-center rounded-md hover:bg-green-200 focus:outline-none focus:bg-green-200 focus:text-green-500 dark:hover:bg-green-900">
                        <span class="sr-only">Remove badge</span>
                        <x-ionicon-close-outline class="shrink-0 size-3" />
                    </button>
                </span>
            </template>
            {{-- </template> --}}
            {{-- <x-bi-dot v-show="selectedVillageName.length > 0" class="size-8 shrink-0" /> --}}

            <template x-for="vlg in selectedVillageName">
                <span
                    class="inline-flex items-center gap-x-1.5 py-1.5 ps-3 pe-2 mr-1 rounded-md text-xs font-medium bg-green-100 text-green-800 dark:bg-green-800/30 dark:text-green-500">
                    <p x-html="vlg.name"></p>
                    <button type="button" @click="addSelectedVillage(vlg);doFilter()"
                        class="shrink-0 size-4 inline-flex items-center justify-center rounded-md hover:bg-green-200 focus:outline-none focus:bg-green-200 focus:text-green-500 dark:hover:bg-green-900">
                        <span class="sr-only">Remove badge</span>
                        <x-ionicon-close-outline class="shrink-0 size-3" />
                    </button>
                </span>
            </template>
        </div>
        {{-- <span x-html="JSON.stringify(selectedDistrictName)"></span> --}}

        <script>
            function filter() {
                return {
                    area: '',
                    statusData: @entangle('statusData'),
                    statusDataName: @entangle('statusDataName'),
                    positionType: @entangle('positionType'),
                    positionTypeName: @entangle('positionTypeName'),
                    positionStatus: '',
                    positionStatusName: '',
                    isParkir: false,
                    isNullPerson: false,
                    search: '',
                    villages: @js($villages),
                    districts: @js($districts),
                    positionTypes: @js($positionTypes),
                    positionTypeStatus: @js($positionTypeStatus),
                    listStatusData: @js($listStatusData),
                    searchDistrict: '',
                    searchVillage: '',
                    selectedDistrict: [],
                    selectedDistrictName: [],
                    selectedVillage: [],
                    selectedVillageName: [],
                    /* date */
                    dateType: '',
                    showSelectMonth: false,
                    month: '',
                    year: '',
                    dateStart: '',
                    dateEnd: '',
                    init() {
                        // Livewire.hook('morph.updating', () => this.loading = true);
                        // Livewire.hook('morph.updated', () => this.loading = false);
                    },
                    get filteredDistricts() {
                        if (this.searchDistrict === "") {
                            return this.districts; // Jika input kosong, tampilkan semua data
                        }

                        let filtered = this.districts.filter((item) =>
                            item.name
                            .toLowerCase()
                            .includes(this.searchDistrict.toLowerCase())
                        );

                        return filtered;
                    },
                    addSelectedDistrict(district) {
                        /* hapus data village */
                        this.selectedVillage = [];

                        let index = this.selectedDistrict.findIndex(item =>
                            item == district.id
                        );

                        if (index !== -1) {
                            this.selectedDistrict.splice(index, 1);
                            this.selectedDistrictName.splice(index, 1);
                        } else {
                            this.selectedDistrict.push(district.id)
                            this.selectedDistrictName.push(district)
                        }
                        console.log(this.selectedDistrict);
                    },
                    checkInSelectedDistrict(value) {
                        let index = this.selectedDistrict.findIndex(item =>
                            item == value
                        );

                        if (index !== -1) {
                            return true;
                        }

                        return false;
                    },


                    get filteredVillages() {
                        if (this.searchVillage === "") {
                            return this.villages; // Jika input kosong, tampilkan semua data
                        }

                        let filtered = this.villages.filter((item) =>
                            item.name
                            .toLowerCase()
                            .includes(this.searchVillage.toLowerCase())
                        );

                        return filtered;
                    },

                    addSelectedVillage(village) {
                        /* hapus data district */
                        this.selectedDistrict = [];

                        let index = this.selectedVillage.findIndex(item =>
                            item == village.id
                        );

                        if (index !== -1) {
                            this.selectedVillage.splice(index, 1);
                            this.selectedVillageName.splice(index, 1);
                        } else {
                            this.selectedVillage.push(village.id)
                            this.selectedVillageName.push(village)
                        }
                        console.log('index', this.selectedVillage)
                    },
                    checkInSelectedVillage(value) {
                        let index = this.selectedVillage.findIndex(item =>
                            item == value
                        );

                        if (index !== -1) {
                            return true;
                        }

                        return false;
                    },
                    doFilter() {
                        // return;
                        console.log('do filter');
                        this.$refs.btnFilter.click();
                    },
                    setPositionTypeName(value) {
                        this.positionTypeName = this.positionType ? value : null;
                    },
                    setPositionStatusName(value) {
                        this.positionStatusName = this.positionStatus ? value : null;
                    },
                    setStatusDataName(value) {
                        this.statusDataName = this.statusData ? value : null;
                    },


                };
            }
        </script>

        @script
            <script>
                window.HSStaticMethods.autoInit();
                initFlowbite()
            </script>
        @endscript
    </div>
</div>
