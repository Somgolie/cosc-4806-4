<?php require_once '../app/views/includes/header.php'; ?>

<div class="container mt-4">
  <h2>User Reminder Report</h2>
  <div class="row row-cols-1 row-cols-md-3 g-4 mt-3">
    <?php foreach ($data['userReminders'] as $row): ?>
      <div class="col">
        <div class="card shadow-sm h-100">
          <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($row['username']) ?></h5>
            <p class="card-text"><?= $row['count'] ?> reminders</p>
            <a href="/reports/user/<?= urlencode($row['username']) ?>" class="btn btn-primary">View Reminders</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>