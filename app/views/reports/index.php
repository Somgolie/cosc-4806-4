<?php require_once 'app/views/templates/header.php'; ?>
<div class="container mt-4">
    
    <h2>All Users</h2>
    <div class="text-center mb-4">
        <button class="btn btn-info" type="button" data-bs-toggle="collapse" data-bs-target="#chartCollapse" aria-expanded="false" aria-controls="chartCollapse">
            Show Chart
        </button>
    </div>

    <!-- Collapsible Chart Container -->
    <div class="collapse mb-4" id="chartCollapse">
        <div class="card card-body">
            <canvas id="reminderChart" height="100"></canvas>
        </div>
    </div>
    
    <div class="row">
        <?php foreach ($data['users'] as $user): ?>
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($user['username']); ?></h5>
                        <p class="card-text text-muted">
                            Reminders: <?php echo $user['reminder_count']; ?>
                            Logins: <?php echo $user['login_count']; ?>
                        </p>
                        <a href="/reports/user/<?php echo $user['id']; ?>" class="btn btn-primary btn-sm">View</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php if (!empty($topUser)): ?>
    <div class="card mt-5 border-success shadow-lg">
        <div class="card-body text-success text-center">
            <h4 class="card-title">Top Reminder User!</h4>
            <p class="card-text fs-5 mb-1">
                <strong><?php echo htmlspecialchars($topUser['username']); ?></strong> has created the most reminders!
            </p>
            <p class="mb-0">Total Reminders: <span class="fw-bold"><?php echo $topUser['reminder_count']; ?></span></p>
        </div>
    </div>
<?php endif; ?>

<?php require_once 'app/views/templates/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('reminderChart').getContext('2d');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?= json_encode(array_column($data['users'], 'username')) ?>,
      datasets: [{
        label: 'Number of Reminders',
        data: <?= json_encode(array_column($data['users'], 'reminder_count')) ?>,
        backgroundColor: 'rgba(54, 162, 235, 0.6)',
        borderColor: 'rgba(54, 162, 235, 1)',
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