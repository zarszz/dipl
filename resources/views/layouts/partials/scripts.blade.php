<script src="{{ mix('js/app.js') }}"></script>

<script src="{{ asset('/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('/vendors/tinymce/tinymce.min.js') }}"></script> --}}


<script src="{{ asset('/js/extensions/sweetalert2.js')}}"></script>
<script src="{{ asset('/vendors/sweetalert2/sweetalert2.all.min.js')}}"></script>

<!-- jQuery -->
<script type="text/javascript" src="{{ asset('js/jquery-3.4.1.min.js') }} "></script>

<!--Datatables -->
<script type="text/javascript" src="{{ asset('js/pdfmake.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/vfs_fonts.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/datatables.min.js') }}"></script>
<script>
    $(document).ready(function () {
        let table = $('#table1').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: true,
            "order": [[0, "desc"]],
            ajax: {
                url: '{{ route('users.index') }}'
            },
            columns: [
                {data: 'email', 'name': 'email'},
                {data: 'nama', 'name': 'nama'},
                {data: 'Actions', name: 'Actions',orderable:false,serachable:false,sClass:'text-center'},
            ]
    });
})
    </script>

@livewireScripts
<script src="{{ asset('/js/main.js') }}"></script>

{{ $script ?? ''}}
