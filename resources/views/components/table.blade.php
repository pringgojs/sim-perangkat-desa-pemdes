<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="border rounded shadow-sm p-6 bg-white dark:bg-neutral-800 dark:border-neutral-700">
        <div class="flex flex-col">
            <div class="grid grid-cols-3 gap-4">
                <div
                    class="col-span-2 p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                    {{ $title }}
                </div>
                <div wire:loading class="content-center justify-end">
                    <div class="-mt-6">
                        @livewire('utils.loading', key(\Illuminate\Support\Str::random(10)))
                    </div>
                </div>
            </div>
            <div class="-m-1.5 overflow-x-auto mb-5">

                <div class="p-1.5 min-w-full inline-block align-middle ">
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">

                            <thead>
                                <tr>
                                    @foreach ($headers as $item)
                                        <th scope="col"
                                            class="px-6 py-3 text-xs text-center font-bold text-black uppercase dark:text-neutral-500">
                                            {{ $item }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                {{ $table ?? '' }}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{ $footer ?? '' }}
        </div>
    </div>
</div>


@script
    <script>
        initFlowbite();
    </script>
@endscript
