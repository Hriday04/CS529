<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Hriday Raj</title>
    <link rel="stylesheet" href="/github/styles.css">
</head>
<body class="login-page">
    <div class="login-box">
        <h2>Login</h2>

        <?php if (isset($_GET['error'])): ?>
            <div style="margin-bottom: 1rem; color: #ff6666; background: rgba(240, 84, 84, 0.1); padding: 0.75rem; border-radius: 5px;">
                <?php
                    switch ($_GET['error']) {
                        case 'wrong_password':
                            echo "Incorrect password.";
                            break;
                        case 'user_not_found':
                            echo "No user found with that username.";
                            break;
                        case 'missing':
                            echo "Please fill in both fields.";
                            break;
                        default:
                            echo "Login failed.";
                    }
                ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="auth.php">
            <input type="text" name="username" placeholder="Username" required /><br/>
            <input type="password" name="password" placeholder="Password" required /><br/>
            <button type="submit">Login</button>
        </form>

        <div style="margin-top: 2rem;">
            <a href="/github/index.php" class="resume-button">Back to Home</a>
        </div>
    </div>
</body>
</html>
