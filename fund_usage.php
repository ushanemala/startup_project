<?php
session_start();
include 'db.php';

$id = $_SESSION['user_id'];

$res = $conn->query("
SELECT usage_type, SUM(amount) as total
FROM investments
WHERE user_id='$id'
GROUP BY usage_type
");

// store data in arrays
$labels = [];
$data = [];

while($row = $res->fetch_assoc()){
    $labels[] = $row['usage_type'];
    $data[] = $row['total'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Fund Usage</title>
    <link rel="stylesheet" href="style.css">

    <!-- 🔥 CHART.JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>Menu</h2>
    <a href="dashboard.php">Dashboard</a>
    <a href="add.php">Add Investment</a>
    <a href="view.php">View</a>
    <a href="investor.php">Investors</a>
    <a href="startup.php">Startups</a>
    <a href="fund_usage.php">Fund Usage</a>
    <a href="logout.php">Logout</a>
</div>

<div class="main">
    <h2>Fund Usage</h2>

    <!-- TEXT DATA -->
    <?php
    for($i=0; $i<count($labels); $i++){
        echo "<p>".$labels[$i]." - ₹".$data[$i]."</p>";
    }
    ?>

    <!-- PIE CHART -->
    <canvas id="myChart" width="400" height="400"></canvas>

</div>

<script>
const ctx = document.getElementById('myChart');


new Chart(ctx, {
    type: 'doughnut', // 🔥 donut style
    data: {
        labels: <?php echo json_encode($labels); ?>,
        datasets: [{
            data: <?php echo json_encode($data); ?>,
            backgroundColor: [
                '#36A2EB',
                '#FF6384',
                '#FFCE56'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        cutout: '60%', // 🔥 donut hole size
        animation: {
            animateScale: true,
            animateRotate: true
        },
        plugins: {
            legend: {
                position: 'top'
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        let total = context.dataset.data.reduce((a, b) => a + b, 0);
                        let value = context.raw;
                        let percentage = ((value / total) * 100).toFixed(1);
                        return context.label + ": ₹" + value + " (" + percentage + "%)";
                    }
                }
            }
        }
    }
});
Chart.register({
    id: 'centerText',
    beforeDraw(chart) {
        const {width, height, ctx} = chart;
        ctx.restore();
        ctx.font = "16px Arial";
        ctx.textAlign = "center";
        ctx.textBaseline = "middle";
        ctx.fillText("Fund Usage", width / 2, height / 2);
        ctx.save();
    }
});


</script>

</body>
</html>