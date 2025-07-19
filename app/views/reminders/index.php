<?php require_once 'app/views/templates/header.php'; ?>
<div class="container">
    <?php
    session_start();

    $toastClasses = [
      'create_message' => 'bg-success',
      'edit_message' => 'bg-info',
      'delete_message' => 'bg-danger',
      'complete_message' => 'bg-warning',
    ];

    $toastMessages = [];
    foreach ($toastClasses as $key => $class) {
        if (!empty($_SESSION[$key])) {
            $toastMessages[] = [
                'message' => $_SESSION[$key],
                'class' => $class
            ];
            unset($_SESSION[$key]);
        }
    }
    ?>

    <?php if (!empty($toastMessages)): ?>
      <div class="position-fixed top-0 end-0 p-3" style="z-index: 1080;">
        <?php foreach ($toastMessages as $index => $toast): ?>
          <div id="toast-<?php echo $index; ?>" 
               class="toast align-items-center text-white <?php echo $toast['class']; ?> border-0 mb-2" 
               role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
              <div class="toast-body">
                <?php echo htmlspecialchars($toast['message']); ?>
              </div>
              <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
    <div class="page-header d-flex justify-content-between align-items-center mb-4">
        <div class="row">
            <div class="col-lg-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Reminders</li>
                    </ol>
                </nav>
        <h1>My Reminders</h1>
                </div>
        </div>
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
                        <a href="/reminders/edit/<?php echo htmlspecialchars($reminder['id']); ?>" class="btn btn-primary btn-sm                                 mt-2">Update</a>
                        <a href="/reminders/delete/<?php echo htmlspecialchars($reminder['id']); ?>" class="btn btn-danger btn-sm                                 mt-2" onclick="return confirm('Are you sure you want to delete this reminder?');">Delete</a>
                    </div>
                    <div>
                        <form action="/reminders/mark_complete/<?php echo htmlspecialchars($reminder['id']); ?>" method="POST"                                     class="mb-0">
                            <input type="hidden" name="toggle" value="1">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="completed" onchange="this.form.submit();" <?php echo $reminder['completed'] ? 'checked' : ''; ?>>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        var toastEls = document.querySelectorAll('.toast');
        toastEls.forEach(function(toastEl) {
          var toast = new bootstrap.Toast(toastEl);
          toast.show();
        });
      });
    </script>
</div>
