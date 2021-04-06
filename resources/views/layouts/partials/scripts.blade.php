<script src="{{ mix('js/app.js') }}"></script>

<script src="{{ asset('/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('/vendors/tinymce/tinymce.min.js') }}"></script> --}}


@if (str_contains(request()->route()->uri, 'dashboard'))
    <script src="{{ asset('/js/extensions/sweetalert2.js') }}"></script>
    <script src="{{ asset('/vendors/sweetalert2/sweetalert2.all.min.js') }}"></script>

    <!-- jQuery -->
    <script type="text/javascript" src="{{ asset('js/jquery-3.4.1.min.js') }} "></script>

    <!--Datatables -->
    <script type="text/javascript" src="{{ asset('js/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.datetimepicker.full.js') }}"></script>

    <!-- Chart -->
    <script type="text/javascript" src="{{ asset('vendors/apexcharts/apexcharts.js') }}"></script>
@endif

<script>
    function createTable(tableID, url, data) {
        return $(tableID).DataTable({
            // processing: true,
            // serverSide: true,
            autoWidth: true,
            "order": [
                [0, "desc"]
            ],
            ajax: {
                url: url
            },
            columns: data
        });
    }

</script>

@if (str_contains(request()->route()->uri, 'dashboard/user'))
    <script>
        let userTable = null;
        $(document).ready(function() {
            const data = [{
                    data: 'nama',
                    'name': 'nama'
                },
                {
                    data: 'email',
                    'name': 'email'
                },
                {
                    data: 'jenis_kelamin',
                    'name': 'jenis_kelamin'
                },
                {
                    data: 'Status',
                    name: 'Status',
                    orderable: false,
                    serachable: false,
                    sClass: 'text-center'
                },
                {
                    data: 'Actions',
                    name: 'Actions',
                    orderable: false,
                    serachable: false,
                    sClass: 'text-center'
                }
            ]
            userTable = createTable('#table1', '{{ route('users.index') }}', data);
        })
        $(document).on('click', '#adminDeleteUser', function() {
            var user_id = $(this).val();;
            Swal.fire({
                title: 'Apa Anda yakin ?',
                text: "Anda tidak dapat mengembalikan data tersebut",
                icon: 'warning',
                showCancelButton: true,
                customClass: {
                    confirmButtonClass: "btn btn-danger"
                },
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "Ya",
                cancelButtonText: "Tidak",
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: `{{ env('APP_URL') }}/dashboard/admin/user/${user_id}/delete`,
                        type: "GET",
                        success: function() {
                            userTable.ajax.reload();
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil.',
                                text: 'Data tersebut berhasil di hapus'
                            });
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!'
                            });
                        }
                    })
                }
            })
        });
        $(document).on('click', '#adminVerifUser', function() {
            var user_id = $(this).val();;
            Swal.fire({
                title: 'Verifikasi user tersebut ?',
                text: "Pastikan user telah melakukan konfirmasi !!!",
                icon: 'warning',
                showCancelButton: true,
                customClass: {
                    confirmButtonClass: "btn btn-danger"
                },
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "Ya",
                cancelButtonText: "Tidak",
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: `{{ env('APP_URL') }}/dashboard/admin/user/${user_id}/verif`,
                        type: "GET",
                        success: function() {
                            userTable.ajax.reload();
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil.',
                                text: 'User berhasil terverifikasi !!'
                            });
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!'
                            });
                        }
                    })
                }
            })
        });

        var options = {
            series: [],
            noData: {
                text: 'Loading ....'
            },
            title: {
                text: 'Grafik Pendaftaran User'
            },
            chart: {
                id: 'area-datetime',
                type: 'area',
                height: 350,
                zoom: {
                    autoScaleYaxis: true
                }
            },
            annotations: {
                yaxis: [{
                    y: 30,
                    borderColor: '#999',
                    label: {
                        show: true,
                        text: 'Support',
                        style: {
                            color: "#fff",
                            background: '#00E396'
                        }
                    }
                }],
                xaxis: [{
                    x: new Date('14 Nov 2012').getTime(),
                    borderColor: '#999',
                    yAxisIndex: 0,
                    label: {
                        show: true,
                        text: 'Rally',
                        style: {
                            color: "#fff",
                            background: '#775DD0'
                        }
                    }
                }]
            },
            dataLabels: {
                enabled: false
            },
            markers: {
                size: 0,
                style: 'hollow',
            },
            xaxis: {
                type: 'datetime',
                min: new Date('01 Mar 2021').getTime(),
                tickAmount: 6,
            },
            tooltip: {
                x: {
                    format: 'dd MMM yyyy'
                }
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.9,
                    stops: [0, 100]
                }
            },
        };

        var chart = new ApexCharts(
            document.querySelector("#chart-registered-user"),
            options
        );

        chart.render();

        var url = "{{ ENV('APP_URL') }}/dashboard/admin/users/graph";
        $.getJSON(url, function(response) {
            chart.updateSeries([{
                name: 'Sales',
                data: response
            }])
        });

    </script>
@endif

@if (str_contains(request()->route()->uri, 'dashboard/kategori'))
    <script>
        let kategoriesTable = null;
        $(document).ready(function() {
            const data = [
                {
                    data: 'id',
                    'name': 'Idd'
                },
                {
                    data: 'kategori',
                    'name': 'kategori'
                },
                {
                    data: 'deskripsi',
                    'name': 'deskripsi'
                },
                {
                    data: 'Actions',
                    name: 'Actions',
                    orderable: false,
                    serachable: false,
                    sClass: 'text-center'
                }
            ]
            kategoriesTable = createTable('#table_kategori', '{{ route('admin.kategories.index') }}', data);
        });

        $(document).on('click', '#adminDeleteKategori', function() {
            var kategori_id = $(this).val();;
            Swal.fire({
                title: 'Hapus kategori tersebut ??',
                text: 'Pastikan kategori tersebut tidak memiliki barang yang tersimpan !!!',
                icon: 'warning',
                showCancelButton: true,
                customClass: {
                    confirmButtonClass: "btn btn-danger"
                },
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "Ya",
                cancelButtonText: "Tidak",
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: `{{ env('APP_URL') }}/dashboard/admin/kategori/${kategori_id}/delete`,
                        type: "GET",
                        success: function() {
                            kategoriesTable.ajax.reload();
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil.',
                                text: 'Kategori tersebut berhasil dihapus !!'
                            });
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!'
                            });
                        }
                    })
                }
            })
        });
    </script>
@endif

<script>
    $('#datetimepicker').datetimepicker();

</script>

@livewireScripts
<script src="{{ asset('/js/main.js') }}"></script>

{{ $script ?? '' }}
