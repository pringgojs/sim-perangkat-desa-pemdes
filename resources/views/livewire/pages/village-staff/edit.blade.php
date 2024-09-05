<div>
    <div class="max-w-4xl px-4 sm:px-6 lg:px-8 mx-auto"><!-- Card -->
        {{-- supaya bisa dirender oleh tailwind --}}
        @if ($form->village_staff->dataStatus->key == 'draft' || $form->village_staff->dataStatus->key == 'revisi')
            @livewire('pages.profile.section.alert-confirmation', ['staff' => $staff])
        @endif

        @livewire('pages.profile.section.header', ['staff' => $staff])
        @livewire('pages.profile.section.form', ['form' => $form, 'staff' => $staff])
    </div>
</div>
