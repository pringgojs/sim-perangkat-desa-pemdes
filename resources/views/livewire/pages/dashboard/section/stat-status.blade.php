<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <h3 class="text-base font-semibold leading-6 text-gray-900">Total Perangkat Desa</h3>
    <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
        @foreach ($stats as $i => $value)
            <a wire:key="stats-staff-{{ $i }}"
                class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                <dt class="truncate text-sm font-medium text-gray-500">{{ $i }}</dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{ $value }}
                </dd>
            </a>
        @endforeach
    </dl>
</div>
