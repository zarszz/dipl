<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

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
