<?php
session_start();

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';
    if ($login == 'manager' && $password == '1') {
        $_SESSION['user'] = 'manager';
        $_SESSION['role'] = 'manager';
        header('Location: index.php');
        exit;
    } elseif ($login == 'accountant' && $password == '1') {
        $_SESSION['user'] = 'accountant';
        $_SESSION['role'] = 'accountant';
        header('Location: index.php');
        exit;
    } elseif ($login == 'admin' && $password == '1') {
        $_SESSION['user'] = 'admin';
        $_SESSION['role'] = 'admin';
        header('Location: index.php');
        exit;
    } else {
        $error = "Неверный логин или пароль";
    }
}

$is_logged_in = isset($_SESSION['user']);
$user_role = $_SESSION['role'] ?? '';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ООО Рога и Копыта</title>
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
        .main-content {
            min-height: 60vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .download-btn {
            margin: 10px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">ООО Рога и Копыта</a>
            <div class="navbar-nav ms-auto">
                <?php if ($is_logged_in): ?>
                    <a class="nav-link" href="?logout=1">Выйти</a>
                <?php else: ?>
                    <a class="nav-link" href="login.php">Авторизация</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <div class="container">
        <?php if ($is_logged_in): ?>
            <div class="main-content">
                <?php if ($user_role === 'manager'): ?>
                    <h1 class="text-center text-primary">Для менеджеров</h1>
                    <p class="text-center">Добро пожаловать в панель управления менеджера</p>
                    <div class="text-center">
                        <a href="report.pdf" class="btn btn-primary download-btn" download>Скачать отчет (PDF)</a>
                        <a href="data.xlsx" class="btn btn-primary download-btn" download>Скачать данные (XLSX)</a>
                    </div>
                <?php elseif ($user_role === 'accountant'): ?>
                    <h1 class="text-center text-success">Для бухгалтеров</h1>
                    <p class="text-center">Добро пожаловать в панель управления бухгалтера</p>
                    <div class="text-center">
                        <a href="report.pdf" class="btn btn-primary download-btn" download>Скачать отчет (PDF)</a>
                        <a href="data.xlsx" class="btn btn-primary download-btn" download>Скачать данные (XLSX)</a>
                    </div>
                <?php elseif ($user_role === 'admin'): ?>
                    <h1 class="text-center text-danger">Для администраторов</h1>
                    <p class="text-center">Добро пожаловать в панель управления администратора</p>
                    <div class="text-center">
                        <a href="report.pdf" class="btn btn-primary download-btn" download>Скачать отчет (PDF)</a>
                        <a href="data.xlsx" class="btn btn-primary download-btn" download>Скачать данные (XLSX)</a>
                    </div>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="main-content">
                <h1 class="text-center">Добро пожаловать в ООО Рога и Копыта</h1>
                <p class="text-center text-muted">Для доступа к системе необходима авторизация</p>
                <div class="text-center mt-4">
                    <a href="login.php" class="btn btn-primary btn-lg">Войти в систему</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <div class="container">
            <p>© 2025 ООО Рога и Копыта. Все права защищены.</p>
        </div>
    </footer>
</body>
</html>
