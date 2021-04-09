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
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

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
            const data = [{
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

@if (str_contains(request()->route()->uri, 'dashboard/gudang'))
    <script>
        let gudangsTable = null;
        $(document).ready(function() {
            const data = [{
                    data: 'id',
                    'name': 'Id'
                },
                {
                    data: 'nama_gudang',
                    'name': 'Nama Gudang'
                },
                {
                    data: 'alamat',
                    'name': 'Alamat'
                },
                {
                    data: 'Actions',
                    name: 'Actions',
                    orderable: false,
                    serachable: false,
                    sClass: 'text-center'
                }
            ]
            gudangsTable = createTable('#table_gudang', '{{ route('admin.gudangs.index') }}', data);
        });

        $(document).on('click', '#adminDeleteGudang', function() {
            var gudang_id = $(this).val();;
            Swal.fire({
                title: 'Hapus gudang tersebut ??',
                text: 'Pastikan gudang tersebut tidak memiliki barang yang tersimpan !!!',
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
                        url: `{{ env('APP_URL') }}/dashboard/admin/gudang/${gudang_id}/delete`,
                        type: "GET",
                        success: function() {
                            gudangsTable.ajax.reload();
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil.',
                                text: 'Gudang tersebut berhasil dihapus !!'
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

@if (str_contains(request()->route()->uri, 'ruangan'))
    <script>
        let ruangansTable = null;
        $(document).ready(function() {
            const data = [{
                    data: 'id',
                    'name': 'Id'
                },
                {
                    data: 'kode_ruangan',
                    'name': 'Kode Ruangan'
                },
                {
                    data: 'nama_ruangan',
                    'name': 'Nama Ruangan'
                },
                {
                    data: 'kode_gudang',
                    'name': 'Kode Gudang'
                },
                {
                    data: 'Actions',
                    name: 'Actions',
                    orderable: false,
                    serachable: false,
                    sClass: 'text-center'
                }
            ]
            ruangansTable = createTable('#table_ruangan', '{{ route('admin.ruangans.index') }}', data);
        });

        $(document).on('click', '#adminDeleteRuangan', function() {
            var ruangan_id = $(this).val();;
            Swal.fire({
                title: 'Hapus ruangan tersebut ??',
                text: 'Pastikan ruangan tersebut tidak memiliki barang yang tersimpan !!!',
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
                        url: `{{ env('APP_URL') }}/dashboard/admin/ruangan/${ruangan_id}/delete`,
                        type: "GET",
                        success: function() {
                            ruangansTable.ajax.reload();
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil.',
                                text: 'Ruangan tersebut berhasil dihapus !!'
                            });
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            let error_message = jqXHR.status === 400 ?
                                'Masih terdapat barang pada ruangan tersebut' :
                                'Terjadi kesalahan !!';
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: error_message
                            });
                        }
                    })
                }
            })
        });

        function setKodeGudang() {
            const e = document.getElementById("ddlRuanganGudang");
            let namaGudang = e.options[e.selectedIndex].text;

            /**
             * mengubah nama gudang menjadi kode ruangan
             * contoh nama gudang : Ucok Gudang 001
             * maka, akan menjadi : UCOK.GUDANG.001
             *
             * */
            document.getElementById("input_kode_ruangan").value = namaGudang
                .split(' ')
                .map(curr => curr.toUpperCase())
                .join('.') + '.';
        }

    </script>
@endif

