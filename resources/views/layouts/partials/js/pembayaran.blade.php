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
