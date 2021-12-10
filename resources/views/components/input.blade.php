<div class="form-control gap-0.5">
    <label class="label flex-col items-start gap-1.5">
        {{ $label }}
        <input
            type="{{ $type }}"
            name="{{ $name }}"
            class="@error($name) input-error @enderror input input-bordered w-full bg-gray-50"
            placeholder="{{ $placeholder }}"
            @unless($name === 'password' || $name === 'password_confirmation')
            value="{{ old($name) }}"
            @endunless
            autocomplete="on"
        >
    </label>
    @error($name)
    <div class="error text-error mb-2 flex gap-1"><i class="bi bi-exclamation-circle-fill"></i> {{ $message }}</div>
    @enderror
</div>


@once
    @push('scripts')
        <script>
            $('.input').on('input', function () {
                $(this).removeClass('input-error');
                $(this).parent().siblings('div.error').hide();
            });
        </script>
    @endpush
@endonce
