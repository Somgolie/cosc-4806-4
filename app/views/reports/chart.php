<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Reminders Chart</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-5 bg-light">
  <div class="container">
    <h1 class="mb-4 text-center">Reminders per User</h1>
    <canvas id="reminderChart" height="100"></canvas>
  </div>

  <script>
    const ctx = document.getElementById('reminderChart').getContext('2d');

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: <?= json_encode(array_column($reminderData, 'username')) ?>,
        datasets: [{
          label: 'Number of Reminders',
          data: <?= json_encode(array_column($reminderData, 'reminder_count')) ?>,
          backgroundColor: 'rgba(75, 192, 192, 0.6)',
          borderColor: 'rgba(75, 192, 192, 1)',
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true,
            ticks: { stepSize: 1 }
          }
        }
      }
    });
  </script>
</body>
</html>