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
        document.querySelector("#chart-profile-visit"),
        options
    );

    chart.render();

    var url = "{{ ENV('APP_URL') }}/dashboard/gudang/barang";
    $.getJSON(url, function(response) {
        chart.updateSeries([{
            name: 'Sales',
            data: response
        }])
    });

</script>
