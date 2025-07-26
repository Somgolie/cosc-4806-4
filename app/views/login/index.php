<?php require_once 'app/views/templates/headerPublic.php' ?>

<style>

	.login-card {
		max-width: 550px;
		margin: 60px auto;
		background-color: #fffef5;
		border-radius: 1rem;
		box-shadow: 0 8px 20px rgba(0,0,0,0.15);
		padding: 2rem;
	}
	.login-card h1 {
		font-weight: bold;
		margin-bottom: 1rem;
	}
	.btn-lg {
		padding: 0.75rem 1.5rem;
		font-size: 1.1rem;
	}
</style>

<main role="main" class="container">
	<div class="login-card">
		<h1 class="text-center text-dark mb-4">
			<i class="bi bi-lock-fill me-2"></i>You are not logged in
		</h1>

		<?php if (!empty($data['message'])): ?>
			<div class="alert alert-danger text-center">
				<?= htmlspecialchars($data['message']); ?>
			</div>
		<?php endif; ?>

		<form action="/login/verify" method="post" class="mb-3">
			<div class="mb-3">
				<label for="username" class="form-label"><i class="bi bi-person-fill"></i> Username</label>
				<input required type="text" class="form-control" name="username" id="username" placeholder="Enter username">
			</div>

			<div class="mb-4">
				<label for="password" class="form-label"><i class="bi bi-shield-lock-fill"></i> Password</label>
				<input required type="password" class="form-control" name="password" id="password" placeholder="Enter password">
			</div>

			<div class="d-grid gap-2 mb-2">
				<button type="submit" class="btn btn-primary btn-lg"><i class="bi bi-box-arrow-in-right"></i> Login</button>
				<a href="/signup" class="btn btn-success btn-lg"><i class="bi bi-person-plus-fill"></i> Create Account</a>
			</div>
		</form>

		<form method="post" action="/login/guest" class="text-center">
			<button type="submit" class="btn btn-outline-secondary btn-sm"><i class="bi bi-eye-fill"></i> Continue as Guest</button>
		</form>
	</div>
</main>
