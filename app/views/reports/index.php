<?php require_once 'app/views/templates/header.php'; ?>
<div class="container mt-4">

    <h2>All Users</h2>

    <!-- Chart Always Visible -->
    <div class="mb-4">
        <div class="card card-body" style="overflow-x: auto; min-height: 350px;">
            <canvas id="reminderChart" height="100"></canvas>
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
                        <a href="/reports/user/<?php echo $user['id']; ?>" class="btn btn-primary btn-sm">View</a>
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
            <h4 class="card-title">Top Reminder User!</h4>
            <p class="card-text fs-5 mb-1">
                <strong><?php echo htmlspecialchars($topUser['username']); ?></strong> has created the most reminders!
            </p>
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
            datasets: [{
                label: 'Number of Reminders',
                data: <?= json_encode(array_column($data['users'], 'reminder_count')) ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            indexAxis: 'y', // <-- Makes it horizontal
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
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

<!-- Optional Chart Styling -->
<style>
    #reminderChart {
        min-width: 600px;
        min-height: 300px;
    }
</style>
