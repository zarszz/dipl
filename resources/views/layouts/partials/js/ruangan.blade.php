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
