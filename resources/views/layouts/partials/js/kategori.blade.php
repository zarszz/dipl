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
