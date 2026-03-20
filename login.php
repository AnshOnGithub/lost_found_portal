<!DOCTYPE html>
<html lang="en">

<head>
    <title>Lost and Found Login</title>

    <style>
        body {
            font-family: Arial, sans-serif, verdana;
            background: #5e9cffff;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            background: #fff;
            padding: 30px;
            width: 320px;
            border-radius: 6px;
            text-align: center;
        }

        .login-box h2 {
            margin-bottom: 5px;
            color: #333;
            font-size: 22px;
        }

        .login-box .subtitle {
            font-size: 14px;
            color: #666;
            margin-bottom: 20px;
        }

        .login-box input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
            box-sizing: border-box;
        }

        .login-box button {
            width: 100%;
            padding: 10px;
            background: #2575fc;
            border: none;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .login-box button:hover {
            background: #1a5fd0;
        }

        .logo {
            width: 120px;
            display: block;
            margin: 0 auto 15px auto;
        }

        .signup-text {
            margin-top: 20px;
            font-size: 14px;
            color: #555;
        }

        .signup-text a {
            color: #2575fc;
            text-decoration: none;
            font-weight: bold;
        }

        .signup-text a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="login-box">
        <img src="images/logo.png" class="logo" alt="XIM Logo">
        <h2>Welcome to Lost and Found Portal</h2>
        <div class="subtitle">Enter details below</div>

        <form action='php/login_user.php' method='POST'>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>

        <div class="signup-text">
            Don't have an account? <a href="register.php">Sign up</a>
        </div>
    </div>

</body>

</html>