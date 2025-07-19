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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="/favicon.png">
    <title>COSC 4806</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
</head>
<body>

  <nav class="navbar navbar-expand-lg" style="background-color: #87CEEB; padding: 1rem 1.5rem;">
    <div class="container-fluid">
      <a class="navbar-brand text-white fw-bold fs-4" href="#">COSC 4806</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
              data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
              aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Navigation -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 fs-5">
          <li class="nav-item"><a class="nav-link text-white" href="/home">Home</a></li>
          <li class="nav-item"><a class="nav-link text-white" href="/about">About Me</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" 
               data-bs-toggle="dropdown" aria-expanded="false">Actions</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">empty</a></li>
              <li><a class="dropdown-item" href="#">empty</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="/reminders">Reminder List</a></li>
            </ul>
          </li>
          <li class="nav-item"><a class="nav-link text-white" href="/reminders">Reminder List</a></li>
        </ul>

        <!-- Right Side Buttons -->
        <ul class="navbar-nav ms-auto align-items-center">
          <?php if (isset($_SESSION['username']) && strtolower($_SESSION['username']) === 'admin'): ?>
            <li class="nav-item me-3">
              <a href="/reports" class="btn btn-outline-light px-4 py-2">Reports</a>
            </li>
          <?php endif; ?>
          <li class="nav-item">
            <a href="/logout" class="btn btn-danger px-4 py-2">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
