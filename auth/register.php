<?php
require "../config.php";

if(isset($_POST['register'])){
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    try {
        $stmt->execute([$username, $email, $password]);
        header("Location: login.php?registered=1");
        exit;
    } catch (PDOException $e) {
        $error = "Email or username already exists.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register - Kaser Diafa</title>
<link rel="stylesheet" href="../style/main.css">
<script src="https://kit.fontawesome.com/4f5f087331.js" crossorigin="anonymous"></script>
</head>
<body>

<?php include "../partials/header.php"; ?>

<main style="min-height: 80vh; display: flex; align-items: center; justify-content: center;">
    <div class="auth-container">
        <div class="auth-form">
            <h2><i class="fas fa-user-plus"></i> Register</h2>
            <form method="POST">
                <div class="form-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" name="register" class="auth-btn">
                    <i class="fas fa-user-plus"></i> Register
                </button>
            </form>
            <?php if(isset($error)) echo "<p class='error-msg'><i class='fas fa-exclamation-triangle'></i> $error</p>"; ?>
            <?php if(isset($_GET['registered'])) echo "<p class='success-msg'><i class='fas fa-check-circle'></i> Registration successful! Please login.</p>"; ?>
            <p class="auth-link">Already have an account? <a href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a></p>
        </div>
    </div>
</main>

<?php include "../partials/footer.php"; ?>

</body>
</html>
