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

        require_once 'app/database.php';
        $db = db_connect();

        // Get average rating
        $stmt = $db->prepare("SELECT AVG(rating) as avg_rating FROM Movie_Ratings WHERE movie = ?");
        $stmt->execute([$movie['Title']]);
        $avg = $stmt->fetch(PDO::FETCH_ASSOC);
        $average_rating = $avg['avg_rating'] ? number_format($avg['avg_rating'], 1) : null;

        // Get all user ratings for this movie
        $stmt = $db->prepare("SELECT username, rating FROM Movie_Ratings WHERE movie = ?");
        $stmt->execute([$movie['Title']]);
        $user_ratings = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //AI review for each user rating
        $review = $this->generateMovieReview($movie['Title'],$userRating);

       
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
    
    private function generateMovieReview($movieTitle,$userRating) {
        $apiKey =$_ENV['GEMINI']; // Replace with your actual key or use 
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=" . $apiKey;

        $data = [
            "contents" => [
                [
                    "parts" => [
                        [
                            "text" => "Give a short review of the movie titled '{$movieTitle}' with an average rating of '{$userRating}' make sure to stay in character as a regular google review so no let me generate that or heres a short review."
                        ]
                    ]
                ]
            ]
        ];

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'X-goog-api-key: ' . $apiKey
        ]);

        $response = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($response, true);

        return $result['candidates'][0]['content']['parts'][0]['text'] ?? "No review available.";
    }

}