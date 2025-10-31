<?php
// users.php - maneja GET /users y POST /users
header('Content-Type: text/html; charset=utf-8');

$db_host = getenv('DB_HOST') ?: 'db';
$db_name = getenv('DB_NAME') ?: 'appdb';
$db_user = getenv('DB_USER') ?: 'appuser';
$db_pass = getenv('DB_PASS') ?: 'apppassword';
$db_port = getenv('DB_PORT') ?: '3306';

function getPdo($host, $port, $db, $user, $pass) {
    $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";
    try {
        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
        return $pdo;
    } catch (PDOException $e) {
        http_response_code(500);
        echo "<h1>Error de conexión a la base de datos</h1>";
        echo "<pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
        exit;
    }
}

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
        // mostrar lista de usuarios
        $pdo = getPdo($db_host, $db_port, $db_name, $db_user, $db_pass);
        $stmt = $pdo->query('SELECT id, nombre, email FROM users');
        $users = $stmt->fetchAll();

        ?>
        <!doctype html>
        <html lang="es">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width,initial-scale=1">
            <title>Lista de usuarios</title>
            <link rel="stylesheet" href="/styles.css">
        </head>
        <body>
            <main class="container">
                <header class="header">
                    <h1>Lista de usuarios</h1>
                    <p class="subtitle">Usuarios registrados en la base de datos</p>
                </header>

                <section class="card">
                    <div class="actions">
                        <a class="btn" href="/">Volver</a>
                        <a class="btn primary" href="/">Agregar usuario</a>
                    </div>

                    <?php if (!$users): ?>
                        <p>No hay usuarios.</p>
                    <?php else: ?>
                        <table class="table">
                            <thead><tr><th>ID</th><th>Nombre</th><th>Email</th></tr></thead>
                            <tbody>
                            <?php foreach ($users as $u): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($u['id']); ?></td>
                                    <td><?php echo htmlspecialchars($u['nombre']); ?></td>
                                    <td><?php echo htmlspecialchars($u['email']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </section>

                <footer class="footer">&copy; Proyecto Docker — PHP + MySQL</footer>
            </main>
        </body>
        </html>
        <?php
        exit;
}

if ($method === 'POST') {
    // insertar nuevo usuario
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';

    if ($name === '' || $email === '') {
        http_response_code(400);
        echo "<p>Nombre y email son requeridos.</p>";
        exit;
    }

    $pdo = getPdo($db_host, $db_port, $db_name, $db_user, $db_pass);
    $stmt = $pdo->prepare('INSERT INTO users (nombre, email) VALUES (:nombre, :email)');
    try {
        $stmt->execute([':nombre' => $name, ':email' => $email]);
        header('Location: /users.php');
        exit;
    } catch (PDOException $e) {
        http_response_code(500);
        echo "<h1>Error al insertar</h1>";
        echo "<pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
        exit;
    }
}

// Fallback
http_response_code(405);
echo "Método no permitido";

?>
