<?php require_once 'app/views/templates/header.php'; ?>
<div class="container mt-4">
    <h2>All Users</h2>
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
<?php require_once 'app/views/templates/footer.php'; ?>
