<?php
include 'config.php';

$get_datagraph = mysqli_query($conn, "SELECT * FROM `products`") or die('query graph failed');

$dataPoints = array();

if (mysqli_num_rows($get_datagraph) > 0) {
    while ($fetch_datagraph = mysqli_fetch_assoc($get_datagraph)) {
        $x = $fetch_datagraph['id']; // Convert x_value to a string
        $y = $fetch_datagraph['pro_rates']; // Convert y_value to an integer
        $dataPoint = array("x" => $x, "y" => $y);
        $dataPoints[] = $dataPoint;
    }
}

?>

<!DOCTYPE HTML>
<html>

<head>
    <script>
        window.onload = function () {
            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                exportEnabled: true,
                theme: "light1", // "light1", "light2", "dark1", "dark2"
                title: {
                    text: "Products VS Rates"
                },
                axisY: {
                    includeZero: true
                },
                data: [{
                    type: "column", //change type to column, bar, line, area, pie, etc
                    indexLabelFontColor: "#5A5757",
                    indexLabelPlacement: "outside",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();
        }
    </script>
</head>

<body>
    <div id="chartContainer" style="height: 370px; width: 90%;"></div>
    <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>

</html>