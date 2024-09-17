<div>

    @livewire('pages.dashboard.stats')
    {{-- daftar menunggu persetujuan --}}
    {{-- @if (auth()->user()->hasRole('administrator')) --}}
    @livewire('pages.dashboard.section.statStatus')
    {{-- @endif --}}
</div>
