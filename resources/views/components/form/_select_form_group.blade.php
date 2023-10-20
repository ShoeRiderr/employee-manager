<div class="form-group mb-2">
    <label for="">{{ $label }}</label>
    <select id="{{ $name }}" name="{{ $name }}" class="form-control @error($name) border-danger @enderror">
        <option value="" default></option>
        @foreach ($values as $value)
            <option value="{{ $value->id }}" @if ($checkedValue === $value->id) selected @endif>
                {{ $value->name }}
            </option>
        @endforeach
    </select>

    @error($name)
        <span class="text-danger">
            {{ $message }}
        </span>
    @enderror
</div>
