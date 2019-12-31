<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body>
        <div class="flex h-screen">
            <div class="w-1/6 p-4 border-r border-gray-300 h-full bg-gray-100">
                <h2 class="text-2xl mb-4">Phil</h2>

                <form action="/user/2/weight" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="2">
                    <input type="text" name="weight" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <button type="submit">Submit</button>
                </form>

                <table class="mt-4 table-fixed w-full">
                    <thead>
                        <tr>
                            <th class="w-1/2 text-left">Date</th>
                            <th class="w-1/2 text-left">Weight</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($phil_weights as $weight)
                            <tr>
                                <td>{{ $weight->created_at->format('M d') }}</td>
                                <td>{{ $weight->weight }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="w-2/3 p-4 h-full">
                <h2 class="text-2xl mb-4">The Chart</h2>
                <div class="relative">
                    <canvas id="myChart" width="400" height="200"></canvas>
                </div>
            </div>
            <div class="w-1/6 p-4 border-l border-gray-300 h-full bg-gray-100">
                <h2 class="text-2xl mb-4">Dave</h2>

                <form action="/user/1/weight" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="1">
                    <input type="text" name="weight" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <button type="submit">Submit</button>
                </form>

                <table class="mt-4 table-fixed w-full">
                    <thead>
                    <tr>
                        <th class="w-1/2 text-left">Date</th>
                        <th class="w-1/2 text-left">Weight</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($dave_weights as $weight)
                        <tr>
                            <td>{{ $weight->created_at->format('M d') }}</td>
                            <td>{{ $weight->weight }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <script src="{{ mix('js/app.js') }}"></script>
        <script type="text/javascript">

            var config = {
                type: 'line',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                    datasets: [{
                        label: 'My First dataset',
                        backgroundColor: '#aaa',
                        borderColor: '#ccc',
                        data: [
                            201,200,202,198,196,198,198
                        ],
                        fill: false,
                    }, {
                        label: 'My Second dataset',
                        fill: false,
                        backgroundColor: '#ddd',
                        borderColor: '#eee',
                        data: [
                            201,202,200,199,198,199,197
                        ],
                    }]
                },
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Nothing'
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false,
                    },
                    hover: {
                        mode: 'nearest',
                        intersect: true
                    },
                    scales: {
                        xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Month'
                            }
                        }],
                        yAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Value'
                            }
                        }]
                    }
                }
            };

            window.onload = function() {
                var ctx = document.getElementById('myChart').getContext('2d');
                window.myLine = new Chart(ctx, config);
            };
        </script>
    </body>
</html>
