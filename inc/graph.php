<div class="w-100 mt-3">
<canvas id="graphCanvas"></canvas>
</div>

<script>
        $(document).ready(function () {
            showGraph();
        });


        function showGraph()
        {
            {
                $.post("data.php",
                function (data)
                {
                    console.log(data);
                     var name = [];
                    var marks = [];

                    for (var i in data) {
                        name.push(data[i].date);
                        marks.push(data[i].times);
                    }

                    var chartdata = {
                        labels: name,
                        datasets: [
                            {
                                label: 'Views',
                                backgroundColor: 'transparent',
                                borderColor: '#1a001a',
                                hoverBackgroundColor: 'transparent',
                                hoverBorderColor: '#dc3545',
                                data: marks
                            }
                        ]
                    };

                    var graphTarget = $("#graphCanvas");

                    var barGraph = new Chart(graphTarget, {
                        type: 'line',
                        data: chartdata
                    });
                });
            }
        }
        </script>
