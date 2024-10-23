<div>
    <div x-data="{
        search: @entangle('search'),
        value: @entangle('value'),
        options: @entangle('options'),
        filteredOptions: [],
        isDropdownVisible: false,
    
        // Inisialisasi dan filterisasi
        init() {
            this.filteredOptions = this.options;
        },
    
        // Fungsi untuk memfilter options berdasarkan pencarian
        filterOptions() {
            this.filteredOptions = this.options.filter(option =>
                option.toLowerCase().includes(this.search.toLowerCase())
            );
        }
    }" x-init="search = value;
    filterOptions()" class="relative" @click.away="isDropdownVisible = false">
        <!-- Kotak Pencarian -->
        <input type="text" x-model="search" @focus="isDropdownVisible = true" @input="filterOptions()"
            @change="value = search"
            class="bg-white border  pe-11 border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500"
            placeholder="Cari..." />

        <!-- Dropdown List -->
        <div class="absolute top-full left-0 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg text-sm"
            x-show="isDropdownVisible" x-cloak style="display: none;">
            <ul>
                <template x-for="option in filteredOptions" :key="option">
                    <li @click="search = option; value = option; isDropdownVisible = false"
                        class="p-2 md:px-3 cursor-pointer hover:bg-gray-100" x-text="option"></li>
                </template>

                <template x-if="filteredOptions.length === 0">
                    <li class="p-2 md:px-3  text-gray-500">Tidak ada hasil ditemukan</li>
                </template>
            </ul>
        </div>
    </div>

</div>
