@props(['for'])

@error(!empty($for) ? $for : "")
    <p {{ $attributes->merge(['class' => 'text-sm text-red-600']) }}>{{ $message }}</p>
@enderror