@if (str_contains(request()->route()->uri, 'barang'))
    <script>
        let barangsTable = null;

        /* Formatting function for row details - modify as you need */
        function format(d) {
            return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
                '<tr>' +
                '<td>Nama User:</td>' +
                '<td>' + d.user + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>Nama Barang:</td>' +
                '<td>' + d.nama_brg + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>Jumlah Barang:</td>' +
                '<td>' + d.jumlah_brg + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>Kategori Barang:</td>' +
                '<td>' + d.kategori + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>Nama Gudang:</td>' +
                '<td>' + d.gudang + '</td>' +
                '</tr>' +
                '<tr>' +
                '<td>Nama Ruangan:</td>' +
                '<td>' + d.ruangan + '</td>' +
                '</tr>' +
                '</table>';
        }

        $(document).ready(function() {
            const data = [{
                    "className": 'details-control',
                    "orderable": false,
                    "data": null,
                    "defaultContent": '',
                },
                {
                    data: 'id',
                    'name': 'Id'
                },
                {
                    data: 'user_id',
                    'name': 'User Id'
                },
                {
                    data: 'kode_gudang',
                    'name': 'Kode Gudang'
                },
                {
                    data: 'nama_brg',
                    'name': 'Nama Barang'
                },
                {
                    data: 'jumlah_brg',
                    'name': 'Jumlah Barang'
                },
                {
                    data: 'Actions',
                    name: 'Actions',
                    orderable: false,
                    serachable: false,
                    sClass: 'text-center'
                }
            ]
            barangsTable = createTable('#table_barang', '{{ route('admin.barangs.index') }}', data);
            $("#table_barang tbody").on("click", 'td.details-control', function() {
                var tr = $(this).closest('tr');
                var row = barangsTable.row(tr);
                const barang = row.data();
                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    // perform ajax to get data
                    $.ajax({
                        url: `{{ env('APP_URL') }}/dashboard/admin/barang/${barang.id}/detail`,
                        type: "GET",
                        dataType: 'json',
                        processData: false,
                        data: $.param({
                            'kode_gudang': barang.kode_gudang,
                            'kode_kategori': barang.kode_kategori,
                            'kode_ruangan': barang.kode_ruangan,
                            'user_id': barang.user_id,
                        }),
                        success: function(result) {
                            let row_data = {
                                'jumlah_brg': barang.jumlah_brg,
                                'nama_brg': barang.nama_brg,
                                'user': result.user.nama,
                                'gudang': result.gudang.nama_gudang,
                                'kategori': result.kategori.kategori,
                                'ruangan': result.ruangan.nama_ruangan
                            }
                            row.child(format(row_data)).show();
                            tr.addClass('shown');
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Terjadi kesalahan !!'
                            });
                        }
                    })
                }
            })
        });

        $(document).on('click', '#deleteBarang', function() {
            var barang_id = $(this).val();;
            Swal.fire({
                title: 'Hapus barang tersebut ??',
                text: 'Pastikan barang tersebut sudah bisa dihapus !!',
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
                        url: `{{ env('APP_URL') }}/dashboard/admin/barang/${barang_id}/delete`,
                        type: "GET",
                        success: function() {
                            barangsTable.ajax.reload();
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil.',
                                text: 'Barang tersebut berhasil dihapus !!'
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

        $(document).on('click', '#userTarikBarang', function() {
            var tr = $(this).closest('tr');
            var barang = barangsTable.row(tr).data();
            const {
                value: amount
            } = Swal.fire({
                title: 'Mengambil barang',
                icon: 'info',
                input: 'range',
                inputLabel: 'Silahkan geser menu dibawah',
                inputAttributes: {
                    min: 1,
                    max: barang.jumlah_brg,
                    step: 1
                },
                inputValue: 1
            }).then((result) => {
                $.ajax({
                    url: `{{ env('APP_URL') }}/dashboard/user/barang/${barang.id}/tarik`,
                    type: "GET",
                    data: $.param({
                        'jumlah_brg': result.value
                    }),
                    success: function() {
                        barangsTable.ajax.reload();
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil.',
                            text: 'Penarikan barang berhasil !!'
                        });
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Terjadi kesalahan !!'
                        });
                    }
                })
            })
        });

        function setDaftarRuangan() {
            let kode_gudang = document.getElementById("ddlSelectGudang").value;
            let ddlSelectRuangan = document.getElementById("ddlSelectRuangan");
            ddlSelectRuangan.innerHTML = '';
            $.ajax({
                url: `{{ env('APP_URL') }}/dashboard/admin/ruangan/${kode_gudang}/gudang`,
                success: function(ruangans) {
                    for (const ruangan of ruangans) {
                        var selectList = document.createElement("option");
                        selectList.value = ruangan.id;
                        selectList.textContent = ruangan.nama_ruangan;
                        ddlSelectRuangan.appendChild(selectList);
                    }
                }
            })
        }

    </script>
@endif

@if (str_contains(request()->route()->uri, 'pembayaran'))
    <script>
        let pembayaransTable = null;

        function format(pembayaran) {
            return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
                '<tr>' +
                '<td><img src="' + pembayaran.bukti_bayar +
                '" width="600" height="600" alt="Bukti Pembayaran"  data-toggle="modal" data-target="#exampleModal"></td>' +
                '</tr>' +
                '</table>';
        }

        $(document).ready(function() {
            const data = [{
                    "className": 'details-control',
                    "orderable": false,
                    "data": null,
                    "defaultContent": '',
                },
                {
                    data: 'id',
                    'name': 'Id'
                },
                {
                    data: 'user_id',
                    'name': 'Id User'
                },
                {
                    data: 'no_bayar',
                    'name': 'Nomor Bayar'
                },
                {
                    data: 'status',
                    'name': 'Status'
                },
                {
                    data: 'jumlah_bayar',
                    'name': 'Jumlah Bayar',
                    render: $.fn.dataTable.render.number(',', '.', 2, 'Rp.')
                },
                {
                    data: 'Verifikasi',
                    name: 'Verifikasi',
                    orderable: false,
                    serachable: false,
                },
                {
                    data: 'Actions',
                    name: 'Actions',
                    orderable: false,
                    serachable: false,
                    sClass: 'text-center'
                }
            ]
            pembayaransTable = createTable('#table_pembayaran', '{{ route('pembayarans.index') }}', data);
            $("#table_pembayaran tbody").on("click", 'td.details-control', function() {
                var tr = $(this).closest('tr');
                var row = pembayaransTable.row(tr);
                const pembayaran = row.data();
                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    // perform ajax to get data
                    $.ajax({
                        url: `{{ env('APP_URL') }}/dashboard/admin/pembayaran/${pembayaran.id}`,
                        type: "GET",
                        dataType: 'json',
                        processData: false,
                        success: function(result) {
                            row.child(format(result)).show();
                            tr.addClass('shown');
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Terjadi kesalahan !!'
                            });
                        }
                    })
                }
            })
        });

        $(document).on('click', '#adminVerifPembayaran', function() {
            var pembayaran_id = $(this).val();;
            Swal.fire({
                title: 'Verifikasi pembayaran tersebut ??',
                text: 'Pastikan cek terlebih dahulu bukti pembayaran !!',
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
                        url: `{{ env('APP_URL') }}/dashboard/admin/pembayaran/${pembayaran_id}/verify`,
                        type: "GET",
                        success: function() {
                            pembayaransTable.ajax.reload();
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil.',
                                text: 'Pembayaran tersebut berhasil terverifikasi !!'
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

        $(document).on('click', '#adminDeletePembayaran', function() {
            var pembayaran_id = $(this).val();;
            Swal.fire({
                title: 'Hapus pembayaran tersebut ??',
                text: 'Apakah anda yakin ?',
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
                        url: `{{ env('APP_URL') }}/dashboard/admin/pembayaran/${pembayaran_id}/delete`,
                        type: "GET",
                        success: function() {
                            pembayaransTable.ajax.reload();
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil.',
                                text: 'Pembayaran tersebut berhasil dihapus !!'
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

@if (str_contains(request()->route()->uri, 'ticketing'))
    <script>
        let ticketingsTable = null;
        $(document).ready(function() {
            const data = [{
                    data: 'id',
                    'name': 'Id'
                },
                {
                    data: 'user_id',
                    'name': 'Id User'
                },
                {
                    data: 'pesan',
                    'name': 'Pesan'
                },
                {
                    data: 'Status',
                    'name': 'Status'
                },
                {
                    data: 'Actions',
                    name: 'Actions',
                    orderable: false,
                    serachable: false,
                    sClass: 'text-center'
                }
            ]
            ticketingsTable = createTable('#table_ticketing', '{{ route('ticketing.index') }}', data);

            $(document).on('click', '#prosesTicket', function() {
                var ticket_id = $(this).val();;
                Swal.fire({
                    title: 'Silahkan pilih status ticket',
                    input: 'select',
                    inputOptions: {
                        pending: 'Pending',
                        on_progress: 'On-progress',
                        finish: 'Finish'
                    },
                    inputPlaceholder: 'Pilih status ticket',
                    showCancelButton: true
                }).then((result) => {
                    let status = result.value.toLowerCase()
                    if (result.value) {
                        $.ajax({
                            url: `{{ env('APP_URL') }}/dashboard/admin/ticketing/${ticket_id}/update_status`,
                            type: "PUT",
                            data: $.param({
                                status
                            }),
                            success: function() {
                                ticketingsTable.ajax.reload();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil.',
                                    text: 'Pembayaran tersebut berhasil terverifikasi !!'
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

            $(document).on('click', '#deleteTicket', function() {
                var ticket_id = $(this).val();;
                Swal.fire({
                    title: 'Hapus ticket tersebut ??',
                    text: 'Apakah anda yakin ?',
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
                            url: `{{ env('APP_URL') }}/dashboard/ticketing/${ticket_id}/delete`,
                            type: "GET",
                            success: function() {
                                ticketingsTable.ajax.reload();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil.',
                                    text: 'Ticket tersebut berhasil dihapus !!'
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
        });

    </script>
@endif

@if (str_contains(request()->route()->uri, 'audit_log'))
    <script>
        let auditLogsTable = null;
        const FROM_PATTERN = 'YYYY-MM-DD HH:mm:ss.SSS';
        const TO_PATTERN = 'DD/MM/YYYY HH:mm';
        $(document).ready(function() {
            const data = [{
                    data: 'id',
                    'name': 'Id'
                },
                {
                    data: 'user_id',
                    'name': 'Id User'
                },
                {
                    data: 'kode_barang',
                    'name': 'Kode Barang'
                },
                {
                    data: 'kode_gudang',
                    'name': 'Kode Gudang'
                },
                {
                    data: 'aksi',
                    'name': 'Aksi'
                },
                {
                    data: 'keterangan',
                    'name': 'Keterangan'
                },
                {
                    data: 'created_at',
                    'namw': 'Waktu',
                    render: (data) => { return new Date(data).toLocaleString('id-ID') },
                    targets: 1
                }
            ]
            auditLogsTable = createTable('#table_audit_log', '{{ route('audit_logs') }}', data);
            setInterval(auditLogsTable.ajax.reload, 2500);
        });

    </script>
@endif

<script>
    $('#datetimepicker').datetimepicker();

</script>

@livewireScripts
<script src="{{ asset('/js/main.js') }}"></script>

{{ $script ?? '' }}
