<?php
// index.php - página principal con UI sencilla
header('Content-Type: text/html; charset=utf-8');
?>
<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Usuarios - PHP + MySQL</title>
	<link rel="stylesheet" href="/styles.css">
</head>
<body>
	<main class="container">
		<header class="header">
			<h1>Administración de Usuarios</h1>
			<p class="subtitle">Proyecto Docker — PHP + MySQL</p>
		</header>

		<section class="card">
			<h2>Agregar usuario</h2>
			<form method="post" action="/users.php" class="form">
				<label>Nombre
					<input name="name" required placeholder="Ej. Ana López">
				</label>
				<label>Email
					<input name="email" type="email" required placeholder="ejemplo@dominio.com">
				</label>
				<div class="actions">
					<button class="btn primary" type="submit">Agregar</button>
					<a class="btn" href="/users.php">Ver lista de usuarios</a>
				</div>
			</form>
		</section>

		<footer class="footer">Puerto: <strong><?php echo htmlspecialchars(getenv('HOST_PORT') ?: '8081'); ?></strong></footer>
	</main>
</body>
</html>

