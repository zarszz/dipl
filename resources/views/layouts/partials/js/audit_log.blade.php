<script>
    let auditLogsTable = null;
    const FROM_PATTERN = 'YYYY-MM-DD HH:mm:ss.SSS';
    const TO_PATTERN = 'DD/MM/YYYY HH:mm';
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
                data: 'kode_barang',
                'name': 'Kode Barang'
            },
            {
                data: 'kode_gudang',
                'name': 'Kode Gudang'
            },
            {
                data: 'aksi',
                'name': 'Aksi'
            },
            {
                data: 'keterangan',
                'name': 'Keterangan'
            },
            {
                data: 'created_at',
                'namw': 'Waktu',
                render: (data) => { return new Date(data).toLocaleString('id-ID') },
                targets: 1
            }
        ]
        auditLogsTable = createTable('#table_audit_log', '{{ route('audit_logs') }}', data);
        setInterval(auditLogsTable.ajax.reload, 2500);
    });

</script>
