<div>
    <label for="phone_numbers">@lang('employee.form.phone_numbers')</label>
    <div id="phone_numbers" class="form-group w-100">
        @foreach ($numbers as $key => $number)
            <div class="d-flex mb-2" id="{{ 'phone_numbers[' . $key . ']' }}">
                <input type="text" name="{{ 'phone_numbers[' . $key . ']' }}"
                    class="form-control @error("phone_numbers[$key]") border-danger @enderror"
                    value="{{ $number }}">
                <button type="button" data-id="phone-btn" data-parent="{{ 'phone_numbers[' . $key . ']' }}"
                    class="btn btn-outline-danger ms-2">
                    X
                </button>
            </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-end">
        <button type="button" id="add_phone_num" class="ms-2 mb-2 btn btn-outline-secondary">
            @lang('employee.form.add_phone_num')
        </button>
    </div>

    @error('phone_numbers')
        <span class="text-danger">
            {{ $message }}
        </span>
    @enderror
</div>
