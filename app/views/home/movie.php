<div class="movie-container">
<h1><?= $movie['Title'] ?> (<?= $movie['Year'] ?>)</h1>

<img src="<?= $movie['Poster'] ?>" alt="Poster" width="200">

<p><strong>Genre:</strong> <?= htmlspecialchars($movie['Genre']) ?></p>
<p><strong>Plot:</strong> <?= htmlspecialchars($movie['Plot']) ?></p>
<p><strong>Actors:</strong> <?= htmlspecialchars($movie['Actors']) ?></p>

<?php if (isset($average_rating)): ?>
    <p><strong>Average Rating:</strong> <?= $average_rating ?>/5</p>
<?php else: ?>
    <p><strong>Average Rating:</strong> No ratings yet.</p>
<?php endif; ?>



<?php if (!empty($review)): ?>
    <h3>AI Review:</h3>
    <p><?= nl2br(htmlspecialchars($review)) ?></p>
<?php else: ?>
    <p><em>No AI review available.</em></p>
<?php endif; ?>

<h3>User Ratings:</h3>
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


<?php if (!empty($user_ratings)): ?>
    <ul>
        <?php foreach ($user_ratings as $ur): ?>
            <li><?= htmlspecialchars($ur['username']) ?> rated: <?= htmlspecialchars($ur['rating']) ?>/5</li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No user ratings yet.</p>
<?php endif; ?>

</div>