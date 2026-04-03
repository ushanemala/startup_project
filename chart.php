<?php
session_start();
include 'db.php';

$id = $_SESSION['user_id'];

// 🔥 DATE-WISE QUERY
$res = $conn->query("
SELECT date, SUM(amount) as total
FROM investments
WHERE user_id='$id'
GROUP BY date
ORDER BY date
");

$labels = [];
$data = [];

while($row = $res->fetch_assoc()){
    $labels[] = $row['date'];
    $data[] = $row['total'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Date-wise Investment</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>Menu</h2>
    <a href="dashboard.php">Dashboard</a>
    <a href="add.php">Add Investment</a>
    <a href="view.php">View</a>
    <a href="chart.php">Charts</a>
    <a href="fund_usage.php">Fund Usage</a>
    <a href="logout.php">Logout</a>
</div>

<div class="main">
    <h2>Date-wise Investment Chart</h2>

    <div class="chart-box">
        <canvas id="lineChart"></canvas>
    </div>
</div>

<script>
const ctx = document.getElementById('lineChart');

new Chart(ctx, {
    type: 'line', // 🔥 LINE GRAPH (best for dates)
    data: {
        labels: <?php echo json_encode($labels); ?>,
        datasets: [{
            label: 'Investment Amount',
            data: <?php echo json_encode($data); ?>,
            borderColor: '#5a78ff',
            backgroundColor: 'rgba(90,120,255,0.2)',
            fill: true,
            tension: 0.3
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: true
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

</body>
</html>