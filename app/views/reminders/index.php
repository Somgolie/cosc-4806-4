<?php require_once 'app/views/templates/header.php' ?>
<?php
session_start();  // Only if session isn’t already started earlier
$user_id = $_SESSION['user_id'] ?? null;


?>
<div class="container">
    <div class="page-header">
        <h1>My Reminders</h1>
        <h1 class="display-4">Welcome <?= htmlspecialchars($_SESSION['username'] ?? 'Guest'); ?>!</h1>
    </div>
    <?php 


    $user_id = $_SESSION['user_id'] ?? null;

    $reminders = $data['reminders'] ?? [];

    $found = false; // track if any reminders shown

    foreach ($reminders as $reminder) {
        if ($reminder['user_id'] == $user_id) { // filter by logged-in user
            echo "<p>" . htmlspecialchars($reminder['subject']) . " update delete </p>";
            $found = true;
        }
    }

    if (!$found) {
        echo "<p>No reminders found.</p>";
    }
    
    ?>
</div>
<?php require_once 'app/views/templates/footer.php' ?>