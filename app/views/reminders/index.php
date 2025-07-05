<?php require_once 'app/views/templates/header.php'; ?>
<div class="container">
    <div class="page-header">
        <h1>My Reminders</h1>
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
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($reminder['subject']); ?></h5>
                    <p class="card-text">
                        Created at: <?php echo htmlspecialchars($reminder['time_created']); ?>
                    </p>
                    <a href="#" class="btn btn-primary">Update</a>
                    <a href="#" class="btn btn-danger">Delete</a>
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
