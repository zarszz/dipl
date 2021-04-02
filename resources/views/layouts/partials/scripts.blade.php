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
@endif

<script>
    function createTable(tableID, url, data) {
        return $(tableID).DataTable({
            processing: true,
            serverSide: true,
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
                    data: 'Actions',
                    name: 'Actions',
                    orderable: false,
                    serachable: false,
                    sClass: 'text-center'
                },
            ]
            userTable = createTable('#table1', '{{ route('users.index') }}', data)
            // userTable = $('#table1').DataTable({
            //     processing: true,
            //     serverSide: true,
            //     autoWidth: true,
            //     "order": [
            //         [0, "desc"]
            //     ],
            //     ajax: {
            //         url: '{{ route('users.index') }}'
            //     },
            //     columns: [{
            //             data: 'nama',
            //             'name': 'nama'
            //         },
            //         {
            //             data: 'email',
            //             'name': 'email'
            //         },
            //         {
            //             data: 'jenis_kelamin',
            //             'name': 'jenis_kelamin'
            //         },
            //         {
            //             data: 'Actions',
            //             name: 'Actions',
            //             orderable: false,
            //             serachable: false,
            //             sClass: 'text-center'
            //         },
            //     ]
            // });
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
        })

    </script>
@endif
<script>
    $('#datetimepicker').datetimepicker();

</script>

@livewireScripts
<script src="{{ asset('/js/main.js') }}"></script>

{{ $script ?? '' }}
