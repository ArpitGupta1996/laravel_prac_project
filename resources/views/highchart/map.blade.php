<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://code.highcharts.com/maps/highmaps.js"></script>
    <script src="https://code.highcharts.com/maps/modules/exporting.js"></script>


</head>

<style>
    #container {
    height: 500px;
    min-width: 310px;
    max-width: 800px;
    margin: 0 auto;
}

.loading {
    margin-top: 10em;
    text-align: center;
    color: gray;
}
</style>

<body>
    <div id="container"></div>
</body>

<script>
    (async () => {

        const topology = await fetch(
            'https://code.highcharts.com/mapdata/countries/in/in-all.topo.json'
        ).then(response => response.json());

        // Prepare demo data. The data is joined to map using value of 'hc-key'
        // property by default. See API docs for 'joinBy' for more info on linking
        // data and map.
        const data = [
            ['in-py', 10],
            ['in-ld', 11],
            ['in-wb', 12],
            ['in-or', 13],
            ['in-br', 14],
            ['in-sk', 15],
            ['in-ct', 16],
            ['in-tn', 17],
            ['in-mp', 18],
            ['in-2984', 19],
            ['in-ga', 20],
            ['in-nl', 21],
            ['in-mn', 22],
            ['in-ar', 23],
            ['in-mz', 24],
            ['in-tr', 25],
            ['in-3464', 26],
            ['in-dl', 27],
            ['in-hr', 28],
            ['in-ch', 29],
            ['in-hp', 30],
            ['in-jk', 31],
            ['in-kl', 32],
            ['in-ka', 33],
            ['in-dn', 34],
            ['in-mh', 35],
            ['in-as', 36],
            ['in-ap', 37],
            ['in-ml', 38],
            ['in-pb', 39],
            ['in-rj', 40],
            ['in-up', 41],
            ['in-ut', 42],
            ['in-jh', 43]
        ];

        // Create the chart
        Highcharts.mapChart('container', {
            chart: {
                map: topology
            },

            title: {
                text: 'Audit Score and Count'
            },

            // subtitle: {
            //     text: 'Source map: <a href="http://code.highcharts.com/mapdata/countries/in/in-all.topo.json">India</a>'
            // },

            mapNavigation: {
                enabled: true,
                buttonOptions: {
                    verticalAlign: 'bottom'
                }
            },

            colorAxis: {
                min: 0
            },

            series: [{
                data: data,
                name: 'Audit Count',
                states: {
                    hover: {
                        color: '#BADA55'
                    }
                },
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            }]
        });

    })();
</script>

</html>
