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
                <div class="card-body d-flex justify-content-between align-items-center">
                   <div>
                        <h5 class="card-title mb-1"><?php echo htmlspecialchars($reminder['subject']); ?></h5>
                        <p class="card-text mb-0">
                            Created at: <?php echo htmlspecialchars($reminder['time_created']); ?>
                        </p>
                        <a href="/reminders/edit/<?php echo htmlspecialchars($reminder['id']); ?>"
                            class="btn btn-primary btn-sm mt-2">Update</a>
                        <a href="/reminders/delete/<?php echo htmlspecialchars($reminder['id']); ?>" 
                            class="btn btn-danger btn-sm mt-2" onclick="return confirm('Are you sure you want to delete this reminder?');">
                            Delete</a>
                    </div>
                    <div>
                        <form action="/reminders/mark_complete/<?php echo htmlspecialchars($reminder['id']); ?>" 
                            method="POST" class="mb-0">
                            <input type="hidden" name="toggle" value="1">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="completed" onchange="this.form.submit();"
                                    <?php echo $reminder['completed'] ? 'checked' : ''; ?>>
                                <label class="form-check-label">
                                    Complete
                                </label>
                            </div>
                        </form>
                    </div>
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
