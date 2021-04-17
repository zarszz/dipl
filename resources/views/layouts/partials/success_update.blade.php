@if (request()->session()->has('status'))
    <button hidden id="success_update"></button>
    @php
        request()
            ->session()
            ->forget('status');
    @endphp
@endif
