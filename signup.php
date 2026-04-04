<?php
require 'functions.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (register($_POST)) {
        echo "<script>
                alert('Registrasi Berhasil! Silakan Login.');
                window.location.href = 'signin.php';
              </script>";
    } else {
        echo "<script>
                alert('Registrasi Gagal! Username atau Email mungkin sudah terdaftar.');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        * {
            margin: 0; padding: 0; box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            background-color: #DADADA;
            display: flex; justify-content: center; align-items: center;
            min-height: 100vh; padding: 20px;
        }

        .signup-container {
            background-color: #A7AFED;
            width: 100%; max-width: 450px;
            padding: 50px 40px; border-radius: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            text-align: center;
        }

        .logo { font-size: 24px; font-weight: bold; margin-bottom: 30px; }
        .signup-title { font-size: 28px; text-align: left; margin-bottom: 20px; }

        .form-group { margin-bottom: 15px; text-align: left; }
        .form-group label { display: block; font-size: 14px; margin-bottom: 5px; font-weight: 500; }
        
        .form-group input {
            width: 100%; padding: 12px;
            background-color: #D9D9D9;
            border: none; border-radius: 10px; outline: none;
        }

        .btn-signup {
            width: 100%; padding: 15px;
            background-color: #333852;
            color: white; border: none; border-radius: 12px;
            font-size: 16px; font-weight: bold; cursor: pointer;
            margin-top: 15px;
        }

        .login-link { margin-top: 25px; font-size: 13px; }
        .login-link a { color: blue; text-decoration: none; font-weight: bold; }

        .debug-box {
            background: white; padding: 10px; border-radius: 8px;
            margin-bottom: 15px; text-align: left; font-size: 12px;
            border-left: 4px solid #333852;
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

    <div class="signup-container">
        <div class="logo-container">
            <img src="../website-ku/assets-html/image/universitas.png" alt="Logo UHN Sugriwa" class="university-logo">
        </div>
        <h2 class="signup-title">Sign Up</h2>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Username" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="Email" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>

            <button type="submit" class="btn-signup">Sign Up</button>
        </form>

        <p class="login-link">Already have an account? <a href="signin.php">Sign In Here</a></p>
    </div>

</body>
</html>