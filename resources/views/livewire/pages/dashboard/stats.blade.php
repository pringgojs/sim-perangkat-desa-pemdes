<div>
    <h3 class="text-base font-semibold leading-6 text-gray-900">Total Perangkat Desa Berdasarkan Jenis Jabatan</h3>
    <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-3">
        @foreach ($options as $item)
            <a href="{{ route('village-staff.index', ['type' => $item->id]) }}" wire:navigate
                wire:key="stats-staff-{{ $item->id }}"
                class="overflow-hidden rounded-lg bg-white px-4 py-5 shadow sm:p-6">
                <dt class="truncate text-sm font-medium text-gray-500">{{ $item->name }}</dt>
                <dd class="mt-1 text-3xl font-semibold tracking-tight text-gray-900">{{ $item->villageStaff->count() }}
                </dd>
            </a>
        @endforeach
    </dl>
</div>
