<div>
    <div x-data="{ open: false }" @set-open-detail.window="open = $event.detail" x-show="open" @click.away="open = false"
        class="fixed inset-0 flex z-50 justify-end">
        <!-- Background overlay -->
        <div x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-black bg-opacity-50"></div>

        <!-- Drawer -->
        <div x-show="open" x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full" class="relative bg-white w-96 h-full shadow-xl">
            <div class="absolute left-0 top-0 -ml-8 flex pr-2 pt-4 sm:-ml-10 sm:pr-4">
                <button type="button" @click="open = false"
                    class="relative rounded-md text-gray-300 hover:text-white focus:outline-none focus:ring-2 focus:ring-white">
                    <span class="absolute -inset-2.5"></span>
                    <span class="sr-only">Close panel</span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Slide-over panel, show/hide based on slide-over state. -->
            <div class="h-full overflow-y-auto bg-white p-8">
                <div class="justify-end flex-initial ml-5 -mt-5" wire:loading wire:target='detail'>
                    @livewire('utils.loading')
                </div>

                @php
                    $sourceImg = asset('images/ktp.png');
                    if ($staff) {
                        $sourceImg = $staff->ktp_scan ? asset('storage/' . $staff->ktp_scan) : $sourceImg;
                    }
                @endphp
                <div class="space-y-6 pb-16">
                    <div>
                        <x-modal id="exampleModal" maxWidth="lg" wire:model="modalPreview">
                            <div class="p-6">
                                <img id="preview-modal"
                                    class="inline-block w-auto h-72 rounded ring-2 ring-white dark:ring-neutral-900"
                                    src="{{ $sourceImg }}" alt="Avatar">
                            </div>
                        </x-modal>
                        <div class="aspect-h-7 aspect-w-10 block w-full overflow-hidden rounded-lg">
                            <img onclick="document.getElementById('exampleModal')._x_dataStack[0].show = true"
                                src="{{ $sourceImg }}" alt="" class="object-cover cursor-pointer">
                        </div>
                        <div class="mt-4 flex items-start justify-between">
                            <div>
                                <h2 class="text-base font-semibold leading-6 text-gray-900"><span
                                        class="sr-only">Details for </span>{{ $staff->name ?? '' }}</h2>
                                <p class="text-sm font-medium text-gray-500">{{ $staff->position_name ?? '' }}</p>
                                <p class="text-sm font-medium text-gray-500">{{ $staff->address ?? '' }}</p>
                            </div>
                            <button type="button"
                                class="relative ml-4 flex h-8 w-8 items-center justify-center rounded-full bg-white text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <span class="absolute -inset-1.5"></span>

                                @if ($staff)
                                    @if ($staff->gender)
                                        <x-fas-male class="h-6 w-6 text-blue-400" />
                                    @else
                                        <x-fas-female class="h-6 w-6 text-purple-400" />
                                    @endif
                                @endif
                                <span class="sr-only">Favorite</span>
                            </button>
                        </div>
                    </div>
                    <div>
                        <h3 class="font-medium text-gray-900">Information</h3>
                        <dl class="mt-2 divide-y divide-gray-200 border-b border-t border-gray-200">
                            <div class="flex justify-between py-3 text-sm font-medium">
                                <dt class="text-gray-500">Place of birth</dt>
                                <dd class="text-gray-900">{{ $staff->place_of_birth ?? '' }}</dd>
                            </div>
                            <div class="flex justify-between py-3 text-sm font-medium">
                                <dt class="text-gray-500">Date of birth</dt>
                                <dd class="text-gray-900">{{ $staff->date_of_birth ?? '' }}</dd>
                            </div>
                            <div class="flex justify-between py-3 text-sm font-medium">
                                <dt class="text-gray-500">Last modified</dt>
                                <dd class="text-gray-900">{{ $staff->updated_at ?? '' }}</dd>
                            </div>
                            <div class="flex justify-between py-3 text-sm font-medium">
                                <dt class="text-gray-500">Position Type</dt>
                                <dd class="text-gray-900">{{ $staff->positionType->name ?? '' }}</dd>
                            </div>

                            <div class="flex justify-between py-3 text-sm font-medium">
                                <dt class="text-gray-500">SK number</dt>
                                <dd class="text-gray-900">{{ $staff->sk_number ?? '' }}</dd>
                            </div>
                            <div class="flex justify-between py-3 text-sm font-medium">
                                <dt class="text-gray-500">SK TMT</dt>
                                <dd class="text-gray-900">{{ $staff->sk_tmt ?? '' }}</dd>
                            </div>
                            <div class="flex justify-between py-3 text-sm font-medium">
                                <dt class="text-gray-500">SK date</dt>
                                <dd class="text-gray-900">{{ $staff->sk_date ?? '' }}</dd>
                            </div>

                            {{-- @if (key_option('bpd')) --}}

                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
