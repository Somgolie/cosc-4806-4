<?php require_once 'app/views/templates/header.php'; ?>
<style>
  body {
    background-color: #f5f5dc; /* cream */
    color: #000;
  }

  .movie-container p,
  .movie-container h1,
  .movie-container h3,
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
  .card.bg-dark .card-text {
    color: #f8f9fa !important;
  }
</style>

<div class="container py-5 movie-container">
  <div class="row">
    <div class="col-md-4 text-center mb-4">
      <img src="<?= htmlspecialchars($movie['Poster']) ?>" alt="Poster" class="img-fluid rounded shadow">
    </div>
    <div class="col-md-8">
      <h1 class="mb-3"><?= htmlspecialchars($movie['Title']) ?> (<?= htmlspecialchars($movie['Year']) ?>)</h1>
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
    <input type="hidden" name="rating" id="rating" required>

    <div class="row g-2 align-items-center">
      <div class="col-auto">
        <label for="rating" class="col-form-label">Rate this movie:</label>
      </div>

      <div id="star-rating" class="mb-3" style="font-size: 2rem; cursor: pointer; color: #ffc107;">
        <i class="bi bi-star" data-value="1"></i>
        <i class="bi bi-star" data-value="2"></i>
        <i class="bi bi-star" data-value="3"></i>
        <i class="bi bi-star" data-value="4"></i>
        <i class="bi bi-star" data-value="5"></i>
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
        <?php
          // Prepare rating counts for chart
          $rating_counts = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
          foreach ($user_ratings as $ur) {
              $r = intval($ur['rating']);
              if ($r >= 1 && $r <= 5) {
                  $rating_counts[$r]++;
              }
          }
        ?>
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
                <p class="card-text mt-2 text-light"><?= nl2br(htmlspecialchars($ur['review'] ?? '')) ?></p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <h3 class="mt-5">Rating Distribution</h3>
      <div class="w-100 w-md-50" style="max-width: 400px;">
        <canvas id="ratingChart"></canvas>
      </div>
    <?php else: ?>
      <p>No user ratings yet.</p>
    <?php endif; ?>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('ratingChart').getContext('2d');
  const ratingData = {
    labels: ['1 Star', '2 Stars', '3 Stars', '4 Stars', '5 Stars'],
    datasets: [{
      label: 'Number of Ratings',
      data: <?= json_encode(array_values($rating_counts)) ?>,
      backgroundColor: [
        '#dc3545', // red
        '#fd7e14', // orange
        '#ffc107', // yellow
        '#198754', // green
        '#0d6efd'  // blue
      ],
      borderWidth: 1
    }]
  };

  const config = {
    type: 'bar',
    data: ratingData,
    options: {
      scales: {
        y: {
          beginAtZero: true,
          precision: 0
        }
      },
      plugins: {
        legend: {
          display: false
        }
      }
    }
  };

  new Chart(ctx, config);

  const stars = document.querySelectorAll('#star-rating i');
  const ratingInput = document.getElementById('rating');

  stars.forEach(star => {
    star.addEventListener('click', () => {
      const val = star.getAttribute('data-value');
      ratingInput.value = val;

      // Reset all stars to empty
      stars.forEach(s => s.classList.replace('bi-star-fill', 'bi-star'));

      // Fill stars up to clicked one
      for(let i = 0; i < val; i++) {
        stars[i].classList.replace('bi-star', 'bi-star-fill');
      }
    });
  });
</script>

<?php require_once 'app/views/templates/footer.php'; ?>
