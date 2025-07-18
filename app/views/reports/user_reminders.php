<?php require_once 'app/views/templates/header.php'; ?>
<div class="container mt-4">
    <h2><?php echo htmlspecialchars($data['username']); ?>'s Reminders</h2>
    <a href="/reports" class="btn btn-secondary btn-sm mb-3">← Back to Users</a>

    <?php foreach ($data['reminders'] as $reminder): ?>
        <div class="card mb-3 bg-light">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-1"><?php echo htmlspecialchars($reminder['subject']); ?></h5>
                    <p class="card-text mb-0">
                        Created at: <?php echo htmlspecialchars($reminder['time_created']); ?><br>
                        Completed at: 
                        <?php
                        echo $reminder['completed'] && !empty($reminder['time_completed'])
                            ? htmlspecialchars($reminder['time_completed'])
                            : 'UNFINISHED';
                        ?>
                    </p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <?php if (empty($data['reminders'])): ?>
        <p>No reminders found for this user.</p>
    <?php endif; ?>
</div>
<?php require_once 'app/views/templates/footer.php'; ?>
