<h1><?= $movie['Title'] ?> (<?= $movie['Year'] ?>)</h1>
<img src="<?= $movie['Poster'] ?>" alt="Poster" width="200">
<p><strong>Plot:</strong> <?= $movie['Plot'] ?></p>
<p><strong>Director:</strong> <?= $movie['Director'] ?></p>
<p><strong>Genre:</strong> <?= $movie['Genre'] ?></p>
<p><strong>IMDb Rating:</strong> <?= $movie['imdbRating'] ?>/10</p>

<h2>Rate this Movie</h2>
<form method="POST" action="/omdb/rate">
  <input type="hidden" name="movie" value="<?= htmlspecialchars($movie['Title']); ?>">

  <label for="rating">Your Rating (1 to 5):</label>
  <select name="rating" id="rating" required>
    <option value="">Select</option>
    <?php for ($i = 1; $i <= 5; $i++): ?>
      <option value="<?= $i; ?>"><?= $i; ?></option>
    <?php endfor; ?>
  </select>

  <button type="submit">Submit Rating</button>
</form>