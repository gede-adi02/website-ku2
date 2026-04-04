<?php
session_start();
require 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $identifier = $_POST['identifier'];
    $password   = $_POST['password'];

    $user = login($identifier, $password);

    if ($user) {
        $_SESSION['username'] = $user['username'];
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<script>alert('Username/Email atau Password salah!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <style>
        * {
            margin: 0; padding: 0; box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #DADADA;
            display: flex; justify-content: center; align-items: center;
            min-height: 100vh; padding: 20px;
        }

        .signin-container {
            background-color: #A7AFED;
            width: 100%; max-width: 450px;
            padding: 50px 40px; border-radius: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            text-align: center;
        }

        .logo {
            font-size: 24px; font-weight: bold; margin-bottom: 40px;
            text-transform: uppercase; letter-spacing: 2px;
        }

        .signin-title {
            font-size: 28px; text-align: left; margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px; text-align: left;
        }

        .form-group label {
            display: block; font-size: 14px; margin-bottom: 8px; font-weight: 500;
        }

        .form-group input {
            width: 100%; padding: 15px;
            background-color: #D9D9D9; /* Abu-abu input sesuai gambar */
            border: none; border-radius: 10px; font-size: 14px; outline: none;
        }

        .form-group input:focus {
            outline: 2px solid #333852;
        }

        .btn-signin {
            width: 100%; padding: 15px;
            background-color: #333852;
            color: white; border: none; border-radius: 12px;
            font-size: 16px; font-weight: bold; cursor: pointer;
            margin-top: 10px; transition: 0.3s;
        }

        .btn-signin:hover {
            background-color: #2D3250;
        }

        .footer-link {
            margin-top: 30px; font-size: 13px;
        }

        .footer-link a {
            color: #0000FF; text-decoration: none; font-weight: bold;
        }

        /* --- CSS BARU UNTUK LOGO UNIVERSITAS --- */
        .logo-container {
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
        }

        .university-logo {
            max-width: 130px;
            height: auto;
            object-fit: contain;
        }
        
    </style>
</head>
<body>

    <div class="signin-container">
        <div class="logo-container">
            <img src="../website-ku/assets-html/image/universitas.png" alt="Logo UHN Sugriwa" class="university-logo">
        </div>
        <h2 class="signin-title">Sign In</h2>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <label for="identifier">Email or Username</label>
                <input type="text" id="identifier" name="identifier" placeholder="Enter Email or Username" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter Password" required>
            </div>

            <button type="submit" class="btn-signin">Sign In</button>
        </form>

        <p class="footer-link">
            Don't have an account? <a href="signup.php">Sign Up Here</a>
        </p>
    </div>

</body>
</html>