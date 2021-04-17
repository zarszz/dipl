<script>
    let barangsOnGudang = null;

    $(document).ready(function() {
        const data = [
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
        barangsOnGudang = createTable('#table_barang_on_gudang', '{{ route('user.gudangs.barangs.ajax', ['user_id' => auth()->user()->id, 'id' => request()->route('id')]) }}', data);
    });

    $(document).on('click', '#userTarikBarangOnGudang', function() {
        var tr = $(this).closest('tr');
        var barang = barangsOnGudang.row(tr).data();
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
                    barangsOnGudang.ajax.reload();
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

</script>
