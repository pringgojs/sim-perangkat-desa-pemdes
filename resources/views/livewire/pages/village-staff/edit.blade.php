<div>
    <div class="max-w-4xl px-4 sm:px-6 lg:px-8 mx-auto"><!-- Card -->
        {{-- supaya bisa dirender oleh tailwind --}}

        {{-- jika from nya dari admin, maka tidak perlu tombol alert confirmasi --}}
        {{-- @if ($form->village_staff->dataStatus->key == 'draft' || $form->village_staff->dataStatus->key == 'revisi')
            @livewire('pages.profile.section.alert-confirmation', ['staff' => $staff])
        @endif --}}

        @livewire('pages.profile.section.header', ['form' => $form, 'staff' => $staff, 'from' => 'admin'])
        @livewire('pages.profile.section.tab', ['staff' => $staff, 'form' => $form, 'isReadonly' => false, 'from' => 'admin'])
    </div>
</div>
