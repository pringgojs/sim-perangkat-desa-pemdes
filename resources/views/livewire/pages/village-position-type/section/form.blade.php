<div>
    <div class="max-w-4xl px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <!-- Card -->
        <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-neutral-900">
            <form>
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
                                <div class="max-w-sm">
                                    <livewire:utils.select-search wire:model="form.district" />
                                </div>
                                {{-- <div class="overflow-y-scroll max-h-48 space-y-0.5 relative ">
                                    <template x-for="item in filteredDistricts">
                                        <a @click="addSelectedDistrict(item);doFilter()"
                                            class="p-2 md:px-3 capitalize flex items-center text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 dark:focus:text-neutral-300"
                                            :class="checkInSelectedDistrict(item.id) ? 'bg-green-100' : ''"
                                            href="#" x-text="item.name">
                                        </a>
                                    </template>
                                </div> --}}
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
                        <input id="af-submit-application-email" type="email"
                            class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-3">
                        <div class="inline-block">
                            <label for="af-submit-application-phone"
                                class="inline-block text-sm font-medium text-gray-500 mt-2.5 dark:text-neutral-500">
                                Phone
                            </label>
                        </div>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">
                        <input id="af-submit-application-phone" type="text"
                            class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">

                        <p class="mt-3">
                            <a class="inline-flex items-center gap-x-1 text-sm text-blue-600 decoration-2 hover:underline focus:outline-none focus:underline font-medium dark:text-blue-500"
                                href="../docs/index.html">
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10" />
                                    <path d="M8 12h8" />
                                    <path d="M12 8v8" />
                                </svg>
                                Add phone
                            </a>
                        </p>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-3">
                        <div class="inline-block">
                            <label for="af-submit-application-current-company"
                                class="inline-block text-sm font-medium text-gray-500 mt-2.5 dark:text-neutral-500">
                                Current Company
                            </label>
                        </div>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">
                        <input id="af-submit-application-current-company" type="text"
                            class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                    </div>
                    <!-- End Col -->
                </div>
                <!-- End Section -->

                <!-- Section -->
                <div
                    class="grid sm:grid-cols-12 gap-2 sm:gap-4 py-8 first:pt-0 last:pb-0 border-t first:border-transparent border-gray-200 dark:border-neutral-700 dark:first:border-transparent">
                    <div class="sm:col-span-12">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">
                            Profile
                        </h2>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-3">
                        <label for="af-submit-application-resume-cv"
                            class="inline-block text-sm font-medium text-gray-500 mt-2.5 dark:text-neutral-500">
                            Resume/CV
                        </label>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">
                        <label for="af-submit-application-resume-cv" class="sr-only">Choose file</label>
                        <input type="file" name="af-submit-application-resume-cv"
                            id="af-submit-application-resume-cv"
                            class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400
              file:bg-gray-50 file:border-0
              file:bg-gray-100 file:me-4
              file:py-2 file:px-4
              dark:file:bg-neutral-700 dark:file:text-neutral-400">
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-3">
                        <div class="inline-block">
                            <label for="af-submit-application-bio"
                                class="inline-block text-sm font-medium text-gray-500 mt-2.5 dark:text-neutral-500">
                                Personal summary
                            </label>
                        </div>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">
                        <textarea id="af-submit-application-bio"
                            class="py-2 px-3 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                            rows="6" placeholder="Add a cover letter or anything else you want to share."></textarea>
                    </div>
                    <!-- End Col -->
                </div>
                <!-- End Section -->

                <!-- Section -->
                <div
                    class="grid sm:grid-cols-12 gap-2 sm:gap-4 py-8 first:pt-0 last:pb-0 border-t first:border-transparent border-gray-200 dark:border-neutral-700 dark:first:border-transparent">
                    <div class="sm:col-span-12">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">
                            Links
                        </h2>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-3">
                        <label for="af-submit-application-linkedin-url"
                            class="inline-block text-sm font-medium text-gray-500 mt-2.5 dark:text-neutral-500">
                            LinkedIn URL
                        </label>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">
                        <input id="af-submit-application-linkedin-url" type="text"
                            class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-3">
                        <label for="af-submit-application-twitter-url"
                            class="inline-block text-sm font-medium text-gray-500 mt-2.5 dark:text-neutral-500">
                            Twitter URL
                        </label>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">
                        <input id="af-submit-application-twitter-url" type="text"
                            class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-3">
                        <label for="af-submit-application-github-url"
                            class="inline-block text-sm font-medium text-gray-500 mt-2.5 dark:text-neutral-500">
                            Github URL
                        </label>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">
                        <input id="af-submit-application-github-url" type="text"
                            class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-3">
                        <label for="af-submit-application-portfolio-url"
                            class="inline-block text-sm font-medium text-gray-500 mt-2.5 dark:text-neutral-500">
                            Portfolio URL
                        </label>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">
                        <input id="af-submit-application-portfolio-url" type="text"
                            class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-3">
                        <label for="af-submit-application-other-website"
                            class="inline-block text-sm font-medium text-gray-500 mt-2.5 dark:text-neutral-500">
                            Other website
                        </label>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">
                        <input id="af-submit-application-other-website" type="text"
                            class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-start-4 sm:col-span-8">
                        <a class="inline-flex items-center gap-x-1 text-sm text-blue-600 decoration-2 hover:underline focus:outline-none focus:underline font-medium dark:text-blue-500"
                            href="../docs/index.html">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10" />
                                <path d="M8 12h8" />
                                <path d="M12 8v8" />
                            </svg>
                            Add URL
                        </a>
                    </div>
                </div>
                <!-- End Section -->

                <!-- Section -->
                <div
                    class="grid sm:grid-cols-12 gap-2 sm:gap-4 py-8 first:pt-0 last:pb-0 border-t first:border-transparent border-gray-200 dark:border-neutral-700 dark:first:border-transparent">
                    <div class="sm:col-span-12">
                        <h2 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">
                            Before sending your application, please let us know...
                        </h2>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-3">
                        <label for="af-submit-application-desired-salary"
                            class="inline-block text-sm font-medium text-gray-500 mt-2.5 dark:text-neutral-500">
                            Desired salary
                        </label>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">
                        <input id="af-submit-application-desired-salary" type="text"
                            class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-3">
                        <label for="af-submit-application-available-start-date"
                            class="inline-block text-sm font-medium text-gray-500 mt-2.5 dark:text-neutral-500">
                            Available start date
                        </label>
                    </div>
                    <!-- End Col -->

                    <div class="sm:col-span-9">
                        <input id="af-submit-application-available-start-date" type="text"
                            class="py-2 px-3 pe-11 block w-full border-gray-200 shadow-sm text-sm rounded-lg focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                    </div>
                    <!-- End Col -->
                </div>
                <!-- End Section -->

                <!-- Section -->
                <div
                    class="py-8 first:pt-0 last:pb-0 border-t first:border-transparent border-gray-200 dark:border-neutral-700 dark:first:border-transparent">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">
                        Submit application
                    </h2>
                    <p class="mt-3 text-sm text-gray-600 dark:text-neutral-400">
                        In order to contact you with future jobs that you may be interested in, we need to store your
                        personal data.
                    </p>
                    <p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                        If you are happy for us to do so please click the checkbox below.
                    </p>

                    <div class="mt-5 flex">
                        <input type="checkbox"
                            class="shrink-0 mt-0.5 border-gray-300 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-600 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800"
                            id="af-submit-application-privacy-check">
                        <label for="af-submit-application-privacy-check"
                            class="text-sm text-gray-500 ms-2 dark:text-neutral-400">Allow us to process your personal
                            information.</label>
                    </div>
                </div>
                <!-- End Section -->

                <button type="button"
                    class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                    Submit application
                </button>
            </form>
        </div>
        <!-- End Card -->

        <script>
            function iniForm() {
                return {
                    villages: @js($villages),
                    districts: @js($districts),
                    positionTypes: @js($positionTypes),
                    positionTypeStatus: @js($positionTypeStatus),
                    searchDistrict: '',
                    searchVillage: '',
                    selectedDistrict: [],
                    selectedVillage: [],
                    init() {},
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
                        } else {
                            this.selectedDistrict.push(district.id)
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
                        } else {
                            this.selectedVillage.push(village.id)
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
                        this.$refs.btnFilter.click();
                    }
                };
            }
        </script>
    </div>
</div>
