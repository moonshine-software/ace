@props([
    'label' => '',
    'value' => '',
    'config',
])

<div
    x-data="ace({{$config}})"
    class="ace"
>
    <div {{ $attributes->only(['class', 'style'])->merge(['class' => 'ace_editor']) }}>{!! $value ?? '' !!}</div>

    <x-moonshine::form.textarea
        :attributes="$attributes->except(['style', 'class'])"
    >{!! $value ?? '' !!}</x-moonshine::form.textarea>
</div>
