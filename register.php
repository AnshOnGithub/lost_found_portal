<!DOCTYPE html>
<html lang="en">

<head>
    <title>Lost and Found - Sign Up</title>

    <style>
        body {
            font-family: Arial, sans-serif, verdana;
            background: #5e9cffff;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .signup-box {
            background: #fff;
            padding: 30px;
            width: 320px;
            border-radius: 6px;
            text-align: center;
        }

        .signup-box h2 {
            margin-bottom: 5px;
            color: #333;
            font-size: 22px;
        }

        .signup-box .subtitle {
            font-size: 14px;
            color: #666;
            margin-bottom: 20px;
        }

        .signup-box input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
            box-sizing: border-box;
        }

        .signup-box button {
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

        .signup-box button:hover {
            background: #1a5fd0;
        }

        .logo {
            width: 120px;
            display: block;
            margin: 0 auto 15px auto;
        }

        .login-text {
            margin-top: 20px;
            font-size: 14px;
            color: #555;
        }

        .login-text a {
            color: #2575fc;
            text-decoration: none;
            font-weight: bold;
        }

        .login-text a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="signup-box">
        <img src="images/logo.png" class="logo" alt="XIM Logo">
        <h2>Create Account</h2>
        <div class="subtitle">Join the Lost and Found Portal</div>

        <form action='php/register_user.php' method='POST' onsubmit='return validateForm()'>
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" id="password" placeholder="Create Password" required>
            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password"
                required>
            <button type="submit">Register</button>
        </form>

        <script>
            function validateForm() {
                var email = document.getElementsByName('email')[0].value;
                var password = document.getElementById('password').value;
                var confirmPassword = document.getElementById('confirm_password').value;

                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                var passRegex = /^.{6,}$/;

                if (!emailRegex.test(email)) {
                    alert("Please enter a valid email address.");
                    return false;
                }
                if (!passRegex.test(password)) {
                    alert("Password must be at least 6 characters long.");
                    return false;
                }
                if (password !== confirmPassword) {
                    alert("Passwords do not match.");
                    return false;
                }
                return true;
            }
        </script>

        <div class="login-text">
            Already have an account? <a href="login.php">Login here</a>
        </div>
    </div>

</body>

</html>