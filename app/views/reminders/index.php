<?php require_once 'app/views/templates/header.php'; ?>
<div class="container">
    <div class="page-header d-flex justify-content-between align-items-center mb-4">
        <h1>My Reminders</h1>
        <a href="/reminders/create" class="btn btn-success">Create Reminder</a>
    </div>

    <?php 
    session_start();

    $user_id = $_SESSION['user_id'] ?? null;

    if (!$user_id) {
        echo "<p>Please <a href='login' style='color: blue;'>log in</a> to view reminders.</p>";
        exit;
    }

    $reminders = $data['reminders'] ?? [];
    $found = false;

    foreach ($reminders as $reminder) {
        if ($reminder['user_id'] == $user_id) {
            $found = true;
            ?>
            <div class="card mb-3 bg-info bg-opacity-10">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($reminder['subject']); ?></h5>
                    <p class="card-text">
                        Created at: <?php echo htmlspecialchars($reminder['time_created']); ?>
                    </p>
                    <a href="/reminders/edit/<?php echo htmlspecialchars($reminder['id']); ?>" class="btn btn-primary">Update</a>
                    <a href="/reminders/delete/<?php echo htmlspecialchars($reminder['id']); ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this reminder?');">Delete</a>
                </div>
            </div>
            <?php
        }
    }

    if (!$found) {
        echo "<p>No reminders found.</p>";
    }
    ?>
        <?php require_once 'app/views/templates/footer.php'; ?>
</div>
