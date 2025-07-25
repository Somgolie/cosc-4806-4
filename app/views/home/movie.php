<?php require_once 'app/views/templates/header.php'; ?>
<style>
  body {
    background-color: #f5f5dc;
    color: #000;
  }

  .movie-container p,
  .movie-container h1,
  .movie-container h3,
  .movie-container li,
  .movie-container label {
    color: #000 !important;
  }

  select,
  input,
  button {
    color: #000;
  }

  .list-group-item {
    background-color: #fffbe6; /* light cream for contrast */
    color: #000;
  }
</style>

<div class="container py-5">
  <div class="row">
    <div class="col-md-4 text-center mb-4">
      <img src="<?= $movie['Poster'] ?>" alt="Poster" class="img-fluid rounded shadow">
    </div>
    <div class="col-md-8">
      <h1 class="mb-3"><?= $movie['Title'] ?> (<?= $movie['Year'] ?>)</h1>
      <p><strong>Genre:</strong> <?= htmlspecialchars($movie['Genre']) ?></p>
      <p><strong>Plot:</strong> <?= htmlspecialchars($movie['Plot']) ?></p>
      <p><strong>Actors:</strong> <?= htmlspecialchars($movie['Actors']) ?></p>

      <?php if (isset($average_rating)): ?>
        <p><strong>Average Rating:</strong> <?= $average_rating ?>/5</p>
      <?php else: ?>
        <p><strong>Average Rating:</strong> No ratings yet.</p>
      <?php endif; ?>

      <?php if (!empty($review)): ?>
        <h3 class="mt-4">Audience Overview:</h3>
        <p><?= nl2br(htmlspecialchars($review)) ?></p>
      <?php else: ?>
        <p><em>No AI review available.</em></p>
      <?php endif; ?>
    </div>
  </div>

  <hr class="my-5">

  <div class="mt-4">
    <h3>User Ratings:</h3>

    <?php if (isset($_SESSION['username'])): ?>
      <form method="post" action="/omdb/rate" class="mb-4">
        <input type="hidden" name="movie" value="<?= htmlspecialchars($movie['Title']) ?>">
        <div class="row g-2 align-items-center">
          <div class="col-auto">
            <label for="rating" class="col-form-label">Rate this movie:</label>
          </div>
          <div class="col-auto">
            <select name="rating" id="rating" class="form-select form-select-lg rounded-pill border-dark bg-light text-dark" style="min-width: 150px;" required>
              <option value="" disabled selected>Rate (1–5)</option>
              <?php for ($i = 1; $i <= 5; $i++): ?>
                <option value="<?= $i ?>"><?= $i ?> Star<?= $i > 1 ? 's' : '' ?></option>
              <?php endfor; ?>
            </select>
          </div>
          <div class="col-auto">
            <button type="submit" class="btn btn-dark px-4 py-2 rounded-pill">Submit Rating</button>
          </div>
        </div>
      </form>
    <?php else: ?>
      <p><em>Login to rate this movie.</em></p>
    <?php endif; ?>

    <?php if (!empty($user_ratings)): ?>
      <div class="row">
        <?php foreach ($user_ratings as $ur): ?>
          <div class="col-md-6 mb-4">
            <div class="card bg-dark text-light border-light h-100">
              <div class="card-body">
                <h5 class="card-title">
                  <?= htmlspecialchars($ur['username']) ?> rated: 
                  <?php for ($i = 0; $i < $ur['rating']; $i++): ?>
                    <i class="bi bi-star-fill text-warning"></i>
                  <?php endfor; ?>
                  <?php for ($i = $ur['rating']; $i < 5; $i++): ?>
                    <i class="bi bi-star text-secondary"></i>
                  <?php endfor; ?>
                </h5>
                <p class="card-text mt-2"><?= nl2br(htmlspecialchars($ur['review'] ?? '')) ?></p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>


      <p>No user ratings yet.</p>
    <?php endif; ?>
  </div>
</div>

<?php require_once 'app/views/templates/footer.php'; ?>
