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
