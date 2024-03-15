<!-- Simplicity is an acquired taste. - Katharine Gerould -->

<!-- inputs -->
<div @class(['form-group md:grid grid-cols-2 gap-2 mt-4'])>
    @foreach ($fields as $attr => $value)
        @php
            $fill = $item->{$attr};
        @endphp

        <div @class(['m-2', 'col-span-2' => isset($value['colspan'])])>

            <x-input-label style="color: #000" for="{{ $attr }}" value="{!! $value['title'] !!}"></x-input-label>

            @if ($value['field'] === 'richtext' || $value['field'] === 'textarea')
                <textarea style="color: #000" class="block mt-1 w-full border-2 py-2 px-4 rounded-lg outline-0" id="reader">{!! old($attr) ?? $fill !!}</textarea>
            @elseif ($value['field'] === 'file')
                <div class="w-1/2 mx-auto p-1 md:p-2">
                    <img alt="gallery" class="block h-full w-full rounded-lg object-cover object-center"
                        src="{{ asset('storage/' . $fill) }}" />
                </div>
            @elseif ($value['field'] === 'multiple-file')
                <div class="flex">
                    @foreach ($images as $item)
                        <div class="w-1/2 mx-auto p-1 md:p-2">
                            <img alt="gallery" class="block h-full w-full rounded-lg object-cover object-center"
                                src="{{ asset('storage/' . $item->image) }}" />
                        </div>
                    @endforeach
                </div>
            @elseif ($value['field'] === 'checkbox')
                <div class="flex items-center">
                    @foreach ($value['options'] as $key => $option)
                        <input type="checkbox" id="{{ $attr }}" name="{{ $attr }}"
                            class="mt-1 border-2 p-2 rounded outline-0" checked readonly>
                        <x-input-label style="color: #000" for="{{ $attr }}" value="{!! $option !!}"
                            class="ml-1 mr-4">
                        </x-input-label>
                    @endforeach
                </div>
            @else
                <x-text-input style="color: #000" class="block mt-1 w-full border-2 py-2 px-4 rounded-lg outline-0"
                    value="{{ old($attr) ?? $fill }}" readonly />
            @endif

        </div>
    @endforeach
    <div class="flex items-center justify-start mt-4">
        <a href="{{ url()->previous() }}">
            <x-primary-button class="ml-4">
                {{ __('Retour') }}
            </x-primary-button>
        </a>
    </div>
</div>

<script>
    ClassicEditor.create(document.querySelector("#reader"), {
        toolbar: [],
    }).then(editor => {
        editor.enableReadOnlyMode("editor");
        console.log(editor);
    }).catch(error => {
        console.error(error);
    });
</script>
