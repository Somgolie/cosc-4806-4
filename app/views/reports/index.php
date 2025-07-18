<?php


require_once 'app/views/templates/header.php';
?>

<div class="container">
    <div class="page-header d-flex justify-content-between align-items-center mb-4">
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Reports</li>
                    </ol>
                </nav>
                <h1>Reports</h1>
            </div>
        </div>
    </div>

    <?php 
    $reminders = $data['reminders'] ?? [];
    if (!empty($reminders)) {
        foreach ($reminders as $reminder) {
            ?>
            <div class="card mb-3 bg-info bg-opacity-10">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-1">
                            <?php echo htmlspecialchars($reminder['subject']); ?>
                            <small class="text-muted">by <?php echo htmlspecialchars($reminder['username']); ?></small>
                        </h5>
                        <p class="card-text mb-0">
                            Created at: <?php echo htmlspecialchars($reminder['time_created']); ?><br>
                            Completed at: 
                            <?php
                            if ($reminder['completed'] && !empty($reminder['time_completed'])) {
                                echo htmlspecialchars($reminder['time_completed']);
                            } else {
                                echo "UNFINISHED";
                            }
                            ?>
                        </p>
                    </div>
                    <div>
                    </div>
                </div>
            </div>
            <?php
        }
    } else {
        echo "<p>No reminders found.</p>";
    }
    ?>

</div>

<?php require_once 'app/views/templates/footer.php'; ?>
