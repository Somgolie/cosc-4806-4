<?php require_once 'app/views/templates/header.php'; ?>

<style>
  html, body {
    height: 100%;
    margin: 0;
  }
  body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    background-color: #fefae0; /* cream */
    font-family: 'Segoe UI', sans-serif;
  }

  .container {
    flex: 1 0 auto; 
  }

  footer {
    flex-shrink: 0; 
  }

  .black-text{
    color: #000;
  }

  .hero-center {
    text-align: center;
    padding: 100px 20px 60px;
  }

  .hero-center h1 {
    font-size: 3.5rem;
    color: #111;
    font-weight: bold;
  }

  .hero-center p {
    font-size: 1.2rem;
    color: #333;
    margin-top: 10px;
    margin-bottom: 40px;
  }

  .search-bar {
    max-width: 600px;
    margin: 0 auto;
  }

  .search-bar input.form-control {
    border-radius: 50px;
    border: 2px solid #000;
    padding: 0.75rem 1.5rem;
  }

  .search-bar button.btn {
    border-radius: 50px;
    padding: 0.75rem 1.5rem;
    background-color: #000;
    color: #fff;
    border: 2px solid #000;
    transition: background-color 0.3s ease;
  }

  .search-bar button.btn:hover {
    background-color: #333;
  }
</style>

<div class="container hero-center">
  <h1>Movie Hunter</h1>
  <h5 class="black-text">
    Welcome, <?= isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Guest' ?>!
  </h5>
  <p>Find ratings, details, and reviews for (almost) any film!</p>

  <form action="/omdb/search" method="get" class="search-bar d-flex">
    <div class="col-12 d-flex justify-content-center">
      <input 
        type="text" 
        name="title" 
        class="form-control me-2"
        placeholder="Search for a movie..." 
        required
      >
    </div>
    <button type="submit" class="btn">Search</button>
  </form>
</div>

<?php require_once 'app/views/templates/footer.php'; ?>
