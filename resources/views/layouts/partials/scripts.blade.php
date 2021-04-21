<script src="{{ mix('js/app.js') }}"></script>

<script src="{{ asset('/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>

<!-- jQuery -->
<script type="text/javascript" src="{{ asset('js/jquery-3.4.1.min.js') }} "></script>
<script type="text/javascript" src="{{ asset('vendors/toastify/toastify.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.datetimepicker.full.js') }}"></script>

@if (str_contains(request()->route()->uri, 'dashboard'))
    <script src="{{ asset('/js/extensions/sweetalert2.js') }}"></script>
    <script src="{{ asset('/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <!--Datatables -->
    <script type="text/javascript" src="{{ asset('js/datatables.min.js') }}"></script>

    <!-- Chart -->
    <script type="text/javascript" src="{{ asset('vendors/apexcharts/apexcharts.js') }}"></script>
    <script>
        var isSuccessUpdated = document.getElementById("success_update");
        if (isSuccessUpdated) {
            Swal.fire(
                'Berhasil !!',
                'Update data Berhasil !!!',
                'success'
            )
        }

    </script>
@endif

<!-- Include base javascript -->
@include('layouts.partials.js.base')

@if (request()->route()->uri == 'dashboard')
    @include('layouts.partials.js.dashboard')
@endif

@if (str_contains(request()->route()->uri, 'dashboard/user'))
    @include('layouts.partials.js.user')
@endif

@if (str_contains(request()->route()->uri, 'dashboard/kategori'))
    @include('layouts.partials.js.kategori')
@endif

@if (str_contains(request()->route()->uri, 'dashboard/gudang'))
    @include('layouts.partials.js.gudang')
@endif

@if (str_contains(request()->route()->uri, 'ruangan'))
    @include('layouts.partials.js.ruangan')
@endif

@if (str_contains(request()->route()->uri, 'barang'))
    @include('layouts.partials.js.barang')
@endif

@if (str_contains(request()->route()->uri, 'pembayaran'))
    @include('layouts.partials.js.pembayaran')
@endif

@if (str_contains(request()->route()->uri, 'ticketing'))
    @include('layouts.partials.js.ticketing')
@endif

@if (str_contains(request()->route()->uri, 'audit_log'))
    @include('layouts.partials.js.audit_log')
@endif

@if (str_contains(request()->route()->uri, 'cek-barang'))
    @include('layouts.partials.js.list_barang')
@endif

<script>
    $('#datetimepicker').datetimepicker();

</script>

@livewireScripts
<script src="{{ asset('/js/main.js') }}"></script>

{{ $script ?? '' }}
