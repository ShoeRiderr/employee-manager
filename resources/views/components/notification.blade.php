@isset($message)
    <div class="alert @isset($alertClass) alert-primary @endisset" role="alert">
        {{ $message }}
    </div>
@endisset
