<?php require_once 'app/views/templates/header.php'; ?>

<style>
  body {
    background-color: #fefae0; /* cream */
    font-family: 'Segoe UI', sans-serif;
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
    max-width: 500px;
    margin: 0 auto;
  }

  .search-bar input {
    border-radius: 0;
    border: 2px solid #000;
  }

  .search-bar button {
    border-radius: 0;
    background-color: #000;
    color: #fff;
    border: 2px solid #000;
  }

  .search-bar button:hover {
    background-color: #222;
  }
</style>

<div class="container hero-center">
  <h1>Movie Lookup</h1>
  <p>Find ratings, details, and AI-generated reviews for any film!</p>

    <form action="/omdb/search" method="get" class="d-flex justify-content-center my-4">
      <input 
        type="text" 
        name="title" 
        class="form-control form-control-lg rounded-pill me-2" 
        placeholder="Search for a movie..." 
        style="max-width: 400px;"
        required
      >
      <button class="btn btn-outline-light rounded-pill" type="submit">Search</button>
    </form>
</div>

<?php require_once 'app/views/templates/footer.php'; ?>
