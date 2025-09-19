<?php
session_start();

if (isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';
    if ($login === 'manager' && $password === '1') {
        $_SESSION['user'] = 'manager';
        $_SESSION['role'] = 'manager';
        header('Location: index.php');
        exit;
    } elseif ($login === 'accountant' && $password === '1') {
        $_SESSION['user'] = 'accountant';
        $_SESSION['role'] = 'accountant';
        header('Location: index.php');
        exit;
    } elseif ($login === 'admin' && $password === '1') {
        $_SESSION['user'] = 'admin';
        $_SESSION['role'] = 'admin';
        header('Location: index.php');
        exit;
    } else {
        $error = "Неверный логин или пароль";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация - ООО Рога и Копыта</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .auth-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 30px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .back-link {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">ООО Рога и Копыта</a>
        </div>
    </nav>
    <div class="container">
        <div class="auth-container">
            <a href="index.php" class="back-link">← На главную</a>
            <h2 class="text-center mb-4">Авторизация</h2>
            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <form method="POST" action="login.php">
                <div class="mb-3">
                    <label for="login" class="form-label">Логин:</label>
                    <input type="text" class="form-control" id="login" name="login" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Пароль:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Войти</button>
            </form>
            <div class="mt-3 p-3 bg-light rounded">
                <small class="text-muted">
                    <strong>Тестовые данные:</strong><br>
                    Менеджер: login: manager, password: 1<br>
                    Бухгалтер: login: accountant, password: 1<br>
                    Администратор: login: admin, password: 1
                </small>
            </div>
        </div>
    </div>
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <div class="container">
            <p>© 2025 ООО Рога и Копыта. Все права защищены.</p>
        </div>
    </footer>
</body>
</html>
