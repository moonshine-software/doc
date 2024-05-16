<div x-data="quill">
    <div class="ql-editor" :id="$id('quill')" style="height: auto;">{!! $value ?? '' !!}</div>

    <x-moonshine::form.textarea
        :attributes="$element->attributes()->merge([
            'class' => 'ql-textarea',
            'name' => $element->name(),
            'style' => 'display: none;'
        ])->except('x-bind:id')"
    >{!! $value ?? '' !!}</x-moonshine::form.textarea>
</div>
