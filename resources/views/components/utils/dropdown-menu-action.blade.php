<!-- resources/views/components/dropdown.blade.php -->
<div class="px-6 py-2">
    <div class="hs-dropdown [--placement:bottom-right] relative inline-block">
        <button id="hs-table-dropdown-{{ $id }}" type="button"
            class="hs-dropdown-toggle py-1.5 px-2 inline-flex justify-center items-center gap-2 rounded-lg text-gray-700 align-middle disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-green-600 transition-all text-sm dark:text-neutral-400 dark:hover:text-white dark:focus:ring-offset-gray-800"
            aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <circle cx="12" cy="12" r="1" />
                <circle cx="19" cy="12" r="1" />
                <circle cx="5" cy="12" r="1" />
            </svg>
        </button>

        <!-- Dropdown Items -->
        <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden divide-y divide-gray-200 min-w-40 z-20 bg-white shadow-2xl rounded-lg p-2 mt-2 dark:divide-neutral-700 dark:bg-neutral-800 dark:border dark:border-neutral-700"
            role="menu" aria-orientation="vertical" aria-labelledby="hs-table-dropdown-{{ $id }}">
            <!-- Title -->
            <div class="py-2 first:pt-0 last:pb-0">
                <span class="block py-2 px-3 text-xs font-medium uppercase text-gray-400 dark:text-neutral-600">
                    Actions
                </span>
            </div>

            <!-- Dynamically Generated Menu Items -->
            @foreach ($items as $item)
                <a class="flex cursor-pointer items-center gap-x-3 py-2 px-3 rounded-lg border-none text-sm {{ $item['color'] ?? 'text-gray-800' }} hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 dark:focus:text-neutral-300"
                    @if ($item['type'] == 'link') href="{{ $item['url'] }}" wire:navigate @endif
                    @if ($item['type'] == 'delete') onclick="document.getElementById('modalConfirm')._x_dataStack[0].show = true;document.getElementById('modalConfirm')._x_dataStack[0].id = '{{ $id }}';" @endif>{{ $item['label'] }}
                </a>
            @endforeach
        </div>
    </div>
</div>
