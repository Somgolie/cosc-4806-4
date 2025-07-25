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
        <h3 class="mt-4">Review Overview:</h3>
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
            <select name="rating" id="rating" class="form-select" required>
              <option value="">--Choose--</option>
              <?php for ($i = 1; $i <= 5; $i++): ?>
                <option value="<?= $i ?>"><?= $i ?></option>
              <?php endfor; ?>
            </select>
          </div>
          <div class="col-auto">
            <button type="submit" class="btn btn-outline-light">Submit Rating</button>
          </div>
        </div>
      </form>
    <?php else: ?>
      <p><em>Login to rate this movie.</em></p>
    <?php endif; ?>

    <?php if (!empty($user_ratings)): ?>
      <ul class="list-group">
        <?php foreach ($user_ratings as $ur): ?>
          <li class="list-group-item bg-dark text-light">
            <?= htmlspecialchars($ur['username']) ?> rated: <?= htmlspecialchars($ur['rating']) ?>/5
          </li>
        <?php endforeach; ?>
      </ul>
    <?php else: ?>
      <p>No user ratings yet.</p>
    <?php endif; ?>
  </div>
</div>

<?php require_once 'app/views/templates/footer.php'; ?>
