<?php require_once 'app/views/templates/header.php'; ?>
<div class="container">
    <div class="page-header mb-4">
        <h1>Edit Reminder</h1>
    </div>

    <?php 
    session_start();
    if (!isset($_SESSION['auth']) || !$_SESSION['auth']) {
        echo "<p>Please <a href='/login' style='color: blue;'>log in</a> to edit reminders.</p>";
        exit;
    }

    if (!empty($_SESSION['edit_message'])) {
        echo "<div class='alert alert-info'>" . htmlspecialchars($_SESSION['edit_message']) . "</div>";
        unset($_SESSION['edit_message']);
    }

    $reminder = $data['reminder'] ?? null;
    if (!$reminder) {
        echo "<p>Reminder not found.</p>";
        exit;
    }
    ?>

    <form action="/reminders/update/<?php echo htmlspecialchars($reminder['id']); ?>" method="POST">
        <div class="mb-3">
            <label for="subject" class="form-label">Reminder Subject</label>
            <input type="text" class="form-control" name="subject" id="subject" value="<?php echo htmlspecialchars($reminder['subject']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="/reminders" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<?php require_once 'app/views/templates/footer.php'; ?>
