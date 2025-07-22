<h1><?= $movie['Title'] ?> (<?= $movie['Year'] ?>)</h1>
<img src="<?= $movie['Poster'] ?>" alt="Poster" width="200">

<p><strong>Year:</strong> <?= htmlspecialchars($movie['Year']) ?></p>
<p><strong>Genre:</strong> <?= htmlspecialchars($movie['Genre']) ?></p>
<p><strong>Plot:</strong> <?= htmlspecialchars($movie['Plot']) ?></p>
<p><strong>Actors:</strong> <?= htmlspecialchars($movie['Actors']) ?></p>

<?php if (isset($average_rating)): ?>
    <p><strong>Average Rating:</strong> <?= $average_rating ?>/5</p>
<?php else: ?>
    <p><strong>Average Rating:</strong> No ratings yet.</p>
<?php endif; ?>

<?php if (isset($_SESSION['username'])): ?>
    <form method="post" action="/omdb/rate">
        <input type="hidden" name="movie" value="<?= htmlspecialchars($movie['Title']) ?>">
        <label for="rating">Rate this movie:</label>
        <select name="rating" id="rating" required>
            <option value="">--Choose--</option>
            <?php for ($i = 1; $i <= 5; $i++): ?>
                <option value="<?= $i ?>"><?= $i ?></option>
            <?php endfor; ?>
        </select>
        <button type="submit">Submit Rating</button>
    </form>
<?php else: ?>
    <p><em>Login to rate this movie.</em></p>
<?php endif; ?>