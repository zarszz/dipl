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

    table_barang_on_gudang

</script>
