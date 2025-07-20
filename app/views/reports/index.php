<?php require_once 'app/views/templates/header.php'; ?>
<div class="container mt-4">
    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Reports</li>
        </ol>
    </nav>
    <h2>All Users</h2>

    <!-- Chart!  -->
    <div class="mb-4">
        <div class="card card-body" style="overflow-x: auto; min-height: 350px; max-width: 100%;">
            <canvas id="reminderChart" style="min-width: 900px; height: 350px;"></canvas>
        </div>
    </div>

    <!-- User Cards -->
    <div class="row">
        <?php foreach ($data['users'] as $user): ?>
            <div class="col-md-4">
                <div class="card mb-3 shadow">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($user['username']); ?></h5>
                        <p class="card-text text-muted mb-2">
                            Reminders: <?php echo $user['reminder_count']; ?><br>
                            Logins: <?php echo $user['login_count']; ?>
                        </p>
                        <a href="/reports/user/<?php echo $user['id']; ?>" class="btn btn-skyblue">View</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Top Reminder Card -->
<?php if (!empty($topUser)): ?>
    <div class="card mt-5 border-success shadow-lg">
        <div class="card-body text-success text-center">
            <h4 class="card-title">
                <p class="card-text fs-5 mb-1">
                    <strong><?php echo htmlspecialchars($topUser['username']); ?></strong> has created the most reminders!
                </p>
            </h4>
  
            <p class="mb-0">Total Reminders: <span class="fw-bold"><?php echo $topUser['reminder_count']; ?></span></p>
        </div>
    </div>
<?php endif; ?>

<?php require_once 'app/views/templates/footer.php'; ?>

<!-- Bootstrap JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Chart Script -->
<script>
    const ctx = document.getElementById('reminderChart').getContext('2d');

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: <?= json_encode(array_column($data['users'], 'username')) ?>,
        datasets: [
              {
                label: 'Number of Reminders',
                data: <?= json_encode(array_column($data['users'], 'reminder_count')) ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
              },
              {
                label: 'Number of Logins',
                data: <?= json_encode(array_column($data['users'], 'login_count')) ?>,
                backgroundColor: 'rgba(255, 206, 86, 0.6)',
                borderColor: 'rgba(255, 206, 86, 1)',
                borderWidth: 1
              }
            ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
          y: {
            beginAtZero: true,
            ticks: { stepSize: 1 }
          }
        },
        plugins: {
          legend: { display: true },
          tooltip: { enabled: true }
        }
      }
    });


</script>

<!-- Styling -->
<style>
    #reminderChart {
        min-width: 600px;
        min-height: 300px;
    }
    
    .btn-skyblue {
      background-color: #87CEEB;
      border-color: #87CEEB;
      color: white;
    }
    .btn-skyblue:hover {
      background-color: #6bbadf;
      border-color: #6bbadf;
      color: white;
    }
   
</style>
