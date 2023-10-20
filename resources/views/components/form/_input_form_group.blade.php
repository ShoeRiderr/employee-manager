<div class="form-group mb-2">
    <label for="{{ $name }}">{{ $label }}</label>
    <input id="{{ $name }}" type="{{ isset($type) ? $type : 'text' }}" name="{{ $name }}"
        class="form-control @error($name) border-danger @enderror" value="{{ $value }}">

        @error($name)
        <span class="text-danger">
                {{ $message }}
            </span>
            @enderror

</div>
