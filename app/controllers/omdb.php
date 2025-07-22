<?php

class omdb extends Controller {
    public function index() {
        
        header("Location: /");
        exit;
    }

    public function search() {
        if (!isset($_GET['title']) || empty(trim($_GET['title']))) {
            die("Please enter a movie title.");
        }

        $title = urlencode(trim($_GET['title']));
        $apiKey = $_ENV['omdb_key'];
        $query_url = "http://www.omdbapi.com/?apikey=$apiKey&t=$title";

        $json = file_get_contents($query_url);
        $phpObj = json_decode($json);

        if (!$phpObj || $phpObj->Response === "False") {
            die("Movie not found.");
        }

        $movie = (array) $phpObj;

        // Fetch average rating
        require_once 'app/database.php';
        $db = db_connect();
        $stmt = $db->prepare("SELECT AVG(rating) as avg_rating FROM Movie_Ratings WHERE movie = ?");
        $stmt->execute([$movie['Title']]);
        $avg = $stmt->fetch(PDO::FETCH_ASSOC);
        $average_rating = $avg['avg_rating'] ? number_format($avg['avg_rating'], 1) : null;

        // Pass to view
        require 'app/views/home/movie.php';
    }


    public function rate() {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../database.php';

            $username = $_SESSION['username'] ?? null;
            $movie = $_POST['movie'] ?? '';
            $rating = intval($_POST['rating'] ?? 0);

            if (!$username) {
                die("You must be logged in to rate movies.");
            }

            if (!$movie || $rating < 1 || $rating > 5) {
                die("Invalid movie title or rating.");
            }

            try {
                $db = db_connect();
                $stmt = $db->prepare("REPLACE INTO Movie_Ratings (username, movie, rating) VALUES (?, ?, ?)");
                $stmt->execute([$username, $movie, $rating]);

                header("Location: /omdb/search?title=" . urlencode($movie));
                exit;
            } catch (PDOException $e) {
                die("Database error: " . $e->getMessage());
            }
        }

        die("Invalid request");
    }

}