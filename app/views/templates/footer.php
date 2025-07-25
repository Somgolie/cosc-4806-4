<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>COSC 4806 Portal</title>

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

  <!-- Custom Styles -->
  <style>
    :root {
      --cream: #f5f5dc;
      --black: #000000;
    }

    body {
      background-color: var(--cream);
      color: var(--cream);
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    a {
      color: var(--cream);
      text-decoration: underline;
    }

    a:hover {
      color: #cccccc;
    }

    .main-content {
      flex: 1;
    }

    footer {
      background-color: #111;
      color: var(--cream);
    }

    .footer-links a {
      color: var(--cream);
      margin: 0 10px;
      text-decoration: underline;
    }

    .footer-links a:hover {
      color: #ccc;
    }
  </style>
</head>
<body>

<div class="main-content">
  <div class="container py-5">
    <!-- Dynamic page content goes here -->
  </div>
</div>

<footer class="py-4 text-center">
  <div class="container">
    <div class="footer-links mb-2">
      <a href="#">Contact</a> |
      <a href="#">Privacy Policy</a> |
      <a href="#">Help Center</a>
    </div>
    <p class="mb-0">&copy; <?= date('Y') ?> COSC 4806 Student Portal. All rights reserved.</p>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
