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

        require_once 'app/views/home/movie.php';
    }
}