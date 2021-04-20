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

<script>
    let optionsVisitorsProfile = {
        series: [70, 30],
        labels: ['Male', 'Female'],
        colors: ['#435ebe', '#55c6e8'],
        chart: {
            type: 'donut',
            width: '100%',
            height: '350px'
        },
        legend: {
            position: 'bottom'
        },
        plotOptions: {
            pie: {
                donut: {
                    size: '30%'
                }
            }
        }
    }

    var optionsEurope = {
        series: [{
            name: 'series1',
            data: [310, 800, 600, 430, 540, 340, 605, 805, 430, 540, 340, 605]
        }],
        chart: {
            height: 80,
            type: 'area',
            toolbar: {
                show: false,
            },
        },
        colors: ['#5350e9'],
        stroke: {
            width: 2,
        },
        grid: {
            show: false,
        },
        dataLabels: {
            enabled: false
        },
        xaxis: {
            type: 'datetime',
            categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z",
                "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z",
                "2018-09-19T06:30:00.000Z", "2018-09-19T07:30:00.000Z", "2018-09-19T08:30:00.000Z",
                "2018-09-19T09:30:00.000Z", "2018-09-19T10:30:00.000Z", "2018-09-19T11:30:00.000Z"
            ],
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
            labels: {
                show: false,
            }
        },
        show: false,
        yaxis: {
            labels: {
                show: false,
            },
        },
        tooltip: {
            x: {
                format: 'dd/MM/yy HH:mm'
            },
        },
    };

    let optionsAmerica = {
        ...optionsEurope,
        colors: ['#008b75'],
    }
    let optionsIndonesia = {
        ...optionsEurope,
        colors: ['#dc3545'],
    }



    var chartVisitorsProfile = new ApexCharts(document.getElementById('chart-visitors-profile'), optionsVisitorsProfile)
    var chartEurope = new ApexCharts(document.querySelector("#chart-europe"), optionsEurope);
    var chartAmerica = new ApexCharts(document.querySelector("#chart-america"), optionsAmerica);
    var chartIndonesia = new ApexCharts(document.querySelector("#chart-indonesia"), optionsIndonesia);

    chartIndonesia.render();
    chartAmerica.render();
    chartEurope.render();
    chartVisitorsProfile.render()

</script>

<!-- Include base javascript -->
@include('layouts.partials.js.base')

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
