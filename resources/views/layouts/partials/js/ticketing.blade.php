<script>
    let ticketingsTable = null;
    $(document).ready(function() {
        const data = [{
                data: 'id',
                'name': 'id'
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
