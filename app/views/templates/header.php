<?php
session_start();
if (!isset($_SESSION['auth'])) {
    header('Location: /login');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>COSC 4806</title>
  <link rel="icon" href="/favicon.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <style>
    :root {
      --cream: #f5f5dc;
      --black: #000000;
    }

    body {
      background-color: var(--black);
      color: var(--cream);
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    .navbar-custom {
      background-color: var(--black);
    }

    .navbar-brand,
    .nav-link,
    .dropdown-item {
      color: var(--cream) !important;
    }

    .nav-link:hover,
    .dropdown-item:hover {
      text-decoration: underline;
      background-color: #1a1a1a;
    }

    .btn-outline-light {
      color: var(--cream);
      border-color: var(--cream);
    }

    .btn-outline-light:hover {
      background-color: var(--cream);
      color: var(--black);
    }

    .btn-danger {
      background-color: #8b0000;
      border: none;
    }

    .dropdown-menu {
      background-color: var(--black);
    }
    .card-text {
      color: #f8f9fa !important; 
    }
  </style>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-custom shadow-sm">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold fs-4" href="/home">
        <i class="bi bi-film"></i> Movie Hunter
      </a>
      <button class="navbar-toggler border-white" type="button" data-bs-toggle="collapse" 
              data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" 
              aria-label="Toggle navigation">
        <span class="navbar-toggler-icon text-white"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 fs-5">
          <li class="nav-item"><a class="nav-link" href="/home">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="/about">About Me</a></li>
        </ul>
        <ul class="navbar-nav ms-auto align-items-center">
          <li class="nav-item">
            <a href="/logout" class="btn btn-danger">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container py-5"><!-- open main content container -->
