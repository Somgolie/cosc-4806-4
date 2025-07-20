<?php require_once 'app/views/templates/header.php'; ?>

<div class="container my-5">
  <div class="bg-info text-white p-5 rounded shadow-sm mb-4">
    <h1 class="display-4">Welcome <?= htmlspecialchars($_SESSION['username'] ?? 'Guest'); ?>!</h1>
    <p class="lead"><?= date("F jS, Y"); ?></p>
  </div>

  <!-- placeholder content -->
  <div class="row">
    <div class="col-md-6 mb-4">
      <div class="card border-light shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Quick Action</h5>
          <p class="card-text">Let's start managing your reminders! Never miss a deadline again :)</p>
          <a href="/reminders" class="btn btn-outline-primary">Go to Reminders</a>
        </div>
      </div>
    </div>
    <div class="col-md-6 mb-4">
      <div class="card border-light shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Need Help?</h5>
          <p class="card-text">Visit our help page or contact our manager.</p>
          <a href="#" class="btn btn-outline-secondary">Help Center</a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require_once 'app/views/templates/footer.php'; ?>
