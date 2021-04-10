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
