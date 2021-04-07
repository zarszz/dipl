<!-- Fonts -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link rel="stylesheet" type='text/css' href="{{ asset('css/fonts.css') }}">

<!-- Vendors -->
<link rel="stylesheet" href="{{ asset('/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
<link rel="stylesheet" href="{{ asset('/vendors/bootstrap-icons/bootstrap-icons.css') }}">


<!-- Styles -->
<link rel="stylesheet" href="{{ mix('css/bootstrap.css') }}">
<link rel="stylesheet" href="{{ mix('css/app.css') }}">

<link href="{{ asset('css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/responsive.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/jquery.datetimepicker.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/buttons.dataTables.min.css') }}">
<style>
    Overrides to match the Tailwind CSS .dataTables_wrapper {
        padding-top: 0.25rem;
        padding-bottom: 0.25rem
    }

    table.dataTable.no-footer {
        border-bottom-width: 1px;
        border-color: #d2d6dc
    }

    table.dataTable tbody td,
    table.dataTable tbody th {
        padding: 0.75rem 1rem;
        border-bottom-width: 1px;
        border-color: #d2d6dc
    }

    div.dt-buttons {
        padding: 1rem 1rem 1rem 0;
        display: flex;
        align-items: center
    }

    .dataTables_filter,
    .dataTables_info {
        padding: 1rem
    }

    .dataTables_wrapper .dataTables_paginate {
        padding: 1rem
    }

    .dataTables_filter label input {
        padding: 0.5rem;
        border-width: 2px;
        border-radius: 0.5rem
    }

    .dataTables_filter label input:focus {
        box-shadow: 0 0 0 3px rgba(118, 169, 250, 0.45);
        outline: 0
    }

    table.dataTable thead tr {
        border-radius: 0.5rem
    }

    table.dataTable thead tr th:not(.text-center) {
        text-align: left
    }

    table.dataTable thead tr th {
        background-color: #edf2f7;
        border-bottom-width: 2px;
        border-top-width: 1px;
        border-color: #d2d6dc
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current:not(.disabled),
    .dataTables_wrapper .dataTables_paginate .paginate_button.next:not(.disabled),
    .dataTables_wrapper .dataTables_paginate .paginate_button.previous:not(.disabled),
    .dataTables_wrapper .dataTables_paginate .paginate_button:not(.disabled),
    button.dt-button {
        transition-duration: 150ms;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-property: background-color, border-color, color, fill, stroke, opacity, box-shadow, transform;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: #374151 !important;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        font-size: 0.75rem;
        font-weight: 600;
        align-items: center;
        display: inline-flex;
        border-width: 1px !important;
        border-color: #d2d6dc !important;
        border-radius: 0.375rem;
        background: #ffffff;
        overflow: visible;
        margin-bottom: 0
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.next:focus:not(.disabled),
    .dataTables_wrapper .dataTables_paginate .paginate_button.next:hover:not(.disabled),
    .dataTables_wrapper .dataTables_paginate .paginate_button.previous:focus:not(.disabled),
    .dataTables_wrapper .dataTables_paginate .paginate_button.previous:hover:not(.disabled),
    .dataTables_wrapper .dataTables_paginate .paginate_button:focus:not(.disabled),
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover:not(.disabled),
    button.dt-button:focus,
    button.dt-button:focus:not(.disabled),
    button.dt-button:hover,
    button.dt-button:hover:not(.disabled) {
        background-color: #edf2f7 !important;
        border-width: 1px !important;
        border-color: #d2d6dc !important;
        color: #374151 !important
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current:not(.disabled) {
        background: #6875f5 !important;
        color: #ffffff !important;
        border-color: #8da2fb !important
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover,
    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background-color: #8da2fb !important;
        color: #ffffff !important;
        border-color: #8da2fb !important
    }

    .dataTables_length select {
        padding: .25rem;
        border-radius: .25rem;
        background-color: #edf2f7;
    }

    .dataTables_length {
        padding-top: 1.25rem;
    }

    td.details-control {
        background: url({{  URL::asset("images/datatables/details_open.png") }}) no-repeat center center;
        cursor: pointer;
    }

    tr.shown td.details-control {
        background: url({{  URL::asset("images/datatables/details_close.png") }}) no-repeat center center;
    }

</style>


@livewireStyles

{{ $style ?? '' }}
