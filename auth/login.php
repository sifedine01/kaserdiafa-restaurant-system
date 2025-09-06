<?php
require "../config.php";

if(isset($_POST['login'])){
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if($user && password_verify($password, $user['password'])){
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['is_admin'] = $user['is_admin'];
        header("Location: ../order.php");
        exit;
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Kaser Diafa</title>
<link rel="stylesheet" href="../style/main.css">
<script src="https://kit.fontawesome.com/4f5f087331.js" crossorigin="anonymous"></script>
</head>
<body>

<?php include "../partials/header.php"; ?>

<main style="min-height: 80vh; display: flex; align-items: center; justify-content: center;">
    <div class="auth-container">
        <div class="auth-form">
            <h2><i class="fas fa-sign-in-alt"></i> Login</h2>
            <form method="POST">
                <div class="form-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" name="login" class="auth-btn">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </form>
            <?php if(isset($error)) echo "<p class='error-msg'><i class='fas fa-exclamation-triangle'></i> $error</p>"; ?>
            <p class="auth-link">No account? <a href="register.php"><i class="fas fa-user-plus"></i> Register</a></p>
        </div>
    </div>
</main>

<?php include "../partials/footer.php"; ?>

</body>
</html>
