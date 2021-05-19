<script>
    var options = {
        annotations: {
            position: 'back'
        },
        dataLabels: {
            enabled: false
        },
        chart: {
            type: 'bar',
            height: 300
        },
        fill: {
            opacity: 1
        },
        plotOptions: {},
        series: [],
        colors: '#435ebe',
        xaxis:{
            type: 'String'
        },
        yaxis: {
            type: 'Integer'
        }
    }


    var chart = new ApexCharts(
        document.querySelector("#chart-distribusi-barang"),
        options
    );

    chart.render();

    var url = "{{ ENV('APP_URL') }}/dashboard/gudang/barang";
    $.getJSON(url, function(response) {
        chart.updateSeries([{
            name: 'Jumlah Barang',
            data: response
        }]);
    });
    $(document).on('click', '#prosesTicket', function() {
        var col = $(this);
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
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil.'
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
